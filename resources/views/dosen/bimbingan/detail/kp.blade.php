@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 flex-column pl-4 mb-4 row">
    <h5 class="">{{$load->cari_bimbingan->judul}}</h5>
    <h6 class="text-muted">{{$load->cari_bimbingan->cari_mahasiswa->nama}}</h6>
  </div>
    
  <div class="col-lg-12 grid-margin stretch-card flex-column">
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive pt-1">
          <table class="display table table-bordered table-hover" id="data-width" width="100%">
            <thead class="text-center">
              <tr>
                <th width="7%">No</th>
                <th width="20%">Tanggal</th>
                <th>Pembahasan</th>
                <th>Status</th>
                <th width="7%">Response</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <button class="btn btn-lampiran pull-right text-avatar">Tambah Lampiran</button>
        <h3 class="card-title">Lampiran</h3>
        <div class="table-responsive pt-1">
          <table class="display table table-bordered table-hover" id="data-lampiran" width="100%">
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
  <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="justify-content-center modal-header">
              <center><b>
              <h4 class="modal-title" id="exampleModalLabel">Response of</h4></b></center>    
          </div>
          <div class="modal-body">
            <table id="data-comment" class="table table-hover" width="100%">
              <thead>
                <tr>
                  <th width="60%">Content</th>
                  <th>User</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <form action="#" method="POST" id="compose-form" class="form-horizontal d-none" enctype="multipart/form-data">
              @csrf
              <div class="modal-body"> 
                  <input type="number" name="id_detail" hidden>
                  <div class="form-group row">
                      <label class="col-sm-3">Content</label>
                      <div class="col-sm-9">
                        <textarea id="myeditorinstance">Input your Comment here!</textarea>
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
                    data: 'tanggal',
                    className: 'text-center',
                },
                {
                    data: 'keterangan',
                    className: 'text-justify',
                },
                {
                    data: 'paraf',
                    className: 'text-center',
                },
                {
                    orderable: false,
                    data: 'id_detail',
                    className: 'text-center', render: function(data){
                      return '<button type="button" class="btn btn-comment" data-id="' + data + '"><i class="fa fa-comments-o text-behance"></i></button>';
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

    $("body").on("click",".btn-comment",function(){
        var id = jQuery(this).attr("data-id");
                    
       
        jQuery("#compose-form").attr("action",'<?=url($page);?>/update/'+id);
        jQuery("#compose .modal-title").html("Response of ");
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
    
</script>
@endSection