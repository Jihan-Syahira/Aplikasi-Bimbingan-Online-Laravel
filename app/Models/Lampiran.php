<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;
    protected $table = 'tb_lampiran';
    protected $primaryKey = 'id';
    protected $fillable = ['id_bimbingan','user_id','file_path'];

    public function cari_bimbingan()
    {
        return $this->belongsTo('App\Models\Bimbingan', 'id_bimbingan', 'id')->withDefault([
            'judul' => 'Null ! Cek Data',
            'keterangan' => 'Null ! Cek Data',
            'status' => 'Null ! Cek Data',
            'id_mahasiswa' => 'Null ! Cek Data',
            'id_dosen' => 'Null ! Cek Data'
        ]);
    }

    public function cari_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault([
            'name' => 'Akun tidak ditemukan',
            'email' => 'Akun tidak ditemukan',
            'level' => 'Akun tidak ditemukan',
            'last_login' => 'Akun tidak ditemukan'
        ]);
    }

}
