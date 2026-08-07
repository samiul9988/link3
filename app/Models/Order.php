<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'customer_id', 'address_id', 'coupon_id', 'subtotal', 'discount', 'delivery_charge', 'total', 'payment_method', 'payment_status', 'order_status', 'transaction_id', 'customer_note', 'admin_note'];
    protected $casts = ['subtotal' => 'decimal:2', 'discount' => 'decimal:2', 'delivery_charge' => 'decimal:2', 'total' => 'decimal:2'];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function address() { return $this->belongsTo(CustomerAddress::class, 'address_id'); }
    public function coupon() { return $this->belongsTo(Coupon::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}
