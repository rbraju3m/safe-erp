



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

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','সম্পাদকের পছন্দ')}} " class="btn btn-primary waves-effect pull-right">সম্পাদকের পছন্দ</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','অর্থনীতি')}} " class="btn btn-warning waves-effect pull-right">অর্থনীতি</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','সারাদেশ')}} " class="btn btn-success waves-effect pull-right">সারাদেশ</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','জনপ্রিয় সংবাদ')}} " class="btn btn-primary waves-effect pull-right">জনপ্রিয় সংবাদ</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','শীর্ষ সংবাদ তালিকা')}} " class="btn btn-warning waves-effect pull-right">শীর্ষ সংবাদ তালিকা</a>

        <a style="margin-left: 10px;" href=" {{route('admin.news.place','শীর্ষ সংবাদ')}} " class="btn btn-success waves-effect pull-right">শীর্ষ সংবাদ</a>
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
                  <th>Category</th>
                  <th style="background: rgb(126, 172, 206);"> Title </th>
                  <th> News Link </th>
                  <th> Status</th>
                  <th> Image</th>
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
                        <td>{{$values->short_order}}</td>
                        <td>{{ $values->category_title }}</td>
                        <td>
                        {{$values->title}}
                        </td>
                        <td>/frontend-singel-news/{{$values->id}}</td>
                        <td>
                          
                          @php
                            if ($values->status == 'active') {
                              $raju = 'btn-success';
                            }

                            if ($values->status == 'cancel') {
                              $raju = 'btn-warning';
                            }

                            if ($values->status == 'inactive') {
                              $raju = 'btn-primary';
                            }
                          @endphp
                          
                          <span class="btn {{$raju}}">{{$values->status}}</span>
                          
                          
                        </td>
                        <td>
                        @if(!empty($values->image_link))
                        <img width="50" height="50" src="{{URL::to('')}}/uploads/news/{{$values->image_link}}">
                        @endif
                        </td>
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

           

