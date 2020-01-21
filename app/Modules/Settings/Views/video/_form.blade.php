  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                      {!! Form::label('title', 'Video Title', array('class' => 'col-form-label')) !!}
                      <span> *</span> 
                      {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control',  'title'=>'Enter category Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                      <span style="color: red">{!! $errors->first('title') !!}</span>
                      
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                 {!! Form::label('sort order', 'Sort Order', array('class' => 'col-form-label')) !!} <span> *</span>
                 {!! Form::text('sort_order',Input::old('sort_order'),['id'=>'sort_order','class' => 'form-control', 'title'=>'Enter News sort' ]) !!}
                      <span style="color: red">{!! $errors->first('sort_order') !!}</span>
             </div>
              </div>

              <div class="col-md-2">
              	<div class="form-group">

                        {!! Form::label('video_image', 'Video Image', array('class' => 'col-form-label')) !!}


                      <div style="position:relative;">
                          <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                              Choose File...
                              

                   
                     <input name="video_image" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>

                   
                          </a>
                          &nbsp;
                          <span class='label label-info' id="upload-file-info"></span><br>
                              <span style="color: red">{!! $errors->first('video_image') !!}</span>

                          </div>

                    @if(isset($data['video_image'] ) && !empty($data['video_image']) )
                      
        <a target="_blank" href="{{URL::to('')}}/uploads/video/{{$data->video_image}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/video/{{$data->video_image}}" height="50px" alt="{{$data['video_image']}}" ></img>
                      </a>
                    @endif
                </div>

                
              </div>

              	<div class="col-md-3">
              		<div class="form-group">
                      {!! Form::label('video_link', 'Video Link In Youtube', array('class' => 'col-form-label')) !!}
                      <span> *</span> 
                      {!! Form::text('video_link',Input::old('video_link'),['id'=>'video_link','class' => 'form-control',  'Placeholder'=>'Enter video link']) !!}
                      <span style="color: red">{!! $errors->first('video_link') !!}</span>
                      
              		</div>
            	</div>

              <div class="col-md-2">
                <div class="form-group">

                        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required"> *</span>
  
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
                        {!! $errors->first('status') !!}
                     </div>
                    </div>
                </div>
            </div>
               

            <div class="row">
              <div class="form-group">
                  <div class="col-md-12">
                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                  </div>
              </div>
            </div>


        </div>

    <script>
        $(function() {
            // highlight
            var elements = $("input[type!='submit'], textarea, select");
            elements.focus(function() {
                $(this).parents('li').addClass('highlight');
            });
            elements.blur(function() {
                $(this).parents('li').removeClass('highlight');
            });

            $("#tagform").validate({
              rules:{
                title:{
                  required:true
              },
              slug:{
                  required:true
              },

              status:{
                  required:true
              }}
          },
          messages:{
            title:'Please enter title !',
            slug: 'Please enter slug !',
            status: 'Please select status !'
        }
    });
        
    </script>