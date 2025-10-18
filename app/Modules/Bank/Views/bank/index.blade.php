@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.bank.index') }}">{{ $ModuleTitle.' > ' }}</a><a href="{{ route('admin.bank.create') }}">{{ $pageTitle }}</a></li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

                @if(Route::currentRouteName() != 'admin.bank.inactive')
                    <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.bank.inactive') }}" class="btn btn-danger waves-effect pull-right">Inactive Bank Profit/Expense</a>
                @endif

                @if(Route::currentRouteName() != 'admin.bank.index')
                    <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.bank.index') }}" class="btn btn-success waves-effect pull-right">Active Bank Profit/Expense</a>
                @endif

                @if(Route::currentRouteName() != 'admin.bank.create' && Auth::user()->type == 'Admin')
                    <a style="margin-left: 3px;font-weight: bold;" href="{{ route('admin.bank.create') }}" class="btn btn-primary waves-effect pull-right">Add Bank Profit/Expense</a>
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
                                    <th>Sl No</th>
                                    <th style="background: rgb(126, 172, 206);">Name</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Tr. Date</th>
                                    <th>Note</th>
                                    <th>Details</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $index => $values)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                        <td style="vertical-align: middle;">
                                            @if($values->image_link)
                                                <a target="_blank" href="{{ url('uploads/bank/'.$values->image_link) }}" class="btn btn-primary btn-sm font-10">
                                                    <img src="{{ url('uploads/bank/'.$values->image_link) }}" style="width: 50px; height: 50px;" alt="Bank Image">
                                                </a>
                                            @endif
                                            <br>{{ $values->name }}
                                        </td>
                                        <td style="vertical-align: middle;">{{ $values->type }}</td>
                                        <td style="vertical-align: middle;">{{ $values->amount }}</td>
                                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($values->ex_date)->format('d-M-Y') }}</td>
                                        <td style="vertical-align: middle;">{{ $values->note }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ \Carbon\Carbon::parse($values->ex_date)->format('h:i A') }}<br>
                                            {{ \Carbon\Carbon::parse($values->ex_date)->format('l, F') }}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if($values->user)
                                                <img src="{{ url('uploads/member/'.$values->user->image_link) }}" class="img-circle" style="width: 50px; height: 50px;" alt="User Image"><br>
                                                {{ $values->user->name }}
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if(isset($Cancel) && $Cancel == 'Cancel')
                                                <a title="ROLL BACK" href="{{ route('admin.bank.rollback', $values->id) }}" onclick="return confirm('Move to active bank?')" class="btn btn-sm btn-default"><i class="fa fa-repeat"></i></a>
                                                @if(Auth::user()->type == 'Admin')
                                                    <a title="PERMANENT DELETE" href="{{ route('admin.bank.delete', $values->id) }}" onclick="return confirm('Are you sure to permanently delete?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                @endif
                                            @else
                                                @if(Auth::user()->type == 'Admin')
                                                    <a title="EDIT" href="{{ route('admin.bank.edit', $values->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a title="Inactive" href="{{ route('admin.bank.destroy', $values->id) }}" onclick="return confirm('Are you sure to mark as inactive?')" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No records found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
