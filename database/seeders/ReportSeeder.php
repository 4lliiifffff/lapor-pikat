<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Laporan Anonim - Menunggu Verifikasi
        $report1 = Report::create([
            'tracking_code' => 'ABT-8K92-7P14',
            'is_anonymous' => true,
            'incident_type' => 'verbal',
            'chronology' => 'Setiap jam istirahat di lorong lantai 2, ada beberapa siswa Paket C yang sering mengejek cara bicara dan penampilan saya dengan kata-kata kasar dan julukan yang merendahkan di depan umum sehingga saya merasa takut ke sekolah.',
            'incident_date' => Carbon::now()->subDays(2),
            'incident_location' => 'Lorong Lantai 2 Dekat Ruang Tutor',
            'parties_involved' => '3 orang siswa Paket C kelas siang',
            'status' => 'pending',
            'created_at' => Carbon::now()->subDays(2),
        ]);

        ReportHistory::create([
            'report_id' => $report1->id,
            'status' => 'pending',
            'note' => 'Laporan berhasil diterima oleh sistem dan sedang menunggu peninjauan awal dari Petugas Internal PKBM Pintar Berbakat.',
            'changed_by' => 'Sistem Lapor Aman',
            'created_at' => Carbon::now()->subDays(2),
        ]);

        // 2. Laporan Dengan Data Pribadi - Sedang Ditinjau Internal
        $report2 = Report::create([
            'tracking_code' => 'ABT-4M21-9X88',
            'is_anonymous' => false,
            'reporter_name' => 'Budi Santoso',
            'reporter_class' => 'Paket B (Setara SMP)',
            'reporter_phone' => '081234567890',
            'incident_type' => 'fisik',
            'chronology' => 'Kemarin setelah kelas selesai di area parkiran, helm saya sengaja dibuang dan tas saya ditarik sampai robek oleh teman sekelas.',
            'incident_date' => Carbon::now()->subDays(4),
            'incident_location' => 'Area Parkiran Sepeda Motor PKBM',
            'parties_involved' => '2 teman sekelas Paket B',
            'status' => 'reviewing',
            'admin_notes' => 'Petugas internal sedang melakukan verifikasi data laporan sebelum diputuskan apakah ditolak atau diteruskan ke Satgas.',
            'created_at' => Carbon::now()->subDays(4),
        ]);

        ReportHistory::create([
            'report_id' => $report2->id,
            'status' => 'pending',
            'note' => 'Laporan diterima sistem.',
            'changed_by' => 'Sistem Lapor Aman',
            'created_at' => Carbon::now()->subDays(4),
        ]);

        ReportHistory::create([
            'report_id' => $report2->id,
            'status' => 'reviewing',
            'note' => 'Petugas internal sedang melakukan verifikasi data laporan sebelum diputuskan apakah ditolak atau diteruskan ke Satgas.',
            'changed_by' => 'Bu Siti (Petugas Internal)',
            'created_at' => Carbon::now()->subDays(3),
        ]);

        // 3. Laporan Selesai
        $report3 = Report::create([
            'tracking_code' => 'ABT-3T67-5L09',
            'is_anonymous' => true,
            'incident_type' => 'online',
            'chronology' => 'Ada akun Instagram palsu yang menyebarkan editan foto memalukan salah satu warga belajar Paket A di grup WhatsApp antar kelas.',
            'incident_date' => Carbon::now()->subDays(10),
            'incident_location' => 'Grup WhatsApp Belajar',
            'parties_involved' => 'Admin akun anonim',
            'status' => 'resolved',
            'admin_notes' => 'Tindak lanjut oleh Satgas telah selesai, konten dihapus, dan mediasi tertulis diselesaikan.',
            'created_at' => Carbon::now()->subDays(10),
        ]);

        ReportHistory::create([
            'report_id' => $report3->id,
            'status' => 'pending',
            'note' => 'Laporan diterima sistem.',
            'changed_by' => 'Sistem Lapor Aman',
            'created_at' => Carbon::now()->subDays(10),
        ]);

        ReportHistory::create([
            'report_id' => $report3->id,
            'status' => 'investigating',
            'note' => 'Laporan disetujui petugas internal dan diteruskan ke Satgas. Menunggu respon & tindakan dari Satgas.',
            'changed_by' => 'Pak Hendra (Petugas Internal)',
            'created_at' => Carbon::now()->subDays(8),
        ]);

        ReportHistory::create([
            'report_id' => $report3->id,
            'status' => 'resolved',
            'note' => 'Mediasi telah dilakukan bersama pengelola PKBM, konten telah dihapus dari peredaran, dan pihak yang terlibat telah diberikan pembinaan serta menandatangani komitmen tertulis.',
            'changed_by' => 'Pak Hendra (Koordinator PKBM)',
            'created_at' => Carbon::now()->subDays(1),
        ]);
    }
}
