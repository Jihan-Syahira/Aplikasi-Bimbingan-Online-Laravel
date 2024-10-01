@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$title}} <br> <br>Mahasiswa : {{$load->cari_mahasiswa->nama}}<br>Judul : {{$load->judul}}</h3>
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
            ]
        });

    });
</script>
@endSection