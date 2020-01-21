  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-5">
              <div class="form-group">
                      {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}
                      <span> *</span> 
                      {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control',  'title'=>'Enter breaking news Title']) !!}
                      <span style="color: red">{!! $errors->first('title') !!}</span>
                      
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                 {!! Form::label('link', 'News Link', array('class' => 'col-form-label')) !!} <span> *</span>
                 {!! Form::text('link',Input::old('link'),['id'=>'link','class' => 'form-control', 'title'=>'Enter News link' ]) !!}
                      <span style="color: red">{!! $errors->first('link') !!}</span>
             </div>
              </div>

              <div class="col-md-3">
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

    