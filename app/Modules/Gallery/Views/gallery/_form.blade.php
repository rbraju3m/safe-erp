<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-block" style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Safe Gallery Information</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('folder', 'Folder', ['class'=>'col-form-label']) !!}
                <span style="color: red">*</span>

                <select id="folder" name="folder" class="form-control">
                    <option value="">Select Folder</option>
                    @foreach($folders ?? [] as $folderName)
                        @if($data)
                            <option value="{{ $folderName }}" {{ $data->folder == $folderName ? 'selected' : '' }}>{{ $folderName }}</option>
                        @else
                            <option value="{{ $folderName }}" {{ old('folder') == $folderName ? 'selected' : '' }}>{{ $folderName }}</option>
                        @endif

                    @endforeach
                    <option value="new_folder" {{ old('folder') == 'new_folder' ? 'selected' : '' }}>+ Create New Folder</option>
                </select>

                <!-- New folder input hidden by default -->
                <input type="text" name="new_folder" id="new_folder" class="form-control mt-2" placeholder="Enter new folder name" style="display: none;" value="{{ old('new_folder') }}">

                <span style="color: red">
            {!! $errors->first('folder') !!} {!! $errors->first('new_folder') !!}
        </span>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('title', 'Image Title', ['class' => 'col-form-label']) !!}
                <span style="color: red">*</span>
                {!! Form::text('title', old('title'), ['id'=>'title','class'=>'form-control','placeholder'=>'Enter Image title']) !!}
                <span style="color: red">{!! $errors->first('title') !!}</span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('discription', 'Description (If Any)', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('discription', old('discription'), ['id'=>'discription','class'=>'form-control discription','rows'=>'1','placeholder'=>'Enter Description']) !!}
                <span style="color: red">{!! $errors->first('discription') !!}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}
                <span class="required" style="color: red"> *</span>
                {!! Form::select('status', ['active'=>'Active','inactive'=>'Inactive'], old('status'), ['id'=>'status','class'=>'form-control']) !!}
                <span style="color: red">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('image_link', 'Image (jpeg, png, jpg, max: 5MB)', ['class'=>'col-form-label']) !!}
                <span class="required" style="color: red">*</span>

                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image_link" onchange="readURL(this);" type="file" style='position:absolute;z-index:2;top:0;left:0;opacity:0;background-color:transparent;color:transparent;' size="40">
                    </a>
                    &nbsp;
                    <span style="color: red">{!! $errors->first('image_link') !!}</span>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>

                @if(isset($data['image_link']) && !empty($data['image_link']))
                    <a target="_blank" href="{{ url('uploads/gallery/'.$data['image_link']) }}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10">
                        <img src="{{ url('uploads/gallery/'.$data['image_link']) }}" height="50px" alt="{{$data['image_link']}}">
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-6">
                <img id="blah" style="margin-top: -22px;" src="#" alt="Preview Image" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                {!! Form::submit('Save changes', ['class'=>'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'Click save changes button to save information']) !!}
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result).width(250).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const folderSelect = document.getElementById('folder');
        const newFolderInput = document.getElementById('new_folder');

        function toggleNewFolder() {
            if (folderSelect.value === 'new_folder') {
                newFolderInput.style.display = 'block';
            } else {
                newFolderInput.style.display = 'none';
                newFolderInput.value = '';
            }
        }

        // Initial check on page load
        toggleNewFolder();

        // Toggle on change
        folderSelect.addEventListener('change', toggleNewFolder);
    });
</script>
