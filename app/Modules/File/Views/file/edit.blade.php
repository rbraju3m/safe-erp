



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
        <li><a href="{{route('admin.file.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.file.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        
        @if (Route::currentRouteName() != 'admin.file.inactive')
        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.file.inactive')}} " class="btn btn-danger waves-effect pull-right inactive">Inactive File</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.file.index')
          <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.file.index')}} " class="btn btn-success waves-effect pull-right">Active File</a>
        @endif
        
        
        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.file.create')}} " class="btn btn-primary waves-effect pull-right">Add File</a>
        
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

          {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.file.update', $data->id],"class"=>"", 'id' => '']) !!}

      @include('File::file._form')

      {!! Form::close() !!}
        </div>
      </div>
      <!-- /.box -->

      

      

    </section>
    <!-- /.content -->
  </div>

@endsection

           