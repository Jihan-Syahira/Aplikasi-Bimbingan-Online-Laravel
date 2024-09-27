<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_bimbingan_detail';
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_bimbingan','tanggal','keterangan','paraf'];

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
}
