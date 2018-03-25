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
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;"></ul>	          

					<?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
						<div class="form-group">
							<label for="stu_first_name" class="col-sm-2 control-label"><?php echo get_label('stu_first_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_first_name',stripslashes($records['stu_first_name']),' class="form-control required"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="stu_last_name" class="col-sm-2 control-label"><?php echo get_label('stu_last_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_last_name',stripslashes($records['stu_last_name']),' class="form-control required"  ');?></div></div>
						</div>
						 
                         <div class="form-group">
							<label for="stu_email" class="col-sm-2 control-label"><?php echo get_label('stu_email').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_email',stripslashes($records['stu_email']),' class="form-control required email"  ');?></div></div>
						</div>
						
						
						
                         <div class="form-group">
							<label for="stu_father_name" class="col-sm-2 control-label"><?php echo get_label('stu_father_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_father_name',stripslashes($records['stu_father_name']),' class="form-control required"   ');?></div></div>
						</div>
						<?php /*
						<div class="form-group">
							<label for="tutor_gender" class="col-sm-2 control-label"><?php echo get_label('tutor_gender').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('tutor_gender',array('male'=>'male','female'=>'Female'),stripslashes($records['tutor_email']),' class="form-control required"   ');?></div></div>
						</div>*/ ?>
						
                         <div class="form-group">
							<label for="stu_course_name" class="col-sm-2 control-label"><?php echo get_label('stu_course_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_course_name',stripslashes($records['stu_course_name']),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="stu_address" class="col-sm-2 control-label"><?php echo get_label('stu_address').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_address',stripslashes($records['stu_address']),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="stu_mobile" class="col-sm-2 control-label"><?php echo get_label('stu_mobile').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_mobile',stripslashes($records['stu_mobile']),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="stu_location" class="col-sm-2 control-label"><?php echo get_label('stu_location').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('stu_location',stripslashes($records['stu_location']),' class="form-control required "   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="stu_description" class="col-sm-2 control-label"><?php echo get_label('stu_description');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('stu_description',stripslashes($records['stu_description']),' class="form-control"  ');?></div></div>
						</div>
						
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown($records['stu_status'],'','class="required" style="width:374px;" ');;?></div></div>
						</div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>
					<input type="hidden" value="" name="remove_image" id="remove_image">
					<?php
					echo form_hidden('edit_id',$records['id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
