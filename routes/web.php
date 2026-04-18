<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome'); 
});

// Halaman Form & List (Halaman yang baru kita buat)
Route::get('/aspirasi', [AspirasiController::class, 'index']);
Route::get('/aspirasi/stats', [AspirasiController::class, 'stats']);
Route::post('/lapor', [AspirasiController::class, 'store']);

// Route Admin 
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/stats', [AdminController::class, 'stats']);
Route::post('/admin/feedback/{id}', [AdminController::class, 'update']);
Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy']);
Route::post('/admin/bulk-delete', [AdminController::class, 'bulkDelete']);
Route::post('/admin/bulk-status', [AdminController::class, 'bulkStatus']);
Route::get('/admin/export/csv', [AdminController::class, 'exportCsv']);
Route::get('/admin/export/pdf', [AdminController::class, 'exportPdf']);

// Route Notifikasi
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);

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