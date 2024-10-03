@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive">
            <form action="{{url($page.'/save')}}" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group row">
                        <label class="col-sm-3">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="date" name="tanggal" class="form-control" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Pilih Judul</label>
                        <div class="col-sm-9">
                            <select name="id_bimbingan" id="id_bimbingan" onchange="ganti_dosen();" class="form-control p-0 px-2" required>
                                <option value="0" selected disabled>-- Pilih Judul</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-3">Dosen Pembimbing</label>
                        <div class="col-sm-9">
                          <input type="text" name="dosen" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Pembahasan</label>
                        <div class="col-sm-9">
                          <textarea name="keterangan" class="form-control" placeholder="Contoh: Perbaikan Penulisan" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
            </form>
            
            <h3 class="card-title">Jadwal Dosen</h3>
            <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_script')
<script>
    var calendarEl = document.getElementById('calendar');
    var calendar;
    var events;
    document.addEventListener('DOMContentLoaded', function () {
        calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
        $.ajax({
            url: "<?=url('mahasiswa/jadwal/bimbingan/json');?>",
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){ 
                    $('#id_bimbingan').append('<option value="' + row.id + '">' + row.judul +  '</option>');
                })
            }
        });
    });
    $("body").on("click",".btn-simpan",function(){
        var tanggal = jQuery("#compose-form input[name=tanggal]").val();
        var bimbingan = jQuery("#compose-form select[name=id_bimbingan] :selected").val();
        if(tanggal === '' || bimbingan === 0)
        {
            alert('Lengkapi Form !');
        }else{
            Swal.fire(
                'Data Disimpan!',
                '',
                'success'
            )
        }
    });
        
    function ganti_dosen()
    {
        calendar.destroy();
        jQuery("#compose-form input[name=tanggal]").val("");
        var id = jQuery("#compose-form select[name=id_bimbingan] :selected").val();
        $.ajax({
            url: "<?=url($page);?>/cari/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                events = dataResult.data;
                jQuery("#compose-form input[name=dosen]").val(dataResult.dosen);
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: events,
                    eventClick: function(info) {
                        Swal.fire(
                            'Tanggal Dipilih!',
                            '',
                            'success'
                        );
                        $.ajax({
                            url: "<?=url($page);?>/tanggal/"+info.event.id,
                            type: "GET",
                            cache: false,
                            dataType: 'json',
                            success: function (dataResult) { 
                                console.log(dataResult);
                                jQuery("#compose-form input[name=tanggal]").val(dataResult);
                            }
                        });
                    }
                });
                calendar.render();
            }
        });
        
    }
</script>
@endSection