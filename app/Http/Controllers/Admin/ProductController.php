<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'images']);
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(20);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'variants.*.type' => 'nullable|string',
            'variants.*.value' => 'nullable|string',
            'variants.*.price' => 'nullable|numeric',
            'variants.*.stock' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $data = $request->except(['_token', 'thumbnail', 'images', 'variants']);
        $data['slug'] = $this->uniqueSlug($request->name);
        $data['sku'] = $request->sku ?? strtoupper(Str::random(8));
        $data['status'] = $request->boolean('status', true);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new_arrival'] = $request->boolean('is_new_arrival');
        $data['is_best_selling'] = $request->boolean('is_best_selling');
        $data['is_flash_deal'] = $request->boolean('is_flash_deal');
        
        if ($data['sale_price'] && $data['sale_price'] < $data['regular_price']) {
            $data['discount_percent'] = round((($data['regular_price'] - $data['sale_price']) / $data['regular_price']) * 100);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'products');
        }

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $this->uploadImage($image, 'products');
                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variant) {
                if (!empty($variant['type']) && !empty($variant['value'])) {
                    $product->variants()->create([
                        'variant_type' => $variant['type'],
                        'variant_value' => $variant['value'],
                        'additional_price' => $variant['price'] ?? 0,
                        'stock_quantity' => $variant['stock'] ?? 0,
                        'sku' => $variant['sku'] ?? null,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'variants', 'category', 'brand']);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'boolean',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail', 'images', 'variants', 'deleted_images', 'deleted_variants']);
        $data['status'] = $request->boolean('status', true);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new_arrival'] = $request->boolean('is_new_arrival');
        $data['is_best_selling'] = $request->boolean('is_best_selling');
        $data['is_flash_deal'] = $request->boolean('is_flash_deal');
        
        if ($data['sale_price'] && $data['sale_price'] < $data['regular_price']) {
            $data['discount_percent'] = round((($data['regular_price'] - $data['sale_price']) / $data['regular_price']) * 100);
        } else {
            $data['discount_percent'] = 0;
        }

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'products');
        }

        $product->update($data);

        if ($request->has('deleted_images')) {
            $deletedIds = explode(',', $request->deleted_images);
            foreach ($deletedIds as $id) {
                $image = $product->images()->find($id);
                if ($image) {
                    if (file_exists(public_path($image->image_path))) {
                        unlink(public_path($image->image_path));
                    }
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $this->uploadImage($image, 'products');
                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $product->images()->count() + $index,
                ]);
            }
        }

        if ($request->has('deleted_variants')) {
            $product->variants()->whereIn('id', explode(',', $request->deleted_variants))->delete();
        }

        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                if (!empty($variantData['type']) && !empty($variantData['value'])) {
                    if (!empty($variantData['id'])) {
                        $product->variants()->where('id', $variantData['id'])->update([
                            'variant_type' => $variantData['type'],
                            'variant_value' => $variantData['value'],
                            'additional_price' => $variantData['price'] ?? 0,
                            'stock_quantity' => $variantData['stock'] ?? 0,
                            'sku' => $variantData['sku'] ?? null,
                        ]);
                    } else {
                        $product->variants()->create([
                            'variant_type' => $variantData['type'],
                            'variant_value' => $variantData['value'],
                            'additional_price' => $variantData['price'] ?? 0,
                            'stock_quantity' => $variantData['stock'] ?? 0,
                            'sku' => $variantData['sku'] ?? null,
                            'sort_order' => $product->variants()->count(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
            unlink(public_path($product->thumbnail));
        }
        foreach ($product->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function uniqueSlug($name)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }

    private function uploadImage($file, $folder)
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/' . $folder), $filename);
        return 'uploads/' . $folder . '/' . $filename;
    }
}
