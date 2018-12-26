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
<?php
// echo "<pre>";
// print_r($records);
// echo "</pre>";
// echo get_date_formart($records['event_start_date']);
?>
                         <div class="form-group">
							<label for="event_title" class="col-sm-2 control-label"><?php echo get_label('event_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_title',stripslashes($records['event_title']),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="event_description" class="col-sm-2 control-label"><?php echo get_label('event_description').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('event_description',stripslashes($records['event_description']),' class="form-control required"  ');?></div></div>
						</div>						 
                         <div class="form-group">
							<label for="event_start_date" class="col-sm-2 control-label"><?php echo get_label('event_start_date').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_start_date',get_date_formart($records['event_start_date']),' class="form-control date_picker required " ');?></div></div>
						</div>
                         <div class="form-group"  id="">
							<label for="event_end_date" class="col-sm-2 control-label"><?php echo get_label('event_end_date').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_end_date',get_date_formart($records['event_end_date']),' class="form-control date_picker required" ');?></div></div>
						</div>
						<div class="form-group">
						    <label for="event_each_day" class="col-sm-2 control-label"><?php echo get_label('event_start_end_time').get_required(); ?></label>
							<div class="col-sm-2"><div class="input_box"><?php  echo form_input('event_start_time',($records['event_start_time']),' placeholder="Start time"  class="form-control time_picker required "  ');?></div></div>						    
							<div class="col-sm-2"><div class="input_box"><?php  echo form_input('event_end_time',($records['event_end_time']),' placeholder="End time" class="form-control time_picker required" ');?></div></div>						    
							<div class="col-sm-<?php echo get_form_size();?>">
								<?php if($records['event_each_day']=="yes") { $checked3 = 'checked="checked"'; } else {$checked3=''; }; ?>								 	
								<div class="input_box">
								    <input type="checkbox" id="event_each_day" name="event_each_day" value="yes" <?php echo $checked3; ?> >All Day
									</div></div>						    
						</div>
				<div class="form-group">
                    <label for="event_is_registration_need" class="col-sm-2 control-label"><?php echo get_label('event_is_registration_need').get_required();?></label>
						<div class="col-sm-<?php echo get_form_size();?>">
							 <div class="checkbox-inline">
								<?php if($records['event_is_registration_need']=="yes") { $checked1 = 'checked="checked"'; } else {$checked1=''; }; ?>								 	
										<?php  echo form_radio('event_is_registration_need','yes',$checked1,'id="event_is_registration_need" onClick="select_registration_rnr()" class="radio required"'); ?>
								<label for="event_is_registration_need" class="chk_box_label">Yes</label>
							</div>
							<div class="checkbox-inline">
								<?php if($records['event_is_registration_need']=="no") { $checked1 = 'checked="checked"'; } else {$checked1=''; }; ?>									
										<?php  echo form_radio('event_is_registration_need','no',$checked1,'id="event_is_registration_need" onClick="select_registration_rnr()"  class="radio required"'); ?>
								<label for="event_is_registration_need" class="chk_box_label">No</label>
							</div>
						</div>
                </div>						
                         <div class="form-group event_is_registration_div">
							<label for="event_transaction_total_amount" class="col-sm-2 control-label"><?php echo get_label('event_transaction_total_amount').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_registration_fees',stripslashes($records['event_registration_fees']),' id="event_registration_fees" class="form-control required number is_registration_input"  onkeypress="return isNumber(event)"   ');?></div></div>
						</div>
                         <div class="form-group event_is_registration_div">
							<label for="event_registration_start_date" class="col-sm-2 control-label"><?php echo get_label('event_registration_start_date').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_registration_start_date',get_date_formart($records['event_registration_start_date']),' class="form-control date_picker required" onkeypress="return isNumber(event)" ');?></div></div>
						</div>
                         <div class="form-group event_is_registration_div">
							<label for="event_registration_end_date" class="col-sm-2 control-label"><?php echo get_label('event_registration_end_date').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_registration_end_date',get_date_formart($records['event_registration_end_date']),' class="form-control date_picker required" onkeypress="return isNumber(event)" ');?></div></div>
						</div>						
                         <div class="form-group event_is_registration_div">
							<label for="event_registration_max_member_count" class="col-sm-2 control-label"><?php echo get_label('event_registration_max_member_count').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_registration_max_member_count',stripslashes($records['event_registration_max_member_count']),' class="form-control required" onkeypress="return isNumber(event)"');?></div></div>
						</div>
                         <div class="form-group event_is_registration_div">
							<label for="event_registration_remainder_alert" class="col-sm-2 control-label"><?php echo get_label('event_registration_remainder_alert').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_registration_remainder_alert',stripslashes($records['event_registration_remainder_alert']),' class="form-control date_picker required" ');?></div></div>
						</div>
						<div class="form-group event_is_registration_div">
							<label for="event_terms_and_conditions" class="col-sm-2 control-label"><?php echo get_label('event_terms_and_conditions').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('event_terms_and_conditions',stripslashes($records['event_terms_and_conditions']),' class="form-control required is_registration_input"  ');?></div></div>
						</div>						
							
						<div class="form-group">
						    <label for="event_have_phy_location" class="col-sm-2 control-label"><?php echo get_label('event_have_phy_location').get_required();?></label>
						<div class="col-sm-<?php echo get_form_size();?>">
							 <div class="checkbox-inline">
								<?php if($records['event_have_phy_location']=="yes") { $checked2 = 'checked="checked"'; } else {$checked2=''; }; ?>									
										<?php  echo form_radio('event_have_phy_location','yes',$checked2,'id="yes"  class="radio required"'); ?>
								<label for="yes" class="chk_box_label">Yes</label>
							</div>
							<div class="checkbox-inline">
								<?php if($records['event_have_phy_location']=="no") { $checked2 = 'checked="checked"'; } else {$checked2=''; }; ?>									
										<?php  echo form_radio('event_have_phy_location','no',$checked2,'id="no"   class="radio required"'); ?>
								<label for="no" class="chk_box_label">No</label>
							</div>
						</div>						    
						</div>
							
                         <div class="form-group event_phy_location_div" id="">
							<label for="event_address" class="col-sm-2 control-label"><?php echo get_label('event_address').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_address',stripslashes($records['event_address']),' class="form-control required  epl_cls " ');?></div></div>
						</div>						
                         <div class="form-group event_phy_location_div"  id="">
							<label for="event_city_town" class="col-sm-2 control-label"><?php echo get_label('event_city_town').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_city_town',stripslashes($records['event_city_town']),' class="form-control required  epl_cls "  ');?></div></div>
						</div>
                         <div class="form-group event_phy_location_div"  id="">
							<label for="event_state_country" class="col-sm-2 control-label"><?php echo get_label('event_state_country').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_state_country',stripslashes($records['event_state_country']),' class="form-control required  epl_cls " ');?></div></div>
						</div>

                         <div class="form-group event_phy_location_div"  id="">
							<label for="event_post_code" class="col-sm-2 control-label"><?php echo get_label('event_post_code').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_post_code',stripslashes($records['event_post_code']),' class="form-control required  epl_cls " ');?></div></div>
						</div>

                         <div class="form-group event_phy_location_div"  id="">
							<label for="event_region" class="col-sm-2 control-label"><?php echo get_label('event_region');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('event_region',stripslashes($records['event_region']),' class="form-control " ');?></div></div>
						</div>

                         <div class="form-group event_phy_location_div"  id="">
							<label for="event_country" class="col-sm-2 control-label"><?php echo get_label('event_country').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo get_country_list_dd('event_country',stripslashes($records['event_country']),'class="form-control select_search required  epl_cls " ');?>
								</div></div>
						</div>																					
						<div class="form-group multi_field_image">
							 <label for="event_image" class="col-sm-2 control-label"><?php echo get_label('event_image');?></label>
							 <div class="col-sm-<?php echo get_form_size();?>">
								  <div class="input_box">
										<div class="custom_browsefile"> 
											<?php echo form_upload('event_image','id="event_image" class="form-control required');?> 
										<div style="color:red;"><?php echo get_label('image_type_size_info');?></div>
										   <span class="result_browsefile">											
											   <span class="brows"></span> + <?php echo get_label('event_image');?>
										   </span>
										</div>
								  </div>
							</div>
						</div>
						<div class="form-group multi_field_image">
							 <label for="event_file_name" class="col-sm-2 control-label"><?php echo get_label('event_file_name');?></label>
							 <div class="col-sm-<?php echo get_form_size();?>">
								  <div class="input_box">
										<div class="custom_browsefile"> 
											<?php echo form_upload('event_file_name[]','id="event_file_name"  class="form-control required" ','multiple="multiple"' );?> 
										<div style="color:red;"><?php echo get_label('image_type_size_info');?></div>
										   <span class="result_browsefile">											
											   <span class="brows"></span> + <?php echo get_label('event_file_name');?>
										   </span>
										</div>
								  </div>
							</div>
						</div>								
						<div class="form-group">
							<label for="event_status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>">
								<div class="input_box">
									<?php  echo get_status_dropdown_causes($records['event_status'],'','class="required" style="width:374px;" ');;?>
									</div>
							</div>
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
					echo form_hidden('edit_id',$records['event_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
    <script type="text/javascript" src="<?php echo admin_skin('js/event.js')?>"></script>
