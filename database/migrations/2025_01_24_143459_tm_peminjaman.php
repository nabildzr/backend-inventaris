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
        Schema::create('tm_peminjaman', function (Blueprint $table) {
            $table->string('pb_id', 20)->autoIncrement()->primary();
            $table->string('user_id', 10);
            $table->dateTime('pb_tgl');
            $table->string('pb_no_siswa', 20);
            $table->string('pb_nama_siswa', 100);
            $table->dateTime('pb_harus_kembali_lagi');
            $table->string('pb_stat');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('tm_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_peminjaman');
    }
};
