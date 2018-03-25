<script type="text/javascript" src="<?php echo load_lib()?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<div class="container-fluid">
	<div class="side-body">

		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info"><?php echo get_label('back');?></a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
                         <div class="form-group">
							<label for="tutor_name" class="col-sm-2 control-label"><?php echo get_label('tutor_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_name',set_value('tutor_name'),' class="form-control required"  ');?></div></div>
						</div>
						 
                         <div class="form-group">
							<label for="tutor_email" class="col-sm-2 control-label"><?php echo get_label('tutor_email').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_email',set_value('tutor_email'),' class="form-control required email"  ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="tutor_age" class="col-sm-2 control-label"><?php echo get_label('tutor_age').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_age',set_value('tutor_age'),' class="form-control required number"   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_gender" class="col-sm-2 control-label"><?php echo get_label('tutor_gender').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('tutor_gender',array('male'=>'male','female'=>'Female'),set_value('tutor_gender'),' class="form-control required"   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_city" class="col-sm-2 control-label"><?php echo get_label('tutor_city').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('tutor_city',array('madurai'=>'Madurai','trichy'=>'Trichy','chennai'=>'Chennai'),set_value('tutor_city'),' class="form-control required"   ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="tutor_address" class="col-sm-2 control-label"><?php echo get_label('tutor_address').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_address',set_value('tutor_address'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_mobile" class="col-sm-2 control-label"><?php echo get_label('tutor_mobile').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_mobile',set_value('tutor_mobile'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_qualification" class="col-sm-2 control-label"><?php echo get_label('tutor_qualification').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_qualification',set_value('tutor_qualification'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_experience" class="col-sm-2 control-label"><?php echo get_label('tutor_experience').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_experience',set_value('tutor_experience'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_subject" class="col-sm-2 control-label"><?php echo get_label('tutor_subject').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_subject',set_value('tutor_subject'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_location" class="col-sm-2 control-label"><?php echo get_label('tutor_location').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_location',set_value('tutor_location'),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_description" class="col-sm-2 control-label"><?php echo get_label('tutor_description');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('tutor_description',set_value('tutor_description'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="tutor_type" class="col-sm-2 control-label"><?php echo get_label('tutor_type');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('tutor_type',array('education'=>'Education','IT'=>'IT','career training'=>'Career Training'),set_value('tutor_type'),' class="form-control required"');?></div></div>
						</div>

						<div class="form-group">
							<label for="tutor_time" class="col-sm-2 control-label"><?php echo get_label('tutor_time');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_time',set_value('tutor_time'),' class="form-control"');?></div></div>
						</div>
						<div class="form-group">
							<label for="tutor_class" class="col-sm-2 control-label"><?php echo get_label('tutor_class');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_class',set_value('tutor_class'),' class="form-control"');?></div></div>
						</div>
						<div class="form-group">
							<label for="tutor_pay" class="col-sm-2 control-label"><?php echo get_label('tutor_pay');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('tutor_pay',set_value('tutor_pay'),' class="form-control"');?></div></div>
						</div>
						
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown('A','','class="required" style="width:374px;" ');?></div></div>
						</div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>
					<?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
