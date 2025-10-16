<?php
use Illuminate\Support\Facades\URL;
?>
    <!-- /.box-header -->
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">
                    Member Payment Information
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('member_id', 'Select Member Name', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::select('member_id', $member, old('member_id'), ['id'=>'member_id', 'class'=>'form-control select2']) !!}
                <span style="color: red">{!! $errors->first('member_id') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('month', 'Select Month', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                <?php
                $month = [
                    'January'=>'January', 'February'=>'February', 'March'=>'March', 'April'=>'April',
                    'May'=>'May', 'June'=>'June', 'July'=>'July', 'August'=>'August',
                    'September'=>'September', 'October'=>'October', 'November'=>'November', 'December'=>'December'
                ];
                ?>
                {!! Form::select('month', $month, old('month'), ['id'=>'month', 'class'=>'form-control select2']) !!}
                <span style="color: red">{!! $errors->first('month') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('year', 'Select Year', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                <?php
                $year = [];
                for($y=2019; $y<=2027; $y++){
                    $year[$y] = $y;
                }
                ?>
                {!! Form::select('year', $year, old('year', date('Y')), ['id'=>'year', 'class'=>'form-control select2']) !!}
                <span style="color: red">{!! $errors->first('year') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('type', 'Payment Type', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::select('type', ['Monthly'=>'Monthly','Monthly With Due'=>'Monthly With Due','Yearly'=>'Yearly','Registration'=>'Registration','Other'=>'Other'], old('type'), ['id'=>'type', 'class'=>'form-control select2']) !!}
                <span style="color: red">{!! $errors->first('type') !!}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('note', 'Note (If any)', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('note', old('note'), ['id'=>'note','class'=>'form-control note','title'=>'Enter note','rows'=>'2']) !!}
                <span style="color: red">{!! $errors->first('note') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('amount', 'Amount', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('amount', old('amount'), ['id'=>'amount','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('amount') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::select('status', ['active'=>'Active','inactive'=>'Inactive'], old('status'), ['id'=>'status','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'Click save changes button to save payment information']) !!}
        </div>
    </div>
</div>
