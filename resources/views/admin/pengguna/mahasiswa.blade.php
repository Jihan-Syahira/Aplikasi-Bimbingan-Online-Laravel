@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary btn-add pull-right" data-toggle="modal" data-target="#compose"><i class="mdi mdi-plus"></i> Tambah Data</button>
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive pt-5">
          <table class="display table table-bordered table-hover" id="data-width" width="100%">
            <thead class="text-center">
              <tr>
                <th width="7%">No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Telepon</th>
                <th>Email</th>
                <th width="15%">#</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

 
<!-- ============ MODAL DATA =============== -->
<div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="justify-content-center modal-header">
              <center><b>
              <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4></b></center>    
          </div>
          <form action="#" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="modal-body"> 
                  <div class="form-group row">
                      <label class="col-sm-3">Nama Mahasiswa</label>
                      <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Mahasiswa..">
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">NIM</label>
                      <div class="col-sm-9">
                        <input type="text" name="nim" class="form-control" required placeholder="NIM Mahasiswa">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3">Telepon</label>
                      <div class="col-sm-9">
                        <input type="number" name="no_hp" class="form-control" required placeholder="Nomor Telepon Mahasiswa">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
              </div>
          </form>
      </div>
  </div>
</div>
<!--- END MODAL DATA --->

<!-- ============ MODAL DATA AKUN =============== -->
<div class="modal fade" id="compose-akun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="justify-content-center modal-header">
              <center><b>
              <h4 class="modal-title">Tambah Data</h4></b></center>    
          </div>
          <form action="#" method="POST" id="compose-form-akun" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="modal-body"> 
                  <div class="form-group row">
                      <label class="col-sm-3">Nama Pengguna</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" readonly>
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" required placeholder="Email Pengguna">
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">Password</label>
                      <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" required placeholder="">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3">Hak Akses</label>
                      <div class="col-sm-9">
                        <input type="text" name="level" class="form-control" readonly value="Mahasiswa">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
              </div>
          </form>
      </div>
  </div>
</div>
<!--- END MODAL DATA AKUN--->
@endsection

@section('custom_script')

<script>
    $(function() {
        var em;
        table = $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: '{{url("$page/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    className: 'text-center'
                },
                {
                    data: 'nim',
                    className: 'text-center'
                },
                {
                    data: 'no_hp',
                    className: 'text-center'
                },
                {
                    data: 'email',
                    className: 'text-center', render:function(data){
                        if(data != 'Akun tidak ditemukan')
                        {
                            em = 'update';
                        }else{
                            em = 'new';
                        }
                        return data;
                    }
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-info btn-'+em+'" data-id="' + data + '"><i class="fa fa-key"></i> </button>\
                        <button type="button" class="btn btn-success btn-edit" data-id="' + data + '"><i class="fa fa-edit"></i> </button>\
                        <a class="btn btn-danger btn-hapus" data-id="' + data + '" data-handler="mahasiswa" href="<?= url($page.'/delete') ?>/' + data + '">\
                        <i class="fa fa-trash"></i> </a> \
					              <form id="delete-form-' + data + '-mahasiswa" action="<?= url($page.'/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
                    }
                },
            ]
        });

    });

    //Button Trigger
    $("body").on("click",".btn-add",function(){
        kosongkan();
        jQuery("#compose-form").attr("action",'<?=url($page);?>/save');
        jQuery("#compose .modal-title").html("Tambah <?=$title;?>");
        jQuery("#compose").modal("toggle");  
    });

    $("body").on("click",".btn-edit",function(){
        var id = jQuery(this).attr("data-id");
                    
        $.ajax({
            url: "<?=url($page);?>/find/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){
                    jQuery("#compose-form input[name=nama]").val(row.nama);
                    jQuery("#compose-form input[name=nim]").val(row.nim);
                    jQuery("#compose-form input[name=no_hp]").val(row.no_hp);
                })
            }
        });
        jQuery("#compose-form").attr("action",'<?=url($page);?>/update/'+id);
        jQuery("#compose .modal-title").html("Update <?=$title?>");
        jQuery("#compose").modal("toggle");
    });
    
    $("body").on("click",".btn-simpan",function(){
        Swal.fire(
            'Data Disimpan!',
            '',
            'success'
            )
    });
        
    function kosongkan()
    {
      jQuery("#compose-form input[name=nama]").val("");
      jQuery("#compose-form input[name=nim]").val("");
      jQuery("#compose-form input[name=no_hp]").val("");
    }
    
    $("body").on("click",".btn-new",function(){
        var id = jQuery(this).attr("data-id");
        $.ajax({
            url: "<?=url($page);?>/find/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){
                    jQuery("#compose-form-akun input[name=name]").val(row.nama);
                    jQuery("#compose-form-akun input[name=email]").val('');
                })
            }
        });
        jQuery("#compose-form-akun").attr("action",'<?=url($page);?>/akun/'+id);
        jQuery("#compose-form-akun input[name=password]").attr("placeholder",'Silahkan masukkan password');
        jQuery("#compose-form-akun input[name=password]").attr("required",'yes');
        jQuery("#compose-akun .modal-title").html("Buat Akun");
        jQuery("#compose-akun").modal("toggle");  
    });

    $("body").on("click",".btn-update",function(){
        var id = jQuery(this).attr("data-id");
        $.ajax({
            url: "<?=url($page);?>/find/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){
                    jQuery("#compose-form-akun input[name=name]").val(row.nama);
                    jQuery("#compose-form-akun input[name=email]").val(row.email);
                })
            }
        });
        jQuery("#compose-form-akun").attr("action",'<?=url($page);?>/akun/'+id);
        jQuery("#compose-form-akun input[name=password]").attr("placeholder",'Kosongkan jika tidak diubah');
        jQuery("#compose-form-akun input[name=password]").attr("required",'no');
        jQuery("#compose-akun .modal-title").html("Update Akun");
        jQuery("#compose-akun").modal("toggle");  
    });

</script>
@endSection