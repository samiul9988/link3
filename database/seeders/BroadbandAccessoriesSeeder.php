<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BroadbandAccessoriesSeeder extends Seeder
{
    private array $productImages = [];

    public function run(): void
    {
        $this->command->info('Clearing old data...');
        $this->clearOldData();

        $this->command->info('Downloading product images...');
        $this->downloadImages();

        $this->command->info('Seeding broadband categories...');
        $catIds = $this->seedCategories();

        $this->command->info('Seeding brands...');
        $this->seedBrands();

        $this->command->info('Seeding products...');
        $this->seedProducts($catIds);

        $this->command->info('Seeding sliders...');
        $this->seedSliders();

        $this->command->info('Seeding banners...');
        $this->seedBanners();

        $this->command->info('Seeding coupons...');
        $this->seedCoupons();

        $this->command->info('Seeding customers & orders...');
        $this->seedCustomers();
        $this->seedOrders();

        $this->command->info('Seeding reviews, pages, subscribers, messages...');
        $this->seedReviews();
        $this->seedPages();
        $this->seedSubscribers();
        $this->seedContactMessages();

        $this->command->info('✅ All broadband accessories data seeded!');
    }

    private function clearOldData(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('carts')->truncate();
        DB::table('wishlists')->truncate();
        DB::table('product_reviews')->truncate();
        DB::table('product_images')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('brands')->truncate();
        DB::table('sliders')->truncate();
        DB::table('banners')->truncate();
        DB::table('coupons')->truncate();
        DB::table('contact_messages')->truncate();
        DB::table('subscribers')->truncate();
        DB::table('pages')->truncate();
        DB::table('customer_addresses')->truncate();
        DB::table('customers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function downloadImages(): void
    {
        $dirs = ['products', 'categories', 'brands', 'sliders', 'banners'];
        foreach ($dirs as $dir) {
            $path = public_path("uploads/{$dir}");
            if (!is_dir($path)) mkdir($path, 0755, true);
        }

        // Download product images from picsum.photos (free real images)
        $productImageCount = 55;
        for ($i = 0; $i < $productImageCount; $i++) {
            $filepath = public_path("uploads/products/prod_{$i}.jpg");
            if (!file_exists($filepath)) {
                $url = "https://picsum.photos/seed/prod{$i}/800/800";
                $this->downloadFile($url, $filepath);
                $this->command->info("  Downloaded product image {$i}/{$productImageCount}");
            }
        }

        // Category images
        for ($i = 0; $i < 30; $i++) {
            $filepath = public_path("uploads/categories/cat_{$i}.jpg");
            if (!file_exists($filepath)) {
                $url = "https://picsum.photos/seed/cat{$i}/400/400";
                $this->downloadFile($url, $filepath);
            }
        }

        // Brand logos
        for ($i = 0; $i < 20; $i++) {
            $filepath = public_path("uploads/brands/brand_{$i}.jpg");
            if (!file_exists($filepath)) {
                $url = "https://picsum.photos/seed/br{$i}/400/400";
                $this->downloadFile($url, $filepath);
            }
        }

        // Slider images
        for ($i = 1; $i <= 6; $i++) {
            $filepath = public_path("uploads/sliders/slide_{$i}.jpg");
            if (!file_exists($filepath)) {
                $url = "https://picsum.photos/seed/slider{$i}/1920/700";
                $this->downloadFile($url, $filepath);
            }
        }

        // Banner images
        for ($i = 1; $i <= 10; $i++) {
            $filepath = public_path("uploads/banners/banner_{$i}.jpg");
            if (!file_exists($filepath)) {
                $url = "https://picsum.photos/seed/bn{$i}/1200/400";
                $this->downloadFile($url, $filepath);
            }
        }
    }

    private function downloadFile(string $url, string $path): bool
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
        ]);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $data) {
            file_put_contents($path, $data);
            return true;
        }
        // Fallback: create colored image if download fails
        $this->createFallbackImage($path, basename(dirname($path)));
        return false;
    }

    private function createFallbackImage(string $path, string $text): void
    {
        $colors = ['#0D9488','#2563EB','#7C3AED','#DB2777','#EA580C','#16A34A','#0891B2','#4F46E5','#9333EA','#DC2626'];
        $w = 800; $h = 800;
        $img = imagecreatetruecolor($w, $h);
        $hex = $colors[array_rand($colors)];
        $r = hexdec(substr($hex,1,2)); $g = hexdec(substr($hex,3,2)); $b = hexdec(substr($hex,5,2));
        $bg = imagecolorallocate($img, $r, $g, $b);
        imagefill($img, 0, 0, $bg);
        $white = imagecolorallocate($img, 255, 255, 255);
        $fs = 5;
        $tw = imagefontwidth($fs) * strlen($text);
        imagestring($img, $fs, (int)(($w-$tw)/2), (int)($h/2), $text, $white);
        imagejpeg($img, $path, 90);
        imagedestroy($img);
    }

    private function seedCategories(): array
    {
        $categories = [
            ['name' => 'Routers & Networking', 'icon' => 'fas fa-wifi', 'desc' => 'WiFi routers, mesh systems, and networking devices'],
            ['name' => 'Cables & Connectors', 'icon' => 'fas fa-plug', 'desc' => 'LAN cables, fiber cables, RJ45 connectors, and accessories'],
            ['name' => 'Antennas & Boosters', 'icon' => 'fas fa-broadcast-tower', 'desc' => 'WiFi antennas, signal boosters, and range extenders'],
            ['name' => 'Modems & ONU', 'icon' => 'fas fa-server', 'desc' => 'GPON ONU, optical network terminals, and modems'],
            ['name' => 'Network Switches', 'icon' => 'fas fa-network-wired', 'desc' => 'Managed/unmanaged switches, PoE switches'],
            ['name' => 'Power & Adapters', 'icon' => 'fas fa-bolt', 'desc' => 'Power adapters, PoE injectors, UPS for networking'],
            ['name' => 'Mounting & Accessories', 'icon' => 'fas fa-tools', 'desc' => 'Wall mounts, brackets, cable organizers'],
            ['name' => 'Fiber Optic Equipment', 'icon' => 'fas fa-fiber', 'desc' => 'Fiber patch cords, SFP modules, media converters'],
            ['name' => 'LAN Cards & Adapters', 'icon' => 'fas fa-ethernet', 'desc' => 'PCIe LAN cards, USB to Ethernet adapters'],
            ['name' => 'CCTV & Security', 'icon' => 'fas fa-video', 'desc' => 'IP cameras, NVR, security accessories'],
        ];

        $ids = ['parent' => [], 'all' => []];
        foreach ($categories as $i => $cat) {
            $id = DB::table('categories')->insertGetId([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'parent_id' => null,
                'image' => "uploads/categories/cat_{$i}.jpg",
                'icon' => $cat['icon'],
                'description' => $cat['desc'],
                'is_featured' => $i < 8,
                'status' => 1,
                'meta_title' => $cat['name'] . ' - Buy Online at Tihan Online',
                'meta_description' => 'Shop the best ' . strtolower($cat['name']) . ' at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',
                'sort_order' => $i,
                'created_at' => now(), 'updated_at' => now(),
            ]);
            $ids['parent'][] = $id;
            $ids['all'][] = $id;

            // 1-2 subcategories per parent
            $subs = [
                $cat['name'] . ' - Premium',
                $cat['name'] . ' - Budget',
            ];
            foreach ($subs as $j => $sub) {
                $sid = DB::table('categories')->insertGetId([
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                    'parent_id' => $id,
                    'image' => "uploads/categories/cat_" . (10 + $i*2 + $j) . ".jpg",
                    'description' => 'Best quality ' . strtolower($cat['name']) . ' at affordable prices.',
                    'is_featured' => false,
                    'status' => 1,
                    'sort_order' => $j,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
                $ids['all'][] = $sid;
            }
        }
        return $ids;
    }

    private function seedBrands(): void
    {
        $brands = [
            'TP-Link', 'D-Link', 'Cisco', 'Netgear', 'MikroTik',
            'Ubiquiti', 'Tenda', 'Xiaomi', 'Huawei', 'ZTE',
            'Totolink', 'Asus', 'Linksys', 'Ruijie', 'Cambium',
            'Cudy', 'Mercusys', 'BDCOM', 'VSOL', 'Nokia',
        ];

        foreach ($brands as $i => $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'logo' => "uploads/brands/brand_{$i}.jpg",
                'description' => "{$brand} is a leading brand providing high-quality networking and broadband accessories worldwide.",
                'is_featured' => $i < 10,
                'status' => 1,
                'meta_title' => "Buy {$brand} Products Online - Tihan Online",
                'meta_description' => "Shop authentic {$brand} networking products at Tihan Online. Best price guaranteed.",
                'sort_order' => $i,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedProducts(array $catIds): void
    {
        $products = [
            // Routers & Networking (cat 1)
            ['name' => 'TP-Link Archer C80 AC1900 Wireless Router', 'cat' => 1, 'brand' => 1, 'price' => 3500, 'sale' => 2999, 'desc' => 'Dual-band WiFi router with MU-MIMO technology. 1300Mbps on 5GHz + 600Mbps on 2.4GHz. 4 external antennas.'],
            ['name' => 'D-Link DIR-825 WiFi 5 AC1200 Router', 'cat' => 2, 'brand' => 2, 'price' => 2800, 'sale' => 2499, 'desc' => 'Dual-band gigabit router. 4 high-gain antennas. MU-MIMO and beamforming support.'],
            ['name' => 'MikroTik hAP ac2 Dual-Band Router', 'cat' => 1, 'brand' => 5, 'price' => 6500, 'sale' => null, 'desc' => 'Professional-grade dual-band router with RouterOS L4. 5x Gigabit ports. IPsec hardware encryption.'],
            ['name' => 'Tenda AC10 AC1200 Smart WiFi Router', 'cat' => 2, 'brand' => 7, 'price' => 1800, 'sale' => 1550, 'desc' => 'Dual-band 1200Mbps router. 4x 6dBi antennas. Smart WiFi schedule. Parental control.'],
            ['name' => 'Xiaomi Mi Router 4A Gigabit Edition', 'cat' => 1, 'brand' => 8, 'price' => 2200, 'sale' => 1899, 'desc' => 'Gigabit dual-band WiFi router. 4 high-performance antennas. Mi WiFi app control.'],

            // Cables & Connectors (cat 3)
            ['name' => 'CAT6 UTP LAN Cable 305m Box', 'cat' => 3, 'brand' => 2, 'price' => 4500, 'sale' => null, 'desc' => 'Premium CAT6 UTP solid copper cable. 23 AWG. 550MHz bandwidth. 305 meters per box.'],
            ['name' => 'RJ45 CAT6 Pass-Through Connector 100pcs', 'cat' => 4, 'brand' => 2, 'price' => 350, 'sale' => 299, 'desc' => 'CAT6 pass-through RJ45 connectors. 3-prong 50 micron gold plated. Pack of 100.'],
            ['name' => '3m CAT6 Patch Cord Ethernet Cable', 'cat' => 3, 'brand' => 1, 'price' => 150, 'sale' => null, 'desc' => 'High-quality CAT6 patch cord. Gold plated connectors. Snagless boot design. 3 meters.'],
            ['name' => 'Fiber Optic Patch Cable SC/APC-SC/APC 3m', 'cat' => 4, 'brand' => 3, 'price' => 180, 'sale' => 150, 'desc' => 'Single-mode fiber patch cord G.652D. SC/APC to SC/APC connectors. 3 meter length.'],
            ['name' => 'RJ45 Crimping Tool with Cable Tester Kit', 'cat' => 4, 'brand' => 2, 'price' => 650, 'sale' => 499, 'desc' => 'Professional crimping tool for RJ45/RJ11. Includes network cable tester. Ergonomic grip.'],

            // Antennas & Boosters (cat 5)
            ['name' => '9dBi Omni WiFi Antenna with RP-SMA', 'cat' => 5, 'brand' => 1, 'price' => 450, 'sale' => 399, 'desc' => 'High-gain 9dBi omni-directional antenna. RP-SMA connector. 2.4GHz frequency.'],
            ['name' => '2.4GHz WiFi Signal Booster Repeater', 'cat' => 6, 'brand' => 8, 'price' => 1200, 'sale' => 999, 'desc' => '300Mbps WiFi range extender. 2 external antennas. Wall plug design. Easy setup.'],
            ['name' => 'Outdoor 14dBi Panel Antenna 2.4GHz', 'cat' => 5, 'brand' => 5, 'price' => 1800, 'sale' => null, 'desc' => 'Directional outdoor panel antenna. 14dBi gain. Weatherproof. N-female connector.'],
            ['name' => 'WiFi 6 Mesh Extender AX1800', 'cat' => 5, 'brand' => 1, 'price' => 4500, 'sale' => 3999, 'desc' => 'WiFi 6 (802.11ax) mesh range extender. Dual-band 1800Mbps. EasyMesh compatible.'],

            // Modems & ONU (cat 7)
            ['name' => 'Huawei HG8245H5 GPON ONU Terminal', 'cat' => 7, 'brand' => 9, 'price' => 2200, 'sale' => 1999, 'desc' => 'GPON ONU with 4 GE ports + 1 POTS + WiFi. SC/APC interface. Bridge and route mode.'],
            ['name' => 'ZTE F660 GPON ONU WiFi Router', 'cat' => 8, 'brand' => 10, 'price' => 1800, 'sale' => 1599, 'desc' => 'GPON terminal with 4 LAN + 2 POTS + WiFi. 300Mbps wireless. NAT/firewall.'],
            ['name' => 'VSOL V2802RH Dual-Band XPON ONU', 'cat' => 7, 'brand' => 18, 'price' => 3500, 'sale' => 3200, 'desc' => 'XPON ONU dual-band WiFi 6. 1x 2.5G port. Compatible with GPON/EPON. Bridge/router mode.'],
            ['name' => 'Nokia G-2425G-A GPON ONT', 'cat' => 8, 'brand' => 20, 'price' => 2500, 'sale' => null, 'desc' => 'Nokia GPON ONT with 4 Gigabit ports + WiFi + VoIP. SC/APC. Bridge/router/WiFi modes.'],

            // Network Switches (cat 9)
            ['name' => 'TP-Link TL-SG108 8-Port Gigabit Switch', 'cat' => 9, 'brand' => 1, 'price' => 1800, 'sale' => 1550, 'desc' => '8-port gigabit unmanaged switch. Plug & play. Auto MDI/MDIX. Green Ethernet technology.'],
            ['name' => 'D-Link DES-1008C 8-Port Fast Switch', 'cat' => 10, 'brand' => 2, 'price' => 950, 'sale' => null, 'desc' => '8-port 10/100Mbps switch. Compact design. Fanless quiet operation. QoS support.'],
            ['name' => 'MikroTik CRS328-24P-4S+RM PoE Switch', 'cat' => 9, 'brand' => 5, 'price' => 38000, 'sale' => null, 'desc' => '24-port PoE+ gigabit switch. 4x SFP+ 10Gbps ports. 450W power budget. RouterOS L5.'],
            ['name' => 'Tenda TEG1024D 24-Port Gigabit Switch', 'cat' => 9, 'brand' => 7, 'price' => 4500, 'sale' => 3999, 'desc' => '24-port gigabit rackmount switch. 48Gbps switching capacity. Fanless design.'],

            // Power & Adapters (cat 11)
            ['name' => '12V 2A DC Power Adapter for Router/ONU', 'cat' => 11, 'brand' => 1, 'price' => 350, 'sale' => 299, 'desc' => 'Universal 12V 2A DC adapter. 5.5mm x 2.1mm connector. Compatible with most routers and ONUs.'],
            ['name' => 'TP-Link TL-PoE150S PoE Injector', 'cat' => 12, 'brand' => 1, 'price' => 850, 'sale' => 750, 'desc' => 'Single-port PoE injector. 802.3af compliant. 15.4W power. Up to 100m transmission.'],
            ['name' => 'UPS 650VA for Networking Equipment', 'cat' => 11, 'brand' => 3, 'price' => 3500, 'sale' => 3200, 'desc' => '650VA/360W line-interactive UPS. 3x battery backup outlets. Surge protection.'],

            // Mounting & Accessories (cat 13)
            ['name' => 'Universal Wall Mount Bracket for Router/ONU', 'cat' => 13, 'brand' => 2, 'price' => 150, 'sale' => null, 'desc' => 'Universal wall mount bracket. Compatible with most routers and ONUs. Includes screws.'],
            ['name' => 'Cable Tie Organizer Kit 200pcs', 'cat' => 14, 'brand' => 2, 'price' => 250, 'sale' => 199, 'desc' => 'Nylon cable ties assorted sizes. UV resistant. Self-locking. Pack of 200.'],
            ['name' => 'Outdoor Weatherproof Enclosure Box', 'cat' => 13, 'brand' => 3, 'price' => 850, 'sale' => 750, 'desc' => 'IP65 weatherproof junction box. Suitable for outdoor networking equipment. With mounting plate.'],

            // Fiber Optic (cat 15)
            ['name' => '1GE SFP Module SX MM 550m LC', 'cat' => 15, 'brand' => 3, 'price' => 1200, 'sale' => 999, 'desc' => '1.25G SFP multimode transceiver. 850nm. LC connector. Up to 550m range.'],
            ['name' => 'Media Converter Gigabit SC Single-Mode', 'cat' => 16, 'brand' => 1, 'price' => 1800, 'sale' => 1600, 'desc' => '10/100/1000M media converter. SC connector single-mode. 20km transmission distance.'],
            ['name' => 'Fiber Optical Power Meter with VFL', 'cat' => 15, 'brand' => 3, 'price' => 2500, 'sale' => 2200, 'desc' => 'Optical power meter -70~+10dBm. Visual fault locator 30mW. FC/SC/ST adapters included.'],
            ['name' => 'SC/APC Fiber Optic Fast Connector 50pcs', 'cat' => 16, 'brand' => 3, 'price' => 1800, 'sale' => 1550, 'desc' => 'SC/APC field assembly connectors. Pre-polished. No epoxy needed. Pack of 50.'],

            // LAN Cards & Adapters (cat 17)
            ['name' => 'USB 3.0 to Gigabit Ethernet Adapter', 'cat' => 17, 'brand' => 1, 'price' => 1200, 'sale' => 999, 'desc' => 'USB 3.0 to RJ45 Gigabit adapter. 10/100/1000Mbps. Plug and play. Windows/Mac/Linux.'],
            ['name' => 'PCIe Gigabit Network Card Dual Port', 'cat' => 18, 'brand' => 4, 'price' => 2500, 'sale' => null, 'desc' => 'Dual-port PCIe x1 gigabit LAN card. Realtek chipset. Low profile bracket included.'],
            ['name' => 'USB WiFi Adapter AC1300 Dual Band', 'cat' => 17, 'brand' => 1, 'price' => 1500, 'sale' => 1299, 'desc' => 'Dual-band AC1300 USB WiFi adapter. 867Mbps on 5GHz + 400Mbps on 2.4GHz. WPA3 support.'],

            // CCTV & Security (cat 19)
            ['name' => 'Hikvision 2MP IP Bullet Camera', 'cat' => 19, 'brand' => 3, 'price' => 3500, 'sale' => 3200, 'desc' => '2MP IP bullet camera. IR 30m. H.265+ compression. IP67 weatherproof. PoE.'],
            ['name' => 'Dahua 4-Channel PoE NVR', 'cat' => 20, 'brand' => 14, 'price' => 5500, 'sale' => 4999, 'desc' => '4-channel PoE NVR. Supports up to 4K recording. H.265+. 1 SATA HDD slot.'],
            ['name' => 'CAT6 Outdoor Ethernet Cable 50m', 'cat' => 19, 'brand' => 2, 'price' => 1200, 'sale' => 999, 'desc' => 'Outdoor CAT6 Ethernet cable. UV resistant. Copper clad aluminum. 50 meters.'],
            ['name' => 'CCTV Power Supply Box 12V 10A 8CH', 'cat' => 20, 'brand' => 3, 'price' => 1200, 'sale' => null, 'desc' => '12V 10A CCTV power distribution box. 8 channels. Short circuit protection. LED indicator.'],
        ];

        $imgIndex = 0;
        foreach ($products as $i => $p) {
            $catIdx = ($p['cat'] - 1);
            $parentCatId = $catIds['parent'][$catIdx % 10] ?? $catIds['parent'][0];
            $imgNum = $i % 55;

            $productId = DB::table('products')->insertGetId([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'sku' => 'TIH-' . strtoupper(Str::random(6)),
                'category_id' => $parentCatId,
                'brand_id' => $p['brand'],
                'short_description' => $p['desc'],
                'full_description' => "<h3>{$p['name']}</h3><p>{$p['desc']}</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>",
                'regular_price' => $p['price'],
                'sale_price' => $p['sale'],
                'discount_percent' => $p['sale'] ? round(($p['price'] - $p['sale']) / $p['price'] * 100) : 0,
                'stock_quantity' => rand(10, 200),
                'min_order_quantity' => 1,
                'unit' => 'pcs',
                'thumbnail' => "uploads/products/prod_{$imgNum}.jpg",
                'is_featured' => $i < 12,
                'is_new_arrival' => $i >= 30,
                'is_best_selling' => $i < 8,
                'is_flash_deal' => $i < 5,
                'flash_deal_end' => $i < 5 ? now()->addDays(rand(1, 5)) : null,
                'status' => 1,
                'meta_title' => $p['name'] . ' - Buy at Best Price | Tihan Online',
                'meta_description' => 'Buy ' . $p['name'] . ' online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',
                'total_sold' => rand(10, 500),
                'total_views' => rand(200, 8000),
                'average_rating' => round(rand(35, 50) / 10, 1),
                'total_reviews' => rand(5, 60),
                'created_at' => now()->subDays(rand(0, 90)),
                'updated_at' => now(),
            ]);

            // 3-5 extra images per product
            for ($j = 1; $j <= rand(3, 5); $j++) {
                $imgIdx = ($imgNum + $j) % 55;
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image_path' => "uploads/products/prod_{$imgIdx}.jpg",
                    'alt_text' => $p['name'] . ' - View ' . $j,
                    'sort_order' => $j - 1,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }

            // Variants (specs-based)
            if (in_array($p['cat'], [1, 2, 5, 6])) {
                // Size/spec variants
                $specs = ['Standard', 'Pro', 'Enterprise'];
                foreach ($specs as $k => $spec) {
                    DB::table('product_variants')->insert([
                        'product_id' => $productId,
                        'variant_type' => 'Version',
                        'variant_value' => $spec,
                        'additional_price' => $k > 0 ? $k * 500 : 0,
                        'stock_quantity' => rand(5, 30),
                        'sku' => 'TIH-' . strtoupper(Str::random(4)),
                        'sort_order' => $k,
                        'created_at' => now(), 'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function seedSliders(): void
    {
        $slides = [
            ['title' => 'High-Speed Routers', 'subtitle' => 'Starting from ৳1,550', 'desc' => 'Get the best WiFi routers for your home and office. TP-Link, D-Link, Tenda & more.', 'btn' => 'Shop Routers', 'link' => '/products?category=routers-networking'],
            ['title' => 'Fiber Optic Solutions', 'subtitle' => 'Premium Quality Cables & Tools', 'desc' => 'SC/APC connectors, patch cords, media converters, power meters. Everything for fiber networks.', 'btn' => 'View Fiber', 'link' => '/products?category=fiber-optic-equipment'],
            ['title' => 'GPON ONU Sale', 'subtitle' => 'Up to 20% Off', 'desc' => 'Huawei, ZTE, Nokia, VSOL GPON ONUs. Bridge mode ready. Best prices guaranteed.', 'btn' => 'Buy ONU', 'link' => '/products?category=modems-onu'],
            ['title' => 'Networking Essentials', 'subtitle' => 'Switches, Cables & More', 'desc' => 'CAT6 cables, RJ45 connectors, gigabit switches. Everything you need for your network setup.', 'btn' => 'Shop Now', 'link' => '/products'],
            ['title' => 'Tihan Online', 'subtitle' => 'Your Broadband Partner', 'desc' => '100% genuine products. Fast delivery across Bangladesh. Expert support.', 'btn' => 'Explore', 'link' => '/products'],
        ];

        foreach ($slides as $i => $slide) {
            DB::table('sliders')->insert([
                'title' => $slide['title'],
                'subtitle' => $slide['subtitle'],
                'description' => $slide['desc'],
                'image_desktop' => "uploads/sliders/slide_" . ($i+1) . ".jpg",
                'image_mobile' => "uploads/sliders/slide_" . ($i+1) . ".jpg",
                'link' => $slide['link'],
                'button_text' => $slide['btn'],
                'sort_order' => $i,
                'status' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedBanners(): void
    {
        $banners = [
            ['title' => 'Router Combo Deal', 'position' => 'home_top', 'link' => '/products?brand=tp-link'],
            ['title' => 'Fiber Optics Special', 'position' => 'home_top', 'link' => '/products?category=fiber-optic-equipment'],
            ['title' => 'ONU Installation Kit', 'position' => 'home_middle', 'link' => '/products?category=modems-onu'],
            ['title' => 'CCTV Camera Deals', 'position' => 'home_middle', 'link' => '/products?category=cctv-security'],
            ['title' => 'Free Shipping Above ৳5000', 'position' => 'home_top', 'link' => '/products'],
            ['title' => 'Antenna & Booster', 'position' => 'listing_page', 'link' => '/products?category=antennas-boosters'],
        ];

        foreach ($banners as $i => $b) {
            DB::table('banners')->insert([
                'title' => $b['title'],
                'image' => "uploads/banners/banner_" . ($i+1) . ".jpg",
                'link' => $b['link'],
                'position' => $b['position'],
                'sort_order' => $i,
                'status' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedCoupons(): void
    {
        $coupons = [
            ['code' => 'TIHAN10', 'type' => 'percent', 'value' => 10, 'min' => 500, 'max' => 300],
            ['code' => 'ROUTER500', 'type' => 'fixed', 'value' => 500, 'min' => 3000, 'max' => null],
            ['code' => 'FIBER20', 'type' => 'percent', 'value' => 20, 'min' => 2000, 'max' => 1000],
            ['code' => 'WELCOME', 'type' => 'percent', 'value' => 15, 'min' => 300, 'max' => 500],
            ['code' => 'BROADBAND', 'type' => 'fixed', 'value' => 200, 'min' => 1000, 'max' => null],
            ['code' => 'FLASH25', 'type' => 'percent', 'value' => 25, 'min' => 5000, 'max' => 2000],
            ['code' => 'SAVE1000', 'type' => 'fixed', 'value' => 1000, 'min' => 8000, 'max' => null],
            ['code' => 'MEGA30', 'type' => 'percent', 'value' => 30, 'min' => 10000, 'max' => 3000],
        ];

        foreach ($coupons as $c) {
            DB::table('coupons')->insert([
                'code' => $c['code'],
                'type' => $c['type'],
                'value' => $c['value'],
                'min_order_amount' => $c['min'],
                'max_discount' => $c['max'],
                'usage_limit' => rand(50, 500),
                'used_count' => rand(0, 30),
                'starts_at' => now()->subDays(rand(0, 5)),
                'expires_at' => now()->addDays(rand(15, 90)),
                'status' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedCustomers(): void
    {
        $bdNames = [
            'Md. Hasan Ahmed', 'Fatima Akhter', 'Tanvir Hasan', 'Nusrat Jahan', 'Shakib Rahman',
            'Ayesha Siddique', 'Mehedi Hassan', 'Tania Sultana', 'Ariful Islam', 'Nadia Islam',
            'Kabir Hossain', 'Sharmin Akhter', 'Rafiqul Islam', 'Jannatul Ferdous', 'Sohel Rana',
            'Mousumi Khatun', 'Imran Khan', 'Sabrina Yesmin', 'Fahim Chowdhury', 'Rokeya Begum',
        ];

        $divisions = ['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Sylhet', 'Barishal', 'Rangpur', 'Mymensingh'];
        $districts = ['Mirpur', 'Gulshan', 'Dhanmondi', 'Uttara', 'Banani', 'Mohammadpur', 'Badda', 'Khilgaon'];

        foreach ($bdNames as $i => $name) {
            $parts = explode(' ', $name);
            $firstName = strtolower(end($parts));
            DB::table('customers')->insert([
                'name' => $name,
                'email' => $firstName . rand(10, 99) . '@gmail.com',
                'email_verified_at' => now(),
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'password' => Hash::make('password123'),
                'status' => 1,
                'created_at' => now()->subDays(rand(1, 180)),
                'updated_at' => now(),
            ]);

            DB::table('customer_addresses')->insert([
                'customer_id' => $i + 1,
                'full_name' => $name,
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'division' => $divisions[array_rand($divisions)],
                'district' => $districts[array_rand($districts)],
                'upazila' => $districts[array_rand($districts)],
                'address_line' => 'House ' . rand(1, 100) . ', Road ' . rand(1, 50) . ', Block ' . chr(rand(65, 70)),
                'is_default' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedOrders(): void
    {
        $maxProductId = DB::table('products')->max('id');
        if (!$maxProductId) return;
        
        $methods = ['cod', 'bkash', 'nagad'];
        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'];

        for ($i = 0; $i < 30; $i++) {
            $customerId = rand(1, 20);
            $subtotal = 0;
            $items = [];

            $itemCount = rand(1, 3);
            for ($j = 0; $j < $itemCount; $j++) {
                $pid = rand(1, $maxProductId);
                $product = DB::table('products')->find($pid);
                if (!$product) continue;
                $qty = rand(1, 3);
                $price = $product->sale_price ?? $product->regular_price;
                $items[] = ['product_id' => $pid, 'name' => $product->name, 'img' => $product->thumbnail, 'qty' => $qty, 'price' => $price];
                $subtotal += $price * $qty;
            }
            if (empty($items)) continue;

            $discount = rand(0, 1) ? round($subtotal * rand(5, 15) / 100) : 0;
            $charge = $subtotal > 5000 ? 0 : (rand(0, 1) ? 60 : 120);
            $total = $subtotal - $discount + $charge;
            $status = $statuses[array_rand($statuses)];
            $payStatus = in_array($status, ['delivered']) ? 'paid' : (rand(0, 1) ? 'paid' : 'pending');

            $orderId = DB::table('orders')->insertGetId([
                'order_number' => 'TIH-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'customer_id' => $customerId,
                'address_id' => $customerId,
                'coupon_id' => rand(0, 1) ? rand(1, 8) : null,
                'subtotal' => $subtotal, 'discount' => $discount,
                'delivery_charge' => $charge, 'total' => $total,
                'payment_method' => $methods[array_rand($methods)],
                'payment_status' => $payStatus, 'order_status' => $status,
                'transaction_id' => $payStatus == 'paid' ? 'TXN' . strtoupper(Str::random(10)) : null,
                'customer_note' => rand(0, 1) ? 'Call before delivery.' : null,
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now(),
            ]);

            foreach ($items as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['name'],
                    'product_image' => $item['img'],
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }

    private function seedReviews(): void
    {
        $maxProductId = DB::table('products')->max('id');
        $maxOrderId = DB::table('orders')->max('id');
        if (!$maxProductId) return;
        
        $comments = [
            'Excellent product! Working perfectly with my broadband connection.',
            'Good quality. Delivery was fast. Highly recommended seller.',
            'Original product as described. Very satisfied with the purchase.',
            'Nice router, easy to set up. Signal strength is great.',
            'Best price in the market. Genuine product with warranty.',
            'Cable quality is excellent. Using it for my ISP setup.',
            'The ONU works perfectly. No issues with bridge mode.',
            'Very fast delivery. Product is exactly as advertised.',
            'Great value for money. Will definitely buy again.',
            'Professional packaging. Product works flawlessly.',
        ];

        for ($i = 0; $i < 40; $i++) {
            $productId = rand(1, $maxProductId);
            DB::table('product_reviews')->insert([
                'customer_id' => rand(1, 20),
                'product_id' => $productId,
                'order_id' => $maxOrderId ? rand(1, $maxOrderId) : null,
                'rating' => rand(3, 5),
                'comment' => $comments[array_rand($comments)],
                'status' => rand(0, 10) > 1 ? 1 : 0,
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedPages(): void
    {
        $pages = [
            ['title' => 'About Us', 'slug' => 'about-us', 'content' => '<h2>About Tihan Online</h2><p>Welcome to <strong>Tihan Online</strong> — your trusted destination for broadband accessories and networking equipment in Bangladesh.</p><p>We specialize in providing high-quality routers, cables, ONUs, fiber optic equipment, switches, antennas, and all networking essentials. Our mission is to make networking equipment accessible and affordable for everyone.</p><h3>Why Choose Tihan Online?</h3><ul><li>100% Genuine Products</li><li>Best Prices in Bangladesh</li><li>Fast Delivery Nationwide</li><li>Expert Technical Support</li><li>Warranty on All Products</li></ul>'],
            ['title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'content' => '<h2>Privacy Policy</h2><p>Tihan Online is committed to protecting your privacy. This policy explains how we collect and use your information.</p><h3>Information We Collect</h3><p>We collect your name, email, phone, and address when you place an order. Payment information is handled securely through our payment partners.</p>'],
            ['title' => 'Terms & Conditions', 'slug' => 'terms', 'content' => '<h2>Terms & Conditions</h2><p>By using tihanonline.net, you agree to our terms. All products come with manufacturer warranty. Prices are subject to change without notice.</p>'],
            ['title' => 'Return Policy', 'slug' => 'return-policy', 'content' => '<h2>Return & Refund</h2><p>Returns accepted within 7 days of delivery. Product must be unused with original packaging. Refunds processed within 5-7 business days.</p>'],
            ['title' => 'Contact Us', 'slug' => 'contact', 'content' => '<h2>Contact Tihan Online</h2><p><strong>Email:</strong> support@tihanonline.net</p><p><strong>Phone:</strong> +8801XXXXXXXXX</p><p><strong>Address:</strong> Dhaka, Bangladesh</p><p>We are available 7 days a week. Feel free to reach out for any inquiries!</p>'],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'title' => $page['title'],
                'slug' => $page['slug'],
                'content' => $page['content'],
                'meta_title' => $page['title'] . ' - Tihan Online',
                'status' => 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    private function seedSubscribers(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('subscribers')->insert([
                'email' => 'subscriber' . $i . '@gmail.com',
                'status' => 1,
                'created_at' => now()->subDays(rand(1, 90)),
            ]);
        }
    }

    private function seedContactMessages(): void
    {
        $subjects = ['Product Inquiry', 'Order Status', 'Technical Support', 'Bulk Order', 'Feedback'];
        for ($i = 0; $i < 20; $i++) {
            DB::table('contact_messages')->insert([
                'name' => 'Customer ' . ($i + 1),
                'email' => 'customer' . ($i + 1) . '@gmail.com',
                'phone' => '01' . rand(7, 9) . rand(10000000, 99999999),
                'subject' => $subjects[array_rand($subjects)],
                'message' => 'I need information about networking products available at Tihan Online.',
                'is_read' => $i < 15,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }
    }
}
