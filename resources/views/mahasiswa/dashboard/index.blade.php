@extends('template.master')


@section('content')
<div class="row">
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-school text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">NIM Mahasiswa</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$nim}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted d-none mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Product-wise sales </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-clipboard-list text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Jumlah Bimbingan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$s_internal}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted d-none mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% lower growth </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-clipboard-check text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Bimbingan Selesai</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$s_karyawan}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted d-none mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
          <h2 class="card-title mb-0">Riwayat Bimbingan</h2>
        </div>
        <div class="chart-container">
          <div class="table-responsive pt-1">
            <table class="display table table-bordered table-hover" id="data-width" width="100%">
              <thead class="text-center">
                <tr>
                  <th width="7%">No</th>
                  <th width="20%">Tanggal</th>
                  <th>Pembahasan</th>
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
  </div>
</div>
@endsection
@section('custom_script')
<script type="text/javascript">

</script>
<script type="text/javascript" src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dashboard.js')}}"></script>
@endsection