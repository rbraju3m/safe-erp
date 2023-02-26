
<?php
use App\Modules\User\Models\User;

?>


@extends('backend.layout.master')


            @section('body')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        {{$ModuleTitle}}
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
{{--        <li><a href="{{route('admin.bank.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.bank.create')}}">{{$pageTitle}}</a></li>--}}
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

        {{--@if (Route::currentRouteName() != 'admin.bank.inactive')
        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.bank.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Bank Profit/Expense</a>
        @endif

        @if (Route::currentRouteName() != 'admin.bank.index')
          <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.bank.index')}} " class="btn btn-success waves-effect pull-right">Active Bank Profit/Expense</a>
        @endif

        @if (Route::currentRouteName() != 'admin.bank.create')
        @if(Auth::user()->type == 'Admin')

        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.bank.create')}} " class="btn btn-primary waves-effect pull-right">Add Bank Profit/Expense</a>
        @endif
        @endif--}}

      </ol>


    </section>
    <!-- Main content -->
    <section class="content">
       @include('backend.layout.msg')

      <div class="row">
        <div class="col-md-12">
                  <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$pageTitle}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>

                <tr>
                  <th>Sl No</th>
                  <th style="background: rgb(126, 172, 206);">Profit Year</th>
                  <th>Net Amount</th>
                  <th>Bank Profit</th>
                  <th>Bank expense</th>
                  <th> Other Expense</th>
                  <th> Net Profit</th>
                  <th> Profit Member</th>
                  <th>Added By</th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody >
                @if(count($data) > 0)
                       <?php
                       $total_rows = 1;
                       ?>
                       @foreach($data as $values)


                       <tr>
                        <td style="vertical-align: middle;"><?=$total_rows?></td>
                        <td style="vertical-align: middle;">{{ $values->profit_year }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->net_amount,2) }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->bank_profit,2) }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->bank_expense,2) }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->other_expense,2) }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->net_profit,2) }}</td>
                        <td style="vertical-align: middle;">{{ number_format($values->total_profit_member,2) }}</td>
                           <?php
                           $name = User::where('id', $values->created_by)
                               ->select('name','image_link')
                               ->first();
                           ?>
                           <td style="vertical-align: middle;"><img src="{{URL::to('')}}/uploads/member/{{$name->image_link}}" class="img-circle" style="width: 50px;
height: 50px;" alt="User Image"><br>{{$name->name}}</td>
                    </tr>
                       <tr>
                           @php
                                $memberProfitDetails = \App\Modules\Bank\Models\ProfitDistributeMember::where('profit_id',$values->id)->get();
                           @endphp
                           <table class="table">
                               <tr>
                                   <th colspan="2"></th>
                                   <th>Member</th>
                                   <th>Deposit</th>
                                   <th>Profit</th>
                               </tr>
                               @foreach($memberProfitDetails as $dis)
                                   <tr>
                                       <td colspan="2"></td>
                                       <td>{{$dis->member_id}}</td>
                                       <td>{{number_format($dis->deposit_amount,2)}}</td>
                                       <td>{{number_format($dis->profit_amount,2)}}</td>
                                   </tr>
                               @endforeach
                           </table>
                       </tr>
                    <?php
                    $total_rows++;
                    ?>
                    @endforeach
                    @endif
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->



          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
@endsection



