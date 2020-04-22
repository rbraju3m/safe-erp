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
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="{{route('admin.member.index')}}">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">Total Member</span>
              <span class="info-box-number" style="font-family: initial;color: #000">
                
                {{ $member_count }}
              <small></small></span>
            </div>
          </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money" style="margin-top: 20px;"></i></span>
            <?php
              $total_deposite = 0;
              foreach ($deposite as $value) {
                $total_deposite = $value->amount+$total_deposite;
              }
            ?>
            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Deposite</span>
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
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Years</span>
              <span class="info-box-number" style="font-family: initial;">
                4
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">New Members</span>
              <span class="info-box-number" style="font-family: initial;">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    <div style="margin-top: 50px;border: 1px #fff;padding: 26px 10px;height: 100%;background-color: #ececec;">

    @foreach ($all_member as $element)
    
<a style="box-shadow: 16px 23px 50px 8px #fff;border: 1px solid #bfbfbf;padding: 5px 5px;font-size: 16px;font-weight: bold;text-transform: uppercase;background: #fff;color: #000;cursor: pointer;margin-left: 10px;

margin-top: 16px;

display: inline-block;" title="{{ $element->name }} Total Deposite" id="view_specific_member" member_id = "{{ $element->id }}" data-href="{{ route('admin.member.specificData') }}">
{{ $element->name }} 
</a>

                @endforeach

            </div>
    </section>
    <!-- /.content -->
  </div>

            @endsection

            <?php
              foreach ($member as $value) {
                $image_link = $value['image_link'];
              }
            ?>


           <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="font-size: 20px;font-weight: bold;text-align: center;">Large Modal</h4>
              <h4 class="modal-title small" style="font-size: 16px;font-weight: bold;text-align: center;">Large Modal</h4>
              
              
              <button style="margin-top: -29px;
color: #000;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->