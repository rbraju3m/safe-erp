
<?php
use App\Modules\User\Models\User;
  
?>
<!-- Main content -->
    <section class="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
              </div><!-- /.card-header -->
<div class="card-body">
  <div class="tab-content">
    <div class="active tab-pane" id="activity">
      <div class="box-body table-responsive no-padding">
        

<table  id="example1" class="table table-bordered table-striped text-center">
  <thead>
    <tr>
      <th>
        <img src="{{URL::to('')}}/uploads/member/{{$member->image_link}}" class="img-circle border " style="width: 50px;height: 50px;" alt="User Image">
      </th>
      <th style="vertical-align: middle;"> 2019 </th>
      <th style="vertical-align: middle;"> 2020 </th>
      <th style="vertical-align: middle;"> 2021 </th>
      <th style="vertical-align: middle;"> 2022 </th>
      <th style="vertical-align: middle;"> 2023 </th>
      <th style="vertical-align: middle;"> 2024 </th>
      <th style="vertical-align: middle;"> 2025 </th>
      <th style="vertical-align: middle;"> Total </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><b>Total</b></td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2019 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2020 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2021 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2022 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2023 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2024 }}</td>
      <td style="background-color: #0a0a66;color: #fff;font-weight: bold;">{{ $total_2025 }}</td>
      <td style="background-color: #711;color: #fff;font-weight: bold;">{{ $total }}</td>
    </tr>

    <tr>
      <td><b>Due</b></td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30100-$total_2019 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2020 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2021 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2022 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2023 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2024 }}</td>
      <td style="background-color: #003b57;color: #fff;font-weight: bold;">{{ 30000-$total_2025 }}</td>
      <td style="background-color: #711;color: #fff;font-weight: bold;">{{ 210100-$total }}</td>
    </tr>
  </tbody>
</table>
      
      </div>
      <div style="margin-top: 8px;">
        <span style="border: 1px solid;padding: 2px 11px;background-color: #711;"></span>  <b style="margin-left: 5px;">Total Diposite / Total Due</b><br>

        <span style="border: 1px solid;padding: 2px 11px;background-color: #0a0a66;"></span>  <b style="margin-left: 5px;">Yearly Total Deposite</b><br>

        <span style="border: 1px solid;padding: 2px 11px;background-color: #003b57;"></span>  <b style="margin-left: 5px;">Yearly Total Due</b>
      </div>
    </div>
  </div>
</div>
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>





