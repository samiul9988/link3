<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'variant_type', 'variant_value', 'additional_price', 'stock_quantity', 'sku', 'sort_order'];
    protected $casts = ['additional_price' => 'decimal:2'];
    public function product() { return $this->belongsTo(Product::class); }
}
