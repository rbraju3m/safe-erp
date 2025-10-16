@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>
                    <a href="{{ route('admin.member.index') }}">{{ $ModuleTitle }} ></a>
                    <a href="{{ route('admin.member.create') }}">{{ $pageTitle }}</a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a href="javascript:history.back()" class="btn btn-warning pull-right" style="margin-left: 5px;font-weight: bold;">Back</a>

                @if (Route::currentRouteName() != 'admin.member.inactive')
                    <a href="{{ route('admin.member.inactive') }}" class="btn btn-danger pull-right" style="margin-left: 5px;font-weight: bold;">Inactive Member</a>
                @endif

                @if (Route::currentRouteName() != 'admin.member.index')
                    <a href="{{ route('admin.member.index') }}" class="btn btn-success pull-right" style="margin-left: 5px;font-weight: bold;">Active Member</a>
                @endif

                @if (Route::currentRouteName() != 'admin.member.create' && Auth::user()->type == 'Admin')
                    <a href="{{ route('admin.member.create') }}" class="btn btn-primary pull-right" style="margin-left: 5px;font-weight: bold;">Add Member</a>
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
                                    <th>ID</th>
                                    <th>Nominee</th>
                                    <th>Extra</th>
                                    <th>Details</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($data as $values)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a id="view_member_deposite" title="Member Total Deposite"
                                               data-href="{{ route('admin.member.show_deposit') }}"
                                               member_id="{{ $values->id }}">
                                                <img src="{{ asset('uploads/member/'.$values->image_link) }}" class="img-circle" style="width:50px;height:50px;cursor: pointer" alt="User Image"><br>
                                                {{ $values->name }}<br>{{ $values->mobile }}
                                            </a>
                                        </td>

                                        <td>{{ 'M-ID : '.$values->member_id }}<br>{{ 'N-ID : '.$values->national_id }}</td>
                                        <td>{{ $values->nominee }}<br>{{ 'N-ID : '.$values->nominee_n_id }}<br>{{ $values->nominee_mobile }}</td>
                                        <td>{{ $values->religion }}<br>{{ $values->gender }}</td>
                                        <td>{{ $values->join_time }}<br>{{ $values->join_day }}<br>{{ $values->join_date }}</td>

                                        <td>
                                            @php
                                                if ($values->type == 'Admin') {
                                                    $btnClass = 'btn-success';
                                                } elseif ($values->type == 'Chairman') {
                                                    $btnClass = 'btn-warning';
                                                } elseif ($values->type == 'General secretary') {
                                                    $btnClass = 'btn-primary';
                                                } else {
                                                    $btnClass = 'btn-danger';
                                                }
                                            @endphp

                                            <span class="btn {{ $btnClass }}">{{ $values->type }}</span>
                                        </td>

                                        <td style="vertical-align: middle; text-align: center;">

                                            <!-- View Member -->
                                            <a title="View Member"
                                               id="view_member"
                                               data-href="{{ route('admin.member.show', $values->id) }}"
                                               member-id="{{ $values->id }}"
                                               class="btn btn-info btn-sm"
                                               style="margin-bottom: 2px;">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            @if (isset($Cancel) && $Cancel == 'Cancel')
                                                <!-- Rollback -->
                                                <a href="{{ route('admin.member.rollback', $values->id) }}"
                                                   class="btn btn-warning btn-sm"
                                                   style="margin-bottom: 2px;"
                                                   onclick="return confirm('Move to active member?')">
                                                    <i class="fa fa-repeat"></i>
                                                </a>

                                                @if (Auth::user()->type == 'Admin')
                                                    <!-- Permanent Delete -->
                                                    <a href="{{ route('admin.member.delete', $values->id) }}"
                                                       class="btn btn-danger btn-sm"
                                                       style="margin-bottom: 2px;"
                                                       onclick="return confirm('Are you sure to permanently delete?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            @else
                                                @if ((Auth::user()->type == 'Admin') || (Auth::user()->user_id == $values->id))
                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.member.edit', $values->id) }}"
                                                       class="btn btn-primary btn-sm"
                                                       style="margin-bottom: 2px;">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif

                                                <a href="{{ route('admin.member.deposit_details', $values->id) }}"
                                                   class="btn btn-success btn-sm"
                                                   style="margin-bottom: 2px;">
                                                    <i class="fa fa-asterisk"></i>
                                                </a>

                                                <!-- Inactive -->
                                                <a href="{{ route('admin.member.destroy', $values->id) }}"
                                                   class="btn btn-secondary btn-sm"
                                                   style="margin-bottom: 2px;"
                                                   onclick="return confirm('Are you sure to Inactive?')">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No member found</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-weight: bold;">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-29px;color:#000;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
