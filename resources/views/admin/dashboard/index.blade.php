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
            <p class="mb-0 text-right">Mahasiswa</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$s_mahasiswa}}</h3>
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
            <i class="mdi mdi-account-multiple text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Dosen</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$s_dosen}}</h3>
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
            <i class="mdi mdi-clipboard-text text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Bimbingan </p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$s_bimbingan}}</h3>
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
          <h2 class="card-title mb-0">Rasio Bimbingan</h2>
          <div class="wrapper d-flex">
            <div class="d-flex align-items-center mr-3">
              <span class="dot-indicator bg-success"></span>
              <p class="mb-0 ml-2 text-muted">Kerja Praktik</p>
            </div>
            <div class="d-flex align-items-center mr-3">
              <span class="dot-indicator bg-primary"></span>
              <p class="mb-0 ml-2 text-muted">Pengajuan Judul</p>
            </div>
            <div class="d-flex align-items-center">
              <span class="dot-indicator bg-warning"></span>
              <p class="mb-0 ml-2 text-muted">Tugas Akhir</p>
            </div>
          </div>
        </div>
        <div class="chart-container">
          <canvas id="dashboard-area-chart" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row d-none">
  <div class="col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Todo</h4>
        <div class="add-items d-flex">
          <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
          <button class="add btn btn-primary font-weight-medium todo-list-add-btn">Add</button>
        </div>
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
            <li class="completed">
              <div class="form-check form-check-flat">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked> Call John </label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li>
              <div class="form-check form-check-flat">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Create invoice </label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li>
              <div class="form-check form-check-flat">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Print Statements </label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li class="completed">
              <div class="form-check form-check-flat">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Schedules</h4>
        <div class="shedule-list d-flex align-items-center justify-content-between mb-3">
          <h3>27 Sep 2018</h3>
          <small>21 Events</small>
        </div>
        <div class="event border-bottom py-3">
          <p class="mb-2 font-weight-medium">Skype call with alex</p>
          <div class="d-flex align-items-center">
            <div class="badge badge-success">3:45 AM</div>
            <small class="text-muted ml-2">London, UK</small>
            <div class="image-grouped ml-auto">
              <img src="{{ url('assets/images/faces/face10.jpg') }}" alt="profile image">
              <img src="{{ url('assets/images/faces/face13.jpg') }}" alt="profile image"> </div>
          </div>
        </div>
        <div class="event py-3 border-bottom">
          <p class="mb-2 font-weight-medium">Data Analysing with team</p>
          <div class="d-flex align-items-center">
            <div class="badge badge-warning">12.30 AM</div>
            <small class="text-muted ml-2">San Francisco, CA</small>
            <div class="image-grouped ml-auto">
              <img src="{{ url('assets/images/faces/face20.jpg') }}" alt="profile image">
              <img src="{{ url('assets/images/faces/face17.jpg') }}" alt="profile image">
              <img src="{{ url('assets/images/faces/face14.jpg') }}" alt="profile image"> </div>
          </div>
        </div>
        <div class="event py-3">
          <p class="mb-2 font-weight-medium">Meeting with client</p>
          <div class="d-flex align-items-center">
            <div class="badge badge-danger">4.15 AM</div>
            <small class="text-muted ml-2">San Diego, CA</small>
            <div class="image-grouped ml-auto">
              <img src="{{ url('assets/images/faces/face21.jpg') }}" alt="profile image">
              <img src="{{ url('assets/images/faces/face16.jpg') }}" alt="profile image"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-4 grid-margin stretch-card">
    <div class="row flex-grow">
      <div class="col-md-6 col-xl-12 grid-margin grid-margin-md-0 grid-margin-xl stretch-card">
        <div class="card card-revenue">
          <div class="card-body d-flex align-items-center">
            <div class="d-flex flex-grow">
              <div class="mr-auto">
                <p class="highlight-text mb-0 text-white"> $168.90 </p>
                <p class="text-white"> This Month </p>
                <div class="badge badge-pill"> 18% </div>
              </div>
              <div class="ml-auto align-self-end">
                <div id="revenue-chart" sparkType="bar" sparkBarColor="#e6ecf5" barWidth="2"> 4,3,10,9,4,3,8,6,7,8 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-12 stretch-card">
        <div class="card card-revenue-table">
          <div class="card-body">
            <div class="revenue-item d-flex">
              <div class="revenue-desc">
                <h6>Member Profit</h6>
                <p class="font-weight-light"> Average Weekly Profit </p>
              </div>
              <div class="revenue-amount">
                <p class="text-primary"> +168.900 </p>
              </div>
            </div>
            <div class="revenue-item d-flex">
              <div class="revenue-desc">
                <h6>Total Profit</h6>
                <p class="font-weight-light"> Weekly Customer Orders </p>
              </div>
              <div class="revenue-amount">
                <p class="text-primary"> +6890.00 </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_script')
<script type="text/javascript">
var data1 = {{json_encode($chart[1])}};
var data2 = {{json_encode($chart[0])}};
var data3 = {{json_encode($chart[2])}};

</script>
<script type="text/javascript" src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dashboard.js')}}"></script>
@endsection