<script src="{{ asset('backend/js/bower/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/js/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/js/bower/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/js/dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/js/bower/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ asset('backend/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<!-- iCheck 1.0.1 -->
<script src="{{ asset('backend/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('backend/js/bower/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/js/bower/chart.js/Chart.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/js/dist/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/js/dist/js/demo.js') }}"></script>
<!-- Live search select -->
<script src="{{ asset('backend/js/bower/select2/dist/js/select2.full.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('backend/js/bower/ckeditor/ckeditor.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('backend/js/bower/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- select2 multiple option select -->
<script src="{{ asset('backend/js/bower/select2/dist/js/select2.full.min.js') }}"></script>


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
    });
  });


  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    // alert('raju');
    CKEDITOR.replace('description')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()

    CKEDITOR.replace('description_tr')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()


    CKEDITOR.replace('meta_description')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
  })
</script>
