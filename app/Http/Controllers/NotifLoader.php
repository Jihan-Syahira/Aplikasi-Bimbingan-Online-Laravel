<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Exception;
use DataTables;
use App\Models\Notif;
use App\Models\Mahasiswa;
use App\Models\Bimbingan;

class NotifLoader extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function logs()
    {
        $user = Auth::user()->level;
        switch ($user) {
            case 'Mahasiswa':
                return redirect(url('mahasiswa/logs'));
            case 'Dosen':
                return redirect(url('dosen/logs'));
            default:
                return "<script>alert('Error !!');history.back();</script>";
        }
    }

    public function cari_bimbingan($id)
    {
        $user = Auth::user()->level;
        $bimbingan = Bimbingan::find($id);
        $link = strtolower($user).'/data/bimbingan/'.$this->tipe($bimbingan->kategori).'/riwayat/'.$id;

        return redirect(url($link));
    }

    public static function notifMe()
    {
        $data = Notif::select('*')->where('status', 'wait')->orderby('created_at', 'DESC')->get(5);

        foreach ($data as $row) {
            $days = strtotime($row->created_at);
            $row->days = date('F d, Y', $days);
        }

        return $data;
    }

    public static function notifAll()
    {
        $data = Notif::select('*')->where('status', 'wait')->get();

        foreach ($data as $row) {
            $days = strtotime($row->created_at);
            $row->days = date('F d, Y', $days);
            $row->waktu = $this->get_hari($time->created_at);
            $a = explode(' ', $row->cari_user->name);
            $row->akun = $row->cari_user->name;
            $user = $a[0];
            $row->full_judul = $row->cari_user->level . '('.$user.') '.ucwords($row->judul);
        }

        return $data;
    }

    public static function countNotifme()
    {
        $data = Notif::select('*')->where('status', 'wait')->get()->count();
        if ($data == 0) {
            return null;
        } else {

            return $data . '+';
        }
    }

    public function read($id)
    {
        $data = [
            'status' => 'read'
        ];

        $rows = Notif::find($id);

        $rows->update($data);

        return  json_encode([
            'message' => 'Dilihat'
        ]);
    }

    public function get_notif()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')
            ->where('id_mahasiswa', $mahasiswa->id)
            ->get()->toArray();

        $data = Notif::select('*')->where('status', 'wait')->whereIn('id_bimbingan', $bimbingan)->get();

        foreach ($data as $row) {
            $days = strtotime($row->created_at);
            $row->days = date('F d, Y', $days);
            $row->waktu = $this->get_hari($row->created_at);
            $row->akun = $row->cari_user->name;
            $row->full_judul = $row->cari_user->level . '('.$row->akun.') '.ucwords($row->judul);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function read_all()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')
            ->where('id_mahasiswa', $mahasiswa->id)
            ->get()->toArray();

        Notif::whereIn('id_bimbingan', $bimbingan)->where('status', 'wait')->update(['status' => 'read']);

        $data = Notif::select('*')->whereIn('id_bimbingan', $bimbingan)->get();

        foreach ($data as $row) {
            $days = strtotime($row->created_at);
            $row->days = date('F d, Y', $days);
            $row->waktu = $this->get_hari($row->created_at);
            $row->akun = $row->cari_user->name;
            //$tipe = $this->tipe($row->cari_bimbingan->kategori);
            //$row->link = '/mahasiswa/data/bimbingan/'.$tipe.'/riwayat/'.$row->id_bimbingan;
            $row->full_judul = $row->cari_user->level . '('.$row->akun.') '.ucwords($row->judul);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);

    }
    public function hitung_hari($tanggal)
    {
        $date1 = date('Y-m-d');
        $date2 = $tanggal;
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        return $days;
    }

    public function get_hari($tanggal)
    {
        $selisih = $this->hitung_hari($tanggal);
        $jam = date('h:i A', strtotime($tanggal));
        if ($selisih < 1) {
            $result = $jam;
        } elseif ($selisih == 1) {
            $result = 'Kemarin, ' . $jam;
        } elseif ($selisih <= 7) {
            $result = $this->hari[date('N', strtotime($tanggal))] . date(' d M,', strtotime($tanggal)) . date(' h:i A', strtotime($tanggal));
        } else {
            $result = date(' d M,', strtotime($tanggal)) . date(' h:i A', strtotime($tanggal));
        }

        return $result;
    }

    public function tipe($cat)
    {
        switch ($cat) {
            case 'KP':
                return 'kerja_praktik';
            case 'TA':
                return 'tugas_akhir';
            case 'Pengajuan':
                return 'pengajuan_judul';
            default:
                return $cat;
        }
    }
}
