<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = ['customer_id', 'full_name', 'phone', 'email', 'division', 'district', 'upazila', 'address_line', 'postal_code', 'is_default', 'type'];
    protected $casts = ['is_default' => 'boolean'];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function orders() { return $this->hasMany(Order::class, 'address_id'); }
}
