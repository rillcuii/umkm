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
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_umkm', 'id_umkm');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }


    protected $table = 'pemilik_umkm';
    protected $primaryKey = 'id_umkm';
    protected $guarded = [];
    protected $fillable = [
        'id_umkm',
        'email',
        'username',
        'nama_lengkap',
        'nama_umkm',
        'foto_profil',
        'foto_umkm',
        'deskripsi',
        'jenis_kelamin',
        'usia',
        'status_kepemilikan',
        'id_kategori',
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
