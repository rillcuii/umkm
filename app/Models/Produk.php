<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public function umkm()
    {
        return $this->belongsTo(PemilikUmkm::class, 'id_umkm', 'id_umkm');
    }
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_produk',
        'id_umkm',
        'nama_produk',
        'stok',
        'foto_produk',
        'harga',
        'status',
    ];
    public $timestamps = false;
}
