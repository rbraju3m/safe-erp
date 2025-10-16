<?php
use App\Modules\User\Models\User;
?>

@extends('backend.layout.master')

@section('body')

    <div class="content-wrapper">
        <section class="content-header">

            <h1>
                {{$ModuleTitle}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>
                    <a href="{{ route('admin.deposit.index') }}">
                        {{$ModuleTitle.' > '}}
                    </a>
                    <a href="{{ route('admin.deposit.create') }}">
                        {{$pageTitle}}
                    </a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

                @if (Route::currentRouteName() != 'admin.deposit.inactive')
                    <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.deposit.inactive') }}" class="btn btn-danger waves-effect pull-right">Inactive Deposit</a>
                @endif

                @if (Route::currentRouteName() != 'admin.deposit.index')
                    <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.deposit.index') }}" class="btn btn-success waves-effect pull-right">Active Deposit</a>
                @endif

                @if (Route::currentRouteName() != 'admin.deposit.create')
                    @if(Auth::user()->type == 'Admin')
                        <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.deposit.create') }}" class="btn btn-primary waves-effect pull-right">Add Deposit</a>
                    @endif
                @endif
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
                                    <th style="background: rgb(126, 172, 206);">Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Month & Year</th>
                                    <th>Note</th>
                                    <th>Payment Details</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @php $total_rows = 1; @endphp
                                    @foreach($data as $values)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $total_rows }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ URL::to('uploads/member/'.$values->image_link) }}" class="img-circle" style="width:50px;height:50px;" alt="User Image"><br>
                                                {{ $values->name }}<br>{{ $values->mobile }}
                                            </td>
                                            <td style="vertical-align: middle;">{{ $values->amount }}</td>
                                            <td style="vertical-align: middle;">
                                                {{ $values->amount == 2100 ? 'Monthly With Due' : $values->type }}
                                            </td>
                                            <td style="vertical-align: middle;">{{ $values->month }}-{{ $values->year }}</td>
                                            <td style="vertical-align: middle;">{{ $values->note }}</td>
                                            <td style="vertical-align: middle;">
                                                {{ $values->payment_time }}<br>
                                                {{ $values->payment_day }}<br>
                                                {{ $values->payment_date }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ URL::to('uploads/member/'.$values->created_image_link) }}" class="img-circle" style="width:50px;height:50px;" alt="User Image"><br>
                                                {{ $values->created_name }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if (isset($Cancel) && $Cancel == 'Cancel')
                                                    <a title="ROLL BACK" href="{{ route('admin.deposit.rollback', $values->id) }}" style="border:1px solid;padding:2px 5px;" onclick="return confirm('Move to active deposit?')"><i class="fa fa-repeat"></i></a>

                                                    @if (Auth::user()->type == 'Admin')
                                                        <a title="PERMANENT DELETE" href="{{ route('admin.deposit.delete', $values->id) }}" style="border:1px solid;padding:2px 5px;" onclick="return confirm('Are you sure to permanently delete?')"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                @else
                                                    @if (Auth::user()->type == 'Admin')
                                                        <a title="EDIT" href="{{ route('admin.deposit.edit', $values->id) }}" style="border:1px solid;padding:2px 5px;"><i class="fa fa-edit"></i></a>
                                                        <a title="Inactive" href="{{ route('admin.deposit.destroy', $values->id) }}" style="border:1px solid;padding:2px 5px;" onclick="return confirm('Are you sure to Inactive?')"><i class="fa fa-ban"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @php $total_rows++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" style="background-color:#f2dede;color:#a94442;">No deposit data found!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
