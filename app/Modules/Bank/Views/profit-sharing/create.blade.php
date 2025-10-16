
@extends('backend.layout.master')
 @section('body')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1 style="text-transform: uppercase;font-weight: bold;font-size: 18px;">

        {{$ModuleTitle}}
        {{-- <small>Preview</small> --}}
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{--<li><a href="{{route('admin.bank.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.bank.create')}}">{{$pageTitle}}</a></li>--}}
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 2px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

        {{--@if (Route::currentRouteName() != 'admin.bank.inactive')
        <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.bank.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Bank Profit / EX</a>
        @endif

        @if (Route::currentRouteName() != 'admin.bank.index')
          <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.bank.index')}} " class="btn btn-success waves-effect pull-right">Active Bank Profit / EX</a>
        @endif

        @if (Route::currentRouteName() != 'admin.bank.create')
        @if(Auth::user()->type == 'Admin')

        <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.bank.create')}} " class="btn btn-primary waves-effect pull-right">Add Bank Profit / EX</a>
        @endif
        @endif--}}

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       @include('backend.layout.msg')

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title" style="text-transform: uppercase;font-weight: bold;font-size: 18px;">{{$pageTitle}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

    {!! Form::open(['route' => 'profit_generate','enctype'=>'multipart/form-data',  'files'=> true]) !!}

        <div class="box-body">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
{{--                        <a data-href="{{route('get_year_wise_profit_expense')}}" id="get_year_wise_profit_expense"></a>--}}
                        {!! Form::label(' year', 'Select Year', array('class' => 'col-form-label')) !!}

                        <span style="color: red"> *</span>
                        <?php
                        $year = array();
                        $year['2022'] = '2022';
                        $year['2023'] = '2023';
                        $year['2024'] = '2024';
                        $year['2025'] = '2025';
                        ?>
                        {!! Form::Select('year',$year,$input?$input['year']:null,['class'=>'form-control select2','placeholder'=>'Choose Year','required'=>true]) !!}
                        <span style="color: red">{!! $errors->first('year') !!}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label(' Member', 'Member ( Choose if you want to skip this member )', array('class' => 'col-form-label')) !!}

                        {!! Form::Select('member_id[]',['Choose Member']+$activeMember,$input?$input['member_id']:null,['id'=>'member_id', 'class'=>'form-control select2',"multiple"=>"multiple"]) !!}
                        <span style="color: red">{!! $errors->first('member_id') !!}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    {!! Form::submit('Profit Generate', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                </div>
            </div>


        </div>

      {!! Form::close() !!}
        </div>
      </div>



           <div class="box box-default">
               <div class="box-header with-border">
                   <h3 class="box-title" style="text-transform: uppercase;font-weight: bold;font-size: 18px;">{{$pageTitle}}</h3>

                   <div class="box-tools pull-right">
                       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                   </div>
               </div>
               <!-- /.box-header -->
               <div class="box-body">

                   {!! Form::open(['route' => 'profit_generate_store','enctype'=>'multipart/form-data',  'files'=> true]) !!}

                   <div class="box-body">
                       <div class="row table-responsive">
                           <caption>Bank statement of year {{$input['year']}}</caption>
                           <table class="table table-bordered table-responsive table-striped text-center">
                               <tr>
                                   <th>Bank Profit</th>
                                   <th>Bank Expense</th>
                                   <th>Other Expense</th>
                                   <th>Net Profit</th>
                               </tr>
                               <tr>
                                   <td>{{number_format($totalBankProfit,2)}}
                                       <input type="hidden" name="profit_year" value="{{$input['year']}}">
                                       <input type="hidden" name="net_amount" value="{{$netAmount}}">
                                       <input type="hidden" name="bank_profit" value="{{$totalBankProfit}}">
                                   </td>
                                   <td>{{number_format($totalBankExpense,2)}}
                                       <input type="hidden" name="bank_expense" value="{{$totalBankExpense}}">
                                   </td>
                                   <td>{{number_format($otherExpense,2)}}
                                       <input type="hidden" name="other_expense" value="{{$otherExpense}}">
                                   </td>
                                   <td>{{number_format($totalBankProfit-($otherExpense+$totalBankExpense),2)}}
                                       <input type="hidden" name="net_profit" value="{{$totalBankProfit-($otherExpense+$totalBankExpense)}}">
                                       <input type="hidden" name="total_profit_member" value="{{count($profitMember)}}">
                                   </td>
                               </tr>
                           </table>
                            <table class="table-striped table table-bordered">
                                <tr>
                                    <th>SL</th>
                                    <th width="40%">Name</th>
                                    <th width="30%">Total Amount</th>
                                    <th width="30%">Profit</th>
                                </tr>
                                <?php $index = 1;$totalPersonProfit = 0;?>
                                @foreach($profitMember as $id => $member)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$member}}</td>
                                    @php
                                        #$memberTotalDipositAmount = DB::table('deposit')->where('member_id',$id)->sum('amount');
                                        $memberTotalDipositAmount = DB::table('deposit')->where('member_id',$id)->whereBetween('year', [2019, $input['year']])->sum('amount');
                                        $memberTotalDipositAmount = $memberTotalDipositAmount-100;

                                    @endphp
                                    <td class="text-right">
                                        {{number_format($memberTotalDipositAmount,2)}}
                                        <input type="hidden" name="member_id[]" value="{{$id}}">
                                        <input type="hidden" name="deposit_amount[]" value="{{$memberTotalDipositAmount}}">
                                    </td>
                                    @php
                                        $netProfit = $totalBankProfit-($otherExpense+$totalBankExpense);
                                        $personWiseProfit = ($netProfit*$memberTotalDipositAmount);
                                        $personWiseProfit = ($personWiseProfit/$netAmount);
                                        $totalPersonProfit = $totalPersonProfit + $personWiseProfit;
                                        /*dd($netProfit,$memberTotalDipositAmount,$netAmount);*/
                                    @endphp
                                    <td>
                                        {{number_format($personWiseProfit,2)}}
                                        <input type="hidden" name="profit_amount[]" value="{{$personWiseProfit}}">
                                    </td>
                                </tr>

                                    <?php $index++; ?>
                                @endforeach
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>{{number_format($totalPersonProfit,2)}}</th>
                                </tr>
                            </table>
                       </div>
                       <div class="row">
                           <div class="col-md-3">
                           </div>
                           <div class="col-md-3">
                           </div>
                           <div class="col-md-6">
                               {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                           </div>
                       </div>


                   </div>

                   {!! Form::close() !!}
               </div>
           </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('per_page_js')
    <script>
        $(document).delegate('#year','change',function () {
            var url = $("#get_year_wise_profit_expense").attr('data-href');
            var year = $(this).val();
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {year: year},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                alert(response.totalBankProfit)
                /*if(response.result == 'success'){
                    $('.modal-title').text(response.header);
                    $('.modal .modal-body').html(response.content);
                    $('.modal').modal('show');
                }else{
                    alert('Something went wrong');
                }*/
            }).fail(function( jqXHR, textStatus ) {

            });
        });

    </script>
@endpush
