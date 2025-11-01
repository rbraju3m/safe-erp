<?php
use Illuminate\Support\Facades\URL;
?>
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">
                    Investment Information
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('project_id', 'Choose project', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::select('project_id', $projects, old('project_id'), ['id'=>'project_id', 'class'=>'form-control select2']) !!}
                <span style="color: red">{!! $errors->first('project_id') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('name', 'Investment Name', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('name', old('name'), ['id'=>'name','class'=>'form-control','placeholder'=>'Enter Investment Name']) !!}
                <span style="color: red">{!! $errors->first('name') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('amount', 'Investment Amount', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('amount', old('amount'), ['id'=>'amount','class'=>'form-control','placeholder'=>'Enter Investment Amount']) !!}
                <span style="color: red">{!! $errors->first('amount') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('investment_date', 'Investment Date', ['class' => 'col-form-label']) !!}
                {!! Form::date('investment_date', old('investment_date', date('Y-m-d')), ['id'=>'investment_date','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('investment_date') !!}</span>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('note', 'Note (If any)', ['class'=>'col-form-label']) !!}
                {!! Form::textarea('note', old('note'), ['id'=>'note','class'=>'form-control','rows'=>'2','placeholder'=>'Enter note']) !!}
                <span style="color: red">{!! $errors->first('note') !!}</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('image', 'Investment Attachment', ['class'=>'col-form-label']) !!}
                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image" onchange="readURL(this);" type="file"
                               style='position:absolute;z-index:2;top:0;left:0;
							filter: alpha(opacity=0);opacity:0;background-color:transparent;color:transparent;'>
                    </a>
                    &nbsp;
                    <span style="color: red">{!! $errors->first('image') !!}</span>
                    <span class='label label-info' id="upload-file-info"></span>
                    <div class="form-group">
                        <img id="blah" src="#" alt="."/>
                    </div>
                </div>

                @if(isset($data->image) && !empty($data->image))
                    <a target="_blank" href="{{ URL::to('uploads/investment/'.$data->image) }}" class="btn btn-primary btn-sm font-10" style="margin-top: 5px;">
                        <img style="height: 80px;width: 80px;" src="{{ URL::to('uploads/investment/'.$data->image) }}">
                    </a>
                @endif
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class'=>'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::select('status', ['active'=>'Active','inactive'=>'Inactive'], old('status'), ['id'=>'status','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('status') !!}</span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            {!! Form::submit('Save changes', ['class'=>'btn btn-primary pull-right btn-sm font-10 m-t-15']) !!}
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(150).height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
