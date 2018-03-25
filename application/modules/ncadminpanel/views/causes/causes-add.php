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
							<label for="causes_title" class="col-sm-2 control-label"><?php echo get_label('causes_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('causes_title',set_value('causes_title'),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="causes_description" class="col-sm-2 control-label"><?php echo get_label('causes_description').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('causes_description',set_value('causes_description'),' class="form-control required"  ');?></div></div>
						</div>						 
                         <div class="form-group">
							<label for="causes_budget" class="col-sm-2 control-label"><?php echo get_label('causes_budget').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('causes_budget',set_value('causes_budget'),' class="form-control required number" onkeypress="return isNumber(event)"  ');?></div></div>
						</div>
						
				<div class="form-group">
                    <label for="causes_is_donation_need" class="col-sm-2 control-label"><?php echo get_label('causes_is_donation_need').get_required();?></label>
						<div class="col-sm-<?php echo get_form_size();?>">
							 <div class="checkbox-inline">
										<?php  echo form_radio('causes_is_donation_need','yes','checked="checked"','id="causes_is_donation_need" onClick="select_donation_rnr()" class="radio required"'); ?>
								<label for="causes_is_donation_need" class="chk_box_label">Yes</label>
							</div>
							<div class="checkbox-inline">
										<?php  echo form_radio('causes_is_donation_need','no','','id="causes_is_donation_need" onClick="select_donation_rnr()"  class="radio required"'); ?>
								<label for="causes_is_donation_need" class="chk_box_label">No</label>
							</div>
						</div>
                </div>						
                         <div class="form-group" id="how_much_donation_need_div">
							<label for="causes_how_much_donation_need" class="col-sm-2 control-label"><?php echo get_label('causes_how_much_donation_need').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('causes_how_much_donation_need',set_value('causes_is_donation_need'),' id="causes_how_much_donation_need" class="form-control required number"  onkeypress="return isNumber(event)"   ');?></div></div>
						</div>
						
				<div class="form-group">
                    <label for="causes_is_volunteers_needed" class="col-sm-2 control-label"><?php echo get_label('causes_is_volunteers_needed').get_required();?></label>
						<div class="col-sm-<?php echo get_form_size();?>">
							 <div class="checkbox-inline">
										<?php  echo form_radio('causes_is_volunteers_needed','yes','checked="checked"','id="causes_is_volunteers_needed" onClick="select_volunteer_rnr()" class="radio required"'); ?>
								<label for="causes_is_volunteers_needed" class="chk_box_label">Yes</label>
							</div>
							<div class="checkbox-inline">
										<?php  echo form_radio('causes_is_volunteers_needed','no','','id="causes_is_volunteers_needed" onClick="select_volunteer_rnr()"  class="radio required"'); ?>
								<label for="causes_is_volunteers_needed" class="chk_box_label">No</label>
							</div>
						</div>
                </div>

                         <div class="form-group" id="how_much_volunteers_need_div">
							<label for="causes_how_much_volunteers_need" class="col-sm-2 control-label"><?php echo get_label('causes_how_much_volunteers_need').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('causes_how_much_volunteers_need',set_value('causes_how_much_volunteers_need'),'id="causes_how_much_volunteers_need"  class="form-control required number" onkeypress="return isNumber(event)"   ');?></div></div>
						</div>
						
						<div class="form-group multi_field_image">
							 <label for="causes_image" class="col-sm-2 control-label"><?php echo get_label('causes_image');?></label>
							 <div class="col-sm-<?php echo get_form_size();?>">
								  <div class="input_box">
										<div class="custom_browsefile"> <?php echo form_upload('causes_image','id="causes_image" class="form-control required');?> 
										<div style="color:red;">Image Type: jpg, png &nbsp;and&nbsp; Maximum Size: 3MB</div>
										   <span class="result_browsefile">											
											   <span class="brows"></span> + <?php echo get_label('causes_image');?>
										   </span>
										</div>
								  </div>
							</div>
						</div>						
				<div class="form-group">
                    <label for="causes_show_home_page" class="col-sm-2 control-label"><?php echo get_label('causes_show_home_page').get_required();?></label>
						<div class="col-sm-<?php echo get_form_size();?>">
							 <div class="checkbox-inline">
										<?php  echo form_radio('causes_show_home_page','yes','checked="checked"','id="yes"  class="radio required"'); ?>
								<label for="yes" class="chk_box_label">Yes</label>
							</div>
							<div class="checkbox-inline">
										<?php  echo form_radio('causes_show_home_page','no','','id="no"  class="radio required"'); ?>
								<label for="no" class="chk_box_label">No</label>
							</div>
						</div>
                </div>						
						<div class="form-group">
							<label for="causes_status" class="col-sm-2 control-label"><?php echo get_label('causes_status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown_causes('1','','class="required" style="width:374px;" ');?></div></div>
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

    <script type="text/javascript" src="<?php echo admin_skin()?>js/causes.js"></script>
