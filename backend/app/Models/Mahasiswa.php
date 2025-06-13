<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Mahasiswa extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;

    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false; // karena pk-nya string
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['nim', 'nama', 'angkatan', 'password', 'prodi_id'];

    protected $hidden = ['password'];

    public function matakuliahs()
    {
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId', 'nim', 'id');
    }


    // Tambahkan metode JWTSubject ini:
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }
    
}