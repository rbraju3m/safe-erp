  <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                      {!! Form::label('name', 'Menu Name', array('class' => 'col-form-label')) !!}
                      <span> *</span> 

                      <?php
                    	$options = array();
						$options['Header Menu'] = 'header_menu';
						$options['Left Menu'] = 'left_menu';
						$options['Right Menu'] = 'right_menu';
						$options['Footer Menu'] = 'footer_menu';
                    ?>

                    

                    <select name="name" class="form-control" >
					<option value="">Select Menu Position</option>
					<?php
					if (! empty($options)) {
					 foreach ($options as $key => $val)  {
					?>
					<option value="<?php echo $key.'---'.$val;?>"  

						<?php
							if(!empty(old('name'))){
								if(old('name') == $key.'---'.$val){
									echo "selected";
								}
							}
						?>

						<?php
						if (isset($data)) {
							$menu_name =  $data->menu_key.'---'.$data->name;
							if(($menu_name) == $key.'---'.$val){
									echo "selected";
								}
							}
						?>

					><?php echo $key;?></option>
					<?php
					 }
					}
					?>

                </select>

                      
                      <span style="color: red">{!! $errors->first('name') !!}</span>
                      
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