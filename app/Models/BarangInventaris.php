<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{


    protected $table = 'tm_barang_inventaris';

    protected $primaryKey = 'br_kode';

    protected $fillable = [
        'br_kode',
        'jns_brg_kode',
        'user_id',
        'br_nama',
        'br_tgl_terima',
        'br_tgl_entry',
        'br_status',
    ];

    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }
}
