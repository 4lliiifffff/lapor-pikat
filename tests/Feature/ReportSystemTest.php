<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReportSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_can_view_create_report_page(): void
    {
        $response = $this->get(route('reports.create'));

        $response->assertStatus(200);
        $response->assertSee('Ceritakan apa yang terjadi');
        $response->assertSee('Anonim');
        $response->assertSee('Pakai Data Saya');
    }

    public function test_can_submit_anonymous_report_successfully(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('bukti.png', 200, 'image/png');

        $payload = [
            'report_method' => 'anonymous',
            'incident_type' => 'verbal',
            'chronology' => 'Saya melihat kejadian perundungan di kelas Paket B kemarin siang.',
            'incident_date' => '2026-09-01',
            'incident_location' => 'Ruang Kelas Paket B',
            'parties_involved' => 'Siswa kelas Paket B',
            'attachments' => [$file],
        ];

        $response = $this->post(route('reports.store'), $payload);

        $report = Report::first();

        $this->assertNotNull($report);
        $this->assertTrue($report->is_anonymous);
        $this->assertNull($report->reporter_name);
        $this->assertStringStartsWith('ABT-', $report->tracking_code);
        $this->assertCount(1, $report->attachments);
        $this->assertCount(1, $report->histories);

        $response->assertRedirect(route('reports.success', ['code' => $report->tracking_code]));
    }

    public function test_can_submit_personal_data_report_successfully(): void
    {
        $payload = [
            'report_method' => 'personal',
            'reporter_name' => 'Fajar Pratama',
            'reporter_class' => 'Paket C (Setara SMA) - IPA',
            'reporter_phone' => '081234567890',
            'incident_type' => 'online',
            'chronology' => 'Menerima pesan bernada ancaman di grup kelas dari akun tidak dikenal.',
            'incident_date' => '2026-09-02',
        ];

        $response = $this->post(route('reports.store'), $payload);

        $report = Report::first();

        $this->assertNotNull($report);
        $this->assertFalse($report->is_anonymous);
        $this->assertSame('Fajar Pratama', $report->reporter_name);
        $this->assertSame('081234567890', $report->reporter_phone);

        $response->assertRedirect(route('reports.success', ['code' => $report->tracking_code]));
    }

    public function test_validation_fails_if_personal_fields_are_missing_when_selecting_personal(): void
    {
        $payload = [
            'report_method' => 'personal',
            'incident_type' => 'fisik',
            'chronology' => 'Perundungan fisik terjadi di halaman.',
        ];

        $response = $this->post(route('reports.store'), $payload);

        $response->assertSessionHasErrors(['reporter_name', 'reporter_class', 'reporter_phone']);
    }

    public function test_can_track_report_with_valid_code(): void
    {
        $report = Report::create([
            'tracking_code' => 'ABT-TEST-1234',
            'is_anonymous' => true,
            'incident_type' => 'sosial',
            'chronology' => 'Kronologi pengucilan warga belajar.',
            'status' => 'pending',
        ]);

        $response = $this->get(route('reports.track.detail', ['code' => 'ABT-TEST-1234']));

        $response->assertStatus(200);
        $response->assertSee('ABT-TEST-1234');
        $response->assertSee('Menunggu Validasi Internal');
        $response->assertSee('Kronologi pengucilan warga belajar.');
    }

    public function test_can_view_education_page(): void
    {
        $response = $this->get(route('education.index'));

        $response->assertStatus(200);
        $response->assertSee('Kenali, Cegah, dan Hadapi Perundungan');
        $response->assertSee('Kamu tidak salah');
        $response->assertSee('Tim PKBM Pintar Berbakat');
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_panel(): void
    {
        $response = $this->get(route('admin.reports.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_without_role_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.reports.index'));

        $response->assertStatus(403);
    }

    public function test_admin_with_role_can_view_reports_and_update_status(): void
    {
        $admin = User::where('email', 'admin@pkbm.id')->first();

        $report = Report::create([
            'tracking_code' => 'ABT-ADMIN-9999',
            'is_anonymous' => true,
            'incident_type' => 'fisik',
            'chronology' => 'Laporan uji coba admin.',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.reports.index'));
        $response->assertStatus(200);
        $response->assertSee('ABT-ADMIN-9999');

        $updateResponse = $this->actingAs($admin)->put(route('admin.reports.updateStatus', $report), [
            'status' => 'investigating',
            'officer_name' => 'Pak Tutor',
            'note' => 'Kasus sedang ditindaklanjuti dengan pemanggilan pihak terkait.',
        ]);

        $updateResponse->assertRedirect(route('admin.reports.show', $report));

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'status' => 'investigating',
        ]);

        $this->assertDatabaseHas('report_histories', [
            'report_id' => $report->id,
            'status' => 'investigating',
            'changed_by' => 'Pak Tutor',
        ]);
    }
}
