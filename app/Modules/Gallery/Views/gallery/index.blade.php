
<?php
use App\Modules\User\Models\User;
  
?>


@extends('backend.layout.master')
      

            @section('body')
            
            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        {{$ModuleTitle}}
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.gallery.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.gallery.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        
        @if (Route::currentRouteName() != 'admin.gallery.inactive')
        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.gallery.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Gallery</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.gallery.index')
          <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.gallery.index')}} " class="btn btn-success waves-effect pull-right">Active Gallery</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.gallery.create')

        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.gallery.create')}} " class="btn btn-primary waves-effect pull-right">Add Gallery</a>
        @endif
        
      </ol>

      
    </section>
    <!-- Main content -->
    <section class="content">
       @include('backend.layout.msg')

      <div class="row">
        <div class="col-md-12">
            <div class="box-header">
              <h3 class="box-title">{{$pageTitle}}</h3>
            </div>
            <!-- /.box-header -->


              <div class="card card-primary">
              <div class="card-header">
                
              </div>
              <div class="card-body">
                <div class="row">
                  
                @if(count($data) > 0)
                @foreach($data as $values)
                  
                  <div class="col-md-3 text-center">
                    <h5 style="font-size: 18px;font-weight: bold;border-bottom: 1px solid;padding-bottom: 6px;">{{$values->title}}</h5>
                    <p>{{ $values->discription }}</p>

                    <a href="{{URL::to('')}}/uploads/gallery/{{$values->image_link}}" data-toggle="lightbox" data-title="{{$values->title}}" data-gallery="gallery">
                      <img style="width: 250px;height: 220px;" src="{{URL::to('')}}/uploads/gallery/{{$values->image_link}}" class="img-fluid mb-2 rounded img-thumbnail" alt="{{$values->title}}"/>
                    </a>
      <?php
        $name = User::where('id', $values->created_by)
                            ->select('name','image_link')
                            ->first();
      ?>
                    <p>{{$values->image_time}} - {{ $values->image_day}} - {{$values->image_date  }} By <img src="{{URL::to('')}}/uploads/member/{{$name->image_link}}" class="img-circle" style="width: 50px;height: 50px;" alt="User Image"><br>{{$name->name}}</p>

                    @if (isset($Cancel) && $Cancel == 'Cancel')
    <a title="ROLL BACK" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.gallery.rollback', $values->id) }}"  onclick="return confirm('Move to active gallery?')" ><i class="fa fa-repeat" aria-hidden="true"></i></a>

@if (Auth::user()->type == 'Admin')

<a title="PARMANENT DELETE" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.gallery.delete', $values->id) }}"  onclick="return confirm('Are you sure to parmanent delete?')" ><i class="fa fa-trash"></i></a>
@endif

@else

{{-- <a title="VIEW" style="border: 1px solid;padding: 2px 5px;" href="{{URL::to('')}}/uploads/gallery/{{$values->gallery_link}}" ><i class="fa fa-eye"></i></a> --}}

<a title="Download"  style="border: 1px solid;padding: 2px 5px;" href="{{URL::to('')}}/uploads/file/download.php?nama={{URL::to('')}}/uploads/gallery/{{$values->image_link}}" ><i class="fa fa-download"></i></a>

@if (Auth::user()->type == 'Admin' || $values->created_by == Auth::user()->id )

  <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.gallery.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>


  <a title="Inactive" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.gallery.destroy', $values->id) }}"  onclick="return confirm('Are you sure to Inactive?')" ><i class="fa fa-ban" aria-hidden="true"></i>
  </a>
@endif

@endif
                  </div>
                  
                @endforeach
                @endif
                </div>
              </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
            
    </section>
    <!-- /.content -->
  </div>
@endsection

           

