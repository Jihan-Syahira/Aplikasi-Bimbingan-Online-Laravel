<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class CustomAuth extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $rows = User::find(Auth::user()->id);
            $rows->update([
                'last_login' => now()
             ]);
            return redirect()->intended('/admin/dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withErrors(['email' => 'Email atau Password Salah']);
    }

    public function set_password(Request $request)
    {
        $data = [
            'password' => Hash::make($request->password)
        ];

        User::find(Auth::user()->id);

        return redirect($request->current_url);
    }

    public function buat_akun(Request $request)
    {

        $cek_akun = User::select('*')->where('email', $request->email)->first();
        if(!empty($cek_akun)) {
            return "<script>alert('Email sudah digunakan !!');history.back();</script>";
        }
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'level' => $request->level
        ];
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        User::create($data);
        $cek_akun = User::select('*')->where('email', $request->email)->first();
        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'no_hp' => '0',
            'id_user' => $cek_akun->id
        ];

        Mahasiswa::create($data);


        return redirect(route('login'))->with(array('message' => 'Proses Berhasil!','info' => 'success'));
    }
}
