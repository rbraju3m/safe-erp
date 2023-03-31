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
        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
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
        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">{{ date("F") }} Deposite</span>
              <span class="info-box-number" style="font-family: initial;">
                {{ $current_total }} Tk.
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-cubes" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">{{ date("F") }} Due</span>
              <span class="info-box-number" style="font-family: initial;">{{ $member_count*2000-$current_total }} Tk.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-balance-scale" style="margin-top: 20px;"></i></span>
            <?php
              $total_deposite = 0;
              foreach ($deposite as $value) {
                $total_deposite = $value->amount+$total_deposite;
              }
            ?>
            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Total Deposite</span>
              <span class="info-box-number" style="font-family: initial;">{{ $total_deposite }} Tk.</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-minus-square" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">{{date('F',strtotime("-1 month"))}} Expense</span>
              <span class="info-box-number" style="font-family: initial;color: #000">

                {{ $previous_expense_total }} TK.
              <small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-minus-square" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">{{date('F')}} Expense</span>
              <span class="info-box-number" style="font-family: initial;color: #000">

                {{ $current_expense_total }} TK.
              <small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">

          <div class="info-box">
            <a href="{{route('admin.expense.index')}}">

            <span class="info-box-icon bg-yellow"><i class="fa fa-minus-square" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Total Expense</span>
              <span class="info-box-number" style="font-family: initial;">
                {{ $total_expense }} Tk.
              </span>
            </div>
            <!-- /.info-box-content -->
          </a>
          </div>
          <!-- /.info-box -->
        </div>

<div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
<div class="info-box">
<span class="info-box-icon" style="height: 93px !important;background-color: #dd4b39 ;color: #fff">
<i class="fa fa-balance-scale" style="margin-top: 20px;"></i></span>
<div class="info-box-content">
<span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;"> Total Cash </span>
<span class="info-box-number" style="font-family: initial;">
<table width="100%" style="margin-top: 5px;">
<tr>
<th> Deposite</th>
<th style="text-align: right !important;">{{$total_deposite}}</th>
</tr>
<tr>
<th> Expense</th>
<th style="text-align: right !important;">(-) {{$total_expense}}</th>
</tr>
<tr>
<th> Cash</th>
<th style="text-align: right !important;">{{$total_deposite-$total_expense}}</th>
</tr>
</table>
</span>
</div>
</div>
</div>



<div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-plus-square" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 15px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">{{date('F',strtotime("-1 month"))}} Bank Profit</span>
              <span class="info-box-number" style="font-family: initial;color: #000">

                {{ $current_bank_profit }} TK.
              <small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-minus-square" style="margin-top: 20px;"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" style="font-size: 14px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">{{date('F')}} Bank Expense</span>
              <span class="info-box-number" style="font-family: initial;color: #000">

                {{ $current_bank_expense }} TK.
              <small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


<div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
<div class="info-box">
<span class="info-box-icon" style="height: 91px !important;background-color: #f39c12  ;color: #fff">
<i class="fa fa-university" style="margin-top: 20px;"></i></span>
<div class="info-box-content">
<span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;"> Total Pro/Exp </span>
<span class="info-box-number" style="font-family: initial;">
<table width="100%" style="margin-top: 5px;">
<tr>
<th> T.B. Profit</th>
<th style="text-align: right !important;">{{$total_bank_profit}}</th>
</tr>
<tr>
<th> T.B. Expense</th>
<th style="text-align: right !important;">{{$total_bank_expense}}</th>
</tr>

</table>
</span>
</div>
</div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
<div class="info-box">
<span class="info-box-icon" style="height: 93px !important;background-color: #dd4b39 ;color: #fff">
<i class="fa fa-balance-scale" style="margin-top: 20px;"></i></span>
<div class="info-box-content">
<!-- <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;"> Total Cash </span> -->
<span class="info-box-number" style="font-family: initial;">
<table width="100%" style="margin-top: 5px;">
  <tr>
<th> Pre Cash</th>
<th style="text-align: right !important;">{{$total_deposite-$total_expense}}</th>
</tr>
<tr>
<th> T.B Profit</th>
<th style="text-align: right !important;">(+) {{$total_bank_profit}}</th>
</tr>
<tr>
<th> T.B Expense</th>
<th style="text-align: right !important;">(-) {{$total_bank_expense}}</th>
</tr>
<tr>
<th style="color: #0087ff;"> Net Cash</th>
<th style="text-align: right !important;color: #0087ff;">{{$total_deposite-$total_expense+$total_bank_profit-$total_bank_expense}}</th>
</tr>
</table>
</span>
</div>
</div>
</div>



        <!-- /.col -->
      </div>
      <!-- /.row -->
{{-- background: #fff;color: #000; --}}
    <div class="member_section" style="">

    @foreach ($all_member as $element)

    <?php
      $id = $element->id;
      if( $id%2 == 0){
        $style = "box-shadow: 16px 23px 50px 8px #fff;border: 1px solid #bfbfbf;padding: 5px 5px;font-size: 16px;font-weight: bold;text-transform: uppercase;cursor: pointer;margin-left: 10px;margin-top: 16px;display: inline-block;background: #ececec;color: #000;";
      }else{
        $style = "box-shadow: 16px 23px 50px 8px #fff;border: 1px solid #bfbfbf;padding: 5px 5px;font-size: 16px;font-weight: bold;text-transform: uppercase;cursor: pointer;margin-left: 10px;margin-top: 16px;display: inline-block;background: #fff;color: #000;";
      }
    ?>

<a style="{{ $style }}" title="{{ $element->name }} Total Deposite" id="view_specific_member" member_id = "{{ $element->id }}" data-href="{{ route('admin.member.specificData') }}">
<img src="{{URL::to('')}}/uploads/member/{{$element->image_link}}" class="img-circle" style="width: 50px;height: 50px;" alt="User Image">
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
