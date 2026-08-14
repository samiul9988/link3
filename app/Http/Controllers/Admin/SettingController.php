<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SettingHelper;

class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $checkboxes = [
            'show_flash_deals', 'show_featured', 'show_new_arrivals',
            'show_best_selling', 'show_category_showcase', 'show_brand_showcase',
            'cod_enabled', 'bkash_enabled', 'nagad_enabled',
        ];

        foreach ($checkboxes as $key) {
            SettingHelper::set($key, $request->has($key) ? 1 : 0);
        }

        foreach ($request->except(array_merge(['_token', 'logo', 'favicon'], $checkboxes)) as $key => $value) {
            SettingHelper::set($key, $value);
        }
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/logos', 'public');
            SettingHelper::set('logo', '/storage/' . $path);
        }
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('uploads/logos', 'public');
            SettingHelper::set('favicon', '/storage/' . $path);
        }
        return back()->with('success', 'Settings saved successfully.');
    }
}
