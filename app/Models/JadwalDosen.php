<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDosen extends Model
{
    use HasFactory;
    protected $table = 'jadwal_dosen';
    protected $primaryKey = 'id';
    protected $fillable = ['tanggal','id_dosen'];

    public function cari_dosen()
    {
        return $this->belongsTo('App\Models\Dosen', 'id_dosen', 'id')->withDefault([
            'nama' => 'Null ! Cek Data',
            'nip' => 'Null ! Cek Data',
            'no_hp' => 'Null ! Cek Data'
        ]);
    }
}
