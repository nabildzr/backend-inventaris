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
        Schema::create('tm_barang_inventaris', function (Blueprint $table) {
            $table->string('br_kode', 12)->autoIncrement()->primary();
            $table->string('jns_brg_kode', 5);
            $table->string('user_id', 10);
            $table->string('br_nama', 50);
            $table->date('br_tgl_terima')->nullable();
            $table->dateTime('br_tgl_entry');
            $table->char('br_status', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_barang_inventaris');
    }
};
