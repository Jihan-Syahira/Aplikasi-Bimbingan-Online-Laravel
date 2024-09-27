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

class KPController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function detail($id)
    {
        $load = Bimbingan::find($id);
        $this->data['page'] = 'admin/data/bimbingan/kerja_praktik/detail/'.$id;
        $this->data['title'] = 'Detail bimbingan';
        $this->data['load'] = $load;
        return view('admin/bimbingan/detail/kp', $this->data);
    }

    public function store(Request $request)
    {
        $data = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori' => 'KP',
            'status' => $request->status,
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_dosen' => $request->id_dosen
        ];

        Bimbingan::create($data);

        return redirect(route('admin.bimbingan.kp'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
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

        return redirect(url('/admin/data/bimbingan/kerja_praktik/detail/'.$id))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori' => 'KP',
            'status' => $request->status,
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_dosen' => $request->id_dosen
        ];

        $rows = Bimbingan::find($id);

        $rows->update($data);

        return redirect(route('admin.bimbingan.kp'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
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

        return redirect(url('/admin/data/bimbingan/kerja_praktik/detail/'.$id))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        $rows = Bimbingan::findOrFail($id);
        $rows->delete();

        return redirect(route('admin.bimbingan.kp'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }
    public function d_destroy($id, $od)
    {
        $rows = BimbinganDetail::findOrFail($od);
        $rows->delete();

        return redirect(url('/admin/data/bimbingan/kerja_praktik/detail/'.$id))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $data = Bimbingan::select('*')
            ->where('kategori', 'KP')
            ->orderBy('judul', 'ASC')
            ->get();

        foreach($data as $row) {
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
}
