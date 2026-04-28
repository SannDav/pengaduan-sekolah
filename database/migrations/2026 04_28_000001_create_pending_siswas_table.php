<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pending_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 10)->unique();
            $table->string('nama', 35);
            $table->string('kelas', 10);
            $table->string('password'); // hashed
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('reject_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pending_siswas');
    }
};