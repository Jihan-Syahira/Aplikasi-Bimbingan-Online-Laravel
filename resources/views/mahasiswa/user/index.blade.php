@extends('template.master')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{$title}}</h3>
			    <div class="card-body">
                    <form action="{{url($page.'/update_profile')}}" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <h3 class="card-title">Informasi Akun</h3>
                        <div class="modal-body"> 
                            <div class="form-group row">
                                <label class="col-sm-4">Nama Pengguna</label>
                                <div class="col-sm-8">
                                  <input type="text" name="username" class="form-control" value="{{$load->cari_user->name}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Email Pengguna</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" class="form-control" value="{{$load->cari_user->email}}" required>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title">Informasi Mahasiswa</h3>
                        <div class="modal-body"> 
                            <div class="form-group row">
                                <label class="col-sm-4">Nama</label>
                                <div class="col-sm-8">
                                  <input type="text" name="nama" class="form-control" value="{{$load->nama}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">NIM</label>
                                <div class="col-sm-8">
                                  <input type="text" name="nim" class="form-control" value="{{$load->nim}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Telepon</label>
                                <div class="col-sm-8">
                                  <input type="number" name="no_hp" class="form-control" value="{{$load->no_hp}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- akhir isi halaman -->
@endSection
@section('js')
<script>

</script>
@endSection