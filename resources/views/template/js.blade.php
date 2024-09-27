
    
    
    <!-- Custom template | don't include it in your project! -->

 
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <!-- jQuery UI -->
  <script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
  <script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
  <!-- jQuery Toastr -->
  <script src="<?= asset('assets/js/toastr.js') ?>"></script>
  <!-- jQuery Scrollbar -->
  <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
  <!-- Datatables -->
  <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Atlantis JS -->
  <script src="{{asset('assets/js/atlantis.min.js')}}"></script>
  <!-- Atlantis DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/js/setting-demo2.js')}}"></script> 
  <!-- Calendar JS -->
  <script src="{{asset('assets/js/calendar/main.min.js')}}"></script>
  <script type="text/javascript">
    @if (session('message'))
        <?php switch (session('info')) {
            case "success":
                ?>
                toastr.success('<?= session('message') ?>');
            <?php break;
            case "info":
                ?>
                toastr.info('<?= session('message') ?>');
            <?php break;
            case "error": ?>
                toastr.error('<?= session('message') ?>');
            <?php break;
            default: ?>
                toastr.warning('<?= session('message') ?>');
        <?php }; ?>
    @endif
    $(document).ready(function() {
      

      $('#basic-datatables').DataTable({
      });

      $('#multi-filter-select').DataTable( {
        "pageLength": 5,
        initComplete: function () {
          this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
                );

              column
              .search( val ? '^'+val+'$' : '', true, false )
              .draw();
            } );

            column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
          } );
        }
      });

      // Add Row
      $('#add-row').DataTable({
        "pageLength": 5,
      });

      var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $('#addRowButton').click(function() {
        $('#add-row').dataTable().fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action
          ]);
        $('#addRowModal').modal('hide');

      });
    });
  </script>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Page level plugins -->
    <script src="{{asset('assets/js/chart.js/Chart.min.js')}}"></script>
    <!-- Money Format plugins -->
    <script src="{{asset('assets/js/dashboard-chart-area.js')}}"></script>
    <script>
        $(function () {
        $(".alert").fadeOut(3000);
        });
        $("body").on("click", ".btn-hapus", function() {
            var x = jQuery(this).attr("data-id");
            var y = jQuery(this).attr("data-handler");
            var xy = x + '-' + y;
            event.preventDefault()
            Swal.fire({
                title: 'Hapus Data ?',
                text: "Data yang dihapus tidak dapat dikembalikan !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Data Dihapus!',
                        '',
                        'success'
                    );
                    document.getElementById('delete-form-' + xy).submit();
                }
            });

        })
    </script>
  
