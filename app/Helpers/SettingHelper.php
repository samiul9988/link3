<?php
namespace App\Helpers;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    public static function all()
    {
        return Cache::rememberForever('settings_array', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    public static function get($key, $default = null)
    {
        $settings = self::all();
        return $settings[$key] ?? $default;
    }

    public static function set($key, $value)
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('settings_array');
    }
}
