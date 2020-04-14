@extends('backend.layout.master')
      

            @section('body')
            
            
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{route('admin.member.index')}}">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;color: #000">Total Member</span>
              <span class="info-box-number" style="font-family: initial;color: #000">{{ $member_count }}<small></small></span>
            </div>
          </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
            <?php
              $total_deposite = 0;
              foreach ($deposite as $value) {
                $total_deposite = $value->amount+$total_deposite;
              }
            ?>
            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;">Deposite</span>
              <span class="info-box-number" style="font-family: initial;">{{ $total_deposite }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;">Years</span>
              <span class="info-box-number" style="font-family: initial;">1</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;">New Members</span>
              <span class="info-box-number" style="font-family: initial;">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


            
    </section>
    <!-- /.content -->
  </div>

            @endsection
           