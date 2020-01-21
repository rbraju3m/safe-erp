



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
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Short Order</th>
                  <th style="background: rgb(126, 172, 206);">Title</th>
                  <th> Slug </th>
                  <th> Status</th>
                  <th> Image</th>
                  <th> Action </th>
                  <th> Sub Category</th>
                </tr>
                </thead>
                <tbody>
                @if(count($data) > 0)
                       <?php
                       $total_rows = 1;
                       ?>
                       @foreach($data as $values)
                        

                       <tr>
                        <td><?=$total_rows?></td>
                        <td>{{$values->short_order}}</td>
                        <td>
                        {{$values->title}}
                        ({{count($values->relCategoryChild)}})
                        </td>
                        <td>{{$values->slug}}</td>
                        <td>{{$values->status}}</td>
                        <td>
                        @if(!empty($values->image_link))
                        <img width="50" height="50" src="{{URL::to('')}}/uploads/category/{{$values->image_link}}">
                        @endif
                        </td>
                        <td>
                            <a title="VIEW" target="new" style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.category.show', $values->id) }}" ><i class="fa fa-eye"></i></a>
                            <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.category.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>
                            <a title="DELETE"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.category.destroy', $values->id) }}"  onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash"></i></a>
                        </td>
                        <td>
                        @if(count($values->relCategoryChild) > 0)
                        <a href="{{ route('admin.sub.category', $values->id) }}">More Category( {{count($values->relCategoryChild)}} )</a>
                        @endif
                        </td>
                    </tr>
                    <?php
                    $total_rows++;
                    ?>
                    @endforeach
                    @endif
                </tbody>
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

           

