<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\CartHelper;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartHelper::items();
        $subtotal = CartHelper::subtotal();
        $discount = CartHelper::discount();
        $coupon = CartHelper::appliedCoupon();
        return view('frontend.cart.index', compact('cartItems', 'subtotal', 'discount', 'coupon'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'variant_id' => 'nullable|exists:product_variants,id', 'quantity' => 'integer|min:1']);
        $product = Product::findOrFail($request->product_id);
        CartHelper::add($product, $request->variant_id, $request->quantity ?? 1);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Added to cart.', 'count' => CartHelper::count()]);
        }
        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request)
    {
        $request->validate(['cart_id' => 'required|exists:carts,id', 'quantity' => 'required|integer|min:1']);
        CartHelper::updateQuantity($request->cart_id, $request->quantity);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'subtotal' => CartHelper::subtotal(), 'count' => CartHelper::count()]);
        }
        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        CartHelper::remove($request->cart_id);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'subtotal' => CartHelper::subtotal(), 'count' => CartHelper::count()]);
        }
        return back()->with('success', 'Item removed.');
    }

    public function applyCoupon(Request $request)
    {
        $result = CartHelper::applyCoupon($request->code);
        if ($request->ajax()) {
            return response()->json($result + ['discount' => CartHelper::discount(), 'subtotal' => CartHelper::subtotal(), 'total' => CartHelper::subtotal() - CartHelper::discount()]);
        }
        if ($result['success']) return back()->with('success', $result['message']);
        return back()->with('error', $result['message']);
    }

    public function removeCoupon(Request $request)
    {
        CartHelper::removeCoupon();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'subtotal' => CartHelper::subtotal()]);
        }
        return back()->with('success', 'Coupon removed.');
    }
}
