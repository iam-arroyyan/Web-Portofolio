<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request) {
        $data = $request->validate([
            'full_name' => 'nullable|string',
            'greeting' => 'nullable|string',
            'tagline' => 'nullable|string',
            'footer_name' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }
        
        if ($request->hasFile('profile_image')) {
            $fileName = time() . '_' . $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->move(public_path('assets/img'), $fileName);
            $data['profile_image'] = 'assets/img/' . $fileName;
        }

        $settings->fill($data)->save();

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan diperbarui.');
    }
}