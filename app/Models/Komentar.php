<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'tb_komentar';
    protected $primaryKey = 'id';
    protected $fillable = ['id_detail','user_id','content'];

    public function cari_detail()
    {
        return $this->belongsTo('App\Models\BimbinganDetail', 'id_detail', 'id')->withDefault([
            'id_bimbingan' => '1',
            'tanggal' => 'Null ! Cek Data',
            'keterangan' => 'Null ! Cek Data',
            'paraf' => 'Null ! Cek Data'
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
