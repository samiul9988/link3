<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'image_desktop', 'image_mobile', 'link', 'button_text', 'sort_order', 'status'];
    protected $casts = ['status' => 'boolean'];
}
