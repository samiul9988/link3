<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'sku', 'category_id', 'brand_id', 'short_description', 'full_description', 'regular_price', 'sale_price', 'discount_percent', 'stock_quantity', 'min_order_quantity', 'unit', 'thumbnail', 'is_featured', 'is_new_arrival', 'is_best_selling', 'is_flash_deal', 'flash_deal_end', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'total_sold', 'total_views', 'average_rating', 'total_reviews'];
    protected $casts = ['regular_price' => 'decimal:2', 'sale_price' => 'decimal:2', 'discount_percent' => 'decimal:2', 'is_featured' => 'boolean', 'is_new_arrival' => 'boolean', 'is_best_selling' => 'boolean', 'is_flash_deal' => 'boolean', 'flash_deal_end' => 'datetime', 'status' => 'boolean', 'average_rating' => 'decimal:2'];

    public function category() { return $this->belongsTo(Category::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function images() { return $this->hasMany(ProductImage::class)->orderBy('sort_order'); }
    public function variants() { return $this->hasMany(ProductVariant::class)->orderBy('sort_order'); }
    public function reviews() { return $this->hasMany(ProductReview::class)->where('status', 1); }
    public function wishlists() { return $this->hasMany(Wishlist::class); }

    public function getFinalPriceAttribute() { return $this->sale_price ?? $this->regular_price; }
    public function getDiscountPercentAttribute() { if ($this->sale_price && $this->sale_price < $this->regular_price) { return round((($this->regular_price - $this->sale_price) / $this->regular_price) * 100); } return 0; }
}
