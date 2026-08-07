<?php

if (!function_exists('setting')) {
    function setting($key, $default = null) {
        return \App\Helpers\SettingHelper::get($key, $default);
    }
}

if (!function_exists('cart_count')) {
    function cart_count() {
        return \App\Helpers\CartHelper::count();
    }
}

if (!function_exists('cart_subtotal')) {
    function cart_subtotal() {
        return \App\Helpers\CartHelper::subtotal();
    }
}
