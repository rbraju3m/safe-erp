
<?php
use App\Modules\User\Models\User;
?>
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Card -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 190px" class="profile-user-img img-fluid img-circle"
                                 src="{{URL::to('')}}/uploads/member/{{$member->image_link}}"
                                 alt="{{ $member->name }} profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $member->name }}</h3>
                        <p class="text-muted text-center">Member since {{ $member->join_date }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>SAFE-ID</b> <a class="float-right">{{ $member->member_id }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>N-ID</b> <a class="float-right">{{ $member->national_id }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right">{{ $member->mobile }}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>{{ $member->type }}</b></a>
                    </div>
                </div>

                <!-- Nominee & Info -->
                <div class="card card-primary">
                    <div class="card-body">
                        <strong>Nominee</strong>
                        <p class="text-muted">
                            {{ $member->nominee }}<br>
                            {{ $member->nominee_mobile }}<br>
                            {{ $member->nominee_n_id }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        @if ($member->present_address == $member->parmanent_address)
                            <p class="text-muted">{{ $member->present_address }}</p>
                        @else
                            <p class="text-muted" style="margin-bottom: 3px;">Present : {{ $member->present_address }}</p>
                            <p class="text-muted">Permanent : {{ $member->parmanent_address }}</p>
                        @endif

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Extra</strong>
                        <?php
                        $genderText = $member->gender === 'Male' ? 'He is Male' :
                            ($member->gender === 'Female' ? 'She is Female' : 'Gender not specified');
                        ?>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item"><a class="float-right">{{ $genderText }}</a></li>
                            <li class="list-group-item"><a class="float-right">Religion is {{ $member->religion }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a style="background-color: #dadbd5; color: #000; font-size: 15px; font-weight: bold;"
                                   class="nav-link active" href="#activity" data-toggle="tab">
                                    Last 10 Transaction Activity
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="box-body table-responsive no-padding">

                                    @if(count($deposite) > 0)
                                        <table id="example1" class="table table-bordered table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Month-Year</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Note</th>
                                                <th>Date</th>
                                                <th>Received</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total_deposite = 0; $total_rows = 1; ?>
                                            @foreach($deposite as $values)
                                                    <?php $total_deposite += $values->amount; ?>
                                                <tr>
                                                    <td>{{ $total_rows }}</td>
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
                                                    <td>{{ $name->name ?? 'N/A' }}</td>
                                                </tr>
                                                    <?php $total_rows++; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"><b>Total</b></td>
                                                <td style="background: #064073; color: #fff;"><b>{{ $total_deposite }}</b></td>
                                                <td colspan="4"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <h3 style="background-color: #8c0707; color: #fff; padding: 5px; text-align: center;">
                                            {{ $member->name }} has no deposit!
                                        </h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yearly Total Deposits -->
                @if(isset($yearTotals) && count($yearTotals) > 0)
                    <div class="card mt-3">
                        <div class="card-header" style="background: #140644; color: #fff;">
                            <h4 class="mb-0">Yearly Total Deposits</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    @for($year = $startYear; $year <= $currentYear; $year++)
                                        <th>{{ $year }}</th>
                                    @endfor
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @for($year = $startYear; $year <= $currentYear; $year++)
                                        <td style="background-color:#0a0a66;color:#fff;font-weight:bold;">
                                            {{ $yearTotals[$year] ?? 0 }}
                                        </td>
                                    @endfor
                                    <td style="background-color:#711;color:#fff;font-weight:bold;">
                                        {{ $grandTotal }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

