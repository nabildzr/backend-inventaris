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
        Schema::create('tm_pengembalian', function (Blueprint $table) {
            $table->string('kembali_id', 20)->primary();
            $table->string('pb_id', 20);
            $table->string('user_id', 10);
            $table->dateTime('kembali_tgl');
            $table->string('kembali_sts', 2);
            $table->timestamps();

            // fk 1
            $table->foreign('pb_id')->references('pb_id')->on('tm_peminjaman')->onDelete('cascade');

            // fk 2
            $table->foreign('user_id')->references('user_id')->on('tm_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_pengembalian');
    }
};
