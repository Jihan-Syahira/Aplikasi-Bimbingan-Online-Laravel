<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\BimbinganDetail;
use App\Models\Dosen;
use App\Models\JadwalDosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['title'] = 'Landing';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landing/index', $this->data);
    }

    public function kerja_praktik()
    {
        $this->data['page'] = 'jadwal/kerja_praktik';
        $this->data['title'] = 'Kerja Praktik';
        return view('landing.jadwal', $this->data);
    }

    public function pengajuan_judul()
    {
        $this->data['page'] = 'jadwal/pengajuan_judul';
        $this->data['title'] = 'Pengajuan Judul';
        return view('landing.jadwal', $this->data);
    }

    public function tugas_akhir()
    {
        $this->data['page'] = 'jadwal/tugas_akhir';
        $this->data['title'] = 'Tugas Akhir';
        return view('landing.jadwal', $this->data);
    }

    public function agenda()
    {
        $this->data['page'] = 'agenda';
        $this->data['title'] = 'Agenda';
        return view('landing.agenda', $this->data);
    }
    //JSON
    public function kp_json()
    {
        $bimbingan = Bimbingan::select('id')->where('kategori', 'KP')->get()->toArray();

        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $no = 1;
        foreach ($data as $row) {
            $row->antrian = $no++;
            $year = date('Y', strtotime($row->tanggal));
            $day = date('d', strtotime($row->tanggal));
            $row->tgl = $day.' '.$this->bulan[date('n', strtotime($row->tanggal))].' '.$year;
            $row->judul = $row->cari_bimbingan->judul;
            $row->dosen = $row->cari_bimbingan->cari_dosen->nama;
            $row->mahasiswa = $row->cari_bimbingan->cari_mahasiswa->nama;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function pengajuan_json()
    {
        $bimbingan = Bimbingan::select('id')->where('kategori', 'Pengajuan')->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $no = 1;
        foreach ($data as $row) {
            $row->antrian = $no++;
            $year = date('Y', strtotime($row->tanggal));
            $day = date('d', strtotime($row->tanggal));
            $row->tgl = $day.' '.$this->bulan[date('n', strtotime($row->tanggal))].' '.$year;
            $row->judul = $row->cari_bimbingan->judul;
            $row->dosen = $row->cari_bimbingan->cari_dosen->nama;
            $row->mahasiswa = $row->cari_bimbingan->cari_mahasiswa->nama;
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function ta_json()
    {
        $bimbingan = Bimbingan::select('id')->where('kategori', 'TA')->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $no = 1;
        foreach ($data as $row) {
            $row->antrian = $no++;
            $year = date('Y', strtotime($row->tanggal));
            $day = date('d', strtotime($row->tanggal));
            $row->tgl = $day.' '.$this->bulan[date('n', strtotime($row->tanggal))].' '.$year;
            $row->judul = $row->cari_bimbingan->judul;
            $row->dosen = $row->cari_bimbingan->cari_dosen->nama;
            $row->mahasiswa = $row->cari_bimbingan->cari_mahasiswa->nama;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }


    public function dosen()
    {
        $data = Dosen::select('*')
            ->orderBy('nama', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->email = $row->cari_user->email;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function cari($id)
    {
        $events = [];
        $jadwal = JadwalDosen::select('*')->where('id_dosen', $id)->get();

        foreach ($jadwal as $row) {
            $events[] = [
                'title' => 'Buka Bimbingan',
                'id' => $row->id,
                'start' => date('Y-m-d', strtotime($row->tanggal)),
                'end' => date('Y-m-d', strtotime($row->tanggal)),
            ];
        }

        return json_encode(array('data' => $events));
    }

    public function find_jadwal($id)
    {
        $data = JadwalDosen::select('*')->where('id', $id)->get();

        foreach ($data as $row) {
            $jam_start = date('H:i', strtotime($row->mulai));
            $jam_end = date('H:i', strtotime($row->akhir));
            $row->waktu = $jam_start.' s/d '.$jam_end;
        }
        return json_encode(array('data' => $data));
    }
}
