@extends('template.layout')

@section('content')

    <!-- awal isi halaman -->
    <div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
                                <button type="button" class="btn btn-primary btn-add pull-right" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> Tambah Data 
                                </button>
								<h4 class="card-title">{{$title}}</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table id="data-width" class="display table table-striped table-hover" width="100%">
                                    <thead>
                                      <tr>
                                          <th style='text-align:center;' width="10%">No</th>
                                          <th>Nama Pengguna</th>
                                          <th>Email Pengguna</th>
                                          <th>Login Terakhir</th>
                                          <th style='text-align:center;' width="20%">Opsi</th>                        
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
        </div>
    </div>
      <!-- akhir isi halaman -->
    
<!-- ============ MODAL DATA JADWAL =============== -->
<div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <center><b>
              <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4></b></center>    
          </div>
          <form action="#" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="modal-body"> 
                  <div class="form-group row">
                      <label class="col-sm-4">Nama Pengguna</label>
                      <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4">Email Pengguna</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4">Password</label>
                      <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
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
<!--- END MODAL DATA JADWAL--->
@endSection
@section('js')

<script>
    $(function() {
        table = $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{{url("$page/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'last_login'
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-success btn-edit" data-id="' + data + '"><i class="fa fa-edit"></i> </button>\
                        <a class="btn btn-danger btn-hapus" data-id="' + data + '" data-handler="user" href="<?= url('admin/user/delete') ?>/' + data + '">\
                        <i class="fa fa-trash"></i> </a> \
					              <form id="delete-form-' + data + '-user" action="<?= url('admin/user/delete') ?>/' + data + '" \
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
    }
</script>
@endSection