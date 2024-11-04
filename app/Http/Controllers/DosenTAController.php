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
use App\Models\Komentar;
use App\Models\Lampiran;
use App\Models\Mahasiswa;
use File;

class DosenTAController extends Controller
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
        $this->data['page'] = 'dosen/data/bimbingan/tugas_akhir/riwayat/'.$id;
        $this->data['title'] = 'Riwayat bimbingan';
        $this->data['load'] = $load;
        $this->data['lampiran'] = 'dosen/data/bimbingan/tugas_akhir/riwayat/'.$load->id_bimbingan;
        $this->data['link_1'] = 'add.lampiran.ta';
        $this->data['link_2'] = 'add.komentar.ta';
        return view('dosen/bimbingan/detail/index', $this->data);
    }

    public function update(Request $request, $od)
    {
        $data = [
            'keterangan' => $request->keterangan,
            'paraf' => $request->paraf
        ];

        $rows = BimbinganDetail::find($od);

        $rows->update($data);

        return redirect(url('/dosen/data/bimbingan/tugas_akhir'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function json()
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $bimbingan = Bimbingan::select('id')->where('kategori', 'TA')->where('id_dosen', $dosen->id)->get()->toArray();
        $data = BimbinganDetail::select('*')
            ->whereIn('id_bimbingan', $bimbingan)
            ->where('tanggal', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $no = 1;
        foreach ($data as $row) {
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

    public function komentar_json($id, $od)
    {
        $data = Komentar::select('*')
            ->where('id_detail', $od)
            ->orderBy('created_at', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->username = $row->cari_user->name .'<br>'.date('d F Y h:i', strtotime($row->created_at));
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function lampiran_json($id)
    {
        $data = Lampiran::select('*')
            ->where('id_bimbingan', $id)
            ->orderBy('created_at', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->username = $row->cari_user->name .'<br>'.date('d F Y h:i', strtotime($row->created_at));
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($od)
    {
        $data = BimbinganDetail::select('*')->where('id_detail', $od)->get();

        return json_encode(array('data' => $data));
    }

    public function find_detail($id, $od)
    {
        $data = BimbinganDetail::select('*')->where('id_detail', $od)->get();

        return json_encode(array('data' => $data));
    }

    //Komentar
    public function store_komentar(Request $request)
    {
        $data = [
            'id_detail' => $request->id_detail,
            'user_id' => Auth::user()->id,
            'content' => $request->content
        ];
        $id = BimbinganDetail::find($request->id_detail);

        Komentar::create($data);
        $this->buat_notif('Menambahkan Komentar pada '.strtolower($id->cari_bimbingan->judul), 'mdi-comment-multiple', 'primary', $id->id_bimbingan);

        return redirect(url('/dosen/data/bimbingan/tugas_akhir/riwayat/'.$request->id_detail))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }


    public function find_komentar($od)
    {
        $data = Komentar::select('*')->where('id', $od)->get();

        return json_encode(array('data' => $data));
    }

    //Upload File
    public function upload_file(Request $request)
    {
        $file = $request->file('upload');
        $id = BimbinganDetail::find($request->id_detail);
        if (isset($file)) {
            $ext = '.' . $file->getClientOriginalExtension();
            $filename =  rand(1001, 9999).'-'.$request->judul . $ext;
            $this->lampiran_destroy($filename);
            $file->storeAs('/', $filename, ['disk' => 'file_upload']);

            $data = [
                'id_bimbingan'  => $id->id_bimbingan,
                'judul' => $request->judul,
                'user_id' => Auth::user()->id,
                'file_path' => $filename
            ];

            Lampiran::create($data);
            $this->buat_notif('Menambahkan file pada '.strtolower($id->cari_bimbingan->judul), 'mdi-file-upload', 'danger', $id->id_bimbingan);


            return redirect(url('/dosen/data/bimbingan/tugas_akhir/riwayat/'.$request->id_detail))->with(array('message' => 'Upload Berhasil!','info' => 'info'));

        } else {
            return '<script>alert("Cek Form!");history.back();</script>';
        }

    }
}
