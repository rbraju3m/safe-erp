
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
        <li><a href="{{route('admin.deposite.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.deposite.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
        
        @if (Route::currentRouteName() != 'admin.deposite.inactive')
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.inactive')}} " class="btn btn-danger waves-effect pull-right">Inactive Deposite</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.deposite.index')
          <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.index')}} " class="btn btn-success waves-effect pull-right">Active Deposite</a>
        @endif
        
        @if (Route::currentRouteName() != 'admin.deposite.create')
        @if(Auth::user()->type == 'Admin')

        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.create')}} " class="btn btn-primary waves-effect pull-right">Add Deposite</a>
        @endif
        @endif
        
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
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>

                <tr>
                  <th>Sl No</th>
                  <th style="background: rgb(126, 172, 206);">Name</th>
                  <th>Amount</th>
                  <th>  Type </th>
                  <th>  Month & Year </th>
                  <th> Note</th>
                  <th>Payment Details</th>
                  <th>Added By</th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody >
                @if(count($data) > 0)
                       <?php
                       $total_rows = 1;
                       ?>
                       @foreach($data as $values)
                        

                       <tr>
                        <td style="vertical-align: middle;"><?=$total_rows?></td>
                        <td style="vertical-align: middle;"><img src="{{URL::to('')}}/uploads/member/{{$values->image_link}}" class="img-circle" style="width: 50px;
height: 50px;" alt="User Image"><br>{{$values->name}}<br>{{' 0'.$values->mobile  }}</td>
                        <td style="vertical-align: middle;">{{ $values->amount }}</td>
                        <td style="vertical-align: middle;">
                        {{$values->type}}
                        </td>
                        <td style="vertical-align: middle;">{{$values->month.'-'.$values->year}}</td>
                        <td style="vertical-align: middle;">{{$values->note}}</td>
                        <td style="vertical-align: middle;">{{$values->payment_time}}
                          <br>{{ $values->payment_day}}
                          <br>{{$values->payment_date  }}</td>
                          <?php
        $name = User::where('id', $values->created_by)
                        ->select('name','image_link')
                        ->first();
                          ?>
                        <td style="vertical-align: middle;"><img src="{{URL::to('')}}/uploads/member/{{$name->image_link}}" class="img-circle" style="width: 50px;
height: 50px;" alt="User Image"><br>{{$name->name}}</td>
                        
                        
                        <td style="vertical-align: middle;">

                          {{-- <a title="VIEW" target="new" style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.deposite.show', $values->id) }}" ><i class="fa fa-eye"></i></a> --}}
                          
                            @if (isset($Cancel) && $Cancel == 'Cancel')
                            <a title="ROLL BACK" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.deposite.rollback', $values->id) }}"  onclick="return confirm('Move to active deposite?')" ><i class="fa fa-repeat" aria-hidden="true"></i></a>
            

            @if (Auth::user()->type == 'Admin')

                            <a title="PARMANENT DELETE" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.deposite.delete', $values->id) }}"  onclick="return confirm('Are you sure to parmanent delete?')" ><i class="fa fa-trash"></i></a>
            @endif
                            
                            @else
            @if (Auth::user()->type == 'Admin')
                            
                              <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.deposite.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>

                              <a title="Inactive" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.deposite.destroy', $values->id) }}"  onclick="return confirm('Are you sure to Inactive?')" ><i class="fa fa-ban" aria-hidden="true"></i>
</a>
            @endif

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

           

