@extends('landing.app')

@section('content')
<section id="edu-aboutus-section" class="ed-about-us layout-2 clearfix">
		<div class="section-seperator top-section-seperator svg-big-triangle-center-wrap">
			<svg class="svg-big-triangle" fill="#FF0000" width="100%" height="100%" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331">
			<path d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"></path>
			</svg>
		</div>
		<div class="section-wrap full-width">
			<div class="container">			
      			<div class="ed-header layout-2">
          			<h2 class="section-header">Kalender Aktif Bimbingan Dosen</h2>      
      			</div>
    			<div class="edu-press-wrap">
					<div class="ed-about-content">					
						<div class="">
							<div class="d-flex">
								<div class="col-12">
									<div class="form-group row align-items-center">
                   					   <label class="col-sm-3 pl-5">Dosen</label>
                   					   <div class="col-sm-9">
                   					     <select name="id_dosen" id="id_dosen" class="form-control p-0 px-2" onchange="ganti_dosen();">
                   					       <option value="0" selected disabled>-- Pilih Dosen</option>
                   					     </select>
                   					   </div>
									</div>
        							<div class="table-responsive pt-5">
        							  <div id="calendar"></div>
        							</div>
								</div>
							</div>
						</div>
						<div class="ed-about-list ui-accordion ui-widget ui-helper-reset" id="edu-accordion" role="tablist">
						</div>
					</div>
				</div>
			</div>
		</div> <!-- section wrap -->
		<div class="section-seperator bottom-section-seperator svg-big-triangle-center-wrap"><svg class="svg-big-triangle" fill="#FF0000" width="100%" height="100%" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331">
			<path d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"></path>
			</svg>
		</div>
	</section>
@endsection

@section('custom_script')

<script>
	var calendarEl = document.getElementById('calendar');
	var calendar;
	var events;
	document.addEventListener('DOMContentLoaded', function () {
		
		$.ajax({
            url: "<?=url('agenda/dosen/json');?>",
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

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
        });
        calendar.render();
    });

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
                    data: 'tgl',
                    className: 'text-center'
                },
                {
                    data: 'antrian',
                    className: 'text-center'
                },
                {
                    data: 'dosen',
                    className: 'text-center'
                },
                {
                    data: 'mahasiswa',
                    className: 'text-center'
                },
                {
                    data: 'paraf',
                    className: 'text-center'
                },
            ]
        });

    });
	function ganti_dosen()
    {
        calendar.destroy();
        var id = jQuery("#id_dosen").val();
        $.ajax({
            url: "<?=url($page);?>/cari/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                events = dataResult.data;
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: events,
                    eventClick: function(info) {
                        $.ajax({
                            url: "<?=url('agenda/dosen/find/');?>/"+info.event.id,
                            type: "GET",
                            cache: false,
                            dataType: 'json',
                            success: function (dataResult) { 
                                console.log(dataResult);
                                var resultData = dataResult.data;
                                $.each(resultData,function(index,row){ 

                                    Swal.fire({
                                    title: 'Jadwal Bimbingan !',
                                    text: "Dimulai dari pukul "+row.waktu+" ",
                                    type: 'info'
                                    })

                                })
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