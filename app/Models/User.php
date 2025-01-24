<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'tm_user';
    protected $primaryKey = 'user_id';
    public $incrementing = true;

    protected $keyType = 'string';


    protected $fillable = [
        'user_id',
        'user_nama',
        'user_pass',
        'user_hak',
        'user_sts'
    ];

    public $timestamps = true;

    protected $hidden = [
        'user_pass'
    ];

      public function setPasswordAttribute($password)
    {
        $this->attributes['user_pass'] = bcrypt($password);
    }


    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id', 'user_id');
    }
}
