<?php
use App\Modules\User\Models\User;
use App\Modules\Deposit\Models\Deposit;
?>

@extends('backend.layout.master')

@section('body')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>
                    <a href="{{ route('admin.deposit.index') }}">{{ $ModuleTitle.' > ' }}</a>
                    <a href="{{ route('admin.deposit.create') }}">{{ $pageTitle }}</a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                @php
                    $next = $year + 1;
                    $previous = $year - 1;
                @endphp

                @if($next <= 2027)
                    <a style="margin-left:10px;font-weight:bold;" href="{{ route('admin.deposit.intotal', $next) }}" class="btn btn-danger pull-right">Next</a>
                @endif

                @if($previous >= 2019)
                    <a style="margin-left:10px;font-weight:bold;" href="{{ route('admin.deposit.intotal', $previous) }}" class="btn btn-success pull-right">Previous</a>
                @endif
            </ol>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ $pageTitle }}</h3>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Registration</th>
                                    @php
                                        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                                    @endphp
                                    @foreach($months as $month)
                                        <th @if($month == 'January') style="background: rgb(126, 172, 206);" @endif>{{ $month }}</th>
                                    @endforeach
                                    <th>Yearly</th>
                                    <th>Total</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($all_member as $member)
                                    @php
                                        $MemberTotal = 0;
                                        $deposits = $member->deposits ?? collect();
                                    @endphp

                                    <tr>
                                        <td>
                                            <img src="{{ URL::to('uploads/member/'.$member->image_link) }}" class="img-circle" style="width:50px;height:50px;" alt="User Image"><br>
                                            {{ $member->name }}<br>{{ '0'.$member->mobile }}
                                        </td>

                                        {{-- Registration --}}
                                        <td>
                                            @foreach($deposits as $deposit)
                                                @if($deposit->type == 'Registration' && $deposit->amount > 0)
                                                    {{ $deposit->amount }}
                                                    @php $MemberTotal += $deposit->amount; @endphp
                                                @endif
                                            @endforeach
                                        </td>

                                        {{-- Monthly Deposits --}}
                                        @foreach($months as $month)
                                            <td>
                                                @foreach($deposits as $deposit)
                                                    @if($deposit->month == $month && in_array($deposit->type,['Monthly','Monthly With Due']) && $deposit->amount > 0)
                                                        {{ $deposit->amount }}
                                                        @php $MemberTotal += $deposit->amount; @endphp
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach

                                        {{-- Yearly Deposit --}}
                                        <td>
                                            @foreach($deposits as $deposit)
                                                @if($deposit->type == 'Yearly' && $deposit->amount > 0)
                                                    {{ $deposit->amount }}
                                                    @php $MemberTotal += $deposit->amount; @endphp
                                                @endif
                                            @endforeach
                                        </td>

                                        {{-- Member Total --}}
                                        <td style="background:#04d0ff;font-weight:bold;">{{ $MemberTotal }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="15" style="font-weight:bold;text-align:center;">All Total</td>
                                    <td style="background:#db4444;color:#fff;font-weight:bold;font-size:18px;">{{ $Total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
