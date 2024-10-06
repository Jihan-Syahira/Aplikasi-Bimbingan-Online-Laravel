@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive pt-5">
          <table class="display table table-bordered table-hover" id="data-width" width="100%">
            <thead class="text-center">
              <tr>
                <th width="7%">No</th>
                <th>Timestamp</th>
                <th>Pesan</th>
                <th>#</th>
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
                url: '{{url("users/notif/get")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'waktu',
                    className: 'text-center'
                },
                {
                    data: 'full_judul',
                    className: 'text-center'
                },
                {
                    data: 'id_bimbingan',
                    className: 'text-center', render: function(data, type, row) {
                        return '<button type="button" class="btn btn-info btn-eye" data-id="' + data + '"><i class="fa fa-eye"></i> </button>';
                       
                }
              },
            ]
        });

    });

    //Button Trigger
    $("body").on("click",".btn-eye",function(){
        var id = jQuery(this).attr("data-id");
        window.location.href = "{{url('/users/bimbingan/find/')}}/"+id;
    });
</script>
@endSection