<?php
namespace App\Helpers;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartHelper
{
    public static function sessionId()
    {
        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', uniqid('cart_', true));
        }
        return Session::get('cart_session_id');
    }

    public static function items()
    {
        $query = Cart::with(['product.images', 'product.brand', 'product.category', 'variant']);
        if (auth()->guard('customer')->check()) {
            $query->where('customer_id', auth()->guard('customer')->id());
        } else {
            $query->where('session_id', self::sessionId());
        }
        return $query->get();
    }

    public static function count()
    {
        return self::items()->sum('quantity');
    }

    public static function subtotal()
    {
        return self::items()->sum(function ($item) {
            $price = $item->product->final_price;
            if ($item->variant) {
                $price += $item->variant->additional_price;
            }
            return $price * $item->quantity;
        });
    }

    public static function add(Product $product, $variantId = null, $quantity = 1)
    {
        $sessionId = self::sessionId();
        $customerId = auth()->guard('customer')->check() ? auth()->guard('customer')->id() : null;

        $query = Cart::where('product_id', $product->id);
        if ($customerId) {
            $query->where('customer_id', $customerId);
        } else {
            $query->where('session_id', $sessionId);
        }
        if ($variantId) {
            $query->where('variant_id', $variantId);
        }

        $cart = $query->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'customer_id' => $customerId,
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'quantity' => $quantity,
            ]);
        }
    }

    public static function updateQuantity($cartId, $quantity)
    {
        $cart = Cart::findOrFail($cartId);
        if ($quantity > 0) {
            $cart->quantity = $quantity;
            $cart->save();
        } else {
            $cart->delete();
        }
    }

    public static function remove($cartId)
    {
        Cart::where('id', $cartId)->delete();
    }

    public static function clear()
    {
        $query = Cart::query();
        if (auth()->guard('customer')->check()) {
            $query->where('customer_id', auth()->guard('customer')->id());
        } else {
            $query->where('session_id', self::sessionId());
        }
        $query->delete();
    }

    public static function mergeOnLogin($customerId)
    {
        $sessionId = self::sessionId();
        $sessionCarts = Cart::where('session_id', $sessionId)->get();

        foreach ($sessionCarts as $cart) {
            $existing = Cart::where('customer_id', $customerId)
                ->where('product_id', $cart->product_id)
                ->where('variant_id', $cart->variant_id)
                ->first();

            if ($existing) {
                $existing->quantity += $cart->quantity;
                $existing->session_id = $sessionId;
                $existing->save();
                $cart->delete();
            } else {
                $cart->customer_id = $customerId;
                $cart->save();
            }
        }
    }

    public static function appliedCoupon()
    {
        if (Session::has('coupon_code')) {
            return Coupon::where('code', Session::get('coupon_code'))->first();
        }
        return null;
    }

    public static function applyCoupon($code)
    {
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon || !$coupon->isValid()) {
            return ['success' => false, 'message' => 'Invalid or expired coupon code.'];
        }
        $subtotal = self::subtotal();
        if ($subtotal < $coupon->min_order_amount) {
            return ['success' => false, 'message' => 'Minimum order amount is ' . number_format($coupon->min_order_amount, 2) . ' BDT.'];
        }
        Session::put('coupon_code', $coupon->code);
        return ['success' => true, 'message' => 'Coupon applied successfully!', 'code' => $coupon->code];
    }

    public static function removeCoupon()
    {
        Session::forget('coupon_code');
    }

    public static function discount()
    {
        $coupon = self::appliedCoupon();
        if (!$coupon) return 0;
        $subtotal = self::subtotal();
        if ($coupon->type === 'fixed') {
            return min($coupon->value, $subtotal);
        } else {
            $discount = $subtotal * ($coupon->value / 100);
            if ($coupon->max_discount) {
                $discount = min($discount, $coupon->max_discount);
            }
            return $discount;
        }
    }
}
