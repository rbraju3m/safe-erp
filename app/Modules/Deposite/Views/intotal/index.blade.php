
<?php
use App\Modules\User\Models\User;
use App\Modules\Deposite\Models\Deposite;

  
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
        <?php
          $next = $year+1;
          $previous = $year-1;
        ?>
        
        <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.intotal',$next)}} " class="btn btn-danger waves-effect pull-right">Next</a>
       
        
        
          <a style="margin-left: 10px;font-weight: bold;" href=" {{route('admin.deposite.intotal',$previous)}} " class="btn btn-success waves-effect pull-right">Previous</a>
        
        
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
                  <th></th>
                  <th>Registration</th>
                  <th style="background: rgb(126, 172, 206);">January</th>
                  <th>February</th>
                  <th>March</th>
                  <th>April</th>
                  <th>May</th>
                  <th>June</th>
                  <th>July</th>
                  <th>August</th>
                  <th>September</th>
                  <th>October</th>
                  <th>November</th>
                  <th>December</th>
                  <th>Yearly</th>
                  <th>Total</th>
                </tr>
                </thead>
                  @if(count($all_member) > 0)
                  
                  @foreach($all_member as $values)
                  <tr>
                    <td>
                      <img src="{{URL::to('')}}/uploads/member/{{$values->image_link}}" class="img-circle" style="width: 50px;height: 50px;" alt="User Image"><br>{{$values->name}}<br>{{' 0'.$values->mobile  }}
                    </td>

                    <?php
                      $id = $values->id;

                      // Get payment  data
                      $MemberData = Deposite::where('status','active')
                              ->where('member_id',$id)
                              ->where('year',$year)
                              ->select('deposite.*')
                              ->get();
                    ?>
                    
                    <?php
                      $MemberTotal = 0;
                    ?>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->type == 'Registration' && $element->amount > 0)
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else

                        @endif
                      @endforeach
                    </td>

                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'January' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'February' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'March' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'April' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'May' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'June' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'July' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'August' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'September' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'October' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'November' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>
                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->month == 'December' && $element->amount > 0 && $element->type == 'Monthly')
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>

                    <td  style="vertical-align: middle;">
                      @foreach ($MemberData as $element)
                        @if ($element->type == 'Yearly' && $element->amount > 0)
                          {{ $element->amount }}
                          <?php
                            $MemberTotal = $MemberTotal+$element->amount;
                          ?>
                        @else
                          
                        @endif
                      @endforeach
                    </td>

                    <td  style="vertical-align: middle;background: #04d0ff;font-weight: bold;">{{ $MemberTotal }}</td>
                  </tr>

                  @endforeach
                  <tr>
                    <td colspan="15">All Total</td>
                    <td  style="vertical-align: middle;background: #db4444;color: #fff;font-weight: bold;font-size: 18px;">{{ $Total }}</td>
                  </tr>
                  @endif

                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
            
    </section>
    <!-- /.content -->
  </div>
@endsection

           

