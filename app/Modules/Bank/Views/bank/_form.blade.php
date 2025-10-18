<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">
                    Bank Profit / Expense Information
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('name', old('name', $data->name ?? null), ['id'=>'name','class' => 'form-control','placeholder' => 'Enter profit / expense name']) !!}
                <span style="color: red">{!! $errors->first('name') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('type', 'Type', ['class' => 'col-form-label']) !!}
                <span class="required" style="color: red"> *</span>
                {!! Form::select('type', ['Profit'=>'Profit','Expense'=>'Expense'], old('type', $data->type ?? null), ['id'=>'type','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('type') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('amount', 'Amount', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('amount', old('amount', $data->amount ?? null), ['id'=>'amount','class'=>'form-control','placeholder' => 'Enter profit / expense amount']) !!}
                <span style="color: red">{!! $errors->first('amount') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ex_date', 'Date', ['class' => 'col-form-label']) !!}
                {!! Form::date('ex_date', old('ex_date', isset($data->ex_date) ? $data->ex_date : date('Y-m-d')), ['id'=>'expense_date','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('ex_date') !!}</span>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('note', 'Note (If any)', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('note', old('note', $data->note ?? null), ['id'=>'note','class'=>'form-control note','rows'=>'2']) !!}
                <span style="color: red">{!! $errors->first('note') !!}</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('image_link', 'Attachment', ['class' => 'col-form-label']) !!}
                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image_link" onchange="readURL(this);" type="file" style='position:absolute;z-index:2;top:0;left:0;opacity:0;background-color:transparent;color:transparent;' size="40">
                    </a>
                    &nbsp;
                    <span style="color: red">{!! $errors->first('image_link') !!}</span>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
                <div class="form-group mt-2">
                    <img id="blah" src="{{ isset($data->image_link) ? url('uploads/bank/'.$data->image_link) : '#' }}" alt="Attachment" style="height:80px;width:80px;">
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}
                <span class="required" style="color: red"> *</span>
                {!! Form::select('status', ['active'=>'Active','inactive'=>'Inactive'], old('status', $data->status ?? 'active'), ['id'=>'status', 'class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6 offset-md-6">
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10']) !!}
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
