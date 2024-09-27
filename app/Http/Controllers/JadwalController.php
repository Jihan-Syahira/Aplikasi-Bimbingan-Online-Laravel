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

class JadwalController extends Controller
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
    public function store(Request $request)
    {
        $cek = JadwalDosen::select('*')->where('id_dosen', $request->id_dosen)->where('tanggal', $request->tanggal)->first();
        if(!empty($cek)) {
            return redirect(route('dosen.jadwal'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
        }
        $data = [
            'tanggal' => $request->tanggal,
            'id_dosen' => $request->id_dosen
        ];

        JadwalDosen::create($data);

        return redirect(route('admin.jadwal'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }


    public function update(Request $request, $id)
    {
        $dosen = Dosen::select('*')->where('id_user', Auth::user()->id)->first();
        $data = [
            'tanggal' => $request->tanggal,
            'id_dosen' => $request->id_dosen
        ];
        $rows = JadwalDosen::find($id);

        $rows->update($data);

        return redirect(route('admin.jadwal'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        $rows = JadwalDosen::findOrFail($id);
        $rows->delete();

        return redirect(route('admin.jadwal'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $data = JadwalDosen::select('*')
            ->orderBy('tanggal', 'ASC')
            ->get();
        foreach($data as $row) {
            $row->dosen = $row->cari_dosen->nama;
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = JadwalDosen::select('*')->where('id', $id)->get();

        return json_encode(array('data' => $data));
    }
}
