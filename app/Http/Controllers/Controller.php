<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use File;
use App\Models\Notif;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public $bulan = array('','Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    public function buat_notif($title, $icon, $color, $idbimbingan)
    {
        $data = [
            'judul' => $title,
            'status' => 'wait',
            'icon' => $icon,
            'color' => $color,
            'id_bimbingan' => $idbimbingan,
            'id_user' => Auth::user()->id
        ];

        Notif::create($data);
    }

    public function lampiran_destroy($filename)
    {
        if (File::exists(public_path('/uploads/' . $filename . ''))) {
            File::delete(public_path('/uploads/' . $filename . ''));
        }
    }

}
