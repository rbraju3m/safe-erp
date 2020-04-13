



@extends('backend.layout.master')
 @section('body')
            
            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>

        {{$ModuleTitle}}
        {{-- <small>Preview</small> --}}
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.deposite.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.deposite.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        
        @if (Route::currentRouteName() != 'admin.deposite.inactive')
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Deposite</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.deposite.index')
          <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.index')}} " class="btn btn-success waves-effect pull-right">Active Deposite</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.deposite.create')
        @if(Auth::user()->type == 'Admin')
        
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.create')}} " class="btn btn-primary waves-effect pull-right">Add Deposite</a>
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
          <h3 class="box-title">{{$pageTitle}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.deposite.update', $data->id],"class"=>"", 'id' => '']) !!}

      @include('Deposite::deposite._form')

      {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box -->

      

      

    </section>
    <!-- /.content -->
  </div>

@endsection

           