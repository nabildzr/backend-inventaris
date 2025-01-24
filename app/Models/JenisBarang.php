<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $fillable = [
        'jns_brg_kode',
        'jns_brg_nama'
    ];
    public $timestamps = true;

}
