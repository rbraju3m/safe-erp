<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<!-- /.box-header -->
<div class="box-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Member Payment Information</button>

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' member_id', 'Select Member Name', array('class' => 'col-form-label')) !!}
				<span style="color: red">*</span>
				{!! Form::Select('member_id',$member,Input::old('member_id'),['id'=>'member_id', 'class'=>'form-control select2']) !!}
				<span style="color: red">{!! $errors->first('member_id') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' month', 'Select Month', array('class' => 'col-form-label')) !!}
				<span style="color: red"> *</span>
				<?php
					$month = array();
					$month['January'] = 'January';
					$month['February'] = 'February';
					$month['March'] = 'March';
					$month['April'] = 'April';
					$month['May'] = 'May';
					$month['June'] = 'June';
					$month['July'] = 'July';
					$month['August'] = 'August';
					$month['September'] = 'September';
					$month['October'] = 'October';
					$month['November'] = 'November';
					$month['December'] = 'December';
				?>
				{!! Form::select('month',$month,Input::old('month'),['id'=>'month','class' => 'form-control select2']) !!}
				<span style="color: red">{!! $errors->first('month') !!}</span>
			</div>
		</div>


		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label(' year', 'Select Year', array('class' => 'col-form-label')) !!}

				<span style="color: red"> *</span>
				<?php
					$year = array();
					$year['2019'] = '2019';
					$year['2020'] = '2020';
					$year['2021'] = '2021';
					$year['2022'] = '2022';
					$year['2023'] = '2023';
					$year['2024'] = '2024';
					$year['2025'] = '2025';
				?>
				{!! Form::Select('year',$year,'2023',['id'=>'year', 'class'=>'form-control select2']) !!}
				<span style="color: red">{!! $errors->first('year') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!!  Form::label('type', 'Payment Type', array('class' => 'col-form-label')) !!} <span class="required" style="color: red"> *</span>

				{!! Form::Select('type',array('Monthly'=>'Monthly','Monthly With Due'=>'Monthly With Due','Yearly'=>'Yearly','Registration'=>'Registration','Other' => 'Other'),Input::old('type'),['id'=>'type', 'class'=>'form-control select2']) !!}
				<span style="color: red">{!! $errors->first('type') !!}</span>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{!! Form::label('note', 'Note (If any)', array('class' => 'col-form-label')) !!}

				{!! Form::textarea('note',Input::old('note'),['id'=>'note','class' => 'form-control note', 'title'=>'Enter note', 'rows'=>'2']) !!}
				<span style="color: red">{!! $errors->first('note') !!}</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('amount', 'Amount', array('class' => 'col-form-label')) !!}
				<span style="color: red"> *</span>


				<?php
					$amount = array();
					$amount['2000'] = '2000';
					$amount['2100'] = '2100';
					$amount['6000'] = '6000';
					$amount['100'] = '100';
				?>
{{--				{!! Form::Select('amount',$amount,Input::old('amount'),['id'=>'amount', 'class'=>'form-control select2']) !!}--}}
				{!! Form::text('amount',Input::old('amount'),['id'=>'amount', 'class'=>'form-control']) !!}
				<span style="color: red">{!! $errors->first('amount') !!}</span>

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
		<div class="col-md-3">
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
		</div>
	</div>


</div>

