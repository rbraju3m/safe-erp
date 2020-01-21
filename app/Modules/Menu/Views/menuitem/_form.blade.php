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
                    {!! Form::label('menudata', 'Menu Name', array('class' => 'col-form-label')) !!} <span> *</span>
                    <select name="menu_id" id="menu_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select menu</option>
                    
                    @foreach ($menudata as $value)
                        <option value="{{$value->id}}"
                        	
                        		@if ($value->id == input::old(menu_id))
		                          {{'selected'}}
		                        @endif
                        	
                        

                        		@if ($value->id == $data['menu_id'])
		                          {{'selected'}}
		                        @endif
                        	
                        
                        >{{$value->menu_key}}</option>
                    @endforeach
                      </select>
                      <span style="color: red">{!! $errors->first('menu_id') !!}</span>
              </div>
            </div>


            <div class="col-md-3">
              <div class="form-group">
                    {!! Form::label('Short Order','Short Order', array('class' => 'col-form-label')) !!} <span> *</span>

                {!! Form::text('short_order',Input::old('short_order'),['class' => 'form-control','placeholder'=>'Enter Sorting Number !']) !!}

                      <span style="color: red">{!! $errors->first('short_order') !!}</span>
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