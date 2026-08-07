<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Ecommerce Store'],
            ['key' => 'tagline', 'value' => 'Best Online Shopping Experience'],
            ['key' => 'contact_email', 'value' => 'support@example.com'],
            ['key' => 'contact_phone', 'value' => '+8801700000000'],
            ['key' => 'address', 'value' => 'Dhaka, Bangladesh'],
            ['key' => 'logo', 'value' => ''],
            ['key' => 'favicon', 'value' => ''],
            ['key' => 'primary_color', 'value' => '#0D9488'],
            ['key' => 'meta_title', 'value' => 'Ecommerce Store - Best Online Shopping'],
            ['key' => 'meta_description', 'value' => 'Shop the best products at affordable prices. Fast delivery across Bangladesh.'],
            ['key' => 'meta_keywords', 'value' => 'ecommerce, online shopping, buy online, Bangladesh'],
            ['key' => 'show_flash_deals', 'value' => '1'],
            ['key' => 'show_featured', 'value' => '1'],
            ['key' => 'show_new_arrivals', 'value' => '1'],
            ['key' => 'show_best_selling', 'value' => '1'],
            ['key' => 'show_category_showcase', 'value' => '1'],
            ['key' => 'show_brand_showcase', 'value' => '1'],
            ['key' => 'products_per_section', 'value' => '12'],
            ['key' => 'cod_enabled', 'value' => '1'],
            ['key' => 'bkash_enabled', 'value' => '1'],
            ['key' => 'nagad_enabled', 'value' => '1'],
            ['key' => 'bkash_number', 'value' => ''],
            ['key' => 'nagad_number', 'value' => ''],
            ['key' => 'payment_instructions', 'value' => 'Please send payment to the above number and enter the Transaction ID.'],
            ['key' => 'inside_dhaka_charge', 'value' => '60'],
            ['key' => 'outside_dhaka_charge', 'value' => '120'],
            ['key' => 'free_delivery_above', 'value' => '5000'],
            ['key' => 'facebook_url', 'value' => ''],
            ['key' => 'twitter_url', 'value' => ''],
            ['key' => 'instagram_url', 'value' => ''],
            ['key' => 'youtube_url', 'value' => ''],
            ['key' => 'whatsapp_number', 'value' => ''],
            ['key' => 'google_login_enabled', 'value' => '0'],
            ['key' => 'google_client_id', 'value' => ''],
            ['key' => 'google_client_secret', 'value' => ''],
            ['key' => 'facebook_login_enabled', 'value' => '0'],
            ['key' => 'facebook_app_id', 'value' => ''],
            ['key' => 'facebook_app_secret', 'value' => ''],
            ['key' => 'google_analytics_id', 'value' => ''],
            ['key' => 'facebook_pixel_id', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
