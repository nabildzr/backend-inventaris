<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{

    protected $table = "tm_peminjaman";
    protected $primaryKey = "pb_id";
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'pb_id',
        'user_id',
        'pb_tgl',
        'pb_no_siswa',
        'pb_nama_siswa',
        'pb_harus_kembali_tgl',
        'pb_stat'
    ];
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
