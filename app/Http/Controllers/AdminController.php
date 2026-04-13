<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        // INI DIA GEMBOKNYA, LEK!
        // Jika tidak ada 'admin_id' di session (artinya belum login)
        if (!session('admin_id')) {
            // Maka tendang dia ke halaman login dengan pesan error
            return redirect('/login')->with('error', 'Login dulu lah kau, Wak! Jangan main masuk aja.');
        }

        $aspirasis = Aspirasi::with('kategori')->orderBy('created_at', 'desc')->get();
        return view('admin_dashboard', compact('aspirasis'));
    }

    public function update(Request $request, $id) {
        // Di sini juga kasih gembok biar orang nggak bisa 'nembak' kirim data
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $request->validate([
            'status' => 'required',
            'feedback' => 'required|max:50'
        ]);

        Aspirasi::findOrFail($id)->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return redirect()->back()->with('success', 'Feedback sudah masuk, Wak!');
    }

    public function destroy($id) {
        if (!session('admin_id')) return redirect('/login');
    
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();
    
        return redirect()->back()->with('success', 'Laporan sudah disapu bersih dari muka bumi!');
    }   

}