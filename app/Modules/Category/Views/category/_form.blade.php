  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                    {!! Form::label('parent_category', 'Parent Category', array('class' => 'col-form-label')) !!} <span class="required"> *</span>
                    {!! Form::Select('parent_category', $parent_category_options ,Input::old('parent_category'),['id'=>'parent_category', 'class'=>'form-control select2','style'=>'width: 100%']) !!}
                    {!! $errors->first('parent_category') !!}
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                      {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}
                      <span class="required"> *</span> 
                      {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control',  'title'=>'Enter category Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                    <span style="color: red">{!! $errors->first('title') !!}</span>  
              </div>
            </div>
            
            <div class="form-group">
              
            <div class="col-md-3">
                 {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!} <span class="required"> *</span>
                 {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control', 'title'=>'Enter category Slug' ]) !!}

                 <span style="color: red">{!! $errors->first('slug') !!}</span>
             
              </div>
            </div>



          </div>


          <div class="row">
            <div class="form-group">
              <div class="col-md-6">
                {!! Form::label('short_order', 'short_order', array('class' => 'col-form-label')) !!}
                {!! Form::text('short_order',Input::old('short_order'),['id'=>'short_order','class' => 'form-control', 'title'=>'Enter Serail' ]) !!}
                {!! $errors->first('short_order') !!}

                  {!! Form::label('meta_title', 'Meta Title', array('class' => 'col-form-label')) !!} 
                  {!! Form::text('meta_title',Input::old('meta_title'),['id'=>'meta_title','class' => 'form-control','title'=>'Enter category Meta Title']) !!}
                  {!! $errors->first('meta_title') !!}
                

               
                        {!! Form::label('meta_keywords', 'Meta Keywords', array('class' => 'col-form-label')) !!}

                        {!! Form::text('meta_keywords',Input::old('meta_keywords'),['id'=>'meta_keywords','class' => 'form-control','title'=>'Enter category Meta Key']) !!}

                        {!! $errors->first('meta_keywords') !!}
                    


                      {!! Form::label('meta_description', 'Meta Description', array('class' => 'col-form-label')) !!}

                      {!! Form::textarea('meta_description',Input::old('meta_description'),['id'=>'meta_description','class' => 'form-control', 'title'=>'Enter Meta Description','size' => '120x9']) !!}

                      {!! $errors->first('meta_description') !!}
                     
                
               </div>
            
                 
                    <div class="col-md-6">

                     {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
                      {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => '', 'title'=>'Enter Description', 'rows'=>'5']) !!}
  
                      {!! $errors->first('description') !!}
                   
                  </div>  
                </div>
            </div>


            


            <div class="row">
                    <div class="col-md-6">
              <div class="form-group">

                        {!! Form::label('image_link', 'Image (Supported format :: jpeg,png,jpg,gif & file size max :: 1MB)', array('class' => 'col-form-label')) !!}


                      <div style="position:relative;">
                          <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                              Choose File...
                              <input name="image_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                          </a>
                          &nbsp;
                          <span class='label label-info' id="upload-file-info"></span>
                          </div>

                    @if(isset($data['image_link'] ) && !empty($data['image_link']) )
                      <a target="_blank" href="{{URL::to('')}}/uploads/category/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/category/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
                      </a>
                    @endif
                </div>

                
              </div>

              <div class="row">
              <div class="form-group">

                  <div class="col-md-6">
                      {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required"> *</span>

                      {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
                      {!! $errors->first('status') !!}
                     
                  </div>
                </div>
            </div>

                
                <br>
                


                  
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

        function convert_to_slug(){
            var str = document.getElementById("title").value;
            str = str.replace(/[ ,.]/g,'-');
            document.getElementById("slug").value = str;

        }

    </script>

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

            $("#categoryform").validate({
              rules:{
                title:{
                  required:true
              },
              slug:{
                  required:true
              },

              status:{
                  required:true
              }


          },
          messages:{
            title:'Please enter title',
            slug: 'Plese enter slug',
            status: 'Plese choose status'
        }
    });
        });
    </script>