<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';  // Tabel yang digunakan oleh model

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'from_umkm_id',
        'to_umkm_id',
        'message',
    ];

    // Relasi dengan tabel users
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    // Relasi dengan tabel pemilik_umkm
    public function fromUmkm()
    {
        return $this->belongsTo(PemilikUmkm::class, 'from_umkm_id');
    }

    public function toUmkm()
    {
        return $this->belongsTo(PemilikUmkm::class, 'to_umkm_id');
    }
}
