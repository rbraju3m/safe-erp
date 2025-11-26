<?php
use Illuminate\Support\Facades\URL;
?>
<!-- /.box-header -->
<div class="box-body" >
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{!! Form::label(' password', 'New Password', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span>
				{!! Form::text('password',old('password'),['id'=>'password','class' => 'form-control','Placeholder' => 'Enter New password']) !!}
				<span style="color: red">{!! $errors->first('password') !!}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{!! Form::label(' Confirm Password', 'Confirm Password', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span>
				{!! Form::text('confirm',old('confirm'),['id'=>'confirm','class' => 'form-control','Placeholder' => 'Confirm Password']) !!}
				<span style="color: red">{!! $errors->first('confirm') !!}</span>
			</div>
		</div>
	</div>




	</div>
	  <div class="row">

	<div class="col-md-8 col-md-offset-2">
		<div class="form-group">
			{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
		</div>
	</div>
</div>


</div>

