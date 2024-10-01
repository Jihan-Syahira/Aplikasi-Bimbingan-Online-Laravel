@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card flex-column">
    <div class="card mb-4">
      <div class="card-body">
        <h3 class="card-title">{{$title}} {{$load->cari_bimbingan->cari_mahasiswa->nama}}<br>Judul : {{$load->cari_bimbingan->judul}}</h3>
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
                      return '<button type="button" class="btn  btn-comment" data-id="' + data + '"><i class="fa fa-comments-o text-behance"></i></button>';
                    }
                },
            ]
        });

    });
</script>
@endSection