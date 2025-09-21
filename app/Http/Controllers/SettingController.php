<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first(); // only 1 settings row
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'email'     => 'nullable|email',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        $setting->site_name = $request->site_name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;

        if ($request->hasFile('logo')) {
            if ($setting->logo && file_exists(public_path('uploads/logo/' . $setting->logo))) {
                unlink(public_path('uploads/logo/' . $setting->logo));
            }
            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logo'), $filename);
            $setting->logo = $filename;
        }

        $setting->save();

        return back()->with('success', 'Settings updated successfully!');
    }
}
