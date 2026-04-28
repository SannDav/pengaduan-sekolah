<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\PendingSiswa;

class AuthController extends Controller {
    public function showLogin() {
        if (session('admin_id')) return redirect('/admin');
        if (session('siswa_nis')) return redirect('/aspirasi');
        return view('login');
    }

    public function login(Request $request) {
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id_admin, 'admin_nama' => $admin->nama_admin]);
            return redirect('/admin')->with('success', 'Halo ' . $admin->nama_admin . ', selamat bertugas!');
        }
        return back()->with('error', 'Username atau Password salah, Wak!');
    }

    public function logout(Request $request) {
        session()->flush();
        return redirect('/')->with('success', 'Sudah keluar kau ya, jangan rindu!');
    }

    public function loginSiswa(Request $request) {
        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            session()->forget(['admin_id', 'admin_nama']);
            session([
                'siswa_nis'  => $siswa->nis,
                'siswa_nama' => $siswa->nama,
                'role'       => 'siswa'
            ]);
            return redirect('/aspirasi')->with('success', 'Halo ' . $siswa->nama . ', mau lapor apa hari ini?');
        }

        // Cek apakah ada di pending (belum diapprove)
        $pending = PendingSiswa::where('nis', $request->nis)->first();
        if ($pending) {
            if ($pending->status === 'pending') {
                return back()->with('error', 'Akun kamu masih menunggu persetujuan admin. Sabar ya, Wak!');
            }
            if ($pending->status === 'rejected') {
                $reason = $pending->reject_reason ? ' Alasan: ' . $pending->reject_reason : '';
                return back()->with('error', 'Pendaftaran kamu ditolak admin.' . $reason);
            }
        }

        return back()->with('error', 'NIS atau Password salah, Lek!');
    }

    public function showRegister() {
        if (session('siswa_nis')) return redirect('/aspirasi');
        if (session('admin_id')) return redirect('/admin');
        return view('register');
    }

    public function registerSiswa(Request $request) {
        $request->validate([
            'nis'      => [
                'required', 'numeric', 'digits_between:1,10',
                // Unik di siswas DAN di pending_siswas
                \Illuminate\Validation\Rule::unique('siswas', 'nis'),
                \Illuminate\Validation\Rule::unique('pending_siswas', 'nis')->where(fn($q) => $q->whereIn('status', ['pending', 'approved'])),
            ],
            'nama'     => 'required|string|max:35',
            'kelas'    => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nis.unique'    => 'NIS sudah terdaftar atau sedang menunggu persetujuan.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
        ]);

        PendingSiswa::create([
            'nis'      => $request->nis,
            'nama'     => $request->nama,
            'kelas'    => $request->kelas,
            'password' => Hash::make($request->password),
            'status'   => 'pending',
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Tunggu persetujuan admin sebelum bisa login ya, Wak.');
    }
}