<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Helpers\CartHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartHelper::items();
        if ($cartItems->isEmpty()) return redirect()->route('cart')->with('error', 'Your cart is empty.');
        
        $customer = auth()->guard('customer')->user();
        $addresses = $customer->addresses;
        $subtotal = CartHelper::subtotal();
        $discount = CartHelper::discount();
        $coupon = CartHelper::appliedCoupon();
        $deliveryCharge = $subtotal > (int) \App\Helpers\SettingHelper::get('free_delivery_above', 5000) ? 0 : (int) \App\Helpers\SettingHelper::get('inside_dhaka_charge', 60);
        $total = $subtotal - $discount + $deliveryCharge;
        
        return view('frontend.checkout.index', compact('cartItems', 'addresses', 'subtotal', 'discount', 'coupon', 'deliveryCharge', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:customer_addresses,id',
            'payment_method' => 'required|in:cod,bkash,nagad',
            'transaction_id' => 'nullable|string',
            'customer_note' => 'nullable|string',
        ]);

        $cartItems = CartHelper::items();
        if ($cartItems->isEmpty()) return back()->with('error', 'Cart is empty.');

        DB::beginTransaction();
        try {
            $subtotal = CartHelper::subtotal();
            $discount = CartHelper::discount();
            $coupon = CartHelper::appliedCoupon();
            $deliveryCharge = $subtotal > (int) \App\Helpers\SettingHelper::get('free_delivery_above', 5000) ? 0 : (int) \App\Helpers\SettingHelper::get('inside_dhaka_charge', 60);
            $total = $subtotal - $discount + $deliveryCharge;

            $order = Order::create([
                'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6)),
                'customer_id' => auth()->guard('customer')->id(),
                'address_id' => $request->address_id,
                'coupon_id' => $coupon ? $coupon->id : null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'delivery_charge' => $deliveryCharge,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'pending',
                'order_status' => 'pending',
                'transaction_id' => $request->transaction_id,
                'customer_note' => $request->customer_note,
            ]);

            foreach ($cartItems as $item) {
                $price = $item->product->final_price;
                if ($item->variant) $price += $item->variant->additional_price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_image' => $item->product->thumbnail,
                    'variant_details' => $item->variant ? $item->variant->variant_type . ': ' . $item->variant->variant_value : null,
                    'quantity' => $item->quantity,
                    'unit_price' => $price,
                    'subtotal' => $price * $item->quantity,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
                $item->product->increment('total_sold', $item->quantity);
            }

            if ($coupon) $coupon->increment('used_count');

            CartHelper::clear();
            DB::commit();
            return redirect()->route('order.success', $order);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function success(Order $order)
    {
        $order->load(['items', 'address']);
        return view('frontend.checkout.success', compact('order'));
    }
}
