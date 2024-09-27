<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','nim','no_hp','id_user'];

    public function cari_user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id')->withDefault([
            'name' => 'Akun tidak ditemukan',
            'email' => 'Akun tidak ditemukan',
            'level' => 'Akun tidak ditemukan',
            'last_login' => 'Akun tidak ditemukan'
        ]);
    }
}
