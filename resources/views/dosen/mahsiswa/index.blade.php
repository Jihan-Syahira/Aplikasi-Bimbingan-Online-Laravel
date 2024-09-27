@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive pt-5">
          <table class="display table table-bordered table-hover" id="data-width" width="100%">
            <thead class="text-center">
              <tr>
                <th width="7%">No</th>
                <th>Judul</th>
                <th>Mahasiswa</th>
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
                      <label class="col-sm-4">Tanggal</label>
                      <div class="col-sm-8">
                        <input type="date" name="tanggal" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4">Pembahasan</label>
                      <div class="col-sm-8">
                        <textarea name="keterangan" placeholder="contoh : Perbaiki Penulisan" class="form-control" required></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4">Validasi</label>
                      <div class="col-sm-8">
                        <select name="paraf" class="form-control p-0 px-2" required>
                          <option value="Menunggu">Menunggu</option>
                          <option value="Bimbingan">Sudah Bimbingan</option>
                          <option value="Ditolak">Batal Bimbingan</option>
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
<!--- END MODAL DATA --->
@endsection

@section('custom_script')

<script>
    $(function() {
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
                    data: 'mahasiswa',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    className: 'text-justify'
                },
                {
                    data: 'paraf',
                    className: 'text-center'
                },
                {
                    data: 'id_detail',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-info btn-eye" data-id="' + data + '"><i class="fa fa-eye"></i></button>\
                        <button type="button" class="btn btn-success btn-edit" data-id="' + data + '"><i class="fa fa-edit"></i></button>';
                    }
                },
            ]
        });

    });

    //Button Trigger
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
                    jQuery("#compose-form input[name=tanggal]").val(row.tanggal);
                    jQuery("#compose-form textarea[name=keterangan]").val(row.keterangan);
                    jQuery("#compose-form select[name=paraf]").val(row.paraf);
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
    
    $("body").on("click",".btn-eye",function(){
        var id = jQuery(this).attr("data-id");
        window.location.href = "{{url($page.'/riwayat')}}/" + id ;
    });
</script>
@endSection