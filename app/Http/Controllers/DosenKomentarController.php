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

class DosenBimbinganController extends Controller
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
        $load = Bimbingan::find($id);
        $this->data['page'] = 'dosen/mahasiswa/riwayat/'.$id;
        $this->data['title'] = 'Riwayat bimbingan Mahasiswa';
        $this->data['load'] = $load;
        return view('dosen/mahasiswa/detail', $this->data);
    }

    public function update(Request $request, $id, $od)
    {
        $data = [
            'keterangan' => $request->keterangan,
            'paraf' => $request->paraf
        ];

        $rows = BimbinganDetail::find($od);

        $rows->update($data);

        return redirect(url('/dosen/data/bimbingan/tugas_akhir/detail/'.$id))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function json()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();

        $data = Bimbingan::select('*')->where('id_dosen', $dosen->id)->get();
        foreach ($data as $row) {
            $row->mahasiswa = $row->cari_mahasiswa->nama;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function d_json($id)
    {
        $data = BimbinganDetail::select('*')
            ->where('id_bimbingan', $id)
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
