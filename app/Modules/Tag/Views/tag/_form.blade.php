  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                      {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}
                      <span> *</span> 
                      {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control',  'title'=>'Enter category Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                      <span style="color: red">{!! $errors->first('title') !!}</span>
                      
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                 {!! Form::label('Tag Slug', 'Tag Slug', array('class' => 'col-form-label')) !!} <span> *</span>
                 {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control', 'title'=>'Enter News Slug' ]) !!}
                      <span style="color: red">{!! $errors->first('slug') !!}</span>
             </div>
              </div>

              <div class="col-md-6">
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