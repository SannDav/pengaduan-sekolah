<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        if (!session('admin_id')) {
            return redirect('/login')->with('error', 'Login dulu lah kau, Wak! Jangan main masuk aja.');
        }

        $kategoris = Kategori::orderBy('id_kategori', 'asc')->get();
        return view('admin_kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $request->validate([
            'id_kategori'  => 'required|integer|unique:kategoris,id_kategori',
            'ket_kategori' => 'required|string|max:30',
        ]);

        Kategori::create([
            'id_kategori'  => $request->id_kategori,
            'ket_kategori' => $request->ket_kategori,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'ket_kategori' => 'required|string|max:30',
        ]);

        $kategori->update([
            'ket_kategori' => $request->ket_kategori,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session('admin_id')) {
            return redirect('/login');
        }

        $kategori = Kategori::findOrFail($id);

        // Cek apakah kategori masih digunakan di aspirasi
        if ($kategori->aspirasis()->count() > 0) {
            return redirect('/admin/kategori')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan di laporan!');
        }

        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}

