<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->decimal('regular_price', 12, 2);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->integer('stock_quantity')->default(0);
            $table->integer('min_order_quantity')->default(1);
            $table->string('unit')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_new_arrival')->default(0);
            $table->boolean('is_best_selling')->default(0);
            $table->boolean('is_flash_deal')->default(0);
            $table->dateTime('flash_deal_end')->nullable();
            $table->boolean('status')->default(1);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->integer('total_sold')->default(0);
            $table->integer('total_views')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();

            $table->index('category_id');
            $table->index('brand_id');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_new_arrival');
            $table->index('is_best_selling');
            $table->index('is_flash_deal');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
