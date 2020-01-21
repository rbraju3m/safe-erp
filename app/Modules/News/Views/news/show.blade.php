



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
        <a href=" {{route('admin.news.create')}} " class="btn btn-primary waves-effect pull-right">Add News</a>
      </ol>

      
    </section>

    <!-- Main content -->
    <section class="content">
       @include('backend.layout.msg')

      <div class="row">
        <div class="col-md-12">
                  <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$data->cat_title .' '.$pageTitle}}</h3>

            <p>
                    @if (isset($news_tags))
                      @foreach ($news_tags as $news_tag)
                        <span><button class="btn btn-primary">{{$news_tag->title}}</button></span>
                      @endforeach
                    @endif
                </p>
              <hr style="margin-bottom: 0px !important">
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

              <div class="box-body">
                  
                <strong>{{$data->title}}</strong>
                
                <?php
                  echo $data->discription
                ?>
                @if(!empty($data->image_link))
                            
                <img class="news_img" src="{{URL::to('')}}/uploads/news/{{$data->image_link}}" alt="">

                            @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                Footer
              </div>
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

           

