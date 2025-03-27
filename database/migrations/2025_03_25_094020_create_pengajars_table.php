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
        Schema::create('pengajars', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama_lengkap');
            $table->string('mata_pelajaran');
            $table->string('tahun_bergabung');
            $table->string('nomor_telp');
            $table->text('alamat');
            $table->tinyInteger('status')->comment('1=Aktif, 2=Tidak Aktif, 3=Pensiun');
            $table->string('pendidikan_terakhir');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajars');
    }
};