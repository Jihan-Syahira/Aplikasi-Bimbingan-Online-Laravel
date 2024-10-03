<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Hash;
use App\Models\User;
use App\Models\Bimbingan;
use App\Models\BimbinganDetail;
use App\Models\Dosen;
use App\Models\JadwalDosen;
use App\Models\Mahasiswa;

class MahasiswaJadwalController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function tambah()
    {
        $this->data['page'] = 'mahasiswa/jadwal';
        $this->data['title'] = 'Tambah jadwal bimbingan';
        return view('mahasiswa/jadwal/tambah', $this->data);
    }

    public function edit($id)
    {
        $load = BimbinganDetail::find($id);
        $jadwal = JadwalDosen::select('*')->where('id_dosen', $load->cari_bimbingan->cari_dosen->id)->get();

        foreach ($jadwal as $row) {
            $events[] = [
                'title' => 'Buka Bimbingan',
                'id' => $row->id,
                'start' => date('Y-m-d', strtotime($row->tanggal)),
                'end' => date('Y-m-d', strtotime($row->tanggal)),
            ];
        }
        $this->data['events'] = $events;
        $this->data['page'] = 'mahasiswa/jadwal/update/'.$id;
        $this->data['title'] = 'Ubah jadwal bimbingan';
        $this->data['load'] = $load;
        return view('mahasiswa/jadwal/edit', $this->data);
    }

    public function store(Request $request)
    {
        $cek = BimbinganDetail::select('*')->where('id_bimbingan', $request->id_bimbingan)->where('tanggal', $request->tanggal)->first();
        if (!empty($cek)) {
            return redirect(route('mahasiswa.jadwal'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
        }
        $data = [
            'id_bimbingan' => $request->id_bimbingan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'paraf' => 'Menunggu'
        ];

        BimbinganDetail::create($data);

        return redirect(route('mahasiswa.jadwal'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }


    public function update(Request $request, $id)
    {
        $data = [
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan
        ];
        $rows = BimbinganDetail::find($id);

        $rows->update($data);

        return redirect(route('mahasiswa.jadwal'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        $rows = BimbinganDetail::findOrFail($id);
        $rows->delete();

        return redirect(route('admin.jadwal'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')->where('id_mahasiswa', $mahasiswa->id)->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', '>=', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        foreach ($data as $row) {
            $bimbinganDosen = Bimbingan::select('id')->where('id_dosen', $row->cari_bimbingan->id_dosen)->get()->toArray();
            $datadosen = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbinganDosen)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
            $no = 1;
            foreach ($datadosen as $low) {
                $low->antrian = $no++;
                $antrian = $this->cek_antrian($low->antrian, $low->id_bimbingan, $row->id_bimbingan);
            }

            $row->judul = $row->cari_bimbingan->judul;
            $row->dosen = $row->cari_bimbingan->cari_dosen->nama;
            $row->antrian = $antrian;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = BimbinganDetail::select('*')->where('id_detail', $id)->get();

        return json_encode(array('data' => $data));
    }

    public function cari_dosen($id)
    {
        $bimbingan = Bimbingan::select('*')->where('id', $id)->first();
        $jadwal = JadwalDosen::select('*')->where('id_dosen', $bimbingan->id_dosen)->get();

        foreach ($jadwal as $row) {
            $events[] = [
                'title' => 'Buka Bimbingan',
                'id' => $row->id,
                'start' => date('Y-m-d', strtotime($row->tanggal)),
                'end' => date('Y-m-d', strtotime($row->tanggal)),
            ];
        }

        return json_encode(array('data' => $events,'dosen' => $bimbingan->cari_dosen->nama));
    }

    public function tanggal($id)
    {
        $data = JadwalDosen::select('tanggal')->where('id', $id)->first();

        return json_encode($data->tanggal);
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

    public function bimbingan()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $data = Bimbingan::select('*')
                ->where('id_mahasiswa', $mahasiswa->id)
                ->orderBy('judul', 'ASC')
                ->get();

        foreach ($data as $row) {
            $row->dosen = $row->cari_dosen->nama;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function cek_antrian($no, $cc, $bcc)
    {
        if ($cc == $bcc) {
            return $no;
        }
    }
}
