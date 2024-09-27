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
          			<h2 class="section-header">Jadwal Bimbingan {{$title}}</h2>      
      			</div>
    			<div class="edu-press-wrap">
					<div class="ed-about-content">					
						<div class="">
							<div class="d-flex">
								<div class="col-12">
									<div class="table-responsive pt-5">
          								<table class="display table table-bordered table-hover" id="data-width" width="100%">
          								  <thead class="text-center">
          								    <tr>
          								      <th width="7%">No</th>
          								      <th>Tanggal</th>
          								      <th>Antrian</th>
          								      <th>Dosen</th>
          								      <th>Mahasiswa</th>
          								      <th>Status</th>
          								    </tr>
          								  </thead>
          								  <tbody>

          								  </tbody>
          								</table>
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
</script>
@endSection