<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    /**
     * Tampilkan daftar laporan masuk untuk tim PKBM INTAN.
     */
    public function index(Request $request): View
    {
        $statusFilter = $request->query('status');
        $methodFilter = $request->query('method');
        $search = $request->query('q');

        $query = Report::with('attachments')->latest();

        if ($statusFilter && in_array($statusFilter, ['pending', 'reviewing', 'recommendation', 'awaiting_satgas', 'satgas_action', 'investigating', 'resolved', 'rejected'])) {
            $query->where('status', $statusFilter);
        }

        if ($methodFilter === 'anonymous') {
            $query->where('is_anonymous', true);
        } elseif ($methodFilter === 'personal') {
            $query->where('is_anonymous', false);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                    ->orWhere('reporter_name', 'like', "%{$search}%")
                    ->orWhere('incident_location', 'like', "%{$search}%")
                    ->orWhere('chronology', 'like', "%{$search}%");
            });
        }

        $reports = $query->paginate(12)->withQueryString();

        $stats = [
            'total' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'reviewing' => Report::where('status', 'reviewing')->count(),
            'recommendation' => Report::where('status', 'recommendation')->count(),
            'awaiting_satgas' => Report::where('status', 'awaiting_satgas')->count(),
            'satgas_action' => Report::whereIn('status', ['satgas_action', 'investigating'])->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'rejected' => Report::where('status', 'rejected')->count(),
        ];

        return view('admin.index', compact('reports', 'stats', 'statusFilter', 'methodFilter', 'search'));
    }

    /**
     * Tampilkan rincian laporan untuk penanganan tim PKBM.
     */
    public function show(Report $report): View
    {
        $report->load(['attachments', 'histories']);

        return view('admin.show', compact('report'));
    }

    /**
     * Update status dan berikan catatan penanganan.
     */
    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,reviewing,recommendation,awaiting_satgas,satgas_action,investigating,resolved,rejected'],
            'note' => ['nullable', 'string', 'max:2000'],
            'officer_name' => ['nullable', 'string', 'max:100'],
        ]);

        $oldStatus = $report->status;
        $newStatus = $validated['status'];
        $officerName = $validated['officer_name'] ?: 'Petugas Internal PKBM';

        $defaultNotes = [
            'pending' => 'Laporan diajukan dan sedang dalam proses validasi kelayakan oleh petugas internal.',
            'reviewing' => 'Laporan dinyatakan valid dan dilanjutkan ke tahap investigasi oleh pihak internal.',
            'recommendation' => 'Pihak internal telah selesai menyusun rekomendasi kasus untuk dikirimkan ke Satgas.',
            'awaiting_satgas' => 'Rekomendasi diserahkan ke Satgas. Pihak internal sedang menunggu respon pemanggilan dari Satgas.',
            'satgas_action' => 'Satgas melaksanakan tindakan pemulihan/rehabilitasi korban dan penetapan sanksi bagi pelaku.',
            'investigating' => 'Satgas melaksanakan tindakan pemulihan/rehabilitasi korban dan penetapan sanksi bagi pelaku.',
            'resolved' => 'Penanganan laporan telah tuntas dan kasus dinyatakan selesai.',
            'rejected' => 'Laporan ditolak setelah validasi/investigasi internal (informasi tidak valid atau bukan bentuk perundungan).',
        ];

        $note = $validated['note'] ?: ($defaultNotes[$newStatus] ?? "Status laporan diperbarui dari {$oldStatus} menjadi {$newStatus}.");

        $report->update([
            'status' => $newStatus,
            'admin_notes' => $note,
        ]);

        ReportHistory::create([
            'report_id' => $report->id,
            'status' => $newStatus,
            'note' => $note,
            'changed_by' => $officerName,
        ]);

        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Status laporan dan catatan tindak lanjut berhasil diperbarui!');
    }
}
