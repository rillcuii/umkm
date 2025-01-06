<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class PemilikUmkm extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_umkm', 'id_umkm');
    }
    

    protected $table = 'pemilik_umkm';
    protected $primaryKey = 'id_umkm'; 
    protected $fillable = [
    'id_umkm',
    'email',
    'username',
    'nama_lengkap',
    'nama_umkm',
    'foto_profil',
    'foto_umkm',
    'jenis_kelamin',
    'usia',
    'status_kepemilikan',
    'id_produk',
    'nomer_handphone',
    'alamat_pemilik',
    'provinsi',
    'kabupaten_kota',
    'kecamatan',
    'kelurahan',
    'kode_pos',
    'status',
    'password',
    ];
    public $timestamps = false;
}

