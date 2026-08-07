<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    private array $colors = [
        '#0D9488','#2563EB','#7C3AED','#DB2777','#EA580C','#16A34A','#0891B2',
        '#4F46E5','#9333EA','#DC2626','#CA8A04','#65A30D','#0E7490','#B45309',
        '#6D28D9','#BE123C','#15803D','#1D4ED8','#A21CAF','#D97706',
    ];

    public function run(): void
    {
        $this->command->info('Generating placeholder images...');
        $this->generatePlaceholderImages();

        $this->command->info('Seeding categories...');
        $this->seedCategories();

        $this->command->info('Seeding brands...');
        $this->seedBrands();

        $this->command->info('Seeding products...');
        $this->seedProducts();

        $this->command->info('Seeding sliders...');
        $this->seedSliders();

        $this->command->info('Seeding banners...');
        $this->seedBanners();

        $this->command->info('Seeding coupons...');
        $this->seedCoupons();

        $this->command->info('Seeding customers...');
        $this->seedCustomers();

        $this->command->info('Seeding orders...');
        $this->seedOrders();

        $this->command->info('Seeding reviews...');
        $this->seedReviews();

        $this->command->info('Seeding pages...');
        $this->seedPages();

        $this->command->info('Seeding subscribers...');
        $this->seedSubscribers();

        $this->command->info('Seeding contact messages...');
        $this->seedContactMessages();

        $this->command->info('All dummy data seeded successfully!');
    }

    private function generatePlaceholderImages(): void
    {
        $types = [
            ['dir' => 'products', 'count' => 60],
            ['dir' => 'categories', 'count' => 20],
            ['dir' => 'brands', 'count' => 20],
            ['dir' => 'sliders', 'count' => 6],
            ['dir' => 'banners', 'count' => 10],
        ];

        foreach ($types as $type) {
            for ($i = 1; $i <= $type['count']; $i++) {
                $filename = public_path("uploads/{$type['dir']}/dummy_{$i}.jpg");
                if (!file_exists($filename)) {
                    $this->createImage($filename, 800, 800, $type['dir'] . ' ' . $i);
                }
            }
        }

        // Create specific slider-sized images
        for ($i = 1; $i <= 6; $i++) {
            $filename = public_path("uploads/sliders/slide_{$i}.jpg");
            if (!file_exists($filename)) {
                $this->createImage($filename, 1920, 700, "Slide {$i}");
            }
        }

        // Create specific banner-sized images
        for ($i = 1; $i <= 10; $i++) {
            $filename = public_path("uploads/banners/banner_{$i}.jpg");
            if (!file_exists($filename)) {
                $this->createImage($filename, 1200, 400, "Banner {$i}");
            }
        }
    }

    private function createImage(string $path, int $w, int $h, string $text): void
    {
        $img = imagecreatetruecolor($w, $h);
        $color = $this->hexToRgb($this->colors[array_rand($this->colors)]);
        $bg = imagecolorallocate($img, $color[0], $color[1], $color[2]);
        imagefill($img, 0, 0, $bg);

        $white = imagecolorallocate($img, 255, 255, 255);
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $x = ($w - $textWidth) / 2;
        $y = ($h - imagefontheight($fontSize)) / 2;
        imagestring($img, $fontSize, (int)$x, (int)$y, $text, $white);

        // Add a subtle pattern
        $lineColor = imagecolorallocatealpha($img, 255, 255, 255, 100);
        for ($i = 0; $i < $w + $h; $i += 40) {
            imageline($img, $i, 0, 0, $i, $lineColor);
        }

        imagejpeg($img, $path, 85);
        imagedestroy($img);
    }

    private function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    private function seedCategories(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Smartphones, laptops, tablets, and accessories'],
            ['name' => 'Fashion', 'description' => 'Clothing, shoes, and accessories for men and women'],
            ['name' => 'Home & Living', 'description' => 'Furniture, decor, and home essentials'],
            ['name' => 'Beauty & Health', 'description' => 'Skincare, makeup, and personal care products'],
            ['name' => 'Sports & Outdoors', 'description' => 'Sports equipment, gym gear, and outdoor essentials'],
            ['name' => 'Books & Stationery', 'description' => 'Books, notebooks, pens, and art supplies'],
            ['name' => 'Toys & Games', 'description' => 'Toys, board games, and puzzles for all ages'],
            ['name' => 'Groceries', 'description' => 'Food, beverages, and daily essentials'],
            ['name' => 'Automotive', 'description' => 'Car accessories, tools, and maintenance products'],
            ['name' => 'Pet Supplies', 'description' => 'Pet food, toys, and accessories'],
        ];

        // Parent categories
        foreach ($categories as $i => $cat) {
            $id = DB::table('categories')->insertGetId([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'parent_id' => null,
                'image' => 'uploads/categories/dummy_'.($i+1).'.jpg',
                'icon' => 'fas fa-star',
                'description' => $cat['description'],
                'is_featured' => $i < 8,
                'status' => 1,
                'meta_title' => $cat['name'] . ' - Buy Online',
                'meta_description' => 'Shop the best ' . strtolower($cat['name']) . ' at great prices.',
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add 1-2 subcategories for each parent
            $subs = [
                $cat['name'] . ' Premium',
                $cat['name'] . ' Budget',
            ];
            foreach ($subs as $j => $sub) {
                DB::table('categories')->insertGetId([
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                    'parent_id' => $id,
                    'image' => 'uploads/categories/dummy_'.(11 + $i*2 + $j).'.jpg',
                    'icon' => null,
                    'description' => 'Premium quality ' . strtolower($cat['name']),
                    'is_featured' => false,
                    'status' => 1,
                    'sort_order' => $j,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function seedBrands(): void
    {
        $brands = [
            'TechPro', 'FashionHub', 'HomeStyle', 'BeautyGlow', 'SportMax',
            'BookWorm', 'ToyLand', 'FreshMart', 'AutoGear', 'PetCare',
            'GadgetZone', 'StyleCraft', 'LivingGoods', 'PureGlow', 'FitGear',
            'ReadMore', 'PlayWorld', 'DailyFresh', 'DrivePlus', 'PetJoy',
        ];

        foreach ($brands as $i => $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'logo' => 'uploads/brands/dummy_'.($i+1).'.jpg',
                'description' => $brand . ' is a leading brand providing quality products.',
                'is_featured' => $i < 10,
                'status' => 1,
                'meta_title' => $brand . ' Products Online',
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedProducts(): void
    {
        $productNames = [
            'Wireless Bluetooth Headphones', 'Slim Fit Cotton T-Shirt', 'Modern Desk Lamp', 'Organic Face Cream',
            'Yoga Mat Premium', 'Bestselling Novel Collection', 'Building Blocks Set', 'Organic Green Tea Pack',
            'Car Phone Holder', 'Pet Chew Toy Set', 'USB-C Fast Charger', 'Denim Jacket Classic',
            'Wall Art Canvas Print', 'Vitamin C Serum', 'Running Shoes Lightweight', 'Cookbook Collection',
            'RC Racing Car', 'Imported Coffee Beans', 'Car Air Freshener', 'Cat Scratching Post',
            'Portable Power Bank', 'Casual Sneakers', 'Throw Pillow Set', 'Hair Dryer Professional',
            'Resistance Bands Set', 'Notebook Set Premium', 'Board Game Family', 'Mixed Nuts Pack',
            'Car Dash Cam', 'Dog Bed Comfort', 'Wireless Earbuds', 'Leather Wallet',
            'Table Clock Modern', 'Sunscreen SPF 50', 'Dumbbell Set', 'Art Sketchbook',
            'Puzzle 1000 Pieces', 'Dates Premium Pack', 'Motorcycle Helmet', 'Fish Tank Filter',
            'Smart Watch', 'Polo T-Shirt', 'Bookshelf Organizer', 'Makeup Brush Set',
        ];

        for ($i = 0; $i < 44; $i++) {
            $regularPrice = rand(299, 8999);
            $hasSale = rand(0, 1);
            $salePrice = $hasSale ? round($regularPrice * (rand(60, 90) / 100), 2) : null;
            $stock = rand(0, 200);

            $productId = DB::table('products')->insertGetId([
                'name' => $productNames[$i],
                'slug' => Str::slug($productNames[$i]) . '-' . Str::random(4),
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'category_id' => rand(1, 10),
                'brand_id' => rand(1, 20),
                'short_description' => 'High quality ' . strtolower($productNames[$i]) . ' perfect for everyday use.',
                'full_description' => '<h3>' . $productNames[$i] . '</h3><p>Experience premium quality with this ' . strtolower($productNames[$i]) . '. Designed for comfort, durability, and style. Perfect for both casual and professional use.</p><ul><li>Premium quality materials</li><li>Ergonomic design</li><li>Easy to use and maintain</li><li>Great value for money</li></ul><p>Order now and enjoy fast delivery across Bangladesh!</p>',
                'regular_price' => $regularPrice,
                'sale_price' => $salePrice,
                'discount_percent' => $salePrice ? round(($regularPrice - $salePrice) / $regularPrice * 100) : 0,
                'stock_quantity' => $stock,
                'min_order_quantity' => 1,
                'unit' => 'pcs',
                'thumbnail' => 'uploads/products/dummy_' . ($i + 1) . '.jpg',
                'is_featured' => $i < 12,
                'is_new_arrival' => $i >= 30,
                'is_best_selling' => $i < 8,
                'is_flash_deal' => $i < 6,
                'flash_deal_end' => $i < 6 ? Carbon::now()->addDays(rand(1, 7)) : null,
                'status' => 1,
                'meta_title' => $productNames[$i] . ' - Buy Online at Best Price',
                'meta_description' => 'Buy ' . $productNames[$i] . ' online at the best price in Bangladesh. Fast delivery.',
                'total_sold' => rand(0, 500),
                'total_views' => rand(100, 5000),
                'average_rating' => round(rand(30, 50) / 10, 1),
                'total_reviews' => rand(0, 50),
                'created_at' => Carbon::now()->subDays(rand(0, 60)),
                'updated_at' => now(),
            ]);

            // Product images (3-5 images per product)
            for ($j = 1; $j <= rand(3, 5); $j++) {
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image_path' => 'uploads/products/dummy_' . (($i + $j) % 60 + 1) . '.jpg',
                    'alt_text' => $productNames[$i] . ' - View ' . $j,
                    'sort_order' => $j - 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Variants (size + color for some products)
            if ($i < 20) {
                $sizes = ['S', 'M', 'L', 'XL'];
                foreach ($sizes as $k => $size) {
                    DB::table('product_variants')->insert([
                        'product_id' => $productId,
                        'variant_type' => 'Size',
                        'variant_value' => $size,
                        'additional_price' => $k > 1 ? ($k - 1) * 50 : 0,
                        'stock_quantity' => rand(5, 30),
                        'sku' => 'SKU-' . strtoupper(Str::random(4)) . '-' . $size,
                        'sort_order' => $k,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } elseif ($i < 30) {
                $colors = ['Red', 'Blue', 'Black', 'White'];
                foreach ($colors as $k => $color) {
                    DB::table('product_variants')->insert([
                        'product_id' => $productId,
                        'variant_type' => 'Color',
                        'variant_value' => $color,
                        'additional_price' => 0,
                        'stock_quantity' => rand(5, 30),
                        'sku' => 'SKU-' . strtoupper(Str::random(4)) . '-' . strtoupper($color),
                        'sort_order' => $k,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function seedSliders(): void
    {
        $slides = [
            ['title' => 'Summer Sale 50% Off', 'subtitle' => 'Limited Time Offer', 'description' => 'Grab the best deals on electronics, fashion, and more!', 'button_text' => 'Shop Now', 'link' => '/products'],
            ['title' => 'New Arrivals 2024', 'subtitle' => 'Fresh Collection', 'description' => 'Discover the latest trends in fashion and technology.', 'button_text' => 'Explore', 'link' => '/products'],
            ['title' => 'Free Delivery', 'subtitle' => 'On Orders Above 5000 BDT', 'description' => 'Enjoy free delivery across Bangladesh on all orders above 5,000 BDT.', 'button_text' => 'Order Now', 'link' => '/products'],
            ['title' => 'Flash Deals', 'subtitle' => 'Up to 70% Off', 'description' => 'Hurry up! Grab the best deals before they run out.', 'button_text' => 'Grab Deal', 'link' => '/products'],
            ['title' => 'Premium Brands', 'subtitle' => 'Authentic Products', 'description' => 'Shop from top brands with 100% authenticity guaranteed.', 'button_text' => 'View Brands', 'link' => '/products'],
        ];

        foreach ($slides as $i => $slide) {
            DB::table('sliders')->insert([
                'title' => $slide['title'],
                'subtitle' => $slide['subtitle'],
                'description' => $slide['description'],
                'image_desktop' => 'uploads/sliders/slide_' . ($i + 1) . '.jpg',
                'image_mobile' => 'uploads/sliders/dummy_' . ($i + 1) . '.jpg',
                'link' => $slide['link'],
                'button_text' => $slide['button_text'],
                'sort_order' => $i,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedBanners(): void
    {
        $positions = ['home_top', 'home_middle', 'product_page', 'listing_page'];
        $bannerData = [
            ['title' => 'Electronics Sale', 'position' => 'home_top', 'link' => '/products?category=electronics'],
            ['title' => 'Fashion Week', 'position' => 'home_top', 'link' => '/products?category=fashion'],
            ['title' => 'Home Decor Deals', 'position' => 'home_middle', 'link' => '/products?category=home-living'],
            ['title' => 'Beauty Products', 'position' => 'home_middle', 'link' => '/products?category=beauty-health'],
            ['title' => 'Sports Gear', 'position' => 'home_top', 'link' => '/products?category=sports-outdoors'],
            ['title' => 'Book Fair', 'position' => 'listing_page', 'link' => '/products?category=books-stationery'],
        ];

        foreach ($bannerData as $i => $b) {
            DB::table('banners')->insert([
                'title' => $b['title'],
                'image' => 'uploads/banners/banner_' . ($i + 1) . '.jpg',
                'link' => $b['link'],
                'position' => $b['position'],
                'sort_order' => $i % 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedCoupons(): void
    {
        $coupons = [
            ['code' => 'WELCOME10', 'type' => 'percent', 'value' => 10, 'min_order' => 500, 'max_discount' => 500],
            ['code' => 'SAVE500', 'type' => 'fixed', 'value' => 500, 'min_order' => 3000, 'max_discount' => null],
            ['code' => 'FLASH20', 'type' => 'percent', 'value' => 20, 'min_order' => 1000, 'max_discount' => 1000],
            ['code' => 'FREESHIP', 'type' => 'fixed', 'value' => 120, 'min_order' => 0, 'max_discount' => null],
            ['code' => 'MEGA30', 'type' => 'percent', 'value' => 30, 'min_order' => 5000, 'max_discount' => 2000],
            ['code' => 'NEWUSER', 'type' => 'percent', 'value' => 15, 'min_order' => 300, 'max_discount' => 300],
            ['code' => 'SAVE1000', 'type' => 'fixed', 'value' => 1000, 'min_order' => 8000, 'max_discount' => null],
            ['code' => 'HOTDEAL', 'type' => 'percent', 'value' => 25, 'min_order' => 2000, 'max_discount' => 1500],
        ];

        foreach ($coupons as $i => $c) {
            DB::table('coupons')->insert([
                'code' => $c['code'],
                'type' => $c['type'],
                'value' => $c['value'],
                'min_order_amount' => $c['min_order'],
                'max_discount' => $c['max_discount'],
                'usage_limit' => rand(50, 200),
                'used_count' => rand(0, 30),
                'starts_at' => Carbon::now()->subDays(rand(0, 10)),
                'expires_at' => Carbon::now()->addDays(rand(10, 60)),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedCustomers(): void
    {
        $names = [
            'Rahul Ahmed', 'Fatema Akter', 'Tanvir Hasan', 'Nusrat Jahan', 'Sakib Rahman',
            'Ayesha Siddiqua', 'Mehedi Hassan', 'Tania Sultana', 'Arif Hossain', 'Nadia Islam',
            'Kabir Uddin', 'Sharmin Akter', 'Rafiqul Islam', 'Jannatul Ferdous', 'Sohel Rana',
            'Mousumi Khatun', 'Imran Khan', 'Sabrina Yesmin', 'Fahim Chowdhury', 'Rokeya Begum',
        ];

        foreach ($names as $i => $name) {
            $parts = explode(' ', $name);
            $firstName = strtolower($parts[0]);
            DB::table('customers')->insert([
                'name' => $name,
                'email' => $firstName . rand(10, 99) . '@example.com',
                'email_verified_at' => now(),
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'password' => Hash::make('password123'),
                'avatar' => null,
                'status' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 180)),
                'updated_at' => now(),
            ]);

            // Address for each customer
            $divisions = ['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Sylhet'];
            $districts = ['Mirpur', 'Gulshan', 'Dhanmondi', 'Uttara', 'Banani'];
            DB::table('customer_addresses')->insert([
                'customer_id' => $i + 1,
                'full_name' => $name,
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'email' => $firstName . rand(10, 99) . '@example.com',
                'division' => $divisions[array_rand($divisions)],
                'district' => $districts[array_rand($districts)],
                'upazila' => $districts[array_rand($districts)],
                'address_line' => 'House ' . rand(1, 100) . ', Road ' . rand(1, 50),
                'is_default' => 1,
                'type' => 'home',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedOrders(): void
    {
        $paymentMethods = ['cod', 'bkash', 'nagad'];
        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];

        for ($i = 0; $i < 20; $i++) {
            $customerId = rand(1, 20);
            $subtotal = 0;
            $items = [];

            // Generate 1-4 items per order
            $itemCount = rand(1, 4);
            for ($j = 0; $j < $itemCount; $j++) {
                $productId = rand(1, 44);
                $product = DB::table('products')->find($productId);
                if (!$product) continue;
                $qty = rand(1, 3);
                $price = $product->sale_price ?? $product->regular_price;
                $items[] = [
                    'product_id' => $productId,
                    'product_name' => $product->name,
                    'product_image' => $product->thumbnail,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'subtotal' => $price * $qty,
                ];
                $subtotal += $price * $qty;
            }

            if (empty($items)) continue;

            $discount = rand(0, 1) ? round($subtotal * rand(5, 15) / 100) : 0;
            $deliveryCharge = $subtotal > 5000 ? 0 : (rand(0, 1) ? 60 : 120);
            $total = $subtotal - $discount + $deliveryCharge;
            $status = $statuses[array_rand($statuses)];
            $paymentStatus = in_array($status, ['delivered']) ? 'paid' : $paymentStatuses[array_rand($paymentStatuses)];

            $orderId = DB::table('orders')->insertGetId([
                'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'customer_id' => $customerId,
                'address_id' => $customerId,
                'coupon_id' => rand(0, 1) ? rand(1, 8) : null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'delivery_charge' => $deliveryCharge,
                'total' => $total,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $paymentStatus,
                'order_status' => $status,
                'transaction_id' => in_array($paymentStatus, ['paid']) ? 'TXN' . strtoupper(Str::random(10)) : null,
                'customer_note' => rand(0, 1) ? 'Please deliver before 5 PM.' : null,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => now(),
            ]);

            foreach ($items as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'product_image' => $item['product_image'],
                    'variant_details' => rand(0, 1) ? 'Size: M' : null,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function seedReviews(): void
    {
        $reviews = [
            'Excellent product! Very satisfied with the quality.',
            'Good value for money. Fast delivery too.',
            'The product is exactly as described. Highly recommend!',
            'Nice quality but delivery took longer than expected.',
            'Amazing! Will definitely order again.',
            'Decent product for the price.',
            'Absolutely love it! Best purchase this month.',
            'Good product but packaging could be better.',
            'Five stars! Exceeded my expectations.',
            'Very good. Already recommended to friends.',
            'Not bad, but expected slightly better quality.',
            'Perfect! Exactly what I was looking for.',
            'Great customer service and product quality.',
            'Satisfied with the purchase. Thank you!',
            'Product is okay. Delivery was fast.',
        ];

        for ($i = 0; $i < 40; $i++) {
            DB::table('product_reviews')->insert([
                'customer_id' => rand(1, 20),
                'product_id' => rand(1, 44),
                'order_id' => rand(0, 1) ? rand(1, 20) : null,
                'rating' => rand(3, 5),
                'comment' => $reviews[array_rand($reviews)],
                'status' => rand(0, 10) > 1 ? 1 : 0,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedPages(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<h2>About Our Store</h2><p>Welcome to our e-commerce store! We are dedicated to bringing you the best products at the most competitive prices. With years of experience in the industry, we understand what our customers need and strive to exceed expectations with every order.</p><p>Our mission is to make online shopping easy, affordable, and enjoyable for everyone. We carefully select each product to ensure quality and value.</p><h3>Why Choose Us?</h3><ul><li>100% Authentic Products</li><li>Fast Delivery Across Bangladesh</li><li>Easy Returns & Refunds</li><li>24/7 Customer Support</li><li>Secure Payment Methods</li></ul>',
                'meta_title' => 'About Us',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2><p>We value your privacy and are committed to protecting your personal information. This policy explains how we collect, use, and safeguard your data when you use our website.</p><h3>Information We Collect</h3><p>We collect information you provide when creating an account, placing an order, or contacting us. This includes your name, email address, phone number, and shipping address.</p><h3>How We Use Your Information</h3><p>Your information is used to process orders, improve our services, and communicate with you about your purchases.</p>',
                'meta_title' => 'Privacy Policy',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<h2>Terms & Conditions</h2><p>By using our website, you agree to these terms and conditions. Please read them carefully before making a purchase.</p><h3>Orders & Payments</h3><p>All orders are subject to availability and confirmation. Prices may change without notice. We accept multiple payment methods including Cash on Delivery, bKash, and Nagad.</p><h3>Shipping & Delivery</h3><p>We deliver across Bangladesh. Delivery times vary based on location. Free delivery is available on orders above 5,000 BDT.</p>',
                'meta_title' => 'Terms & Conditions',
            ],
            [
                'title' => 'Return Policy',
                'slug' => 'return-policy',
                'content' => '<h2>Return & Refund Policy</h2><p>We want you to be completely satisfied with your purchase. If you are not happy with your order, you can return it within 7 days of delivery.</p><h3>Return Conditions</h3><ul><li>Product must be unused and in original packaging</li><li>Return must be initiated within 7 days</li><li>Proof of purchase is required</li></ul><h3>Refund Process</h3><p>Refunds are processed within 5-7 business days after we receive the returned item.</p>',
                'meta_title' => 'Return Policy',
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'content' => '<h2>Frequently Asked Questions</h2><h3>How do I place an order?</h3><p>Browse our products, add items to your cart, and proceed to checkout. You will need to provide your shipping address and select a payment method.</p><h3>What payment methods do you accept?</h3><p>We accept Cash on Delivery (COD), bKash, and Nagad payments.</p><h3>How long does delivery take?</h3><p>Delivery within Dhaka takes 1-2 business days. Delivery outside Dhaka takes 2-5 business days.</p><h3>Can I cancel my order?</h3><p>Yes, you can cancel your order if it has not been shipped yet. Contact our support team for assistance.</p>',
                'meta_title' => 'FAQ',
            ],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'title' => $page['title'],
                'slug' => $page['slug'],
                'content' => $page['content'],
                'meta_title' => $page['meta_title'],
                'meta_description' => $page['meta_title'] . ' - ' . DB::table('settings')->where('key', 'site_name')->value('value') ?? 'E-Commerce',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedSubscribers(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('subscribers')->insert([
                'email' => 'subscriber' . $i . '@example.com',
                'status' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 90)),
            ]);
        }
    }

    private function seedContactMessages(): void
    {
        $subjects = ['Order Inquiry', 'Product Question', 'Delivery Issue', 'Return Request', 'Feedback'];
        $messages = [
            'I would like to know about the delivery time for my order.',
            'Can you tell me more about this product before I purchase?',
            'My order has not arrived yet. Can you help track it?',
            'I want to return a product I received yesterday.',
            'Great experience shopping here! Just wanted to share positive feedback.',
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('contact_messages')->insert([
                'name' => 'Customer ' . ($i + 1),
                'email' => 'customer' . ($i + 1) . '@example.com',
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'subject' => $subjects[array_rand($subjects)],
                'message' => $messages[array_rand($messages)],
                'is_read' => $i < 15 ? 1 : 0,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}
