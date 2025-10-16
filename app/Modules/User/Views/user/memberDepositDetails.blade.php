<?php
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\URL;
?>

@extends('backend.layout.master')

@section('body')

    <div class="content-wrapper">
        <!-- Page Header -->
        <section class="content-header">
            <h2 class="member_modute_title">
                {{ $ModuleTitle }}
            </h2>

            <ol class="breadcrumb breadcrumbbutton">
                <div class="form-group">
                    {!! Form::Select(
                        'member_id',
                        $memberList,
                        old('member_id'),
                        [
                            'id' => 'member_id_for_search',
                            'class' => 'form-control select2'
                        ]
                    ) !!}
                    <span style="color: red">{!! $errors->first('member_id') !!}</span>
                    <a class="raju"
                       style="border: 1px solid; padding: 4px 18px; background-color: #140644; color: #fff; font-weight: bold; display: none;">
                        Search
                    </a>
                </div>
            </ol>
        </section>

        <!-- Main Content -->
        <section class="content">
            @include('backend.layout.msg')

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <!-- Box Header -->
                        <div class="box-header">
                            <h3 class="box-title">{{ $pageTitle }}</h3>
                        </div>

                        <!-- Box Body -->
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th style="background: rgb(126, 172, 206);">Month-Year</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Note</th>
                                    <th>Date</th>
                                    <th>Received By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                        <?php $total_rows = 1; ?>
                                    @foreach($data as $values)
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
                                @else
                                    <tr>
                                        <td colspan="7" style="background-color: #8c0707; color: #fff; font-weight: bold;">
                                            No Deposit Records Found!
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
