@extends('template.master') @section('content')
<div class="row">
    <div class="col-lg-12 flex-column pl-4 mb-4 row">
        <h5 class="">{{$load->judul}}</h5>
        <h6 class="text-muted">
            {{$load->cari_mahasiswa->nama}}
        </h6>
    </div>

    <div class="col-lg-12 grid-margin stretch-card flex-column">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive pt-1">
                    <table
                        class="display table table-bordered table-hover"
                        id="data-width"
                        width="100%"
                    >
                        <thead class="text-center">
                            <tr>
                                <th width="7%">No</th>
                                <th width="20%">Tanggal</th>
                                <th>Pembahasan</th>
                                <th>Status</th>
                                <th width="7%">Response</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button class="btn btn-lampiran pull-right text-avatar text-primary">
                    Tambah Lampiran
                </button>
                <h3 class="card-title">Lampiran</h3>
                <div class="table-responsive pt-1">
                    <table
                        class="display table table-hover"
                        id="data-lampiran"
                        width="100%"
                    >
                    <thead>
                        <tr>
                            <th width="70%">File Name</th>
                            <th>User</th>
                        </tr>
                    </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============ MODAL DATA =============== -->
<div
    class="modal fade"
    id="compose"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="justify-content-center modal-header">
                <center>
                    <b>
                        <h4 class="modal-title" id="exampleModalLabel">
                            Response of
                        </h4></b
                    >
                </center>
            </div>
            <div class="modal-body">
                <label id="title-section" class="pl-2">Judul Bimbingan</label>

                <table id="data-comment" class="table table-hover table-light" width="100%">
                    <thead>
                        <tr>
                            <th width="60%">Content</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <form
                action="#"
                method="POST"
                id="compose-form"
                class="form-horizontal d-none"
                enctype="multipart/form-data"
            >
                @csrf

                <input type="text" id="id_detail" name="id_detail" style="display:none;"/>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-12">Content</label>
                        <div class="col-sm-12">
                            <textarea id="myeditorinstance" name="content" rows="2">Input your Comment here!</textarea>
                        </div>
                    </div>
                </div>
                
            </form>
            <div class="modal-footer d-none" id="second-footer">
                <button
                    type="reset"
                    class="btn btn-danger btn-batal"
                    data-dismiss="modal"
                >
                    Batal
                </button>
                <button type="button" class="btn btn-primary btn-simpan">
                    Simpan
                </button>
            </div>
            
            <div class="modal-footer " id="main-footer">
                <button type="button" class="btn btn-primary btn-tambah">
                    Add Comment
                </button>
            </div>
        </div>
    </div>
</div>
<!--- END MODAL DATA --->

 
<!-- ============ MODAL DATA =============== -->
<div class="modal fade" id="compose-lampiran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="justify-content-center modal-header">
              <center><b>
              <h4 class="modal-title" id="exampleModalLabel">Upload File</h4></b></center>    
          </div>
          <form action="#" method="POST" id="compose-form-lampiran" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              
              <input type="number" name="id_bimbingan" hidden value="{{$load->id}}"/>
              <div class="modal-body"> 
                  <div class="form-group row">
                      <label class="col-sm-3">Nama File</label>
                      <div class="col-sm-9">
                        <input type="text" name="judul" class="form-control" required placeholder="ex : Lampiran revisi 1..">
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">File</label>
                      <div class="col-sm-9">
                        <input type="file" name="upload" class="form-control px-1 py-2" required>
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
@endsection @section('custom_script')

<script>
    $(function () {
        table = $("#data-width").DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: '{{url("$page/json")}}',
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "tanggal",
                    className: "text-center",
                },
                {
                    data: "keterangan",
                    className: "text-justify",
                },
                {
                    data: "paraf",
                    className: "text-center",
                },
                {
                    orderable: false,
                    data: "id_detail",
                    className: "text-center",
                    render: function (data) {
                        return (
                            '<button type="button" class="btn btn-comment" data-id="' +
                            data +
                            '"><i class="fa fa-comments-o text-behance"></i></button>'
                        );
                    },
                },
            ],
        });

        table2 = $("#data-comment").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            paging: false,
            info: false,
            lengthchange: false,
            ajax: {
                url: '{{url("$page/json/komentar/0")}}',
            },
            columns: [
                {
                    data: "content", render: function(data, type, row) {
                        return renderAsHtml(data);
                    }
                },
                {
                    data: "username",
                    className: "text-center", render: function(data, type, row) {
                        return renderAsHtml(data);
                    }
                },
            ],
        });

        table3 = $("#data-lampiran").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            paging: false,
            info: false,
            lengthchange: false,
            ajax: {
                url: '{{url("$lampiran/json/lampiran")}}',
            },
            columns: [
                {
                    data: "file_path", render: function(data, type, row) {
                        return '<a href="{{asset("uploads/file/")}}/'+data+'" target="_blank">'+data+'</a>';
                    }
                },
                {
                    data: "username",
                    className: "text-center", render: function(data, type, row) {
                        return renderAsHtml(data);
                    }
                },
            ],
        });
    });

    //Button Trigger
    $("body").on("click", ".btn-lampiran", function () {
        kosongkan();
        jQuery("#compose-form-lampiran").attr("action", "{{route($link_1)}}");
        jQuery("#compose-lampiran .modal-title").html("Upload File");
        jQuery("#compose-lampiran").modal("toggle");
    });

    $("body").on("click", ".btn-comment", function () {
        var id = jQuery(this).attr("data-id");
        $.ajax({
            url: "<?=url($page);?>/find/"+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData,function(index,row){
                    jQuery("#id_detail").val(row.id_detail);
                    jQuery("#compose .modal-title").html("Response of "+row.keterangan);
                    jQuery("#title-section").html(row.keterangan);
                })
            }
        });
        
        table2.ajax.url('{{url("$page/json/komentar/")}}/'+id).load();
        jQuery("#compose-form").attr("action", "{{route($link_2)}}");
        jQuery("#compose").modal("toggle");
    });

    $("body").on("click", ".btn-tambah", function () {
        jQuery("#compose-form").removeClass().addClass( "form-horizontal" );
        jQuery("#second-footer").removeClass().addClass( "modal-footer" );
        jQuery("#main-footer").removeClass().addClass( "modal-footer d-none" );
    })

    $("body").on("click", ".btn-batal", function () {
        jQuery("#compose-form").removeClass().addClass( "form-horizontal d-none" );
        jQuery("#main-footer").removeClass().addClass( "modal-footer" );
        jQuery("#second-footer").removeClass().addClass( "modal-footer d-none" );
    })
    
    $("body").on("click", ".btn-simpan", function () {
        Swal.fire("Data Disimpan!", "", "success");
        document.getElementById('compose-form').submit();
    });
    
    function kosongkan()
    {
        jQuery("#compose-form-lampiran input[name=judul]").val("");
        jQuery("#compose-form-lampiran input[name=upload]").val("");
    }
</script>
@endSection
