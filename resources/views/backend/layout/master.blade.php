<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SAFE | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  @include('backend.layout.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('backend.layout.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('backend.layout.nav')

  <!-- Content Wrapper. Contains page content -->
  
            @yield('body')

    

  @include('backend.layout.footer')

  <!-- Control Sidebar -->
  @include('backend.layout.control_setting')

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
@include('backend.layout.js')
</body>
</html>
