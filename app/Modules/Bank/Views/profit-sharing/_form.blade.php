<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<!-- /.box-header -->
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Bank profit / expense Information</button> 

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' Name', ' Name', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','Placeholder' => 'Enter profit / expense name']) !!}
				<span style="color: red">{!! $errors->first('name') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">

				{!!  Form::label('Type', 'Type', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('type',array('Profit'=>'Profit','Expense'=>'Expense'),Input::old('status'),['id'=>'type', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('type') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' Amount', ' Amount', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('amount',Input::old('amount'),['id'=>'amount','class' => 'form-control','Placeholder' => 'Enter profit / expense amount']) !!}
				<span style="color: red">{!! $errors->first('amount') !!}</span>
			</div>
		</div>


		<div class="col-md-3">
			<div class="form-group">
			{!! Form::label('  Date', ' Date', array('class' => 'col-form-label')) !!}
			{{ Form::date('ex_date',Input::old(date('Y-m-d')),['id'=>'expense_date','class' => 'form-control','Placeholder' => 'Enter Expense Date']) }} 
			<span style="color: red">{!! $errors->first('ex_date') !!}</span>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">  
				{!! Form::label('note', 'Note (If any)', array('class' => 'col-form-label')) !!}

				{!! Form::textarea('note',Input::old('note'),['id'=>'note','class' => 'form-control note', 'title'=>'Enter note', 'rows'=>'2']) !!}
				<span style="color: red">{!! $errors->first('note') !!}</span>
			</div>
		</div>

		<div class="col-md-4">
		<div class="form-group">
			{!! Form::label('image_link', ' Attachment', array('class' => 'col-form-label')) !!}


		<div style="position:relative;">
			<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
			Choose File...
			<input name="image_link" onchange="readURL(this);" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
			</a>
			&nbsp;
			<span style="color: red">{!! $errors->first('image_link') !!}</span>
			<span class='label label-info' id="upload-file-info"></span>
			<div class="form-group">
		<img id="blah"  src="#" alt="."/>
	</div>
		</div>
		<div>@if(isset($data['image_link'] ) && !empty($data['image_link']) )
				<a target="_blank" href="{{URL::to('')}}/uploads/bank/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10">
					<img style="height: 80px;width: 80px;" src="{{URL::to('')}}/uploads/bank/{{$data->image_link}}">
				</a>
				@endif</div>
	</div>
	
	</div>

	
		<div class="col-md-2">
			<div class="form-group">

				{!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('status') !!}</span>
			</div>
		</div>

		

	</div>
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
		</div>
	</div>

	
</div>

<script>

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#blah')
	                .attr('src', e.target.result)
	                .width(150)
	                .height(150);
	        };

	        reader.readAsDataURL(input.files[0]);
	    }
	}

		
</script>