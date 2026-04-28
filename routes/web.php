<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminApprovalController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome'); 
});

// Aspirasi
Route::get('/aspirasi', [AspirasiController::class, 'index']);
Route::get('/aspirasi/stats', [AspirasiController::class, 'stats']);
Route::post('/lapor', [AspirasiController::class, 'store']);

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/stats', [AdminController::class, 'stats']);
Route::post('/admin/feedback/{id}', [AdminController::class, 'update']);
Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy']);
Route::post('/admin/bulk-delete', [AdminController::class, 'bulkDelete']);
Route::post('/admin/bulk-status', [AdminController::class, 'bulkStatus']);
Route::get('/admin/export/csv', [AdminController::class, 'exportCsv']);
Route::get('/admin/export/pdf', [AdminController::class, 'exportPdf']);

// ── ADMIN APPROVAL ROUTES ──
Route::get('/admin/approvals', [AdminApprovalController::class, 'index']);
Route::post('/admin/approvals/{id}/approve', [AdminApprovalController::class, 'approve']);
Route::post('/admin/approvals/{id}/reject', [AdminApprovalController::class, 'reject']);
Route::post('/admin/approvals/bulk-approve', [AdminApprovalController::class, 'bulkApprove']);

// Notifikasi
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);

// Auth
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login-siswa', [AuthController::class, 'loginSiswa']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'registerSiswa']);

// Profile
Route::get('/profile', [AspirasiController::class, 'profile']);