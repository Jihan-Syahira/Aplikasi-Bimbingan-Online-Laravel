@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive">
            <form action="{{url($page)}}" method="POST" id="compose-form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group row">
                        <label class="col-sm-3">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="date" name="tanggal" class="form-control" value="{{$load->tanggal}}" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Pilih Judul</label>
                        <div class="col-sm-9">
                            <select name="id_bimbingan" id="id_bimbingan" class="form-control p-0 px-2" required>
                                <option value="{{$load->id_bimbingan}}" selected>{{$load->cari_bimbingan->judul}}</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-3">Dosen Pembimbing</label>
                        <div class="col-sm-9">
                          <input type="text" name="dosen" value="{{$load->cari_bimbingan->cari_dosen->nama}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Pembahasan</label>
                        <div class="col-sm-9">
                          <textarea name="keterangan" class="form-control" placeholder="Contoh: Perbaikan Penulisan" required>{{$load->keterangan}}</textarea>
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
    var events = @json($events);
    document.addEventListener('DOMContentLoaded', function () {
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
                    url: "<?=url('mahasiswa/jadwal');?>/tanggal/"+info.event.id,
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
</script>
@endSection