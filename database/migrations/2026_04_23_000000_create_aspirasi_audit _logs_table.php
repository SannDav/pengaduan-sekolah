<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('aspirasi_id');       // FK ke aspirasis.id_pelaporan
            $table->string('nis_siswa');                  // NIS siswa pemilik laporan
            $table->string('admin_nama');                 // Nama admin yang melakukan aksi
            $table->string('action');                     // 'feedback_given', 'status_changed', 'bulk_status'
            $table->string('old_status')->nullable();     // Status sebelumnya
            $table->string('new_status')->nullable();     // Status baru
            $table->text('feedback')->nullable();         // Isi feedback yang diberikan
            $table->text('notes')->nullable();            // Catatan tambahan
            $table->timestamps();

            $table->index(['nis_siswa', 'created_at']);
            $table->index(['aspirasi_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi_audit_logs');
    }
};