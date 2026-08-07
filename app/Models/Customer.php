<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'avatar', 'provider', 'provider_id', 'status', 'email_verified_at', 'phone_verified_at'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'phone_verified_at' => 'datetime', 'status' => 'boolean'];

    public function addresses() { return $this->hasMany(CustomerAddress::class); }
    public function orders() { return $this->hasMany(Order::class)->latest(); }
    public function wishlists() { return $this->hasMany(Wishlist::class); }
    public function reviews() { return $this->hasMany(ProductReview::class); }

    public function defaultAddress() { return $this->addresses()->where('is_default', 1)->first(); }
}
