<!-- jQuery -->
<script src="../js/jquery-3.2.1.min.js"></script>

<script src="../js/moment.min.js"></script>

<!-- custom js styling -->
<script src="../js/custom/custom.js"></script>

<!-- js functions -->
<script src="../js/custom/js_function.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!--Bootstrap dateTimePicker -->
<script src="../js/datetimepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>

<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

<!-- DataTables JavaScript -->
<script src="../js/dataTables/jquery.dataTables.min.js"></script>
<script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#dataTables-example').DataTable();
       // $('.myTable').DataTable();
   } );
   // $('#loadContent').load("/pages/reports");
</script>


<script type="text/javascript">
	//$('#main_content_div').load('/pages/reports');projoStart
	$('#projoStart').datetimepicker();
	$('#employeeDOB').datetimepicker();
	$('#projoEnd').datetimepicker();
</script>
