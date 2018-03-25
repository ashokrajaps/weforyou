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
							<label for="volunteer_first_name" class="col-sm-2 control-label"><?php echo get_label('volunteer_first_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_first_name',set_value('volunteer_first_name'),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="volunteer_last_name" class="col-sm-2 control-label"><?php echo get_label('volunteer_last_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_last_name',set_value('volunteer_last_name'),' class="form-control required"  ');?></div></div>
						</div>						
						<div class="form-group">
							<label for="volunteer_mobile_no" class="col-sm-2 control-label"><?php echo get_label('volunteer_mobile_no').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_mobile_no',set_value('volunteer_mobile_no'),' class="form-control required number" onkeypress="return isNumber(event)"  ');?></div></div>
						</div>
						
						<div class="form-group" id="">
							<label for="volunteer_email" class="col-sm-2 control-label"><?php echo get_label('volunteer_email');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_email',set_value('volunteer_email'),' class="form-control email"  ');?></div></div>
						</div>
						<div class="form-group" id="">
							<label for="volunteer_age" class="col-sm-2 control-label"><?php echo get_label('volunteer_age').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_age',set_value('volunteer_age'),' class="form-control required number" onkeypress="return isNumber(event)"   ');?></div></div>
						</div>						
						<div class="form-group">
							<label for="volunteer_gender" class="col-sm-2 control-label"><?php echo get_label('volunteer_gender').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>">
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_gender','male','checked="checked"','id="volunteer_gender" class="radio required"'); ?>
									<label for="volunteer_gender" class="chk_box_label">Male</label>
								</div>
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_gender','yes','','id="volunteer_gender"  class="radio required"'); ?>
									<label for="volunteer_gender" class="chk_box_label">Female</label>
								</div>
							</div>
						</div>						
						<div class="form-group">
							<label for="volunteer_way_to_contact" class="col-sm-2 control-label"><?php echo get_label('volunteer_way_to_contact').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>">
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_way_to_contact','phone','checked="checked"','id="volunteer_way_to_contact" class="radio required"'); ?>
									<label for="phone" class="chk_box_label">Phone</label>
								</div>
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_way_to_contact','mail','','id="volunteer_way_to_contact"  class="radio required"'); ?>
									<label for="mail" class="chk_box_label">Mail</label>
								</div>
							</div>
						</div>						
						<div class="form-group">
							<label for="volunteer_previous_experience" class="col-sm-2 control-label"><?php echo get_label('volunteer_previous_experience').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>">
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_previous_experience','yes','checked="checked"','id="volunteer_previous_experience" class="radio vol_exp_yes_no required"'); ?>
									<label for="volunteer_previous_experience" onClick="select_vol_exp_yes_no()" class="chk_box_label">Yes</label>
								</div>
								<div class="checkbox-inline">
									<?php  echo form_radio('volunteer_previous_experience','no','','id="volunteer_previous_experience" onClick="select_vol_exp_yes_no()"  class="radio vol_exp_yes_no required"'); ?>
									<label for="volunteer_previous_experience" class="chk_box_label">No</label>
								</div>
							</div>
						</div>

						<div class="form-group" id="vol_exp_if_yes_where_div">
							<label for="volunteer_exp_if_yes_where" class="col-sm-2 control-label"><?php echo get_label('volunteer_exp_if_yes_where');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_exp_if_yes_where',set_value('volunteer_exp_if_yes_where'),' id="volunteer_exp_if_yes_where" class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="volunteer_area_of_interest" class="col-sm-2 control-label"><?php echo get_label('volunteer_area_of_interest').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_area_of_interest_dropdown('','','class="form-control required" ');?></div></div>
						</div>						
						<div class="form-group">
							<label for="volunteer_address" class="col-sm-2 control-label"><?php echo get_label('volunteer_address');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('volunteer_address',set_value('volunteer_address'),' class="form-control "  ');?></div></div>
						</div>			
						<div class="form-group">
							<label for="volunteer_city" class="col-sm-2 control-label"><?php echo get_label('volunteer_city').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_city',set_value('volunteer_city'),' class="form-control required"  ');?></div></div>
						</div>																					
						<div class="form-group">
							<label for="volunteer_zip_postal_code" class="col-sm-2 control-label"><?php echo get_label('volunteer_zip_postal_code').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('volunteer_zip_postal_code',set_value('volunteer_zip_postal_code'),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="volunteer_country" class="col-sm-2 control-label"><?php echo get_label('volunteer_country').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
								<?php  echo get_country_list_dd('volunteer_country','','class="form-control select_search required" ');?></div></div>
							</div>
							<div class="form-group">
								<label for="volunteer_passionate_social_service" class="col-sm-2 control-label"><?php echo get_label('volunteer_passionate_social_service');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('volunteer_passionate_social_service',set_value('volunteer_passionate_social_service'),' class="form-control "  ');?></div></div>
							</div>						 
							<div class="form-group multi_field_image">
								<label for="volunteer_profile_image" class="col-sm-2 control-label"><?php echo get_label('volunteer_profile_image');?></label>
								<div class="col-sm-<?php echo get_form_size();?>">
									<div class="input_box">
										<div class="custom_browsefile"> <?php echo form_upload('volunteer_profile_image','id="volunteer_profile_image" class="form-control required');?> 
											<div style="color:red;">Image Type: jpg, png &nbsp;and&nbsp; Maximum Size: 3MB</div>
											<span class="result_browsefile">											
												<span class="brows"></span> + <?php echo get_label('volunteer_profile_image');?>
											</span>
										</div>
									</div>
								</div>
							</div>						
							<div class="form-group">
								<label for="volunteer_status" class="col-sm-2 control-label"><?php echo get_label('volunteer_status').get_required();?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown('1','','class="form-control required" style="width:374px;" ');?></div></div>
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

	<script type="text/javascript" src="<?php echo admin_skin()?>js/volunteer.js"></script>
