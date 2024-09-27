<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $table = 'tb_bimbingan';
    protected $primaryKey = 'id';
    protected $fillable = ['judul','keterangan','kategori','status','id_mahasiswa','id_dosen'];

    public function cari_mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa', 'id_mahasiswa', 'id')->withDefault([
            'nama' => 'Null ! Cek Data',
            'nim' => 'Null ! Cek Data',
            'no_hp' => 'Null ! Cek Data'
        ]);
    }

    public function cari_dosen()
    {
        return $this->belongsTo('App\Models\Dosen', 'id_dosen', 'id')->withDefault([
            'nama' => 'Null ! Cek Data',
            'nip' => 'Null ! Cek Data',
            'no_hp' => 'Null ! Cek Data'
        ]);
    }
}
