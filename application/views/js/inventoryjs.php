<style>
#block1,#block2,#block3{
  margin-top: 5px;
}
</style>
  <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,"paging": true,
      "searching": false,
      "ordering": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $( "#from" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
      $( "#from" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
      $( "#to" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });

      var from_date= "<?php echo isset($_GET['from']) ?$_GET['from'] : "" ?>"
      var to_date= "<?php echo isset($_GET['to']) ?$_GET['to'] : "" ?>"

      $("#from").val(from_date);


    $('#search_by').change(function(sender,args){
      if(sender.target.value == "item"){
          $('.cbItem').css('display','inline');
          $('.txtPrice').css('display','none');
      }
      else{
          $('.cbItem').css('display','none');
          $('.txtPrice').css('display','inline');
      }
       
    });
      $( "#to" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
      $("#to").val(to_date);

    $('#example1_info').css('display','none');

      $('#search_by').val("<?php echo isset($_GET['search_by']) ?$_GET['search_by'] : "" ?>");
      $('#search_by').trigger("change");

    $('#param').val("<?php echo isset($_GET['param']) ?$_GET['param'] : "" ?>");
    $('#param2').val("<?php echo isset($_GET['param2']) ?$_GET['param2'] : "" ?>");

  });
</script>
