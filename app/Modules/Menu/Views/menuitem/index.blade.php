



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
        <a href=" {{route('admin.menuitem.create')}} " class="btn btn-primary waves-effect pull-right">Add menu item</a>
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
                  <th>Sorting Order</th>
                  <th style="background: rgb(126, 172, 206);"> Menu item</th>
                  <th> Category name</th>
                  <th>Action</th>
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
                        {{$values->name}}
                        </td>
                        <td>{{$values->title}}</td>


                        <td>
                        	<a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menuitem.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>

                              <a title="CANCEL" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menuitem.delete', $values->id) }}"  onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-trash" aria-hidden="true"></i></td>
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

           

