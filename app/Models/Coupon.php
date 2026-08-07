<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'min_order_amount', 'max_discount', 'usage_limit', 'used_count', 'starts_at', 'expires_at', 'status'];
    protected $casts = ['value' => 'decimal:2', 'min_order_amount' => 'decimal:2', 'max_discount' => 'decimal:2', 'starts_at' => 'datetime', 'expires_at' => 'datetime', 'status' => 'boolean'];

    public function isValid() {
        $now = now();
        if (!$this->status) return false;
        if ($now->lt($this->starts_at) || $now->gt($this->expires_at)) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        return true;
    }
}
