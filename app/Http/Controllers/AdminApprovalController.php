<?php

namespace App\Http\Controllers;

use App\Models\PendingSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminApprovalController extends Controller
{
    public function index()
    {
        if (!session('admin_id')) {
            return redirect('/login')->with('error', 'Login dulu lah kau, Wak!');
        }

        $pending  = PendingSiswa::pending()->orderBy('created_at', 'desc')->get();
        $approved = PendingSiswa::approved()->orderBy('updated_at', 'desc')->limit(20)->get();
        $rejected = PendingSiswa::rejected()->orderBy('updated_at', 'desc')->limit(20)->get();

        $countPending = $pending->count();

        return view('admin_approval', compact('pending', 'approved', 'rejected', 'countPending'));
    }

    public function approve($id)
    {
        if (!session('admin_id')) return redirect('/login');

        $pending = PendingSiswa::findOrFail($id);

        // Pindahkan ke tabel siswas
        Siswa::create([
            'nis'      => $pending->nis,
            'nama'     => $pending->nama,
            'kelas'    => $pending->kelas,
            'password' => $pending->password, // sudah di-hash
        ]);

        $pending->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Akun ' . $pending->nama . ' (NIS: ' . $pending->nis . ') berhasil disetujui!');
    }

    public function reject(Request $request, $id)
    {
        if (!session('admin_id')) return redirect('/login');

        $request->validate([
            'reject_reason' => 'nullable|string|max:255',
        ]);

        $pending = PendingSiswa::findOrFail($id);
        $pending->update([
            'status'        => 'rejected',
            'reject_reason' => $request->reject_reason,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ' . $pending->nama . ' ditolak.');
    }

    public function bulkApprove(Request $request)
    {
        if (!session('admin_id')) return response()->json(['error' => 'Unauthorized'], 401);

        $request->validate(['ids' => 'required|array']);
        $ids = $request->ids;

        $pendings = PendingSiswa::whereIn('id', $ids)->where('status', 'pending')->get();

        $approvedCount = 0;
        foreach ($pendings as $pending) {
            // Cek NIS belum ada di siswas
            if (!Siswa::where('nis', $pending->nis)->exists()) {
                Siswa::create([
                    'nis'      => $pending->nis,
                    'nama'     => $pending->nama,
                    'kelas'    => $pending->kelas,
                    'password' => $pending->password,
                ]);
                $pending->update(['status' => 'approved']);
                $approvedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => $approvedCount . ' akun berhasil disetujui!',
        ]);
    }
}