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

class LoginMahasiswa extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_mahasiswa');

        $this->data['title'] = 'Dashboard Mahasiswa';
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        return view('mahasiswa/dashboard/index', $this->data);
    }

    public function dashboard()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $this->data['nim'] = $mahasiswa->nim;
        $this->data['s_internal'] = 0;
        $this->data['s_karyawan'] = 0;
        $this->data['chart'] = [0];
        return view('mahasiswa/dashboard/index', $this->data);
    }

    //Bimbingan
    public function kerja_praktik()
    {
        $this->data['page'] = 'mahasiswa/data/bimbingan/kerja_praktik';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('mahasiswa.bimbingan.kp', $this->data);
    }

    public function pengajuan_judul()
    {
        $this->data['page'] = 'mahasiswa/data/bimbingan/pengajuan_judul';
        $this->data['title'] = 'Data Bimbingan Pengajuan Judul';
        return view('mahasiswa.bimbingan.pengajuan', $this->data);
    }

    public function tugas_akhir()
    {
        $this->data['page'] = 'mahasiswa/data/bimbingan/tugas_akhir';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('mahasiswa.bimbingan.kp', $this->data);
    }


    public function jadwal()
    {
        $this->data['page'] = 'mahasiswa/jadwal';
        $this->data['title'] = 'Data Jadwal Bimbingan';
        return view('mahasiswa.jadwal.index', $this->data);
    }
    //User
    public function profile()
    {
        $this->data['page'] = 'mahasiswa/profile';
        $this->data['title'] = 'Data Mahasiswa';
        $this->data['load'] =  Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        return view('mahasiswa.user.index', $this->data);
    }
    public function update_profile(Request $request)
    {
        $dosen = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'no_hp' => $request->no_hp
        ];

        $data2 = [
            'name' => $request->username,
            'email' => $request->email
        ];

        $rows = Mahasiswa::find($dosen->id);
        $rows->update($data);

        $rows = User::find(Auth::user()->id);
        $rows->update($data2);

        return redirect(route('mahasiswa.profile'))->with(array('message' => 'Ubah Berhasil!','info' => 'success'));
    }

    //COUNTER
    public function c_menunggu()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $data = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('id_dosen', $dosen->id)
            ->where('paraf', 'Menunggu')->count();
        return $data;
    }

    public function c_selesai()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $data = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('id_dosen', $dosen->id)
            ->where('paraf', 'Bimbingan')->count();

        return $data;
    }
}
