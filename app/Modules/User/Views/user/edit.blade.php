@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.member.index') }}">Member Information</a></li>
                <li class="active">{{ isset($data) ? 'Edit Member' : 'Add Member' }}</li>
            </ol>

            <div class="breadcrumb breadcrumbbutton">
                <a href="javascript:history.back()" class="btn btn-warning pull-right" style="margin-left:10px;">Back</a>

                @if(Route::currentRouteName() != 'admin.member.inactive')
                    <a href="{{ route('admin.member.inactive') }}" class="btn btn-danger pull-right">Inactive Member</a>
                @endif

                @if(Route::currentRouteName() != 'admin.member.index')
                    <a href="{{ route('admin.member.index') }}" class="btn btn-success pull-right">Active Member</a>
                @endif

                @if(Route::currentRouteName() != 'admin.member.create' && Auth::user()->type == 'Admin')
                    <a href="{{ route('admin.member.create') }}" class="btn btn-primary pull-right">Add Member</a>
                @endif
            </div>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $pageTitle }}</h3>
                </div>
                <div class="box-body">
                    @if(isset($data))
                        {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.member.update', $data->id]]) !!}
                    @else
                        {!! Form::open(['method' => 'POST', 'files'=> true, 'route'=> ['admin.member.store']]) !!}
                    @endif

                    @include('User::user._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection
