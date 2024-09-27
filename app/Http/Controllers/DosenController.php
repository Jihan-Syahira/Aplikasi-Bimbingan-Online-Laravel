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

class DosenController extends Controller
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
    public function akun(Request $request, $id)
    {
        $pengguna = Dosen::find($id);
        $cek_akun = User::find($pengguna->id_user);

        $data = [
            'name' => $pengguna->nama,
            'email' => $request->email,
            'level' => $request->level
        ];

        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if(empty($cek_akun)) {
            User::create($data);
        } else {
            $cek_akun->update($data);
        }

        $cek_akun = User::select('*')->where('email', $request->email)->first();
        $pengguna->update(['id_user' => $cek_akun->id]);

        return redirect(route('admin.user.dosen'))->with(array('message' => 'Proses Berhasil!','info' => 'success'));
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'id_user' => 0
        ];

        Dosen::create($data);

        return redirect(route('admin.user.dosen'))->with(array('message' => 'Simpan Berhasil!','info' => 'success'));
    }


    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp
        ];

        $rows = Dosen::find($id);

        $rows->update($data);

        return redirect(route('admin.user.dosen'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        $rows = Dosen::findOrFail($id);
        $id_user = $rows->id_user;
        $rows->delete();
        $rows = User::findOrFail($id_user);
        $rows->delete();

        return redirect(route('admin.user.dosen'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $data = Dosen::select('*')
            ->orderBy('nama', 'ASC')
            ->get();

        foreach($data as $row) {
            $row->email = $row->cari_user->email;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = Dosen::select('*')->where('id', $id)->get();

        foreach($data as $row) {
            $row->email = $row->cari_user->email;
        }
        return json_encode(array('data' => $data));
    }
}
