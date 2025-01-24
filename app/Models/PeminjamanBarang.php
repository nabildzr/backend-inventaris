<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    protected $fillable = [
        'phd_id',
        'pb_id',
        'br_kode',
        'pdb_tgl',
        'pdb_sts',
    ];
    public $timestamps = true;


    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }

    public function barangInventaris()
    {
        return $this->belongsTo(Peminjaman::class, 'br_kode', 'br_kode');
    }
}
