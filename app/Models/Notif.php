<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;
    protected $table = 'notif';
    protected $primaryKey = 'id';
    protected $fillable = ['judul','status','icon','color','id_user','id_bimbingan'];

    public function cari_bimbingan()
    {
        return $this->belongsTo('App\Models\Bimbingan', 'id_bimbingan', 'id')->withDefault([
            'judul' => 'Null ! Cek Data',
            'keterangan' => 'Null ! Cek Data',
            'kategori' => 'Null ! Cek Data',
            'status' => 'Null ! Cek Data',
            'id_mahasiswa' => 'Null ! Cek Data',
            'id_dosen' => 'Null ! Cek Data'
        ]);
    }

    public function cari_user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id')->withDefault([
            'name' => 'Anonim',
            'email'  => 'Anonim'
        ]);
    }
}
