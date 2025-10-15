<?php use Illuminate\Support\Facades\URL; ?>
<div class="box-body">

    <!-- Section Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">
                    Member Personal Information
                </button>
            </div>
        </div>
    </div>

    <!-- Member Personal Info -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('name', 'Member Name') !!} <span class="text-danger">*</span>
                {!! Form::text('name', old('name'), ['id'=>'name','class'=>'form-control','placeholder'=>'Enter Member Name']) !!}
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('mobile', 'Member Mobile') !!} <span class="text-danger">*</span>
                {!! Form::text('mobile', old('mobile'), ['id'=>'mobile','class'=>'form-control','placeholder'=>'Enter Member Mobile']) !!}
                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('member_id', 'Member ID') !!} <span class="text-danger">*</span>
                {!! Form::text('member_id', old('member_id'), ['id'=>'member_id','class'=>'form-control','placeholder'=>'Enter Member ID (SAFE-0011)']) !!}
                @error('member_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('national_id', 'National ID') !!} <span class="text-danger">*</span>
                {!! Form::text('national_id', old('national_id'), ['id'=>'national_id','class'=>'form-control','placeholder'=>'Enter National ID']) !!}
                @error('national_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Father/Husband & Nominee Info -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('f_h_name', 'Father / Husband Name') !!}
                {!! Form::text('f_h_name', old('f_h_name'), ['id'=>'f_h_name','class'=>'form-control','placeholder'=>'Enter Father / Husband Name']) !!}
                @error('f_h_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('nominee', 'Nominee Name') !!}
                {!! Form::text('nominee', old('nominee'), ['id'=>'nominee','class'=>'form-control','placeholder'=>'Enter Nominee Name']) !!}
                @error('nominee')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('nominee_mobile', 'Nominee Mobile') !!}
                {!! Form::text('nominee_mobile', old('nominee_mobile'), ['id'=>'nominee_mobile','class'=>'form-control','placeholder'=>'Enter Nominee Mobile']) !!}
                @error('nominee_mobile')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('nominee_n_id', 'Nominee National ID') !!}
                {!! Form::text('nominee_n_id', old('nominee_n_id'), ['id'=>'nominee_n_id','class'=>'form-control','placeholder'=>'Enter Nominee National ID']) !!}
                @error('nominee_n_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Addresses -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('present_address', 'Present Address') !!} <span class="text-danger">*</span>
                {!! Form::textarea('present_address', old('present_address'), ['id'=>'present_address','class'=>'form-control','rows'=>'2','placeholder'=>'Enter Present Address']) !!}
                @error('present_address')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('parmanent_address', 'Permanent Address') !!} <span class="text-danger">*</span><br>
                <input type="checkbox" id="same_address" class="form-check-input">
                <label for="same_address">Same as present address</label>
                {!! Form::textarea('parmanent_address', old('parmanent_address'), ['id'=>'parmanent_address','class'=>'form-control','rows'=>'2','placeholder'=>'Enter Permanent Address']) !!}
                @error('parmanent_address')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Member Type, Religion, Gender, Status -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                    <?php
                    $admintype = (Auth::user()->type == 'Admin') ? '' : 'disabled';
                    $text = (Auth::user()->type != 'Admin') ? 'Only admin can change' : '';
                    ?>
                {!! Form::label('type', 'Member Type') !!} <span class="text-danger">*</span>
                {!! Form::select('type', [''=>'Select Member Type','Admin'=>'Admin','Chairman'=>'Chairman','General secretary'=>'General secretary','Member'=>'Member'], old('type'), ['class'=>'form-control', $admintype]) !!}
                @if(Auth::user()->type != 'Admin')
                    <input type="hidden" name="type" value="{{ old('type', $data->type ?? '') }}">
                @endif
                <span class="text-danger">{{ $text }}</span>
                @error('type')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('religion', 'Religion') !!} <span class="text-danger">*</span>
                {!! Form::select('religion', [''=>'Select Religion','Islam'=>'Islam','Hinduism'=>'Hinduism','Christianity'=>'Christianity','Buddhism'=>'Buddhism'], old('religion'), ['class'=>'form-control']) !!}
                @error('religion')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('gender', 'Gender') !!} <span class="text-danger">*</span>
                {!! Form::select('gender', [''=>'Select Gender','Male'=>'Male','Female'=>'Female','Others'=>'Others'], old('gender'), ['class'=>'form-control']) !!}
                @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('status', 'Status') !!} <span class="text-danger">*</span>
                {!! Form::select('status', ['active'=>'Active','inactive'=>'Inactive'], old('status'), ['class'=>'form-control']) !!}
                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('image_link', 'Profile Image (jpeg,png,jpg, max 5MB)') !!} <span class="text-danger">*</span>
                <input type="file" name="image_link" id="image_link" class="form-control" onchange="readURL(this);">
                @error('image_link')<span class="text-danger">{{ $message }}</span>@enderror

                @if(isset($data['image_link']) && !empty($data['image_link']))
                    <a target="_blank" href="{{ URL::to('uploads/member/'.$data['image_link']) }}" class="btn btn-primary btn-sm mt-2">
                        <img src="{{ URL::to('uploads/member/'.$data['image_link']) }}" height="50px" alt="Profile Image">
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <img id="blah" src="#" alt="Image Preview" style="margin-top: 10px; display:none;" width="250" height="200"/>
        </div>
    </div>

    <!-- Submit -->
    <div class="row">
        <div class="col-md-6">
            {!! Form::submit('Save changes', ['class'=>'btn btn-primary pull-right mt-3']) !!}
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Image preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Copy present address to permanent address
    $('#same_address').change(function() {
        if($(this).is(':checked')) {
            $('#parmanent_address').val($('#present_address').val());
        } else {
            $('#parmanent_address').val('');
        }
    });
</script>
