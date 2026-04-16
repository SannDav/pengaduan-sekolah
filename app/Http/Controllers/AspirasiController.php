<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index() 
    {
        $kategoris = Kategori::all();

        if (session('admin_id')) {
            $aspirasis = Aspirasi::with('kategori')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('aspirasi', compact('kategoris', 'aspirasis'));
        }

        if (!session('siswa_nis')) {
            return redirect('/login')->with('error', 'Login dulu, Wak. Baru bisa lihat laporanmu di sini.');
        }

        $aspirasis = Aspirasi::where('nis', session('siswa_nis'))
                        ->with('kategori')
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        return view('aspirasi', compact('kategoris', 'aspirasis'));
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
            'total' => $scope->count(),
            'menunggu' => (clone $scope)->where('status', 'Menunggu')->count(),
            'selesai' => (clone $scope)->where('status', 'Selesai')->count(),
        ]);
    }

    public function profile() {
        // 1. Cek dulu, kalau belum login tendang ke login
        if (!session('siswa_nis')) {
            return redirect('/login')->with('error', 'Login dulu kau, Wak!');
        }
    
        // 2. Ambil data siswa dari tabel siswas
        $user = \App\Models\Siswa::where('nis', session('siswa_nis'))->first();
    
        // 3. Ambil laporan KHUSUS milik dia aja
        $laporan_saya = Aspirasi::where('nis', session('siswa_nis'))
                        ->with('kategori')
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        return view('siswa_profile', compact('user', 'laporan_saya'));
    }

    

    public function store(Request $request) 
{
        // Lapis 1: Validasi Format Data
        $request->validate([
            'nis'         => 'required|numeric|digits_between:5,10', // NIS harus angka & panjangnya pas
            'id_kategori' => 'required|exists:kategoris,id_kategori', // Kategori harus ada di database
            'lokasi'      => 'required|max:50',
            'ket'         => 'required|min:10', // Biar nggak cuma isi "asdasd"
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Pesan eror pake bahasa kita biar mantap
            'nis.numeric' => 'NIS itu pake angka lah, Wak! Jangan kau masukkan huruf pulak.',
            'ket.min'     => 'Curhat sikit lah, minimal 10 huruf biar admin paham.',
            'foto.image'  => 'Foto harus berupa file gambar.',
            'foto.mimes'  => 'Foto hanya boleh JPG, JPEG, PNG, atau GIF.',
            'foto.max'    => 'Foto maksimal 2MB saja, Wak.',
        ]);

        // Lapis 2: Validasi Anti-Spam (Pencegahan)
        $cekSpam = Aspirasi::where('nis', $request->nis)
                    ->whereDate('created_at', date('Y-m-d')) // Cek laporan di hari yang sama
                    ->count();

        if ($cekSpam >= 2) { // Kita kasih jatah maksimal 2 laporan per hari biar gak pelit kali
            return redirect()->back()->withErrors(['spam' => 'Sabar, Wak! Kau sudah melapor 2 kali hari ini. Tunggu besok ya atau tunggu dibalas admin.']);
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $folder = public_path('uploads/aspirasi');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->move($folder, $filename);
            $fotoPath = 'uploads/aspirasi/' . $filename;
        }

        // Kalau lolos dua lapis tadi, baru kita simpan
        Aspirasi::create([
            'nis'         => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'status'      => 'Menunggu', // Status awal default
            'foto'        => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Paten! Laporan kau sudah masuk antrean.');
    }
}