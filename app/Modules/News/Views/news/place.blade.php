
<?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
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
        <li><a href="#">{{$ModuleTitle.' > '.$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        <a style="margin-left: 10px;" href=" {{route('admin.news.create')}} " class="btn btn-success waves-effect pull-right">Add News</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','সম্পাদকের পছন্দ')}} " class="btn btn-primary waves-effect pull-right">সম্পাদকের পছন্দ <b style="color:black;">(9)</b></a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','অর্থনীতি')}} " class="btn btn-warning waves-effect pull-right">অর্থনীতি<b style="color:black;">(4)</b></a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','সারাদেশ')}} " class="btn btn-success waves-effect pull-right">সারাদেশ<b style="color:black;">(6)</b></a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','জনপ্রিয় সংবাদ')}} " class="btn btn-primary waves-effect pull-right">জনপ্রিয় সংবাদ<b style="color:black;">(4)</b></a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','শীর্ষ সংবাদ তালিকা')}} " class="btn btn-warning waves-effect pull-right">শীর্ষ সংবাদ তালিকা<b style="color:black;">(6)</b></a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','শীর্ষ সংবাদ')}} " class="btn btn-success waves-effect pull-right">শীর্ষ সংবাদ <b style="color:black;">(3)</b></a>
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
              {!! Form::open(['route' => 'admin.news.place.store','enctype'=>'multipart/form-data',  'files'=> true, 'id'=>'newsform', 'class' => '']) !!}


              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th style="background: rgb(126, 172, 206);"> Title </th>
                  <th>Short Order</th>
                  <th> News Link </th>
                  <th>Place</th>
                  <th> Action </th>
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
                        <td>{{$values->title}}</td>
                        <td>
                      
                      
                      @if (!empty($values->order))
                        <input type="text" class="form-control" placeholder="Enter Short Order" name="order[]" value="{{ $values->order }}">
                      @else
                      <input type="text" class="form-control" placeholder="Enter Short Order" name="order[]">
                      @endif

                      {{-- {!! Form::text('order[]',Input::old('order[]'),['id'=>'order[]','class' => 'form-control', 'placeholder'=>'Enter Short Order' ]) !!} --}}

              
<input type="hidden" name="id[]" value="{{$values->place_id}}">
                        </td>
                        <td>/frontend-singel-news/{{$values->id}}</td>
                        <td>{{$values->place}}</td>
                        
                        <td>

                          <a title="VIEW" target="new" style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.news.show', $values->id) }}" ><i class="fa fa-eye"></i></a>
                          
                            @if (isset($Cancel) && $Cancel == 'Cancel')
                            <a title="ROLL BACK" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.news.rollback', $values->id) }}"  onclick="return confirm('Move to active news?')" ><i class="fa fa-repeat" aria-hidden="true"></i></a>

                            <a title="PARMANENT DELETE" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.news.delete', $values->id) }}"  onclick="return confirm('Are you sure to parmanent delete?')" ><i class="fa fa-trash"></i></a>
                            
                            @else
                              <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.news.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>

                              <a title="CANCEL" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.news.destroy', $values->id) }}"  onclick="return confirm('Are you sure to Cancel?')" ><i class="fa fa-ban" aria-hidden="true"></i>
</a>
                            @endif


                          

                            

                            
                        </td>
                    </tr>
                    <?php
                    $total_rows++;
                    ?>
                    @endforeach
                    @endif

                    
                </tbody>

                <tr style="background: #f9f63e;">
                      <td colspan="6" >{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;</td>
                    </tr>
              </table>
      {!! Form::close() !!}

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

           

