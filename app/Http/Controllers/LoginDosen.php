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

class LoginDosen extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_dosen');

        $this->data['title'] = 'Dashboard Dosen';
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        return view('dosen/dashboard/index', $this->data);
    }

    public function dashboard()
    {
        $this->data['s_mahasiswa'] = $this->c_mahasiswa();
        $this->data['s_menunggu'] = $this->c_menunggu();
        $this->data['s_selesai'] = $this->c_selesai();
        $this->data['chart'] = $this->chart();
        return view('dosen/dashboard/index', $this->data);
    }

    //Bimbingan
    public function kerja_praktik()
    {
        $this->data['page'] = 'dosen/data/bimbingan/kerja_praktik';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('dosen.bimbingan.kp', $this->data);
    }

    public function pengajuan_judul()
    {
        $this->data['page'] = 'dosen/data/bimbingan/pengajuan_judul';
        $this->data['title'] = 'Data Bimbingan Pengajuan Judul';
        return view('dosen.bimbingan.pengajuan', $this->data);
    }

    public function tugas_akhir()
    {
        $this->data['page'] = 'dosen/data/bimbingan/tugas_akhir';
        $this->data['title'] = 'Data Bimbingan Kerja Praktik';
        return view('dosen.bimbingan.ta', $this->data);
    }

    public function bimbingan()
    {
        $this->data['page'] = 'dosen/mahasiswa';
        $this->data['title'] = 'Data Mahasiswa Bimbingan';
        return view('dosen.mahasiswa.index', $this->data);
    }

    public function jadwal()
    {
        $events = [];
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $jadwal = JadwalDosen::select('*')->where('id_dosen', $dosen->id)->get();

        foreach ($jadwal as $row) {
            $events[] = [
                'title' => 'Buka Bimbingan',
                'id' => $row->id,
                'start' => date('Y-m-d', strtotime($row->tanggal)),
                'end' => date('Y-m-d', strtotime($row->tanggal)),
            ];
        }
        $this->data['events'] = $events;
        $this->data['page'] = 'dosen/jadwal';
        $this->data['title'] = 'Data Hari Aktif Bimbingan';
        return view('dosen.jadwal.index', $this->data);
    }
    //User
    public function profile()
    {
        $this->data['page'] = 'dosen/profile';
        $this->data['title'] = 'Data Dosen';
        $this->data['load'] =  Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        return view('dosen.user.index', $this->data);
    }
    public function update_profile(Request $request)
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $data = [
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp
        ];

        $data2 = [
            'name' => $request->username,
            'email' => $request->email
        ];

        $rows = Dosen::find($dosen->id);
        $rows->update($data);

        $rows = User::find(Auth::user()->id);
        $rows->update($data2);

        return redirect(route('dosen.profile'))->with(array('message' => 'Ubah Berhasil!','info' => 'success'));
    }
    //COUNTER
    public function c_mahasiswa()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $data = Bimbingan::select('*')->where('id_dosen', $dosen->id)->count();

        return $data;
    }

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

    //CHART
    public function chart()
    {
        $data = array();
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $no = 0;
        $date = date('Y') . '-';
        for ($i = 1;$i <= 12;$i++) {
            if ($i < 10) {
                $finder = $date . '0' . $i;
            } else {
                $finder = $date . $i;
            }
            $start = $finder.'-00';
            $end = $finder.'-31';
            $kp = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('id_dosen', $dosen->id)
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)->where('kategori', 'KP')->count();
            $pengajuan = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('id_dosen', $dosen->id)
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)
            ->where('kategori', 'Pengajuan')->count();
            $ta = BimbinganDetail::select('*')
            ->leftJoin('tb_bimbingan', 'tb_bimbingan.id', '=', 'tb_bimbingan_detail.id_bimbingan')
            ->where('id_dosen', $dosen->id)
            ->where('tanggal', '>=', $start)
            ->where('tanggal', '<=', $end)->where('kategori', 'TA')->count();
            $data[0][] = $kp;
            $data[1][] = $pengajuan;
            $data[2][] = $ta;
        }

        return $data;
    }
}
