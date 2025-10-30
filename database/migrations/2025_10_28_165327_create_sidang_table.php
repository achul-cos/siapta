<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sidang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen');
            $table->foreignId('id_dosen_penguji')->constrained('dosen')->nullable();
            $table->foreignId('id_periode')->constrained('periode');
            $table->foreignId('id_tugas_akhir')->nullable()->constrained('tugas_akhir');
            $table->enum('jenis', ['seminar', 'tugas_akhir_1', 'tugas_akhir_2']);
            $table->enum('status', ['terjadwal', 'selesai', 'ditolak'])->default('terjadwal');
            $table->string('ruangan')->nullable();
            $table->dateTime('tanggal_sidang')->nullable();
            $table->json('dokumen_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang');
    }
};
