  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                    {!! Form::label('parent_category', 'Parent Category', array('class' => 'col-form-label')) !!} <span> *</span>
                    {!! Form::Select('category_id', $parent_category_options ,Input::old('category_id'),['id'=>'parent_category', 'class'=>'form-control select2','style'=>'width: 100%']) !!}
                    
                      <span style="color: red">{!! $errors->first('category_id') !!}</span>

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                      {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}
                      <span> *</span> 
                      {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control',  'title'=>'Enter news Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                      <span style="color: red">{!! $errors->first('title') !!}</span>
                      
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                 {!! Form::label('News Slug', 'News Slug', array('class' => 'col-form-label')) !!} <span> *</span>
                 {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control', 'title'=>'Enter News Slug' ]) !!}

                 
                      <span style="color: red">{!! $errors->first('slug') !!}</span>

             </div>
              </div>

          </div>


          <div class="row">
              <div class="col-md-6">
                      <div class="form-group">

                     {!! Form::label('News Excerpt', 'News Excerpt', array('class' => 'col-form-label')) !!}
                     {!! Form::text('excerpt',Input::old('excerpt'),['id'=>'news_excerpt','class' => 'form-control', 'title'=>'Enter News Excerpt' ]) !!}
                      <span style="color: red">{!! $errors->first('excerpt') !!}</span>
                      
                     
               </div>
             </div>

              <div class="col-md-6">
                      <div class="form-group">

                     {!! Form::label('short_order', 'Short Order', array('class' => 'col-form-label')) !!}
                     {!! Form::text('short_order',Input::old('short_order'),['id'=>'short_order','class' => 'form-control', 'title'=>'Enter Serail' ]) !!}

                     
                      <span style="color: red">{!! $errors->first('short_order') !!}</span>

                   </div>
               </div>
            </div>

            <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">

                     {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
                      {!! Form::textarea('discription',Input::old('discription'),['id'=>'description','class' => '', 'title'=>'Enter Description', 'rows'=>'5']) !!}
                    </div>
                  </div>

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
                      <a target="_blank" href="{{URL::to('')}}/uploads/news/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/news/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
                      </a>
                    @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">

                       <label>Select Tags</label>
                        <select class="form-control select2" name="tag[]" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;">
                          @foreach ($tags as $tag)
                            <option value="{{$tag->id}}"
                                <?php
                                  if (isset($product_tags)) {
                                    foreach ($product_tags as  $value) {
                                      if ($value->tag_id == $tag->id) {
                                        echo "selected";
                                      }
                                    }
                                  }
                                ?>
                            >{{$tag->title}}</option>
                          @endforeach
                        </select>
                      <span style="color: red">{!! $errors->first('tag') !!}</span>

                      

                     </div>
                    </div>

          <div class="col-md-6">
            <div class="form-group">

             <label>Select frontend Place</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Select Frontend Place" name="place[]" style="width: 100%;">
                <option value="শীর্ষ সংবাদ"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'শীর্ষ সংবাদ') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >শীর্ষ সংবাদ</option>
                <option value="শীর্ষ সংবাদ তালিকা"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'শীর্ষ সংবাদ তালিকা') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >শীর্ষ সংবাদ তালিকা</option>
                <option value="জনপ্রিয় সংবাদ"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'জনপ্রিয় সংবাদ') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >জনপ্রিয় সংবাদ</option>
                <option value="সারাদেশ"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'সারাদেশ') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >সারাদেশ</option>
                <option value="সম্পাদকের পছন্দ"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'সম্পাদকের পছন্দ') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >সম্পাদকের পছন্দ</option>
                <option value="অর্থনীতি"
                    <?php
                      if (isset($news_place)) {
                        foreach ($news_place as  $value) {
                          if ($value->place == 'অর্থনীতি') {
                            echo "selected";
                          }
                        }
                      }
                    ?>
                >অর্থনীতি</option>
              </select>
            <span style="color: red">{!! $errors->first('place') !!}</span>

            

           </div>
          </div>

                    <div class="col-md-6">
                      <div class="form-group">

                        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span class="required"> *</span>
  
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control']) !!}
                        {!! $errors->first('status') !!}
                     </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        {!!  Form::label('is_featured', 'Is featured', array('class' => 'col-form-label')) !!} <span class="required"> *</span><BR>
                        
                        <label>
                          <input type="radio" name="is_feature" value="yes" class="minimal" checked>YES
                        </label>
                        <label>
                          <input type="radio" name="is_feature" value="no" class="minimal">NO
                        </label>
                        {!! $errors->first('is_featured') !!}

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

            $("#newsform").validate({
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