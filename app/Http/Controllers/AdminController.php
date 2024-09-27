<?php

namespace App\Http\Controllers;

//Models
use App\Models\User;
use App\Models\Bimbingan;
use App\Models\BimbinganDetail;
use App\Models\Dosen;
use App\Models\JadwalDosen;
use App\Models\Mahasiswa;

use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Exceptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

        $this->data['title'] = 'Dashboard Admin';
        //$this->middleware('is_admin');
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        return view('admin/dashboard/index', $this->data);
    }

    public function dashboard()
    {
        $this->data['s_mahasiswa'] = $this->c_mahasiswa();
        $this->data['s_dosen'] = $this->c_dosen();
        $this->data['s_bimbingan'] = $this->c_bimbingan();
        $this->data['chart'] = $this->chart();
        return view('admin/dashboard/index', $this->data);
    }

    //Bimbingan
    public function kerja_praktik()
    {
        $this->data['page'] = 'admin/data/bimbingan/kerja_praktik';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('admin.bimbingan.kp', $this->data);
    }

    public function pengajuan_judul()
    {
        $this->data['page'] = 'admin/data/bimbingan/pengajuan_judul';
        $this->data['title'] = 'Data Bimbingan Pengajuan Judul';
        return view('admin.bimbingan.pengajuan', $this->data);
    }

    public function tugas_akhir()
    {
        $this->data['page'] = 'admin/data/bimbingan/tugas_akhir';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('admin.bimbingan.kp', $this->data);
    }

    //User
    public function dosen()
    {
        $this->data['page'] = 'admin/user/dosen';
        $this->data['title'] = 'Data Dosen';
        return view('admin.pengguna.dosen', $this->data);
    }

    public function mahasiswa()
    {
        $this->data['page'] = 'admin/user/mahasiswa';
        $this->data['title'] = 'Data Mahasiswa';
        return view('admin.pengguna.mahasiswa', $this->data);
    }

    public function other()
    {
        $this->data['page'] = 'admin/user/other';
        $this->data['title'] = 'Data Pengguna';
        return view('admin.pengguna.other', $this->data);
    }
    //Jadwal
    public function jadwal()
    {
        $this->data['page'] = 'admin/jadwal';
        $this->data['title'] = 'Data Hari Aktif Bimbingan Dosen';
        return view('admin.jadwal.index', $this->data);
    }

    //COUNTER
    public function c_mahasiswa()
    {
        $data = Mahasiswa::select('*')->count();

        return $data;
    }

    public function c_dosen()
    {
        $data = Dosen::select('*')->count();

        return $data;
    }

    public function c_bimbingan()
    {
        $data = Bimbingan::select('*')->count();

        return $data;
    }

    //CHART
    public function chart()
    {
        $data = array();
        $no = 0;
        $date = date('Y') . '-';
        for($i = 1;$i <= 12;$i++) {
            if($i < 10) {
                $finder = $date . '0' . $i;
            } else {
                $finder = $date . $i;
            }
            $start = $finder.'-00';
            $end = $finder.'-31';
            $kp = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)->where('kategori', 'KP')->count();
            $pengajuan = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)
            ->where('kategori', 'Pengajuan')->count();
            $ta = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)->where('kategori', 'TA')->count();
            $data[0][] = $kp;
            $data[1][] = $pengajuan;
            $data[2][] = $ta;
        }

        return $data;
    }
}
