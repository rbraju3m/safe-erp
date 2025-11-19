{{--
@extends('backend.layout.master')


@section('body')

    <div class="content-wrapper">
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

        <section class="content">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
                    <div class="info-box">
                        <a href="{{route('admin.member.index')}}">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o" style="margin-top: 20px;"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 16px;font-weight: bold;font-family: initial;color: #000;border-bottom: 1px solid;">Total Member</span>
                                <span class="info-box-number" style="font-family: initial;color: #000">

                {{ $totalMember }}
              <small></small></span>
                            </div>
                        </a>
                    </div>
                </div>



                <div class="clearfix visible-sm-block"></div>


                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-money" style="margin-top: 20px;"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"
                                  style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Total Deposit</span>
                            <span class="info-box-number" style="font-family: initial;">{{ $totalDeposit }} Tk.</span>
                        </div>
                    </div>
                </div>



                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">

                    <div class="info-box">
                        <a href="{{route('admin.expense.index')}}">

                            <span class="info-box-icon bg-yellow"><i class="fa fa-minus-square"
                                                                     style="margin-top: 20px;"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"
                                      style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Total Expense</span>
                                <span class="info-box-number" style="font-family: initial;">
                {{ $totalExpense }} Tk.
              </span>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">

                    <div class="info-box">
                        <a href="{{route('admin.investment.index')}}">

                            <span class="info-box-icon bg-yellow"><i class="fa fa-minus-square"
                                                                     style="margin-top: 20px;"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"
                                      style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;">Total Investment</span>
                                <span class="info-box-number" style="font-family: initial;">
                {{ $totalInvestment }} Tk.
              </span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
                    <div class="info-box">
<span class="info-box-icon" style="height: 93px !important;background-color: #dd4b39 ;color: #fff">
<i class="fa fa-balance-scale" style="margin-top: 20px;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"
                                  style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;"> Total Cash </span>
                            <span class="info-box-number" style="font-family: initial;">
<table width="100%" style="margin-top: 5px;">
<tr>
<th> Deposit</th>
<th style="text-align: right !important;">{{$totalDeposit}}</th>
</tr>
<tr>
<th> Expense</th>
<th style="text-align: right !important;">(-) {{$totalExpense}}</th>
</tr>
<tr>
<th> Cash</th>
<th style="text-align: right !important;">{{$totalDeposit-$totalExpense}}</th>
</tr>
</table>
</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right: 0px">
                    <div class="info-box">
<span class="info-box-icon" style="height: 91px !important;background-color: #f39c12  ;color: #fff">
<i class="fa fa-university" style="margin-top: 20px;"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"
                                  style="font-size: 16px;font-weight: bold;font-family: initial;border-bottom: 1px solid;"> Total Pro/Exp (ok) </span>
                            <span class="info-box-number" style="font-family: initial;">
<table width="100%" style="margin-top: 5px;">
<tr>
<th> T.B. Profit</th>
<th style="text-align: right !important;">{{$totalBankProfit}}</th>
</tr>
<tr>
<th> T.B. Expense</th>
<th style="text-align: right !important;">{{$totalBankExpense}}</th>
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
<th style="text-align: right !important;">{{$totalDeposit-$totalExpense}}</th>
</tr>
<tr>
<th> T.B Profit</th>
<th style="text-align: right !important;">(+) {{$totalBankProfit}}</th>
</tr>
<tr>
<th> T.B Expense</th>
<th style="text-align: right !important;">(-) {{$totalBankExpense}}</th>
</tr>
<tr>
<th style="color: #0087ff;"> Net Cash</th>
<th style="text-align: right !important;color: #0087ff;">{{$totalDeposit-$totalExpense+$totalBankProfit-$totalBankExpense}}</th>
</tr>
</table>
</span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="member_section" style="">

                @foreach ($allMember as $element)

                        <?php
                        $id = $element->id;
                        if ($id % 2 == 0) {
                            $style = "box-shadow: 16px 23px 50px 8px #fff;border: 1px solid #bfbfbf;padding: 5px 5px;font-size: 16px;font-weight: bold;text-transform: uppercase;cursor: pointer;margin-left: 10px;margin-top: 16px;display: inline-block;background: #ececec;color: #000;";
                        } else {
                            $style = "box-shadow: 16px 23px 50px 8px #fff;border: 1px solid #bfbfbf;padding: 5px 5px;font-size: 16px;font-weight: bold;text-transform: uppercase;cursor: pointer;margin-left: 10px;margin-top: 16px;display: inline-block;background: #fff;color: #000;";
                        }
                        ?>

                    <a style="{{ $style }}" title="{{ $element->name }} Total Deposite" id="view_specific_member"
                       member_id="{{ $element->id }}" data-href="{{ route('admin.member.specificData') }}">
                        <img src="{{URL::to('')}}/uploads/member/{{$element->image_link}}" class="img-circle"
                             style="width: 50px;height: 50px;" alt="User Image">
                        {{ $element->name }}
                    </a>

                @endforeach

            </div>
        </section>
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
                <h4 class="modal-title small" style="font-size: 16px;font-weight: bold;text-align: center;">Large
                    Modal</h4>


                <button style="margin-top: -29px;
color: #000;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary">Save changes</button>
                --}}{{--

            </div>
        </div>
    </div>
</div>
--}}


@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                {{-- TOTAL MEMBERS --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{ route('admin.member.index') }}">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Members</span>
                                <span class="info-box-number">{{ $totalMember }}</span>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- TOTAL DEPOSIT --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{ route('admin.deposit.index') }}">
                            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Deposit</span>
                                <span class="info-box-number">{{ number_format($totalDeposit,2) }} Tk</span>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- TOTAL EXPENSE --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{ route('admin.expense.index') }}">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-minus-square"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Expense</span>
                                <span class="info-box-number">{{ number_format($totalExpense,2) }} Tk</span>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- TOTAL INVESTMENT --}}
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{ route('admin.investment.index') }}">
                            <span class="info-box-icon bg-red"><i class="fa fa-line-chart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Investment</span>
                                <span class="info-box-number">{{ number_format($totalInvestment,2) }} Tk</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            {{-- BANK PROFIT & EXPENSE --}}
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Summary</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>Bank Profit</th>
                                    <td>{{ number_format($totalBankProfit,2) }} Tk</td>
                                </tr>
                                <tr>
                                    <th>Bank Expense</th>
                                    <td>{{ number_format($totalBankExpense,2) }} Tk</td>
                                </tr>
                                <tr>
                                    <th>Net Cash</th>
                                    <td><strong>{{ number_format($totalDeposit - $totalExpense + $totalBankProfit - $totalBankExpense - $totalInvestment,2) }} Tk</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- QUICK ACTIONS --}}
                <div class="col-md-6 col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quick Actions</h3>
                        </div>
                        <div class="box-body text-center">
                            <a href="{{ route('admin.member.create') }}" class="btn btn-primary btn-sm">Add Member</a>
                            <a href="{{ route('admin.deposit.create') }}" class="btn btn-success btn-sm">Add Deposit</a>
                            <a href="{{ route('admin.expense.create') }}" class="btn btn-warning btn-sm">Add Expense</a>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-info btn-sm">Add Gallery</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MEMBER SECTION --}}
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Active Members</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        @forelse ($allMember as $member)
                            <div class="col-md-2 col-sm-3 col-xs-6 text-center" style="margin-bottom:15px;">
                                <a href="javascript:void(0)"
                                   class="view-member"
                                   member_id="{{ $member->id }}"
                                   data-href="{{ route('admin.member.specificData') }}"
                                   id="view_specific_member"
{{--                                   data-id="{{ $member->id }}"--}}
                                >
                                    <img src="{{ asset('uploads/member/'.$member->image_link) }}"
                                         onerror="this.src='{{ asset('uploads/member/default.png') }}'"
                                         class="img-circle"
                                         style="width:60px;height:60px;">
                                    <p style="margin-top:8px;font-weight:600;color:#333;">{{ $member->name }}</p>
                                </a>
                            </div>
                            {{--<a style="{{ $style }}" title="{{ $element->name }} Total Deposite" id="view_specific_member" member_id="{{ $element->id }}" data-href="{{ route('admin.member.specificData') }}"> <img src="{{URL::to('')}}/uploads/member/{{$element->image_link}}" class="img-circle" style="width: 50px;height: 50px;" alt="User Image"> {{ $element->name }} </a>--}}
                        @empty
                            <div class="col-md-12 text-center text-muted">No active members found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Member Modal --}}
    <div class="modal fade" id="memberModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-white">Member Details</h4>
                </div>
                <div class="modal-body text-center" id="memberModalBody">
                    <i class="fa fa-spinner fa-spin"></i> Loading...
                </div>
            </div>
        </div>
    </div>

@endsection

{{--@section('per_page_js')
    <script>
        $(document).ready(function () {
            $('.view-member').click(function () {
                let memberId = $(this).data('id');
                let url = $(this).data('href');

                $('#memberModal').modal('show');
                $('#memberModalBody').html('<i class="fa fa-spinner fa-spin"></i> Loading...');

                $.get(url, { member_id: memberId }, function (data) {
                    if (data.result === 'success') {
                        $('#memberModalBody').html(data.content);
                    } else {
                        $('#memberModalBody').html('<div class="alert alert-danger">No data found!</div>');
                    }
                }).fail(function () {
                    $('#memberModalBody').html('<div class="alert alert-danger">Error loading data.</div>');
                });
            });
        });
    </script>
@endsection--}}
