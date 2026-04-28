<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Notification;
use App\Models\AspirasiAuditLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin_id')) {
            return redirect('/login')->with('error', 'Login dulu lah kau, Wak! Jangan main masuk aja.');
        }

        $query = Aspirasi::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('ket', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($kq) use ($search) {
                      $kq->where('ket_kategori', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $aspirasis = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin_dashboard', compact('aspirasis'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $request->validate([
            'status'   => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'required|max:50',
        ]);

        $aspirasi   = Aspirasi::findOrFail($id);
        $oldStatus  = $aspirasi->status;
        $adminNama  = session('admin_nama');
        $statusChanged  = $oldStatus !== $request->status;
        $feedbackChanged = trim($aspirasi->feedback ?? '') !== trim($request->feedback);

        $aspirasi->update([
            'status'   => $request->status,
            'feedback' => $request->feedback,
        ]);

        // ── AUDIT LOG ──────────────────────────────────────────────
        $action = 'feedback_given';
        if ($statusChanged && $feedbackChanged) {
            $action = 'status_changed';
        } elseif ($statusChanged) {
            $action = 'status_changed';
        }

        AspirasiAuditLog::create([
            'aspirasi_id' => $aspirasi->id_pelaporan,
            'nis_siswa'   => $aspirasi->nis,
            'admin_nama'  => $adminNama,
            'action'      => $action,
            'old_status'  => $oldStatus,
            'new_status'  => $request->status,
            'feedback'    => $request->feedback,
            'notes'       => $statusChanged
                ? "Status diubah dari '{$oldStatus}' menjadi '{$request->status}'"
                : "Feedback diperbarui tanpa perubahan status",
        ]);
        // ──────────────────────────────────────────────────────────

        // ── NOTIFIKASI SISWA ───────────────────────────────────────
        if (($statusChanged || $feedbackChanged) && $aspirasi->nis) {
            $statusText = match ($request->status) {
                'Selesai'  => 'Selesai ✅',
                'Proses'   => 'Sedang Diproses 🔄',
                'Menunggu' => 'Menunggu ⏳',
                default    => 'Diperbarui',
            };

            $katNama = $aspirasi->kategori ? $aspirasi->kategori->ket_kategori : 'Tidak diketahui';

            Notification::create([
                'user_id' => $aspirasi->nis,
                'type'    => 'status_update',
                'title'   => "Laporan Kamu Diperbarui: {$statusText}",
                'message' => "Admin {$adminNama} memperbarui laporan kategori '{$katNama}'. "
                           . ($statusChanged ? "Status: {$oldStatus} → {$request->status}. " : '')
                           . "Feedback: {$request->feedback}",
                'data'    => [
                    'aspirasi_id' => $aspirasi->id_pelaporan,
                    'old_status'  => $oldStatus,
                    'new_status'  => $request->status,
                    'feedback'    => $request->feedback,
                    'admin_nama'  => $adminNama,
                    'action'      => $action,
                ],
            ]);
        }
        // ──────────────────────────────────────────────────────────

        return redirect()->back()->with('success', 'Feedback sudah masuk, Wak!');
    }

    public function destroy($id)
    {
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $aspirasi = Aspirasi::findOrFail($id);

        if ($aspirasi->foto && file_exists(public_path($aspirasi->foto))) {
            @unlink(public_path($aspirasi->foto));
        }

        // Hapus audit log terkait juga
        AspirasiAuditLog::where('aspirasi_id', $aspirasi->id_pelaporan)->delete();

        $aspirasi->delete();

        return redirect()->back()->with('success', 'Laporan sudah disapu bersih dari muka bumi!');
    }

    public function stats()
    {
        if (!session('admin_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'total'    => Aspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'proses'   => Aspirasi::where('status', 'Proses')->count(),
            'selesai'  => Aspirasi::where('status', 'Selesai')->count(),
        ]);
    }

    public function bulkDelete(Request $request)
    {
        if (!session('admin_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate(['ids' => 'required|array']);
        $ids = $request->ids;

        $aspirasis = Aspirasi::whereIn('id_pelaporan', $ids)->get();
        foreach ($aspirasis as $aspirasi) {
            if ($aspirasi->foto && file_exists(public_path($aspirasi->foto))) {
                @unlink(public_path($aspirasi->foto));
            }
        }

        AspirasiAuditLog::whereIn('aspirasi_id', $ids)->delete();
        Aspirasi::whereIn('id_pelaporan', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' laporan berhasil dihapus',
        ]);
    }

    public function bulkStatus(Request $request)
    {
        if (!session('admin_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'ids'    => 'required|array',
            'status' => 'required|in:Menunggu,Proses,Selesai',
        ]);

        $ids       = $request->ids;
        $status    = $request->status;
        $adminNama = session('admin_nama');

        $aspirasis = Aspirasi::whereIn('id_pelaporan', $ids)->with('kategori')->get();

        foreach ($aspirasis as $aspirasi) {
            $oldStatus = $aspirasi->status;
            $aspirasi->update(['status' => $status]);

            // ── AUDIT LOG per item ────────────────────────────────
            AspirasiAuditLog::create([
                'aspirasi_id' => $aspirasi->id_pelaporan,
                'nis_siswa'   => $aspirasi->nis,
                'admin_nama'  => $adminNama,
                'action'      => 'bulk_status',
                'old_status'  => $oldStatus,
                'new_status'  => $status,
                'feedback'    => null,
                'notes'       => "Status diubah massal dari '{$oldStatus}' menjadi '{$status}'",
            ]);
            // ─────────────────────────────────────────────────────

            if ($aspirasi->nis) {
                $statusText = match ($status) {
                    'Selesai'  => 'Selesai ✅',
                    'Proses'   => 'Sedang Diproses 🔄',
                    'Menunggu' => 'Menunggu ⏳',
                    default    => 'Diperbarui',
                };
                $katNama = $aspirasi->kategori ? $aspirasi->kategori->ket_kategori : 'Tidak diketahui';

                Notification::create([
                    'user_id' => $aspirasi->nis,
                    'type'    => 'bulk_status_update',
                    'title'   => "Status Laporan Diperbarui: {$statusText}",
                    'message' => "Admin {$adminNama} mengubah status laporan '{$katNama}' menjadi {$status}.",
                    'data'    => [
                        'aspirasi_id' => $aspirasi->id_pelaporan,
                        'old_status'  => $oldStatus,
                        'new_status'  => $status,
                        'admin_nama'  => $adminNama,
                        'action'      => 'bulk_status',
                    ],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' laporan berhasil diubah statusnya',
        ]);
    }

    public function exportCsv(Request $request)
    {
        if (!session('admin_id')) return redirect('/login');

        $query = Aspirasi::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('ket', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($kq) use ($search) {
                      $kq->where('ket_kategori', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status'))   $query->where('status', $request->status);
        if ($request->filled('kategori')) $query->where('id_kategori', $request->kategori);

        $aspirasis = $query->orderBy('created_at', 'desc')->get();
        $filename  = 'laporan_aspirasi_' . date('Y-m-d_H-i-s') . '.csv';

        return response()->stream(function () use ($aspirasis) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['NIS', 'Kategori', 'Isi Laporan', 'Status', 'Feedback', 'Tanggal Dibuat']);
            foreach ($aspirasis as $aspi) {
                fputcsv($file, [
                    $aspi->nis,
                    $aspi->kategori->ket_kategori ?? '-',
                    $aspi->ket,
                    $aspi->status,
                    $aspi->feedback ?? '-',
                    $aspi->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        }, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function exportPdf(Request $request)
    {
        if (!session('admin_id')) return redirect('/login');

        $query = Aspirasi::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('ket', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($kq) use ($search) {
                      $kq->where('ket_kategori', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status'))   $query->where('status', $request->status);
        if ($request->filled('kategori')) $query->where('id_kategori', $request->kategori);

        $aspirasis = $query->orderBy('created_at', 'desc')->get();

        $html = '<html><head><style>
            body { font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            h1 { text-align: center; }
        </style></head><body>
        <h1>Laporan Aspirasi Siswa</h1>
        <p>Diekspor pada: ' . date('Y-m-d H:i:s') . '</p>
        <table><thead><tr>
            <th>NIS</th><th>Kategori</th><th>Isi Laporan</th>
            <th>Status</th><th>Feedback</th><th>Tanggal</th>
        </tr></thead><tbody>';

        foreach ($aspirasis as $aspi) {
            $html .= "<tr>
                <td>{$aspi->nis}</td>
                <td>" . ($aspi->kategori->ket_kategori ?? '-') . "</td>
                <td>{$aspi->ket}</td>
                <td>{$aspi->status}</td>
                <td>" . ($aspi->feedback ?? '-') . "</td>
                <td>" . $aspi->created_at->format('Y-m-d H:i:s') . "</td>
            </tr>";
        }

        $html .= '</tbody></table></body></html>';
        $filename = 'laporan_aspirasi_' . date('Y-m-d_H-i-s') . '.html';

        return response($html, 200, [
            'Content-Type'        => 'text/html',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}