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

class MahasiswaTAController extends Controller
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

    public function detail($id)
    {
        $load = Bimbingan::find($id);
        $this->data['page'] = 'mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$id;
        $this->data['title'] = 'Detail bimbingan';
        $this->data['load'] = $load;
        $this->data['lampiran'] = 'mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$load->id;
        $this->data['link_1'] = 'add.lampiran.ta.mhs';
        $this->data['link_2'] = 'add.komentar.ta.mhs';
        return view('mahasiswa/bimbingan/detail/index', $this->data);
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $data = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori' => 'TA',
            'status' => $request->status,
            'id_mahasiswa' => $mahasiswa->id,
            'id_dosen' => $request->id_dosen
        ];

        Bimbingan::create($data);

        return redirect(route('mahasiswa.bimbingan.ta'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }

    public function d_store(Request $request, $id)
    {
        $data = [
            'id_bimbingan' => $id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'paraf' => $request->paraf
        ];

        BimbinganDetail::create($data);

        return redirect(url('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$id))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori' => 'TA',
            'status' => $request->status,
            'id_dosen' => $request->id_dosen
        ];

        $rows = Bimbingan::find($id);

        $rows->update($data);

        return redirect(route('mahasiswa.bimbingan.ta'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }
    public function d_update(Request $request, $id, $od)
    {
        $data = [
            'id_bimbingan' => $id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'paraf' => $request->paraf
        ];

        $rows = BimbinganDetail::find($od);

        $rows->update($data);

        return redirect(url('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$id))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        $rows = Bimbingan::findOrFail($id);
        $rows->delete();

        return redirect(route('mahasiswa.bimbingan.ta'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }
    public function d_destroy($id, $od)
    {
        $rows = BimbinganDetail::findOrFail($od);
        $rows->delete();

        return redirect(url('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$id))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $mahasiswa = Mahasiswa::select('*')->where('id_user', Auth::user()->id)->first();
        $data = Bimbingan::select('*')
            ->where('id_mahasiswa', $mahasiswa->id)
            ->where('kategori', 'TA')
            ->orderBy('judul', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->dosen = $row->cari_dosen->nama;
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

    public function find($id)
    {
        $data = Bimbingan::select('*')->where('id', $id)->get();

        return json_encode(array('data' => $data));
    }

    public function d_find($id, $od)
    {
        $data = BimbinganDetail::select('*')->where('id_detail', $od)->get();

        return json_encode(array('data' => $data));
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

        return redirect(url('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$id->id_bimbingan))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
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
        if (isset($file)) {
            $ext = '.' . $file->getClientOriginalExtension();
            $filename = rand(1001, 9999).'-'. $request->judul . $ext;
            $this->lampiran_destroy($filename);
            $file->storeAs('/', $filename, ['disk' => 'file_upload']);

            $data = [
                'id_bimbingan'  => $request->id_bimbingan,
                'judul' => $request->judul,
                'user_id' => Auth::user()->id,
                'file_path' => $filename
            ];

            Lampiran::create($data);

            $id = BimbinganDetail::find($request->id_bimbingan);

            return redirect(url('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/'.$request->id_bimbingan))->with(array('message' => 'Upload Berhasil!','info' => 'info'));

        } else {
            return '<script>alert("Cek Form!");history.back();</script>';
        }
    }
}
