
<?php
use App\Modules\User\Models\User;
  
?>


@extends('backend.layout.master')
      

            @section('body')
            
            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1 style="border: 1px solid;padding: 7px 10px;background-color: #328588;color: #fff;width: 59%;text-transform: uppercase;font-weight: bold;">
        {{$ModuleTitle}}
      </h1>

      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.member.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.member.create')}}">{{$pageTitle}}</a></li>
      </ol> --}}

      <ol class="breadcrumb breadcrumbbutton">
        
        <?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


      <div class="form-group">

        {!! Form::Select('member_id',$member,Input::old('member_id'),['id'=>'member_id_for_search', 'class'=>'form-control select2']) !!}
        <span style="color: red">{!! $errors->first('member_id') !!}</span>
        <a class="raju" style="border: 1px solid;padding: 4px 18px;background-color: #140644;color: #fff;font-weight: bold;display: none;" >Search</a>
      </div>
        
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
              <table  id="example1" class="table table-bordered table-striped text-center">
                <thead>

                <tr>
                  <th>Sl No</th>
                  <th style="background: rgb(126, 172, 206);">Month-Year</th>
                  <th> Amount </th>
                  <th> Type </th>
                  <th> Note </th>
                  <th> Date </th>
                  <th> Received By</th>
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
  <td style="position: relative;">{{ $values->month }}-{{ $values->year }}</td>
  <td>{{ $values->amount }}</td>
  <td>{{ $values->type }}</td>
  <td>{{ $values->note }}</td>
  <td>{{ $values->payment_date }}</td>
  <?php
        $name = User::where('id', $values->created_by)
                        ->select('name','image_link')
                        ->first();
                          ?>
  <td>{{ $name->name }}</td>
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

