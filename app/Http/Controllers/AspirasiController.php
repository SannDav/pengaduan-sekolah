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
        $aspirasis = Aspirasi::with('kategori')->orderBy('created_at', 'desc')->get();
    
        return view('aspirasi', compact('kategoris', 'aspirasis'));
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
    ], [
        // Pesan eror pake bahasa kita biar mantap
        'nis.numeric' => 'NIS itu pake angka lah, Wak! Jangan kau masukkan huruf pulak.',
        'ket.min'     => 'Curhat sikit lah, minimal 10 huruf biar admin paham.',
    ]);

    // Lapis 2: Validasi Anti-Spam (Pencegahan)
    $cekSpam = Aspirasi::where('nis', $request->nis)
                ->whereDate('created_at', date('Y-m-d')) // Cek laporan di hari yang sama
                ->count();

    if ($cekSpam >= 2) { // Kita kasih jatah maksimal 2 laporan per hari biar gak pelit kali
        return redirect()->back()->withErrors(['spam' => 'Sabar, Wak! Kau sudah melapor 2 kali hari ini. Tunggu besok ya atau tunggu dibalas admin.']);
    }

    // Kalau lolos dua lapis tadi, baru kita simpan
    Aspirasi::create([
        'nis'         => $request->nis,
        'id_kategori' => $request->id_kategori,
        'lokasi'      => $request->lokasi,
        'ket'         => $request->ket,
        'status'      => 'Menunggu', // Status awal default
    ]);

    return redirect()->back()->with('success', 'Paten! Laporan kau sudah masuk antrean.');
}
}