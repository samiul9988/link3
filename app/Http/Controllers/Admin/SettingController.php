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
        foreach ($request->except(['_token', 'logo', 'favicon']) as $key => $value) {
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
