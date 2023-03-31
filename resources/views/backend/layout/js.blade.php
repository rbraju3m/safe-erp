
<script src="{{ asset('backend/js/bower/jquery/dist/jquery.min.js') }}"></script>
{{-- <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> --}}
{{-- <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> --}}

{{-- <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script> --}}
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
{{--<script src="{{ asset('backend/js/dist/js/pages/dashboard2.js') }}"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/js/dist/js/demo.js') }}"></script>
<!-- Live search select -->
<script src="{{ asset('backend/js/bower/select2/dist/js/select2.full.min.js') }}"></script>
<!-- CK Editor -->
{{--<script src="{{ asset('backend/js/bower/ckeditor/ckeditor.js') }}"></script>--}}

<!-- Ekko Lightbox -->
<script src="{{ asset('backend/css/bower/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('backend/js/bower/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('backend/js/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- select2 multiple option select -->
<script src="{{ asset('backend/js/bower/select2/dist/js/select2.full.min.js') }}"></script>




<script>



    $(window).on('load', function () {
        var route = window.location.pathname;

        if( route == "/admin-dashboard"){
            Swal.fire(
              'When You Leave This Site \n Please Logout ',
              '',
              'success'
            )
        }
    });




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

    // for gallery
    $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })


  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    // alert('raju');
    // CKEDITOR.replace('description')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()

    // CKEDITOR.replace('description_tr')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()


    // CKEDITOR.replace('meta_description')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

  })

  //Presernt address as parmanent address
  $(document).delegate('.Paramanent_Address','click',function () {
    var value = $('.Paramanent_Address_check:checked').val();
    // alert(value);
    if(value == 'on'){
      // alert('check ase');
      var present_address = $('.present_address').val();
      // alert(present_address);
      $('#Paramanent_Address').text(present_address);
    }else{
      $('#Paramanent_Address').text('');
    }
  })

  //for view model open with data
    $(document).delegate('#view_member','click',function () {
        var url = $(this).attr('data-href');
        // var member_id = '';

        // alert(member_id);
        // exit();
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            // data: {member_id: member_id},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
          // alert(response)
            if(response.result == 'success'){
                $('.modal-title').text(response.header);
                $('.modal .modal-body').html(response.content);
                $('.modal').modal('show');
            }else{
                alert('Something went wrong');
            }
        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });



    //for view model open with data
    $(document).delegate('#view_member_deposite','click',function () {
        var url = $(this).attr('data-href');
        var member_id = $(this).attr('member_id');

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: {member_id: member_id},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
          // alert(response)
            if(response.result == 'success'){
                $('.modal-title').text(response.header);
                $('.modal .modal-body').html(response.content);
                $('.modal').modal('show');
            }else{
                alert('Something went wrong');
            }
        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });

    //for search deposite specific member data
    $(document).delegate('#member_id_for_search','change',function () {
        var id = $(this).val();
        var location = window.location.origin;
        var route = location+'/admin-member-depositeDetails/'+id;
        $(".raju").attr("href",route);
        $(".raju").attr("style","border: 1px solid;padding: 4px 18px;background-color: #140644;color: #fff;font-weight: bold;");
    });

    //for view specific model open with data
    $(document).delegate('#view_specific_member','click',function () {
        var url = $(this).attr('data-href');
        var member_id = $(this).attr('member_id');

        // alert(url+'--'+member_id);
        // exit();

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: {member_id: member_id},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
          // alert(response)
            if(response.result == 'success'){
                $('.modal-title').text(response.header);
                $('.modal-title.small').text(response.headerSmall);
                $('.modal .modal-body').html(response.content);
                $('.modal').modal('show');
            }else{
                alert('Something went wrong');
            }
        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });


    $(document).delegate('#profit-details','click',function () {
        var url = $('#profit-details-route').attr('data-href');
        var profit_id = $(this).attr('profit-id');

        // alert(url+'--'+member_id);
        // exit();

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: {profit_id: profit_id},
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
          // alert(response)
            if(response.result == 'success'){
                $('.modal-title').text(response.header);
                $('.modal-title.small').text(response.headerSmall);
                $('.modal .modal-body').html(response.content);
                $('.modal').modal('show');
            }else{
                alert('Something went wrong');
            }
        }).fail(function( jqXHR, textStatus ) {

        });
        return false;
    });


</script>
