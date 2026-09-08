<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSettingTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->seed(SettingSeeder::class);

        $this->superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
        ]);
        $this->superAdmin->assignRole('super_admin');

        $this->adminUser = User::factory()->create([
            'name' => 'Regular Admin',
            'email' => 'admin@admin.com',
        ]);
        $this->adminUser->assignRole('admin');
    }

    public function test_guest_cannot_access_settings_page(): void
    {
        $response = $this->get(route('admin.settings.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_regular_admin_cannot_access_settings_page(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.settings.index'));
        $response->assertStatus(403);
    }

    public function test_super_admin_can_view_settings_page(): void
    {
        $response = $this->actingAs($this->superAdmin)->get(route('admin.settings.index'));
        $response->assertStatus(200);
        $response->assertSee('Pengaturan CMS & Branding Sistem');
    }

    public function test_super_admin_can_update_system_settings_and_upload_files(): void
    {
        Storage::fake('public');

        $logoFile = UploadedFile::fake()->image('custom_logo.png', 200, 200);
        $faviconFile = UploadedFile::fake()->image('custom_favicon.png', 32, 32);

        $response = $this->actingAs($this->superAdmin)->post(route('admin.settings.update'), [
            'app_name' => 'LaporAman CMS Custom',
            'institution_name' => 'PKBM Unggul Berbakat',
            'app_tagline' => 'Sistem Pengaduan Terpadu',
            'app_logo' => $logoFile,
            'app_favicon' => $faviconFile,
            'contact_phone' => '0899-1122-3344',
            'contact_email' => 'support@pkbm.sch.id',
            'contact_address' => 'Jl. Merdeka No. 45',
            'operating_hours' => 'Senin - Sabtu (08:00 - 17:00)',
            'announcement_enabled' => '1',
            'announcement_text' => 'Pengumuman Penting: Sistem berjalan normal.',
            'footer_copyright' => '© 2026 PKBM Unggul Berbakat.',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('LaporAman CMS Custom', setting('app_name'));
        $this->assertEquals('PKBM Unggul Berbakat', setting('institution_name'));
        $this->assertEquals('0899-1122-3344', setting('contact_phone'));
        $this->assertEquals('1', setting('announcement_enabled'));

        $this->assertNotNull(setting('app_logo'));
        Storage::disk('public')->assertExists(setting('app_logo'));

        $this->assertNotNull(setting('app_favicon'));
        Storage::disk('public')->assertExists(setting('app_favicon'));
    }
}
