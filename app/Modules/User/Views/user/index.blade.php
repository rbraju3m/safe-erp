



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
        <li><a href="{{route('admin.member.index')}}">{{$ModuleTitle.' > '}}</a><a href="{{route('admin.member.create')}}">{{$pageTitle}}</a></li>
      </ol>

      <ol class="breadcrumb breadcrumbbutton">
        <a style="margin-left: 10px;font-weight: bold;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.index')}} " class="btn btn-danger waves-effect pull-right">Inactive Member</a>

        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.index')}} " class="btn btn-success waves-effect pull-right">Active Member</a>

        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.member.create')}} " class="btn btn-primary waves-effect pull-right">Add Member</a>

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
                  <th>Sl No</th>
                  <th style="background: rgb(126, 172, 206);">Name</th>
                  <th>Mobile</th>
                  <th> Member ID </th>
                  <th> National ID </th>
                  <th> Type</th>
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
                        <td>{{$values->name}}</td>
                        <td>{{ $values->mobile }}</td>
                        <td>
                        {{$values->member_id}}
                        </td>
                        <td>{{$values->national_id}}</td>
                        <td>
                          
                          @php
                            if ($values->type == 'Admin') {
                              $raju = 'btn-success';
                            }

                            if ($values->type == 'Chairman') {
                              $raju = 'btn-warning';
                            }

                            if ($values->type == 'General secretary') {
                              $raju = 'btn-primary';
                            }
                            if ($values->type == 'Member') {
                              $raju = 'btn-danger';
                            }
                          @endphp
                          
                          <span class="btn {{$raju}}">{{$values->type}}</span>
                          
                          
                        </td>
                        <td>
                        @if(!empty($values->image_link))
                        <img width="50" height="50" src="{{URL::to('')}}/uploads/member/{{$values->image_link}}">
                        @endif
                        </td>
                        <td>

                          <a title="VIEW" target="new" style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.member.show', $values->id) }}" ><i class="fa fa-eye"></i></a>
                          
                            @if (isset($Cancel) && $Cancel == 'Cancel')
                            <a title="ROLL BACK" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.member.rollback', $values->id) }}"  onclick="return confirm('Move to active member?')" ><i class="fa fa-repeat" aria-hidden="true"></i></a>

                            <a title="PARMANENT DELETE" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.member.edit', $values->id) }}"  onclick="return confirm('Are you sure to parmanent delete?')" ><i class="fa fa-trash"></i></a>
                            
                            @else
                              <a title="EDIT" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.member.edit', $values->id) }}" ><i class="fa fa-edit"></i></a>

                              <a title="CANCEL" target="new"  style="border: 1px solid;padding: 2px 5px;" href="{{ route('admin.member.destroy', $values->id) }}"  onclick="return confirm('Are you sure to Cancel?')" ><i class="fa fa-ban" aria-hidden="true"></i>
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

           

