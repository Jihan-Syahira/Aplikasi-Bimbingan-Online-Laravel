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

class MahasiswaHistoryController extends Controller
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


    public function json()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')->where('id_mahasiswa', $mahasiswa->id)->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->orderBy('created_at', 'ASC')
            ->get();

        foreach ($data as $row) {

            $row->judul = $row->cari_bimbingan->judul;
            $row->dosen = $row->cari_bimbingan->cari_dosen->nama;
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
}
