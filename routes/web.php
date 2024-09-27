<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::GET('/', [App\Http\Controllers\PublicController::class, 'index'])->name('landing');
Auth::routes();

//Route::GET('/login', [App\Http\Controllers\CustomAuth::class, 'index'])->name('login');
Route::POST('/set_password', [App\Http\Controllers\CustomAuth::class, 'set_password'])->name('set.password');
Route::GET('/test', [App\Http\Controllers\AdminController::class, 'test']);
Route::POST('/validate', [App\Http\Controllers\CustomAuth::class, 'customLogin'])->name('custom.login');
Route::POST('/register/buat_akun', [App\Http\Controllers\CustomAuth::class, 'buat_akun'])->name('custom.register');

//PUBLIC GET
Route::GET('/jadwal/kerja_praktik', [App\Http\Controllers\PublicController::class, 'kerja_praktik'])->name('public.kp');
Route::GET('/jadwal/pengajuan_judul', [App\Http\Controllers\PublicController::class, 'pengajuan_judul'])->name('public.pengajuan');
Route::GET('/jadwal/tugas_akhir', [App\Http\Controllers\PublicController::class, 'tugas_akhir'])->name('public.ta');
Route::GET('/agenda', [App\Http\Controllers\PublicController::class, 'agenda'])->name('public.agenda');

//PUBLIC JSON
Route::get('/jadwal/kerja_praktik/json', [App\Http\Controllers\PublicController::class, 'kp_json']);
Route::get('/jadwal/pengajuan_judul/json', [App\Http\Controllers\PublicController::class, 'pengajuan_json']);
Route::get('/jadwal/tugas_akhir/json', [App\Http\Controllers\PublicController::class, 'ta_json']);
Route::get('/agenda/dosen/json', [App\Http\Controllers\PublicController::class, 'dosen']);
Route::get('/agenda/cari/{id}', [App\Http\Controllers\PublicController::class, 'cari']);

//ADMIN GET
Route::GET('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::GET('/admin/data/bimbingan/kerja_praktik', [App\Http\Controllers\AdminController::class, 'kerja_praktik'])->name('admin.bimbingan.kp');
Route::GET('/admin/data/bimbingan/pengajuan_judul', [App\Http\Controllers\AdminController::class, 'pengajuan_judul'])->name('admin.bimbingan.pengajuan');
Route::GET('/admin/data/bimbingan/tugas_akhir', [App\Http\Controllers\AdminController::class, 'tugas_akhir'])->name('admin.bimbingan.ta');
Route::GET('/admin/user/dosen', [App\Http\Controllers\AdminController::class, 'dosen'])->name('admin.user.dosen');
Route::GET('/admin/user/mahasiswa', [App\Http\Controllers\AdminController::class, 'mahasiswa'])->name('admin.user.mahasiswa');
Route::GET('/admin/user/other', [App\Http\Controllers\AdminController::class, 'other'])->name('admin.user.other');
Route::GET('/admin/jadwal', [App\Http\Controllers\AdminController::class, 'jadwal'])->name('admin.jadwal');

//DETAIL
Route::GET('/admin/data/bimbingan/kerja_praktik/detail/{id}', [App\Http\Controllers\KPController::class, 'detail']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/detail/{id}', [App\Http\Controllers\PengajuanController::class, 'detail']);
Route::GET('/admin/data/bimbingan/tugas_akhir/detail/{id}', [App\Http\Controllers\TAController::class, 'detail']);


//STORE
Route::POST('/admin/data/bimbingan/kerja_praktik/save', [App\Http\Controllers\KPController::class, 'store']);
Route::POST('/admin/data/bimbingan/kerja_praktik/detail/{id}/save', [App\Http\Controllers\KPController::class, 'd_store']);
Route::POST('/admin/data/bimbingan/pengajuan_judul/save', [App\Http\Controllers\PengajuanController::class, 'store']);
Route::POST('/admin/data/bimbingan/pengajuan_judul/detail/{id}/save', [App\Http\Controllers\PengajuanController::class, 'd_store']);
Route::POST('/admin/data/bimbingan/tugas_akhir/save', [App\Http\Controllers\TAController::class, 'store']);
Route::POST('/admin/data/bimbingan/tugas_akhir/detail/{id}/save', [App\Http\Controllers\TAController::class, 'd_store']);

Route::POST('/admin/user/dosen/save', [App\Http\Controllers\DosenController::class, 'store']);
Route::POST('/admin/user/mahasiswa/save', [App\Http\Controllers\MahasiswaController::class, 'store']);
Route::POST('/admin/jadwal/save', [App\Http\Controllers\JadwalController::class, 'store']);

//UPDATE
Route::POST('/admin/data/bimbingan/kerja_praktik/update/{id}', [App\Http\Controllers\KPController::class, 'update']);
Route::POST('/admin/data/bimbingan/kerja_praktik/detail/{id}/update/{od}', [App\Http\Controllers\KPController::class, 'd_update']);
Route::POST('/admin/data/bimbingan/pengajuan_judul/update/{id}', [App\Http\Controllers\PengajuanController::class, 'update']);
Route::POST('/admin/data/bimbingan/pengajuan_judul/detail/{id}/update/{od}', [App\Http\Controllers\PengajuanController::class, 'd_update']);
Route::POST('/admin/data/bimbingan/tugas_akhir/update/{id}', [App\Http\Controllers\TAController::class, 'update']);
Route::POST('/admin/data/bimbingan/tugas_akhir/detail/{id}/update/{od}', [App\Http\Controllers\TAController::class, 'd_update']);

Route::POST('/admin/user/dosen/update/{id}', [App\Http\Controllers\DosenController::class, 'update']);
Route::POST('/admin/user/dosen/akun/{id}', [App\Http\Controllers\DosenController::class, 'akun']);
Route::POST('/admin/user/mahasiswa/update/{id}', [App\Http\Controllers\MahasiswaController::class, 'update']);
Route::POST('/admin/user/mahasiswa/akun/{id}', [App\Http\Controllers\MahasiswaController::class, 'akun']);
Route::POST('/admin/jadwal/update/{id}', [App\Http\Controllers\JadwalController::class, 'update']);

//DESTROY
Route::GET('/admin/data/bimbingan/kerja_praktik/delete/{id}', [App\Http\Controllers\KPController::class, 'destroy']);
Route::GET('/admin/data/bimbingan/kerja_praktik/detail/{id}/delete/{od}', [App\Http\Controllers\KPController::class, 'd_destroy']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/delete/{id}', [App\Http\Controllers\PengajuanController::class, 'destroy']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/detail/{id}/delete/{od}', [App\Http\Controllers\PengajuanController::class, 'd_destroy']);
Route::GET('/admin/data/bimbingan/tugas_akhir/delete/{id}', [App\Http\Controllers\TAController::class, 'destroy']);
Route::GET('/admin/data/bimbingan/tugas_akhir/detail/{id}/delete/{od}', [App\Http\Controllers\TAController::class, 'd_destroy']);

Route::GET('/admin/user/dosen/delete/{id}', [App\Http\Controllers\DosenController::class, 'destroy']);
Route::GET('/admin/user/mahasiswa/delete/{id}', [App\Http\Controllers\MahasiswaController::class, 'destroy']);
Route::GET('/admin/jadwal/delete/{id}', [App\Http\Controllers\JadwalController::class, 'destroy']);

//JSON
Route::GET('/admin/data/bimbingan/kerja_praktik/json', [App\Http\Controllers\KPController::class, 'json']);
Route::GET('/admin/data/bimbingan/kerja_praktik/detail/{id}/json', [App\Http\Controllers\KPController::class, 'd_json']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/json', [App\Http\Controllers\PengajuanController::class, 'json']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/detail/{id}/json', [App\Http\Controllers\PengajuanController::class, 'd_json']);
Route::GET('/admin/data/bimbingan/tugas_akhir/json', [App\Http\Controllers\TAController::class, 'json']);
Route::GET('/admin/data/bimbingan/tugas_akhir/detail/{id}/json', [App\Http\Controllers\TAController::class, 'd_json']);

Route::GET('/admin/user/dosen/json', [App\Http\Controllers\DosenController::class, 'json']);
Route::GET('/admin/user/mahasiswa/json', [App\Http\Controllers\MahasiswaController::class, 'json']);
Route::GET('/admin/jadwal/json', [App\Http\Controllers\JadwalController::class, 'json']);

//FIND
Route::GET('/admin/data/bimbingan/kerja_praktik/find/{id}', [App\Http\Controllers\KPController::class, 'find']);
Route::GET('/admin/data/bimbingan/kerja_praktik/detail/{id}/find/{od}', [App\Http\Controllers\KPController::class, 'd_find']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/find/{id}', [App\Http\Controllers\PengajuanController::class, 'find']);
Route::GET('/admin/data/bimbingan/pengajuan_judul/detail/{id}/find/{od}', [App\Http\Controllers\PengajuanController::class, 'd_find']);
Route::GET('/admin/data/bimbingan/tugas_akhir/find/{id}', [App\Http\Controllers\TAController::class, 'find']);
Route::GET('/admin/data/bimbingan/tugas_akhir/detail/{id}/find/{od}', [App\Http\Controllers\TAController::class, 'd_find']);

Route::GET('/admin/user/dosen/find/{id}', [App\Http\Controllers\DosenController::class, 'find']);
Route::GET('/admin/user/mahasiswa/find/{id}', [App\Http\Controllers\MahasiswaController::class, 'find']);
Route::GET('/admin/jadwal/find/{id}', [App\Http\Controllers\JadwalController::class, 'find']);

//DOSEN GET
Route::GET('/dosen/dashboard', [App\Http\Controllers\LoginDosen::class, 'dashboard'])->name('dosen.dashboard');
Route::GET('/dosen/data/bimbingan/kerja_praktik', [App\Http\Controllers\LoginDosen::class, 'kerja_praktik'])->name('dosen.bimbingan.kp');
Route::GET('/dosen/data/bimbingan/pengajuan_judul', [App\Http\Controllers\LoginDosen::class, 'pengajuan_judul'])->name('dosen.bimbingan.pengajuan');
Route::GET('/dosen/data/bimbingan/tugas_akhir', [App\Http\Controllers\LoginDosen::class, 'tugas_akhir'])->name('dosen.bimbingan.ta');
Route::GET('/dosen/mahasiswa', [App\Http\Controllers\LoginDosen::class, 'bimbingan'])->name('dosen.mahasiswa');
Route::GET('/dosen/jadwal', [App\Http\Controllers\LoginDosen::class, 'jadwal'])->name('dosen.jadwal');
Route::GET('/dosen/profile', [App\Http\Controllers\LoginDosen::class, 'profile'])->name('dosen.profile');

//DETAIL
Route::GET('/dosen/data/bimbingan/kerja_praktik/riwayat/{id}', [App\Http\Controllers\DosenKPController::class, 'detail']);
Route::GET('/dosen/data/bimbingan/pengajuan_judul/riwayat/{id}', [App\Http\Controllers\DosenPengajuanController::class, 'detail']);
Route::GET('/dosen/data/bimbingan/tugas_akhir/riwayat/{id}', [App\Http\Controllers\DosenTAController::class, 'detail']);

//STORE
Route::POST('/dosen/jadwal/save', [App\Http\Controllers\DosenJadwalController::class, 'store']);

//UPDATE
Route::POST('/dosen/jadwal/update/{id}', [App\Http\Controllers\DosenJadwalController::class, 'update']);
Route::POST('/dosen/profile/update_profile', [App\Http\Controllers\LoginDosen::class, 'update_profile']);
Route::POST('/dosen/data/bimbingan/kerja_praktik/update/{id}', [App\Http\Controllers\DosenKPController::class, 'update']);
Route::POST('/dosen/data/bimbingan/pengajuan_judul/update/{id}', [App\Http\Controllers\DosenPengajuanController::class, 'update']);
Route::POST('/dosen/data/bimbingan/tugas_akhir/update/{id}', [App\Http\Controllers\DosenTAController::class, 'update']);

//DESTROY
Route::GET('/dosen/jadwal/delete/{id}', [App\Http\Controllers\DosenJadwalController::class, 'destroy']);

//JSON
Route::get('/dosen/jadwal/json', [App\Http\Controllers\DosenJadwalController::class, 'json']);
Route::get('/dosen/data/bimbingan/kerja_praktik/json', [App\Http\Controllers\DosenKPController::class, 'json']);
Route::get('/dosen/data/bimbingan/kerja_praktik/riwayat/{id}/json', [App\Http\Controllers\DosenKPController::class, 'd_json']);
Route::get('/dosen/data/bimbingan/pengajuan_judul/json', [App\Http\Controllers\DosenPengajuanController::class, 'json']);
Route::get('/dosen/data/bimbingan/pengajuan_judul/riwayat/{id}/json', [App\Http\Controllers\DosenPengajuanController::class, 'd_json']);
Route::get('/dosen/data/bimbingan/tugas_akhir/json', [App\Http\Controllers\DosenTAController::class, 'json']);
Route::get('/dosen/data/bimbingan/tugas_akhir/riwayat/{id}/json', [App\Http\Controllers\DosenTAController::class, 'd_json']);

//FIND
Route::get('/dosen/jadwal/find/{id}', [App\Http\Controllers\DosenJadwalController::class, 'find']);
Route::get('/dosen/data/bimbingan/kerja_praktik/find/{id}', [App\Http\Controllers\DosenKPController::class, 'find']);
Route::get('/dosen/data/bimbingan/pengajuan_judul/find/{id}', [App\Http\Controllers\DosenPengajuanController::class, 'find']);
Route::get('/dosen/data/bimbingan/tugas_akhir/find/{id}', [App\Http\Controllers\DosenTAController::class, 'find']);

//MAHASISWA GET
Route::GET('/mahasiswa/dashboard', [App\Http\Controllers\LoginMahasiswa::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::GET('/mahasiswa/data/bimbingan/kerja_praktik', [App\Http\Controllers\LoginMahasiswa::class, 'kerja_praktik'])->name('mahasiswa.bimbingan.kp');
Route::GET('/mahasiswa/data/bimbingan/pengajuan_judul', [App\Http\Controllers\LoginMahasiswa::class, 'pengajuan_judul'])->name('mahasiswa.bimbingan.pengajuan');
Route::GET('/mahasiswa/data/bimbingan/tugas_akhir', [App\Http\Controllers\LoginMahasiswa::class, 'tugas_akhir'])->name('mahasiswa.bimbingan.ta');
Route::GET('/mahasiswa/jadwal', [App\Http\Controllers\LoginMahasiswa::class, 'jadwal'])->name('mahasiswa.jadwal');
Route::GET('/mahasiswa/profile', [App\Http\Controllers\LoginMahasiswa::class, 'profile'])->name('mahasiswa.profile');

//DETAIL
Route::GET('/mahasiswa/jadwal/tambah', [App\Http\Controllers\MahasiswaJadwalController::class, 'tambah']);
Route::GET('/mahasiswa/jadwal/edit/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'edit']);
Route::GET('/mahasiswa/data/bimbingan/kerja_praktik/riwayat/{id}', [App\Http\Controllers\MahasiswaKPController::class, 'detail']);
Route::GET('/mahasiswa/data/bimbingan/pengajuan_judul/riwayat/{id}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'detail']);
Route::GET('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/{id}', [App\Http\Controllers\MahasiswaTAController::class, 'detail']);

//STORE
Route::POST('/mahasiswa/jadwal/save', [App\Http\Controllers\MahasiswaJadwalController::class, 'store']);
Route::POST('/mahasiswa/data/bimbingan/kerja_praktik/save', [App\Http\Controllers\MahasiswaKPController::class, 'store']);
Route::POST('/mahasiswa/data/bimbingan/kerja_praktik/detail/{id}/save', [App\Http\Controllers\MahasiswaKPController::class, 'd_store']);
Route::POST('/mahasiswa/data/bimbingan/pengajuan_judul/save', [App\Http\Controllers\MahasiswaPengajuanController::class, 'store']);
Route::POST('/mahasiswa/data/bimbingan/pengajuan_judul/detail/{id}/save', [App\Http\Controllers\MahasiswaPengajuanController::class, 'd_store']);
Route::POST('/mahasiswa/data/bimbingan/tugas_akhir/save', [App\Http\Controllers\MahasiswaTAController::class, 'store']);
Route::POST('/mahasiswa/data/bimbingan/tugas_akhir/detail/{id}/save', [App\Http\Controllers\MahasiswaTAController::class, 'd_store']);

//UPDATE
Route::POST('/mahasiswa/jadwal/update/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'update']);
Route::POST('/mahasiswa/profile/update_profile', [App\Http\Controllers\LoginMahasiswa::class, 'update_profile']);
Route::POST('/mahasiswa/data/bimbingan/kerja_praktik/update/{id}', [App\Http\Controllers\MahasiswaKPController::class, 'update']);
Route::POST('/mahasiswa/data/bimbingan/kerja_praktik/riwayat/{id}/update/{od}', [App\Http\Controllers\MahasiswaKPController::class, 'd_update']);
Route::POST('/mahasiswa/data/bimbingan/pengajuan_judul/update/{id}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'update']);
Route::POST('/mahasiswa/data/bimbingan/pengajuan_judul/riwayat/{id}/update/{od}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'd_update']);
Route::POST('/mahasiswa/data/bimbingan/tugas_akhir/update/{id}', [App\Http\Controllers\MahasiswaTAController::class, 'update']);
Route::POST('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/{id}/update/{od}', [App\Http\Controllers\MahasiswaTAController::class, 'd_update']);

//DESTROY
Route::GET('/mahasiswa/jadwal/delete/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'destroy']);
Route::GET('/mahasiswa/data/bimbingan/kerja_praktik/delete/{id}', [App\Http\Controllers\MahasiswaKPController::class, 'destroy']);
Route::GET('/mahasiswa/data/bimbingan/kerja_praktik/riwayat/{id}/delete/{od}', [App\Http\Controllers\MahasiswaKPController::class, 'd_destroy']);
Route::GET('/mahasiswa/data/bimbingan/pengajuan_judul/delete/{id}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'destroy']);
Route::GET('/mahasiswa/data/bimbingan/pengajuan_judul/riwayat/{id}/delete/{od}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'd_destroy']);
Route::GET('/mahasiswa/data/bimbingan/tugas_akhir/delete/{id}', [App\Http\Controllers\MahasiswaTAController::class, 'destroy']);
Route::GET('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/{id}/delete/{od}', [App\Http\Controllers\MahasiswaTAController::class, 'd_destroy']);

//JSON
Route::get('/mahasiswa/jadwal/json', [App\Http\Controllers\MahasiswaJadwalController::class, 'json']);
Route::get('/mahasiswa/data/bimbingan/kerja_praktik/json', [App\Http\Controllers\MahasiswaKPController::class, 'json']);
Route::get('/mahasiswa/data/bimbingan/kerja_praktik/riwayat/{id}/json', [App\Http\Controllers\MahasiswaKPController::class, 'd_json']);
Route::get('/mahasiswa/data/bimbingan/pengajuan_judul/json', [App\Http\Controllers\MahasiswaPengajuanController::class, 'json']);
Route::get('/mahasiswa/data/bimbingan/pengajuan_judul/riwayat/{id}/json', [App\Http\Controllers\MahasiswaPengajuanController::class, 'd_json']);
Route::get('/mahasiswa/data/bimbingan/tugas_akhir/json', [App\Http\Controllers\MahasiswaTAController::class, 'json']);
Route::get('/mahasiswa/data/bimbingan/tugas_akhir/riwayat/{id}/json', [App\Http\Controllers\MahasiswaTAController::class, 'd_json']);

//FIND
Route::get('/mahasiswa/jadwal/find/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'find']);
Route::get('/mahasiswa/data/bimbingan/kerja_praktik/find/{id}', [App\Http\Controllers\DosenKPController::class, 'find']);
Route::get('/mahasiswa/data/bimbingan/pengajuan_judul/find/{id}', [App\Http\Controllers\MahasiswaPengajuanController::class, 'find']);
Route::get('/mahasiswa/data/bimbingan/tugas_akhir/find/{id}', [App\Http\Controllers\MahasiswaTAController::class, 'find']);

//FILTER
Route::get('/mahasiswa/jadwal/dosen/json', [App\Http\Controllers\MahasiswaJadwalController::class, 'dosen']);
Route::get('/mahasiswa/jadwal/bimbingan/json', [App\Http\Controllers\MahasiswaJadwalController::class, 'bimbingan']);
Route::get('/mahasiswa/jadwal/cari/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'cari_dosen']);
Route::get('/mahasiswa/jadwal/tanggal/{id}', [App\Http\Controllers\MahasiswaJadwalController::class, 'tanggal']);
