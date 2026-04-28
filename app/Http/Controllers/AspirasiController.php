<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\AspirasiAuditLog;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $status    = request('status');

        if (session('admin_id')) {
            $aspirasisQuery = Aspirasi::with('kategori')->orderBy('created_at', 'desc');

            $stats = [
                'total'    => $aspirasisQuery->count(),
                'menunggu' => (clone $aspirasisQuery)->where('status', 'Menunggu')->count(),
                'proses'   => (clone $aspirasisQuery)->where('status', 'Proses')->count(),
                'selesai'  => (clone $aspirasisQuery)->where('status', 'Selesai')->count(),
            ];

            if (in_array($status, ['Menunggu', 'Proses', 'Selesai'])) {
                $aspirasisQuery->where('status', $status);
            }

            $aspirasis = $aspirasisQuery->get();

            return view('aspirasi', compact('kategoris', 'aspirasis', 'status', 'stats'));
        }

        if (!session('siswa_nis')) {
            return redirect('/login')->with('error', 'Login dulu, Wak. Baru bisa lihat laporanmu di sini.');
        }

        $aspirasisQuery = Aspirasi::where('nis', session('siswa_nis'))
                            ->with('kategori')
                            ->orderBy('created_at', 'desc');

        $stats = [
            'total'    => $aspirasisQuery->count(),
            'menunggu' => (clone $aspirasisQuery)->where('status', 'Menunggu')->count(),
            'proses'   => (clone $aspirasisQuery)->where('status', 'Proses')->count(),
            'selesai'  => (clone $aspirasisQuery)->where('status', 'Selesai')->count(),
        ];

        $aspirasis = $aspirasisQuery->get();

        return view('aspirasi', compact('kategoris', 'aspirasis', 'stats'));
    }

    public function stats()
    {
        if (session('admin_id')) {
            $scope = Aspirasi::query();
        } elseif (session('siswa_nis')) {
            $scope = Aspirasi::where('nis', session('siswa_nis'));
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'total'    => $scope->count(),
            'menunggu' => (clone $scope)->where('status', 'Menunggu')->count(),
            'proses'   => (clone $scope)->where('status', 'Proses')->count(),
            'selesai'  => (clone $scope)->where('status', 'Selesai')->count(),
        ]);
    }

    public function profile()
    {
        if (!session('siswa_nis')) {
            return redirect('/login')->with('error', 'Login dulu kau, Wak!');
        }

        $user = \App\Models\Siswa::where('nis', session('siswa_nis'))->first();

        $laporan_saya = Aspirasi::where('nis', session('siswa_nis'))
                        ->with('kategori')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // ── AUDIT LOGS milik siswa ini, terbaru di atas ──────────
        $auditLogs = AspirasiAuditLog::where('nis_siswa', session('siswa_nis'))
                        ->with(['aspirasi.kategori'])
                        ->orderBy('created_at', 'desc')
                        ->get();
        // ─────────────────────────────────────────────────────────

        return view('siswa_profile', compact('user', 'laporan_saya', 'auditLogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'         => 'required|numeric|digits_between:5,10',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi'      => 'required|max:50',
            'ket'         => 'required|min:10|max:255',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nis.numeric' => 'NIS itu pake angka lah, Wak! Jangan kau masukkan huruf pulak.',
            'ket.min'     => 'Curhat sikit lah, minimal 10 huruf biar admin paham.',
            'foto.image'  => 'Foto harus berupa file gambar.',
            'foto.mimes'  => 'Foto hanya boleh JPG, JPEG, PNG, atau GIF.',
            'foto.max'    => 'Foto maksimal 2MB saja, Wak.',
        ]);

        $cekSpam = Aspirasi::where('nis', $request->nis)
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();

        if ($cekSpam >= 2) {
            return redirect()->back()->withErrors(['spam' => 'Sabar, Wak! Kau sudah melapor 2 kali hari ini.']);
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $folder   = public_path('uploads/aspirasi');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->move($folder, $filename);
            $fotoPath = 'uploads/aspirasi/' . $filename;
        }

        Aspirasi::create([
            'nis'         => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'status'      => 'Menunggu',
            'foto'        => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Paten! Laporan kau sudah masuk antrean.');
    }
}