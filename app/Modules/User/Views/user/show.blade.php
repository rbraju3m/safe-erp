
<?php
use App\Modules\User\Models\User;
  
?>
<!-- Main content -->
    <section class="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img style="width: 190px" class="profile-user-img img-fluid img-circle"
                       src="{{URL::to('')}}/uploads/member/{{$member->image_link}}"
                       alt="{{ $member->name }} profile picture">

                </div>

                <h3 class="profile-username text-center">{{ $member->name }}</h3>

                <p class="text-muted text-center">Member science {{ $member->join_date }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>SAFE-ID</b> <a class="float-right">{{ $member->member_id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>N-ID</b> <a class="float-right">{{ $member->national_id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Mobile</b> <a class="float-right">0{{ $member->mobile }}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>{{ $member->type }}</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <div class="card-body">
                <strong></i> Nominee</strong>

                <p class="text-muted">
                  {{ $member->nominee }}<br>
                   0{{ $member->nominee_mobile }}<br>
                   {{ $member->nominee_n_id }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <?php
                  if ($member->present_address == $member->parmanent_address) { ?>
                    <p class="text-muted">{{ $member->present_address }}</p>
                <?php }else{ ?>
                <p class="text-muted" style="margin-bottom: 3px;">Present : {{ $member->present_address }}</p>
                <p class="text-muted">Parmanent : {{ $member->parmanent_address }}</p>
                <?php } ?>
                

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Extra</strong>

                <?php
                  $gender = $member->gender;
                  if ($gender == 'Male') {
                    $gender = 'He is Male';
                  }elseif ($gender == 'Female') {
                    $gender = 'She is Female';
                  }else{
                    $gender = 'Allah Gooooo !!!';
                  }


                ?>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                     <a class="float-right">{{ $gender }}</a>
                  </li>
                  <li class="list-group-item">
                     <a class="float-right">Religion is {{ $member->religion }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a style="background-color: #dadbd5;

color: #000;

font-size: 15px;

font-weight: bold;" class="nav-link active" href="#activity" data-toggle="tab">Last 10 Transaction Activity</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="box-body table-responsive no-padding">
                       @if(count($deposite) > 0)

              <table  id="example1" class="table table-bordered table-striped text-center">
               
                <thead>

                <tr>
                
                  
                  <th> ID </th>
                  <th> Month-Year </th>
                  <th> Amount </th>
                  <th> Type </th>
                  <th> Note</th>
                  <th> Date </th>
                  <th> Received </th>
                </tr>
                </thead>
<tbody>
<?php
$total_deposite = 0;
$total_rows = 1;
?>
@foreach($deposite as $values)
 
<?php
    $total_deposite = $total_deposite+$values->amount;
?>

<tr>
  <td><?=$total_rows?></td>
  <td>{{ $values->month }}-{{ $values->year }}</td>
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
<tr>
  <td colspan="2"><b>Total</b></td>
  <td style="background: #064073;
color: #fff;"><b>{{ $total_deposite }}</b></td>
  <td colspan="4"></td>
</tr>
            {{-- {{$deposite->links()}} --}}

@else

  <h3 style="    background-color: #8c0707;
    color: #fff;
    padding: 5px 5px;
    text-align: center;
}">{{ $member->name }} Has No Deposite !</h3>
@endif
</tbody>
              </table>
            </div>
            <!-- /.box-body -->
                    

                    
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

    </section>





