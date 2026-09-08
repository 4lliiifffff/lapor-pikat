<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportAttachment;
use App\Models\ReportHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Tampilkan formulir pelaporan bullying.
     */
    public function create(): View
    {
        $classes = [
            'Paket A (Setara SD)',
            'Paket B (Setara SMP)',
            'Paket C (Setara SMA) - IPA',
            'Paket C (Setara SMA) - IPS',
            'Kursus & Pelatihan Keterampilan',
            'Keaksaraan Fungsional',
            'Lainnya / Umum',
        ];

        $incidentTypes = [
            'fisik' => 'Perundungan Fisik (Memukul, menendang, merusak barang, dll)',
            'verbal' => 'Perundungan Verbal (Mengejek, mengancam, memanggil julukan buruk, dll)',
            'sosial' => 'Perundungan Sosial (Mengucilkan, menyebar gosip, menghasut, dll)',
            'online' => 'Online / Cyberbullying (Meneror di medsos, menyebar chat/foto memalukan, dll)',
            'lainnya' => 'Bentuk Perundungan Lainnya',
        ];

        return view('reports.create', compact('classes', 'incidentTypes'));
    }

    /**
     * Simpan laporan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $isAnonymous = $request->input('report_method') === 'anonymous';

        $rules = [
            'report_method' => ['required', 'in:anonymous,personal'],
            'incident_type' => ['required', 'in:fisik,verbal,sosial,online,lainnya'],
            'chronology' => ['required', 'string', 'min:10', 'max:5000'],
            'incident_date' => ['nullable', 'date'],
            'incident_location' => ['nullable', 'string', 'max:150'],
            'parties_involved' => ['nullable', 'string', 'max:255'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:1024'], // max 1MB per file
        ];

        if (! $isAnonymous) {
            $rules['reporter_name'] = ['required', 'string', 'max:150'];
            $rules['reporter_class'] = ['required', 'string', 'max:100'];
            $rules['reporter_phone'] = ['required', 'string', 'max:30', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'];
        }

        $validated = $request->validate($rules, [
            'chronology.required' => 'Ceritakan kronologi kejadian secara jelas agar dapat ditindaklanjuti.',
            'chronology.min' => 'Kronologi kejadian minimal 10 karakter.',
            'incident_type.required' => 'Silakan pilih jenis kejadian.',
            'reporter_name.required' => 'Nama lengkap wajib diisi untuk pelaporan dengan data diri.',
            'reporter_class.required' => 'Pilih kelas kamu saat ini.',
            'reporter_phone.required' => 'Nomor WhatsApp aktif wajib diisi.',
            'reporter_phone.regex' => 'Format nomor WhatsApp tidak valid (contoh: 081234567890).',
            'attachments.max' => 'Maksimal bukti pendukung yang diunggah adalah 5 file.',
            'attachments.*.max' => 'Ukuran masing-masing file maksimal 1 MB.',
            'attachments.*.mimes' => 'Format file yang didukung hanya JPG, PNG, WEBP, atau PDF.',
        ]);

        $report = DB::transaction(function () use ($validated, $isAnonymous, $request) {
            $trackingCode = Report::generateUniqueTrackingCode();

            $report = Report::create([
                'tracking_code' => $trackingCode,
                'is_anonymous' => $isAnonymous,
                'reporter_name' => $isAnonymous ? null : $validated['reporter_name'],
                'reporter_class' => $isAnonymous ? null : $validated['reporter_class'],
                'reporter_phone' => $isAnonymous ? null : $validated['reporter_phone'],
                'incident_type' => $validated['incident_type'],
                'chronology' => $validated['chronology'],
                'incident_date' => $validated['incident_date'] ?? null,
                'incident_location' => $validated['incident_location'] ?? null,
                'parties_involved' => $validated['parties_involved'] ?? null,
                'status' => 'pending',
                'admin_notes' => null,
            ]);

            // Log riwayat awal
            ReportHistory::create([
                'report_id' => $report->id,
                'status' => 'pending',
                'note' => 'Laporan berhasil diterima oleh sistem dan sedang menunggu validasi kelayakan oleh Petugas Internal.',
                'changed_by' => 'Sistem Lapor Aman',
            ]);

            // Upload attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('report-attachments', 'public');
                    ReportAttachment::create([
                        'report_id' => $report->id,
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType() ?? $file->getMimeType(),
                    ]);
                }
            }

            return $report;
        });

        return redirect()->route('reports.success', ['code' => $report->tracking_code]);
    }

    /**
     * Halaman konfirmasi sukses setelah kirim laporan.
     */
    public function success(string $code): View|RedirectResponse
    {
        $report = Report::where('tracking_code', $code)->first();

        if (! $report) {
            return redirect()->route('reports.create')->with('error', 'Laporan tidak ditemukan.');
        }

        return view('reports.success', compact('report'));
    }

    /**
     * Halaman form pelacakan laporan.
     */
    public function track(): View
    {
        return view('reports.track');
    }

    /**
     * Cari laporan berdasarkan kode pelacakan.
     */
    public function trackSearch(Request $request): RedirectResponse
    {
        $request->validate([
            'tracking_code' => ['required', 'string', 'max:50'],
        ], [
            'tracking_code.required' => 'Masukkan kode pelacakan yang kamu miliki.',
        ]);

        $code = trim(strtoupper($request->input('tracking_code')));

        $report = Report::where('tracking_code', $code)->first();

        if (! $report) {
            return redirect()->route('reports.track')
                ->withInput()
                ->with('error', "Kode pelacakan '{$code}' tidak ditemukan. Pastikan format penulisan sudah benar (contoh: ABT-XXXX-XXXX).");
        }

        return redirect()->route('reports.track.detail', ['code' => $code]);
    }

    /**
     * Tampilkan detail status laporan berdasarkan kode.
     */
    public function trackDetail(string $code): View|RedirectResponse
    {
        $code = trim(strtoupper($code));
        $report = Report::with(['histories', 'attachments'])->where('tracking_code', $code)->first();

        if (! $report) {
            return redirect()->route('reports.track')
                ->with('error', "Kode pelacakan '{$code}' tidak ditemukan.");
        }

        return view('reports.track', compact('report'));
    }
}
