<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminSettingController extends Controller
{
    /**
     * Display the CMS System Settings & Branding interface for Super Admin.
     */
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update CMS settings and handle file uploads for Logo & Favicon.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'institution_name' => ['required', 'string', 'max:255'],
            'app_tagline' => ['nullable', 'string', 'max:255'],
            'app_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'app_favicon' => ['nullable', 'image', 'mimes:ico,png,jpg,jpeg,svg,webp', 'max:1024'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_address' => ['nullable', 'string', 'max:500'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'announcement_enabled' => ['nullable', 'in:0,1'],
            'announcement_text' => ['nullable', 'string', 'max:1000'],
            'footer_copyright' => ['nullable', 'string', 'max:255'],
        ]);

        // 1. Identitas & Branding
        Setting::set('app_name', $request->input('app_name'), 'branding');
        Setting::set('institution_name', $request->input('institution_name'), 'branding');
        Setting::set('app_tagline', $request->input('app_tagline'), 'branding');

        // Handle App Logo Upload
        if ($request->hasFile('app_logo')) {
            $oldLogo = Setting::get('app_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('app_logo')->store('settings', 'public');
            Setting::set('app_logo', $logoPath, 'branding', 'image');
        } elseif ($request->boolean('remove_logo')) {
            $oldLogo = Setting::get('app_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            Setting::set('app_logo', null, 'branding', 'image');
        }

        // Handle App Favicon Upload
        if ($request->hasFile('app_favicon')) {
            $oldFavicon = Setting::get('app_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('app_favicon')->store('settings', 'public');
            Setting::set('app_favicon', $faviconPath, 'branding', 'image');
        } elseif ($request->boolean('remove_favicon')) {
            $oldFavicon = Setting::get('app_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            Setting::set('app_favicon', null, 'branding', 'image');
        }

        // 2. Kontak & Bantuan Darurat
        Setting::set('contact_phone', $request->input('contact_phone'), 'contact');
        Setting::set('contact_email', $request->input('contact_email'), 'contact');
        Setting::set('contact_address', $request->input('contact_address'), 'contact');
        Setting::set('operating_hours', $request->input('operating_hours'), 'contact');

        // 3. Pengumuman & Halaman
        Setting::set('announcement_enabled', $request->boolean('announcement_enabled') ? '1' : '0', 'announcement', 'boolean');
        Setting::set('announcement_text', $request->input('announcement_text'), 'announcement', 'textarea');
        Setting::set('footer_copyright', $request->input('footer_copyright'), 'general');

        Setting::flushCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan CMS, Logo, Favicon, dan Branding sistem telah berhasil diperbarui.');
    }
}
