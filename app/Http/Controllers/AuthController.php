<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;

class AuthController extends Controller {
    public function showLogin() {
        // Kalau sudah ada session, gak usah login lagi, Wak!
        if (session('admin_id')) {
            return redirect('/admin');
        }
        if (session('siswa_nis')) {
            return redirect('/aspirasi');
        }
        return view('login');
    }

    public function login(Request $request) {
        $admin = Admin::where('username', $request->username)->first();

        // Cek username dan password manual karena kita pake tabel custom
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id_admin, 'admin_nama' => $admin->nama_admin]);
            return redirect('/admin')->with('success', 'Halo ' . $admin->nama_admin . ', selamat bertugas!');
        }

        return back()->with('error', 'Username atau Password salah, Wak!');
    }

    public function logout(Request $request) {
        // Sapu bersih semua session
        session()->flush(); 
        
        // Atau kalau mau satu-satu:
        // session()->forget(['admin_id', 'admin_nama', 'siswa_nis', 'siswa_nama', 'role']);
    
        return redirect('/')->with('success', 'Sudah keluar kau ya, jangan rindu!');
    }

    public function loginSiswa(Request $request) {
        $siswa = Siswa::where('nis', $request->nis)->first();
    
        // Cek NIS dan Password (asumsi password di database sudah di-bcrypt)
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            // Hapus session admin kalau ada (Biar gak bentrok)
            session()->forget(['admin_id', 'admin_nama']);
            
            session([
                'siswa_nis' => $siswa->nis,
                'siswa_nama' => $siswa->nama,
                'role' => 'siswa'
            ]);
            return redirect('/aspirasi')->with('success', 'Halo ' . $siswa->nama . ', mau lapor apa hari ini?');
        }
    
        return back()->with('error', 'NIS atau Password salah, Lek!');
    }

    public function showRegister() {
        if (session('siswa_nis')) {
            return redirect('/aspirasi');
        }
        if (session('admin_id')) {
            return redirect('/admin');
        }

        return view('register');
    }

    public function registerSiswa(Request $request) {
        $request->validate([
            'nis' => 'required|numeric|digits_between:1,10|unique:siswas,nis',
            'nama' => 'required|string|max:35',
            'kelas' => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nis.unique' => 'NIS sudah terdaftar.',
            'password.confirmed' => 'Password konfirmasi tidak cocok.',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login sebagai siswa.');
    }
}
