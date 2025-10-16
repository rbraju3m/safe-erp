
@extends('backend.layout.master')
@section('body')

<div class="content-wrapper">
    <section class="content-header">

      <h1>{{$ModuleTitle}}</h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>

    </section>
    <section class="content">
       @include('backend.layout.msg')

      <div class="row">
        <div class="col-md-12">
                  <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$pageTitle}}</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-striped text-center">
                    <h1 class="text-center">Delete confirmation</h1>
                    <tr>
                        <th>Name</th>
                        <td>{{$member->name}}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{$member->mobile}}</td>
                    </tr>
                    <tr>
                        <th>Nominee</th>
                        <td>{{$member->nominee}}</td>
                    </tr>
                    <tr>
                        <th>Nominee Mobile</th>
                        <td>{{$member->nominee_mobile}}</td>
                    </tr>
                    <tr>
                        <th>Total Deposit</th>
                        <td>{{number_format($totalDeposit,2)}}</td>
                    </tr>
                    <tr>
                        <th>Total Profit</th>
                        <td>{{number_format($totalProfit,2)}}</td>
                    </tr>
                    <tr>
                        <th>Sub Total</th>
                        <td>{{number_format(($totalProfit+$totalDeposit),2)}}</td>
                    </tr>
                    <tr>
                        <th>Deduction Amount <span style="font-size: 10px;">( 50% of profit )</span></th>
                        <td>{{number_format(($totalProfit/2),2)}}</td>
                    </tr>
                    <tr>
                        <th>Grand Total{{-- <span style="font-size: 10px;">( 50% of profit )</span>--}}</th>
                        <td>{{number_format((($totalProfit+$totalDeposit)-$totalProfit/2),2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <a title="Inactive"  style="border: 1px solid;padding: 2px 5px;margin-left: 5px;background-color: red;color: #0a0a0a" href="{{ route('admin.member.permanentDelete', $member->id) }}"  onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-ban" aria-hidden="true"></i> Parmanent Delete
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

