<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customer = auth()->guard('customer')->user();
        $totalOrders = $customer->orders()->count();
        $pendingOrders = $customer->orders()->where('order_status', 'pending')->count();
        $deliveredOrders = $customer->orders()->where('order_status', 'delivered')->count();
        $recentOrders = $customer->orders()->take(5)->get();
        return view('frontend.customer.dashboard', compact('totalOrders', 'pendingOrders', 'deliveredOrders', 'recentOrders'));
    }

    public function orders()
    {
        $orders = auth()->guard('customer')->user()->orders()->paginate(10);
        return view('frontend.customer.orders.index', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if ($order->customer_id !== auth()->guard('customer')->id()) abort(403);
        $order->load(['items.product', 'address']);
        return view('frontend.customer.orders.detail', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        if ($order->customer_id !== auth()->guard('customer')->id()) abort(403);
        if (in_array($order->order_status, ['pending', 'confirmed'])) {
            $order->update(['order_status' => 'cancelled']);
            return back()->with('success', 'Order cancelled.');
        }
        return back()->with('error', 'Order cannot be cancelled.');
    }

    public function wishlist()
    {
        $wishlists = Wishlist::with('product.images')->where('customer_id', auth()->guard('customer')->id())->latest()->get();
        return view('frontend.customer.wishlist', compact('wishlists'));
    }

    public function toggleWishlist(Request $request)
    {
        $customerId = auth()->guard('customer')->id();
        $exists = Wishlist::where('customer_id', $customerId)->where('product_id', $request->product_id)->first();
        if ($exists) {
            $exists->delete();
            return response()->json(['success' => true, 'action' => 'removed', 'message' => 'Removed from wishlist.']);
        }
        Wishlist::create(['customer_id' => $customerId, 'product_id' => $request->product_id]);
        return response()->json(['success' => true, 'action' => 'added', 'message' => 'Added to wishlist.']);
    }

    public function profile() { return view('frontend.customer.profile'); }

    public function updateProfile(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email|unique:customers,email,'.auth()->guard('customer')->id(), 'phone' => 'nullable|string|max:20']);
        auth()->guard('customer')->user()->update($request->only('name', 'email', 'phone'));
        return back()->with('success', 'Profile updated.');
    }

    public function addresses()
    {
        $addresses = auth()->guard('customer')->user()->addresses;
        return view('frontend.customer.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate(['full_name' => 'required', 'phone' => 'required', 'division' => 'required', 'district' => 'required', 'address_line' => 'required']);
        $data = $request->all();
        $data['customer_id'] = auth()->guard('customer')->id();
        if ($request->boolean('is_default')) {
            auth()->guard('customer')->user()->addresses()->update(['is_default' => 0]);
        }
        \App\Models\CustomerAddress::create($data);
        return back()->with('success', 'Address added.');
    }

    public function updateAddress(Request $request, $id)
    {
        $address = \App\Models\CustomerAddress::findOrFail($id);
        if ($address->customer_id !== auth()->guard('customer')->id()) abort(403);
        $address->update($request->all());
        return back()->with('success', 'Address updated.');
    }

    public function deleteAddress($id)
    {
        $address = \App\Models\CustomerAddress::findOrFail($id);
        if ($address->customer_id !== auth()->guard('customer')->id()) abort(403);
        $address->delete();
        return back()->with('success', 'Address deleted.');
    }

    public function changePassword(Request $request)
    {
        $request->validate(['current_password' => 'required', 'password' => 'required|string|min:6|confirmed']);
        $customer = auth()->guard('customer')->user();
        if (!Hash::check($request->current_password, $customer->password)) return back()->with('error', 'Current password is incorrect.');
        $customer->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password changed.');
    }

    public function submitReview(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'rating' => 'required|integer|min:1|max:5', 'comment' => 'nullable|string|max:1000']);
        ProductReview::create([
            'customer_id' => auth()->guard('customer')->id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 1,
        ]);
        $avg = ProductReview::where('product_id', $request->product_id)->where('status', 1)->avg('rating');
        $count = ProductReview::where('product_id', $request->product_id)->where('status', 1)->count();
        Product::where('id', $request->product_id)->update(['average_rating' => $avg, 'total_reviews' => $count]);
        return back()->with('success', 'Review submitted.');
    }
}
