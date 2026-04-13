<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome'); 
});


// Halaman Form & List (Halaman yang baru kita buat)
Route::get('/aspirasi', [AspirasiController::class, 'index']);
Route::post('/lapor', [AspirasiController::class, 'store']);

// Route Siswa
Route::get('/', function () { return view('welcome'); });
Route::get('/aspirasi', [AspirasiController::class, 'index']);
Route::post('/lapor', [AspirasiController::class, 'store']);

// Route Admin 
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/feedback/{id}', [AdminController::class, 'update']);
Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy']);

// --- JALUR LOGIN/LOGOUT ---
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Proses Login Admin
Route::post('/login', [AuthController::class, 'login']);

// Proses Login Siswa (Fungsi yang kita buat tadi)
Route::post('/login-siswa', [AuthController::class, 'loginSiswa']);

// Halaman Registrasi Siswa
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'registerSiswa']);

// Halaman profile
Route::get('/profile', [AspirasiController::class, 'profile']);