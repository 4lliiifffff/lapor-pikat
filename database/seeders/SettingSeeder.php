<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSettings = [
            // Identitas & Branding
            'app_name' => ['value' => 'LaporAman', 'group' => 'branding', 'type' => 'text'],
            'institution_name' => ['value' => 'PKBM Pintar Berbakat', 'group' => 'branding', 'type' => 'text'],
            'app_tagline' => ['value' => 'Pusat Pelaporan & Perlindungan Anti-Perundungan', 'group' => 'branding', 'type' => 'text'],
            'app_logo' => ['value' => null, 'group' => 'branding', 'type' => 'image'],
            'app_favicon' => ['value' => null, 'group' => 'branding', 'type' => 'image'],

            // Informasi Kontak & Bantuan Darurat
            'contact_phone' => ['value' => '0812-3456-7890', 'group' => 'contact', 'type' => 'text'],
            'contact_email' => ['value' => 'lapor@pkbmpintar.sch.id', 'group' => 'contact', 'type' => 'text'],
            'contact_address' => ['value' => 'Jl. Pendidikan No. 123, Jakarta Selatan', 'group' => 'contact', 'type' => 'text'],
            'operating_hours' => ['value' => 'Senin - Jumat (08:00 - 16:00 WIB)', 'group' => 'contact', 'type' => 'text'],

            // Pengumuman & Teks Halaman
            'announcement_enabled' => ['value' => '0', 'group' => 'announcement', 'type' => 'boolean'],
            'announcement_text' => ['value' => 'Layanan pengaduan tetap buka 24 jam. Setiap laporan diproses dengan jaminan kerahasiaan penuh.', 'group' => 'announcement', 'type' => 'textarea'],
            'footer_copyright' => ['value' => '© 2026 PKBM Pintar Berbakat. Hak Cipta Dilindungi.', 'group' => 'general', 'type' => 'text'],
        ];

        foreach ($defaultSettings as $key => $data) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $data['value'],
                    'group' => $data['group'],
                    'type' => $data['type'],
                ]
            );
        }

        Setting::flushCache();
    }
}
