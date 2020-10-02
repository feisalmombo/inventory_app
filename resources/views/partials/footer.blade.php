<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0.0
	</div>
	<strong style="text-align: center;">Copyright &copy; {{ date('Y') }} Inventory Management System at <a href="http://umojaswitch.co.tz/"  target="_blank" style="text-decoration: none;">UmojaSwitch</a>.</strong> All Rights Reserved.
</footer>


<!-- jQuery 3 -->
<script src="{{ URL::asset('temp/bower_components/jquery/dist/jquery.min.js') }}"></script>


<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('temp/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

<!--JQueryFile -->
<script src="{{ URL::asset('js/jQueryFile.js') }}" type="text/javascript"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
-->

<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('temp/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- DataTables -->
<script src="{{URL::asset('temp/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('temp/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- Morris.js charts -->
<script src="{{URL::asset('temp/bower_components/raphael/raphael.min.js')}}"></script>
<!--<script src="{{--URL::asset('temp/bower_components/morris.js/morris.min.js')--}}"></script> -->

<!-- Sparkline -->
<script src="{{URL::asset('temp/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>

<!-- jvectormap -->
<script src="{{URL::asset('temp/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>

<script src="{{URL::asset('temp/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{URL::asset('temp/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{URL::asset('temp/bower_components/moment/min/moment.min.js')}}"></script>

<script src="{{URL::asset('temp/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- datepicker -->
<script src="{{URL::asset('temp/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::asset('temp/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->

<script src="{{URL::asset('temp/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- FastClick -->
<script src="{{URL::asset('temp/bower_components/fastclick/lib/fastclick.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{URL::asset('temp/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('temp/dist/js/pages/dashboard.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('temp/dist/js/demo.js')}}"></script>

<!-- DataTable script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });

</script>

</body>
</html>
