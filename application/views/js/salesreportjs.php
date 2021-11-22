<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- DataTables -->
<script src="<?php echo base_url() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>dist/js/jszip.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<!-- page script -->
<script>
$(function() {
    $('#salereporttable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'csv', {
                extend: 'print',
                title: '',
                messageTop: '<div class="col-sm-8">' +
                    '<h3 class="m-0 text-dark" style="text-align:right;">Kethmi Holding Hardware Stores</h3>' +
                    '<h5 class="m-0 text-dark" style="text-align:right;">Building No, Street Name, City, Street,Zip</h5>' +
                    '<h5 class="m-0 text-dark" style="text-align:right;">Contact No: 011 255 6666 / 077 5677 722</h5>' +
                    
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-4">' +
                    '</div>' +
                    '<div class="col-sm-4" style="text-align:center;">' +
                    '<h5>Sales Report</h5>' +
                    '</div>' +
                    '<div class="col-sm-4">' +
                    '</div>' +
                    '</div>'
            }
        ]
    });
});
</script>