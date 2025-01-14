<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'id_umkm',
        'nama_lengkap',
        'nomor_telepon',
        'email',
        'jumlah',
        'alamat',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kelurahan',
        'created_at',
        'status',
    ];
    public $timestamps = true;

    public function pemilikUmkm()
    {
        return $this->belongsTo(PemilikUmkm::class, 'id_umkm', 'id_umkm');
    }
    public function umkm()
    {
        return $this->belongsTo(PemilikUmkm::class, 'id_umkm');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
