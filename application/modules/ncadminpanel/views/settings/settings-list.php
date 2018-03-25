<div class="container-fluid">
	<div class="side-body">
		<?php echo get_template('layout/notifications','')?>	
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $module_labels;?>   </div>
						</div>    
					</div>

					<div class="card-body">
						<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
						</ul>	          
						<?php echo form_open_multipart(admin_url().$module,' class="form-horizontal" id="common_form" ' );?>
                         
                        <div class="panel panel-default setting_article">
							<div class="panel-heading"> 
								<div class="panel-title">
								 <a data-toggle="collapse" href="#basic_settings" aria-expanded="true"><i class="fa fa-plus"></i> &nbsp;<?php echo get_label('basic_details'); ?></a>
									
								</div>
							</div>
							<div id="basic_settings" class="panel-collapse collapse in">
								
								<div class="panel-body">
									<div class="form-group">
										<label for="settings_site_title" class="col-sm-2 control-label"><?php echo get_label('settings_site_title');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_site_title',stripslashes($records['settings_site_title']),' class="form-control"');?></div></div>
									</div>
									
									
									<div class="form-group">
										<label for="settings_admin_records" class="col-sm-2 control-label"><?php echo get_label('settings_records_perpage').get_required().add_tooltip('settings_admin_records');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_admin_records',stripslashes($records['settings_admin_records']),' class="form-control required number"  ');?></div></div>
									</div>
								</div>	
							</div>	
                        </div>
						<div class="clear"></div>


				 <!-- social network links start -->
                   <!--      
                        <div class="panel fresh-color panel-default setting_article">
						<div class="panel-heading"> 
                            <div class="panel-title">
							<a data-toggle="collapse" href="#socail_network"><i class="fa fa-plus"></i> &nbsp;<?php echo get_label('social_network'); ?></a>
                            </div>
                       </div>
                       <div id="socail_network" class="panel-collapse collapse">
                            <div class="panel-body">
							 <div class="form-group">
								<label for="client_name" class="col-sm-2 control-label"><?php echo get_label('youtube');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_youtube',stripslashes($records['setting_youtube_url']),' class="form-control"');?></div></div>
							</div>
							
							 <div class="form-group">
								<label for="client_company_name" class="col-sm-2 control-label"><?php echo get_label('facebook');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_facebook',stripslashes($records['setting_facebook_url']),' class="form-control"');?></div></div>
							</div>
							<div class="form-group">
								<label for="client_company_name" class="col-sm-2 control-label"><?php echo get_label('twitter');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_twitter',stripslashes($records['setting_twitter_url']),' class="form-control"');?></div></div>
							</div>
							<div class="form-group">
								<label for="client_about_company" class="col-sm-2 control-label"><?php echo get_label('instagram');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_instagram',stripslashes($records['setting_instagram_url']),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="client_records_perpage" class="col-sm-2 control-label"><?php echo get_label('google_plus');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_google_plus',stripslashes($records['setting_gplus_url']),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="client_about_company" class="col-sm-2 control-label"><?php echo get_label('pinterest');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('site_pinterest',stripslashes($records['setting_pinterest_url']),' class="form-control"');?></div></div>
							</div>
							
						</div>	
                        </div>
                        </div>
                            
                        <div class="clear"></div>   -->
                         
                         <!-- social network links end -->						
                        
                         
                        <div class="panel fresh-color panel-default setting_article">
							<div class="panel-heading"> 
								<div class="panel-title">
								<a data-toggle="collapse" href="#smptp_details"><i class="fa fa-plus"></i> &nbsp;<?php echo get_label('mail_configuration'); ?></a>
								</div>
							</div>
							<div id="smptp_details" class="panel-collapse collapse">
								<div class="panel-body">	
									<div class="form-group">
										<label for="settings_from_email" class="col-sm-2 control-label"><?php echo get_label('settings_from_email');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_from_email',stripslashes($records['settings_from_email']),' class="form-control"');?></div></div>
									</div>
									
									<div class="form-group">
										<label for="settings_to_email" class="col-sm-2 control-label"><?php echo get_label('settings_admin_email');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_admin_email',stripslashes($records['settings_admin_email']),' class="form-control"');?></div></div>
									</div>
							
									<div class="form-group">
										<label for="settings_email_footer_content" class="col-sm-2 control-label"><?php echo get_label('settings_email_footer');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('settings_email_footer',stripslashes($records['settings_email_footer']),'class="form-control" ' )?></div></div>
									</div>

									<div class="form-group">
										<label for="settings_mail_from_smtp" class="col-sm-2 control-label"><?php echo get_label('settings_send_mail_from_smptp').add_tooltip('settings_send_mail_from_smptp');?></label>
			                            <div class="col-sm-<?php echo get_form_size();?>">
											<div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
												<?php  echo form_checkbox('settings_mail_from_smtp','1',$records['settings_mail_from_smtp'],'id="settings_mail_from_smtp" class="multi_check"'); ?>
												<label for="settings_mail_from_smtp" class="chk_box_label"></label>
											</div>
										</div>
									</div>
							
									<div class="form-group">
										<label for="settings_smtp_host" class="col-sm-2 control-label"><?php echo get_label('settings_smtp_host');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_smtp_host',stripslashes($records['settings_smtp_host']),' class="form-control"  ');?></div></div>
									</div>
							
									<div class="form-group">
										<label for="settings_smtp_user" class="col-sm-2 control-label"><?php echo get_label('settings_smtp_user');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_smtp_user',stripslashes($records['settings_smtp_user']),' class="form-control"  ');?></div></div>
									</div>
							
									<div class="form-group">
										<label for="settings_smtp_pass" class="col-sm-2 control-label"><?php echo get_label('settings_smtp_pass');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_password('settings_smtp_pass',$records['settings_smtp_pass'],' class="form-control"  ');?></div></div>
									</div>
							
									<div class="form-group">
										<label for="settings_smtp_port" class="col-sm-2 control-label"><?php echo get_label('settings_smtp_port');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_smtp_port',$records['settings_smtp_port'],' class="form-control"  ');?></div></div>
									</div>
							
									<div class="form-group">
										<label for="settings_mailpath" class="col-sm-2 control-label"><?php echo get_label('settings_mailpath');?></label>
										<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('settings_mailpath',$records['settings_mailpath'],' class="form-control"  ');?></div></div>
									</div>
							
							
								</div>	
							</div>
                        </div>
                            
                        <div class="clear"></div>    


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" id="settings_submit" class="btn btn-info " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                            </div>
                        </div>
					
                   
					<?php
					echo form_hidden('edit_id',$records['settings_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			         </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    
$('#settings_submit').click(function(){
	$('.panel-collapse').removeClass('in');
	$('.panel-collapse').addClass('in');
});

</script>
