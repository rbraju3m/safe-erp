@extends('backend.layout.master')
@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1 style="text-transform: uppercase;font-weight: bold;font-size: 18px;">
                {{$ModuleTitle}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>
                    <a href="{{route('admin.member.index')}}">{{$ModuleTitle.' > '}}</a>
                    <a href="{{route('admin.member.create')}}">{{$pageTitle}}</a>
                </li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a style="margin-left: 4px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

                @if (Route::currentRouteName() != 'admin.member.inactive')
                    <a style="margin-left: 4px;font-weight: bold;" href="{{route('admin.member.inactive')}}" class="btn btn-danger waves-effect pull-right">Inactive Member</a>
                @endif

                @if (Route::currentRouteName() != 'admin.member.index')
                    <a style="margin-left: 4px;font-weight: bold;" href="{{route('admin.member.index')}}" class="btn btn-success waves-effect pull-right">Active Member</a>
                @endif

                @if (Route::currentRouteName() != 'admin.member.create')
                    <a style="margin-left: 4px;font-weight: bold;" href="{{route('admin.member.create')}}" class="btn btn-primary waves-effect pull-right">Add Member</a>
                @endif
            </ol>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title" style="text-transform: uppercase;font-weight: bold;font-size: 18px;">{{$pageTitle}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    {!! Form::open(['route' => 'admin.member.store','enctype'=>'multipart/form-data','files'=>true,'id'=>'memberform']) !!}
                    @include('User::user._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection
