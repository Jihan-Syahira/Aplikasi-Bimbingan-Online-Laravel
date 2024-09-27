<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\BimbinganDetail;
use App\Models\Dosen;
use App\Models\JadwalDosen;
use App\Models\Mahasiswa;

class DosenKPController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function detail($id)
    {
        $load = BimbinganDetail::find($id);
        $this->data['page'] = 'dosen/data/bimbingan/kerja_praktik/riwayat/'.$id;
        $this->data['title'] = 'Riwayat bimbingan';
        $this->data['load'] = $load;
        return view('dosen/bimbingan/detail/kp', $this->data);
    }

    public function update(Request $request, $id, $od)
    {
        $data = [
            'keterangan' => $request->keterangan,
            'paraf' => $request->paraf
        ];

        $rows = BimbinganDetail::find($od);

        $rows->update($data);

        return redirect(url('/dosen/data/bimbingan/kerja_praktik/detail/'.$id))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function json()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')->where('kategori', 'KP')->where('id_dosen', $dosen->id)->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $no = 1;
        foreach($data as $row) {
            $row->antrian = $no++;
            $row->judul = $row->cari_bimbingan->judul;
            $row->mahasiswa = $row->cari_bimbingan->cari_mahasiswa->nama;
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function d_json($id)
    {
        $bimbingan = BimbinganDetail::find($id);
        $data = BimbinganDetail::select('*')
            ->where('id_bimbingan', $bimbingan->id_bimbingan)
            ->orderBy('tanggal', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($od)
    {
        $data = BimbinganDetail::select('*')->where('id_detail', $od)->get();

        return json_encode(array('data' => $data));
    }
}
