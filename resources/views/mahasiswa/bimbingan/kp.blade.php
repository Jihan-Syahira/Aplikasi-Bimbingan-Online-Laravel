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
                <th>Judul</th>
                <th>Dosen Pembimbing</th>
                <th>Keterangan</th>
                <th>Status</th>
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
 
 <!-- ============ MODAL DATA JADWAL =============== -->
 <div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
           <div class="justify-content-center modal-header">
               <center><b>
               <h4 class="modal-title" id="exampleModalLabel">Tambah Data</h4></b></center>    
           </div>
           <form action="#" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
               @csrf
               <div class="modal-body"> 
                   <div class="form-group row">
                       <label class="col-sm-3 pl-5">Judul</label>
                       <div class="col-sm-9">
                         <input type="text" name="judul" class="form-control" required placeholder="Judul Laporan Kerja Praktik">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="col-sm-3 pl-5">Dosen Pembimbing</label>
                       <div class="col-sm-9">
                         <select name="id_dosen" id="id_dosen" class="form-control p-0">
                           <option value="0" selected disabled>-- Pilih Dosen Pembimbing</option>
                         </select>
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="col-sm-3 pl-5">Keterangan</label>
                       <div class="col-sm-9">
                         <textarea name="keterangan" class="form-control" required>-</textarea>
                       </div>
                   </div>
                   <div class="form-group row">
                       <label class="col-sm-3 pl-5">Status</label>
                       <div class="col-sm-9">
                         <select name="status" class="form-control p-0" readonly>
                           <option value="Berjalan" selected>Berjalan</option>
                           <option value="Selesai">Selesai</option>
                           <option value="Batal">Ditolak</option>
                         </select>
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
@endsection

@section('custom_script')

<script>
    $(function() {
      $.ajax({
            url: "<?=url('mahasiswa/jadwal/dosen/json');?>",
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){ 
                    $('#id_dosen').append('<option value="' + row.id + '">' + row.nama +  '</option>');
                })
            }
        });
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
                    data: 'judul',
                    className: 'text-center'
                },
                {
                    data: 'dosen',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    className: 'text-justify'
                },
                {
                    data: 'status',
                    className: 'text-center'
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-info btn-eye" data-id="' + data + '"><i class="fa fa-eye"></i> </button>\
                        <button type="button" class="btn btn-success btn-edit" data-id="' + data + '"><i class="fa fa-edit"></i> </button>\
                        <a class="btn btn-danger btn-hapus" data-id="' + data + '" data-handler="kp" href="<?= url($page.'/delete') ?>/' + data + '">\
                        <i class="fa fa-trash"></i> </a> \
					              <form id="delete-form-' + data + '-kp" action="<?= url($page.'/delete') ?>/' + data + '" \
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
                    jQuery("#compose-form input[name=judul]").val(row.judul);
                    jQuery("#compose-form select[name=id_dosen]").val(row.id_dosen);
                    jQuery("#compose-form select[name=status]").val(row.status);
                    jQuery("#compose-form textarea[name=keterangan]").val(row.keterangan);
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
      jQuery("#compose-form input[name=judul]").val("");
      jQuery("#compose-form select[name=id_dosen]").val(0);
      jQuery("#compose-form select[name=status]").val('Berjalan');
      jQuery("#compose-form textarea[name=keterangan]").val('-');
    }

    $("body").on("click",".btn-eye",function(){
        var id = jQuery(this).attr("data-id");
        window.location.href = "{{url($page.'/riwayat')}}/" + id ;
    });
</script>
@endSection