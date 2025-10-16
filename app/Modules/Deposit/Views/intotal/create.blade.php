



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
        <li><a href="{{route('admin.deposit.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.deposit.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

        @if (Route::currentRouteName() != 'admin.deposit.inactive')
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposit.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive deposite</a>
        @endif

        @if (Route::currentRouteName() != 'admin.deposit.index')
          <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposit.index')}} " class="btn btn-success waves-effect pull-right">Active deposite</a>
        @endif

        @if (Route::currentRouteName() != 'admin.deposit.create')
        @if(Auth::user()->type == 'Admin')

        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposit.create')}} " class="btn btn-primary waves-effect pull-right">Add deposite</a>
        @endif
        @endif

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

    {!! Form::open(['route' => 'admin.deposit.store','enctype'=>'multipart/form-data',  'files'=> true, 'id'=>'depositeform', 'class' => '']) !!}

      @include('Deposit::deposit._form')

      {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box -->





    </section>
    <!-- /.content -->
  </div>

@endsection

