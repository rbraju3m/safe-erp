



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
        <li><a href="{{route('admin.member.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.member.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        
        @if (Route::currentRouteName() != 'admin.member.inactive')
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Member</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.member.index')
          <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.index')}} " class="btn btn-success waves-effect pull-right">Active Member</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.member.create')
        @if (Auth::user()->type == 'Admin')
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.create')}} " class="btn btn-primary waves-effect pull-right">Add Member</a>
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

          {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.member.update', $data->id],"class"=>"", 'id' => '']) !!}

      @include('User::user._form')

      {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box -->

      

      

    </section>
    <!-- /.content -->
  </div>

@endsection

           