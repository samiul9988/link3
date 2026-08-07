<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'logo', 'description', 'is_featured', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'sort_order'];
    protected $casts = ['is_featured' => 'boolean', 'status' => 'boolean'];

    public function products() { return $this->hasMany(Product::class); }
}
