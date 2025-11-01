<?php
use App\Modules\User\Models\User;
?>

@extends('backend.layout.master')

@section('body')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>
                    <a href="{{ route('admin.expense.index') }}">{{ $ModuleTitle }} ></a>
                    <a href="{{ route('admin.expense.create') }}">{{ $pageTitle }}</a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a href="javascript:history.back()" class="btn btn-warning waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Back</a>

                @if (Route::currentRouteName() != 'admin.expense.inactive')
                    <a href="{{ route('admin.expense.inactive') }}" class="btn btn-danger waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Inactive Expense</a>
                @endif

                @if (Route::currentRouteName() != 'admin.expense.index')
                    <a href="{{ route('admin.expense.index') }}" class="btn btn-success waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Active Expense</a>
                @endif

                @if (Route::currentRouteName() != 'admin.expense.create' && Auth::user()->type === 'Admin')
                    <a href="{{ route('admin.expense.create') }}" class="btn btn-primary waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Add Expense</a>
                @endif
            </ol>
        </section>

        <section class="content" style="margin-top: 50px">
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
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Expense Details</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($data as $index => $values)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ asset('uploads/expense/' . $values->image_link) }}" target="_blank" class="btn btn-primary btn-sm font-10" style="margin-top: 5px;">
                                                <img src="{{ asset('uploads/expense/' . $values->image_link) }}" style="width: 50px; height: 50px;" alt="Expense Image">
                                            </a>
                                            <br>{{ $values->name }}
                                        </td>
                                        <td>{{ number_format($values->amount, 2) }}</td>
                                        <td>{{ $values->note }}</td>
                                        <td>
                                            {{ $values->expense_time }}<br>
                                            {{ $values->expense_day }}<br>
                                            {{ $values->expense_date }}
                                        </td>

                                        @php
                                            $user = User::find($values->created_by);
                                        @endphp
                                        <td>
                                            @if ($user)
                                                <img src="{{ asset('uploads/member/' . $user->image_link) }}" class="img-circle" style="width: 50px; height: 50px;" alt="User Image"><br>
                                                {{ $user->name }}
                                            @else
                                                <span class="text-danger">User Deleted</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($Cancel) && $Cancel === 'Cancel')
                                                <a title="ROLL BACK" href="{{ route('admin.expense.rollback', $values->id) }}" class="btn btn-sm btn-warning" onclick="return confirm('Move to active expense?')">
                                                    <i class="fa fa-repeat"></i>
                                                </a>

                                                @if (Auth::user()->type === 'Admin')
                                                    <a title="Permanent Delete" href="{{ route('admin.expense.delete', $values->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to permanently delete?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            @else
                                                @if (Auth::user()->type === 'Admin')
                                                    <a title="Edit" href="{{ route('admin.expense.edit', $values->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a title="Inactive" href="{{ route('admin.expense.destroy', $values->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to make inactive?')">
                                                        <i class="fa fa-ban"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">No expense records found!</td>
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
