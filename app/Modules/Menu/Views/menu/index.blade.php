



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
        <a href=" {{route('admin.menu.create')}} " class="btn btn-primary waves-effect pull-right">Add menu</a>
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
                  <th style="background: rgb(126, 172, 206);"> Title</th>
                  <th> Status</th>
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
                        <td>
                        {{$values->menu_key}}
                        </td>
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
                          
                            @if (isset($Cancel) && $Cancel == 'Cancel')
                            <a title="ROLL BACK" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menu.rollback', $values->id) }}"  onclick="return confirm('Move to active menu?')" ><i class="fa fa-repeat" aria-hidden="true"></i></a>

                            <a title="PARMANENT DELETE" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menu.delete', $values->id) }}"  onclick="return confirm('Are you sure to parmanent delete?')" ><i class="fa fa-trash"></i></a>
                            
                            @else
                              <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menu.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>

                              <a title="CANCEL" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.menu.cancel', $values->id) }}"  onclick="return confirm('Are you sure to Cancel?')" ><i class="fa fa-ban" aria-hidden="true"></i>
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

           

