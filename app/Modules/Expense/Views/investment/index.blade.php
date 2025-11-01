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
                    <a href="{{ route('admin.investment.index') }}">{{ $ModuleTitle }} ></a>
                    <a href="{{ route('admin.investment.create') }}">{{ $pageTitle }}</a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a href="javascript:history.back()" class="btn btn-warning waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Back</a>

                @if (Route::currentRouteName() != 'admin.investment.inactive')
                    <a href="{{ route('admin.investment.inactive') }}" class="btn btn-danger waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Inactive Investment</a>
                @endif

                @if (Route::currentRouteName() != 'admin.investment.index')
                    <a href="{{ route('admin.investment.index') }}" class="btn btn-success waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Active Investment</a>
                @endif

                @if (Route::currentRouteName() != 'admin.investment.create' && Auth::user()->type === 'Admin')
                    <a href="{{ route('admin.investment.create') }}" class="btn btn-primary waves-effect pull-right" style="margin-left: 3px; font-weight: bold;">Add Investment</a>
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
                                    <th>Project</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Date</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($data as $index => $values)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $values->project->name }}</td>
                                        <td>
                                            <a href="{{ asset('uploads/investment/' . $values->image) }}" target="_blank" class="btn btn-primary btn-sm font-10" style="margin-top: 5px;">
                                                <img src="{{ asset('uploads/investment/' . $values->image) }}" style="width: 50px; height: 50px;" alt="Investment Image">
                                            </a>
                                            <br>{{ $values->name }}
                                        </td>
                                        <td>{{ number_format($values->amount, 2) }}</td>
                                        <td>{{ $values->note }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($values->investment_date)->format('d-M-Y h:i:s A') }}
                                        </td>

                                        @php
                                            $user = User::find($values->created_by);
                                        @endphp
                                        <td>
                                            @if ($user)
                                                <img src="{{ asset('uploads/member/' . $user->image_link) }}" class="img-circle" style="width: 50px; height: 50px;" alt="User Image"><br>
                                                {{ $user->name }} <br>
                                                {{ \Carbon\Carbon::parse($values->created_at)->format('d-M-Y h:i:s A') }}
                                            @else
                                                <span class="text-danger"></span>
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($Cancel) && $Cancel === 'Cancel')
                                                <a title="ROLL BACK" href="{{ route('admin.investment.rollback', $values->id) }}" class="btn btn-sm btn-warning" onclick="return confirm('Move to active investment?')">
                                                    <i class="fa fa-repeat"></i>
                                                </a>

                                                @if (Auth::user()->type === 'Admin')
                                                    <a title="Permanent Delete" href="{{ route('admin.investment.delete', $values->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to permanently delete?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            @else
                                                @if (Auth::user()->type === 'Admin')
                                                    <a title="Edit" href="{{ route('admin.investment.edit', $values->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a title="Inactive" href="{{ route('admin.investment.destroy', $values->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to make inactive?')">
                                                        <i class="fa fa-ban"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">No investment records found!</td>
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
