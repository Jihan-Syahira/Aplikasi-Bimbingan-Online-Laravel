<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Hash;

use App\Models\User;

class UserController extends Controller
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
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        return redirect(route('admin.user'))->with(array('message' => 'Simpan Berhasil!','info' => 'info'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level
        ];
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $rows = User::find($id);

        $rows->update($data);

        return redirect(route('admin.user'))->with(array('message' => 'Ubah Berhasil!','info' => 'info'));
    }

    public function destroy($id)
    {
        if(Auth::user()->id == $id) {
            return '<script>alert("User Sedang Login");</script>';
        } else {
            $rows = User::findOrFail($id);
            $rows->delete();
        }

        return redirect(route('admin.user'))->with(array('message' => 'Hapus Berhasil!','info' => 'error'));
    }

    public function json()
    {
        $data = User::select('*')
            ->orderBy('name', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = User::select('*')->where('id', $id)->get();

        return json_encode(array('data' => $data));
    }

}
