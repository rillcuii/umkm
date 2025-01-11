<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'username',
        'nama_lengkap',
        'role',
        'password',
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function pemilikUmkm()
    {
        return $this->hasOne(PemilikUmkm::class, 'user_id', 'id'); 
    }
}
