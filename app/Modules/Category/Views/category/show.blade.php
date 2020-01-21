



@extends('backend.layout.master')
@section('body')
            
            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        {{$ModuleTitle}}
        {{-- <small>Version 2.0</small> --}}
      </h1>
      

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">{{$ModuleTitle.' > '.$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        <a href=" {{route('admin.category.create')}} " class="btn btn-primary waves-effect pull-right">Add Category</a>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       @include('backend.layout.msg')

      <div class="row">
        <div class="col-md-12">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$pageTitle}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-striped table-responsive">
                <tr>
                        <th>Title</th>
                        <td>{{ $data->title}}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{$data->slug}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $data->description !!}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>{{$data->status}}</td>
                    </tr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{ $data->meta_title }}</td>
                    </tr>
                    <tr>
                        <th>Meta Keyword</th>
                        <td>{{ $data->meta_keywords }}</td>
                    </tr>
                    <tr>
                        <th>Meta Description</th>
                        <td>{{ $data->meta_description }}</td>
                    </tr>
                    


                    <tr>
                        <th>Image</th>
                        <td>
                            @if(!empty($data->image_link))
                            <a target="_blank" href="{{URL::to('')}}/uploads/category/{{$data->image_link}}">
                                <img width="50" height="50" src="{{URL::to('')}}/uploads/category/{{$data->image_link}}">            
                            </a>
                            @endif
                        </td>
                    </tr>

              </table>
            </div>
            <!-- /.box-body -->
        
           
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
            
    </section>
    <!-- /.content -->
  </div>
@endsection

           

