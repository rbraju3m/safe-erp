<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<!-- /.box-header -->
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">safe gallery Information</button> 

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' title', 'Image Title', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span> 
				{!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','Placeholder' => 'Enter Image title']) !!}
				<span style="color: red">{!! $errors->first('title') !!}</span>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">  
				{!! Form::label('discription', 'Discription (If Any)', array('class' => 'col-form-label')) !!}

				{!! Form::textarea('discription',Input::old('discription'),['id'=>'discription','class' => 'form-control discription', 'title'=>'Enter discription', 'rows'=>'1']) !!}
				<span style="color: red">{!! $errors->first('discription') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">

				{!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
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
				<a target="_blank" href="{{URL::to('')}}/uploads/news/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/member/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
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