@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary btn-add pull-right"><i class="mdi mdi-plus"></i> Tambah Data</button>
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive pt-5">
          <div id="calendar"></div>
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
                      <label class="col-sm-3">Tanggal</label>
                      <div class="col-sm-9">
                        <input type="date" name="tanggal" class="form-control" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3">Mulai</label>
                      <div class="col-sm-9">
                        <input type="time" name="mulai" class="form-control in-mulai" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3">Akhir</label>
                      <div class="col-sm-9">
                        <input type="time" name="akhir" class="form-control in-akhir" required>
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
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events),
            eventClick: function(info) {
                Swal.fire({
                title: 'Modifikasi Data ?',
                text: "Data yang dimodifikasi tidak dapat dikembalikan !",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Edit',
                cancelButtonText: 'Hapus'
                }).then((result) => {
                    if (result.value) {
                        edit(info.event.id)
                    } else if(result.dismiss == 'cancel'){
                        Swal.fire(
                            'Data Dihapus!',
                            '',
                            'success'
                        );
                        window.location.href= "{{url($page.'/delete/')}}/"+info.event.id;
                    }
                });
            }
        });
        calendar.render();
    });
</script>
<script>
    //Button Trigger
    $("body").on("click change key-up",".in-mulai, .in-akhir",function(){
        let tanggal = jQuery("#compose-form input[name=tanggal]").val();
        let mulai = jQuery("#compose-form input[name=mulai]").val();
        let akhir = jQuery("#compose-form input[name=akhir]").val();
        if(mulai < akhir && tanggal != '' && mulai != '')
        {
            console.log(akhir);
            jQuery(".btn-simpan").removeAttr("disabled");
        }else{
            console.log(mulai);
            jQuery(".btn-simpan").attr("disabled",'yes');
        }
        
    });
    $("body").on("click",".btn-add",function(){
        kosongkan();
        jQuery(".btn-simpan").attr("disabled",'yes');
        jQuery("#compose-form").attr("action",'<?=url($page);?>/save');
        jQuery("#compose .modal-title").html("Tambah <?=$title;?>");
        jQuery("#compose").modal("toggle");  
    });

    function edit(id){
                    
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
                    jQuery("#compose-form input[name=mulai]").val(row.mulai);
                    jQuery("#compose-form input[name=akhir]").val(row.akhir);
                })
            }
        });
        jQuery("#compose-form").attr("action",'<?=url($page);?>/update/'+id);
        jQuery("#compose .modal-title").html("Update <?=$title?>");
        jQuery("#compose").modal("toggle");
    };
    
    $("body").on("click",".btn-simpan",function(){
        Swal.fire(
            'Data Disimpan!',
            '',
            'success'
            )
    });
        
    function kosongkan()
    {
        jQuery("#compose-form input[name=tanggal]").val("");
        jQuery("#compose-form input[name=mulai]").val("");
        jQuery("#compose-form input[name=akhir]").val("");
    }
</script>
@endSection