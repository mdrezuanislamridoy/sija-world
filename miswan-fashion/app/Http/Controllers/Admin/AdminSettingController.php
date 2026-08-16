<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();

        $validated = $request->validate([
            'site_name' => 'required|string|max:191',
            'site_title' => 'required|string|max:191',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:500',
            'currency_symbol' => 'required|string|max:10',
            'shipping_inside_city' => 'required|numeric|min:0',
            'shipping_outside_city' => 'required|numeric|min:0',
            'facebook_url' => 'nullable|string',
            'announcement_text' => 'nullable|string',
        ]);

        $setting->fill($validated);
        $setting->save();

        return back()->with('success', 'General settings saved successfully!');
    }
}
