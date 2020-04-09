<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<!-- /.box-header -->
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Member Personal Information</button> 

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' Name', 'Member Name', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','Placeholder' => 'Enter Member Name']) !!}
				<span style="color: red">{!! $errors->first('name') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' mobile', 'Member Mobile', array('class' => 'col-form-label')) !!}
				<span style="color: red"> *</span> 
				{!! Form::text('mobile',Input::old('mobile'),['id'=>'mobile','class' => 'form-control','Placeholder' => 'Enter Member Mobile']) !!}
				<span style="color: red">{!! $errors->first('mobile') !!}</span>     
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">  
				{!! Form::label('id', 'Member ID', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('member_id',Input::old('member_id'),['id'=>'member_id','class' => 'form-control','Placeholder' => 'Enter Member ID (SAFE-0011)']) !!}
				<span style="color: red">{!! $errors->first('member_id') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">  
				{!! Form::label('id', 'National ID', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('national_id',Input::old('national_id'),['id'=>'national_id','class' => 'form-control','Placeholder' => 'Enter National ID']) !!}
				<span style="color: red">{!! $errors->first('national_id') !!}</span>
			</div>
		</div>
	</div>

		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('Name', 'Father / Husband Name', array('class' => 'col-form-label')) !!}
				<span></span> 
				{!! Form::text('f_h_name',Input::old('f_h_name'),['id'=>'f_h_name','class' => 'form-control','Placeholder' => 'Enter Father / Husband Name']) !!}
				<span style="color: red">{!! $errors->first('f_h_name') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('Nominee', 'Nominee Name', array('class' => 'col-form-label')) !!}
				<span></span> 
				{!! Form::text('nominee',Input::old('nominee'),['id'=>'Nominee','class' => 'form-control','Placeholder' => 'Enter Nominee Name']) !!}
				<span style="color: red">{!! $errors->first('nominee') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('Name', 'Nominee Mobile', array('class' => 'col-form-label')) !!}
				<span></span> 
				{!! Form::text('nominee_mobile',Input::old('nominee_mobile'),['id'=>'nominee_mobile','class' => 'form-control','Placeholder' => 'Enter Nominee Mobile']) !!}
				<span style="color: red">{!! $errors->first('nominee_mobile') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('Name', 'Nominee National ID', array('class' => 'col-form-label')) !!}
				<span></span> 
				{!! Form::text('nominee_n_id',Input::old('nominee_n_id'),['id'=>'nominee_n_id','class' => 'form-control','Placeholder' => 'Enter Nominee National ID']) !!}
				<span style="color: red">{!! $errors->first('nominee_n_id') !!}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">  
				{!! Form::label('present_address', 'Present Address', array('class' => 'col-form-label')) !!}
				<span class="required" style="color: red"> *</span>

				{!! Form::textarea('present_address',Input::old('present_address'),['id'=>'present_address','class' => 'form-control present_address', 'title'=>'Enter present_address', 'rows'=>'2']) !!}
				<span style="color: red">{!! $errors->first('present_address') !!}</span>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				{!! Form::label('parmanent_address', 'Parmanent Address', array('class' => 'col-form-label')) !!}
				<span class="required" style="color: red"> *</span>
				<span class="Paramanent_Address" >
					<input type="checkbox" class="form-check-input Paramanent_Address_check" id="exampleCheck1">
					
				</span>
				<label class="form-check-label" for="exampleCheck1">Same as present address</label>
				
				{{-- <span class="float-right" id="address"></span> --}}

				{!! Form::textarea('parmanent_address',Input::old('parmanent_address'),['id'=>'Paramanent_Address','class' => 'form-control ', 'Placeholder'=>'Enter Parmanent Address', 'rows'=>'2']) !!}
				<span style="color: red">{!! $errors->first('parmanent_address') !!}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				{!!  Form::label('type', 'Member Type', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('type',array(''=>'Select Member Type','Admin'=>'Admin','Chairman'=>'Chairman','General secretary' => 'General secretary','Member'=>'Member'),Input::old('type'),['id'=>'type', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('type') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!!  Form::label('Religion', 'Religion', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('religion',array(''=>'Select Member Religion','Islam'=>'Islam','Hinduism'=>'Hinduism','Christianity' => 'Christianity','Buddhism'=>'Buddhism'),Input::old('religion'),['id'=>'Religion', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('religion') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!!  Form::label('gender', 'Gender', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('gender',array(''=>'Select Member Gender','Male'=>'Male','Female'=>'Female','Others' => 'Others'),Input::old('gender'),['id'=>'gender', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('gender') !!}</span>
			</div>
		</div>


		<div class="col-md-3">
			<div class="form-group">

				{!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('status') !!}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{!! Form::label('image_link', 'Image (Supported format :: jpeg,png,jpg & file size max :: 5MB)', array('class' => 'col-form-label')) !!}
				<span class="required" style="color: red"> *</span>


				<div style="position:relative;">
					<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
						Choose File...
						<input name="image_link" onchange="readURL(this);" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
					</a>
					&nbsp;
<span style="color: red">{!! $errors->first('image_link') !!}</span>
					<span class='label label-info' id="upload-file-info"></span>
				</div>

				@if(isset($data['image_link'] ) && !empty($data['image_link']) )
				<a target="_blank" href="{{URL::to('')}}/uploads/news/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/news/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
				</a>
				@endif

			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<img id="blah" style="margin-top: -22px;" src="#" alt="." />
			
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
		</div>
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
	                .width(250)
	                .height(200);
	        };

	        reader.readAsDataURL(input.files[0]);
	    }
	}

		
</script>