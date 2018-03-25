
<div class="modal without_header_popup fade settingpopup" tabindex="-1" role="dialog" aria-labelledby="settingpopup">
    <div class="modal-dialog user-setting-popup" role="document">
        <div class="modal-content">
			<div class="setting-tittle-top"><i class="fa fa-cog" aria-hidden="true"></i>Settings</div>
			<!------ success msg----->
				<div class="alert alert-success" id="success_div">
					<strong><span  class="success_msg"></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div>              
				<!------ success msg----->                                       
				<!------ Error msg----->
				<div class="alert alert-danger" id="error_div">
					<strong><span  class="error_msg"></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div> 				
				<!------ Error msg-----> 
				<?php
					$user_id = get_user_id();
					$profile = get_user_profile($user_id);
				?>
			<div class="modal-header">
				<h5>User Profile Settings</h5>
			</div>
			<div class="user-pro-setting">
				<?php echo form_open_multipart(base_url()."settings/",'class="form-horizontal" id="profile_settings"');?>
					<div class="form-group">
						<label for="exampleInputName2">User Name :</label>
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
						<div class="input-group">
							<div class="input-group-addon">www.releaf.com/</div>
								<input type="text" class="form-control required border-right-hid" id="user_name" name="user_name" placeholder="type your user name here">
									<div class="input-group-addon">Name Suggestions</div>
							</div>
							<div id="userInfo" align="left"></div>
							<span class="text-desc">This will visible as your username and help other users to search profile</span>
						</div>
						<div class="form-group">
							<label for="user_email">Email address :</label>
							<?php echo form_input('user_email',stripslashes($profile['users_email']),' class="form-control required" placeholder="Email" disabled  ');?>
						</div>
						<div class="form-group">
							<label for="user_password">Password :</label>
							<?php //echo form_password('user_password','',' class="form-control"');?>
							<input type="password" id="user_password" name="user_password" class="form-control" value="">
						</div>
						<div class="form-group">
						<div class="checkbox custom-checkbox">
							<input type="radio" id="t-option" name="selector">
							<label for="t-option">Block mature content in the Posts</label>
							<div class="check"><div class="inside"></div></div>
     					</div>
						</div>
     					<div class="form-group">
							<label for="country">Country : <?php echo get_required();?></label>
							<?php echo get_country_list('country',stripslashes($profile['users_country']),' class="form-control required search-country" placeholder="Please Select Country" id="country"');?>
						</div>	
						
						<?php
							if($profile['user_type'] != "")
							{
								$user_type=$profile['user_type'];
								if($profile['user_type']=="Nonphysician")
								{
									$user_type="Non Physician";
								}
						?>			
						<div class="form-group">
							<label for="user_type">User Type : <?php echo get_required();?></label>
							<?php echo form_input('user_type',stripslashes($user_type),' class="form-control" placeholder="User Type" readonly ' );?>
							<input type="hidden" name="user_type" id="user_type" value="<?php echo $profile['user_type'];?>">										
						</div>	
						<?php	}
							else
							{ ?>		
						<div class="form-group">
							<label for="user_type">User Type : <?php echo get_required();?></label>
							<?php
								$user_type_value=isset($profile['user_type'])?$profile['user_type']:set_value('user_type');
								$options = array(''=>'Select User Type','Physician' => 'Physician', 'Nonphysician' => 'Non Physician');
								echo form_dropdown('user_type', $options,$user_type_value,'class="form-control required" id="user_type" ');	
							?>
						</div> -->
						<?php } ?>
						<div class="form-group">
							<label for="about_me">About you/ Bio :</label>
							<?php echo form_textarea('about_me',stripslashes($profile['users_about_me']),' class="form-control required" rows="3" ' );?>
						</div>
						<div class="form-group">
						<span id="fileselector">
							<label class="btn-upload" for="upload-file-selector">
							<input id="upload-file-selector" type="file">
						</span>
						</div>
						<div class="form-group social-input-group">
							<label for="exampleInputName2">Social networks :</label>
							<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
								<div class="input-group facebook-text">
									<div class="input-group-addon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
									<div class="input-group-addon">Connected to Facebook</div>
										<input type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="https://www.facebook.com/app_scoped_user_id/759458954171594/">
								</div>
								<div class="input-group twitter-text">
									<div class="input-group-addon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
										<div class="input-group-addon">Connected to Twitter</div>
											<input type="text" class="form-control" id="twitter_url" name="twitter_url" placeholder="https://www.facebook.com/app_scoped_user_id/759458954171594/">
								</div>
								<div class="input-group google-text">
									<div class="input-group-addon"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
										<div class="input-group-addon">Connected to Google +</div>
											<input type="text" class="form-control" id="google_url" name="google_url" placeholder="https://www.facebook.com/app_scoped_user_id/759458954171594/">
								</div>
						</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-danger btn-red"><i class="fa fa-trash-o" aria-hidden="true"></i>Deactivate account</button>
				<button type="button" class="btn-close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
				<button type="button" id="save_settings" class="btn-saves-settings"><i class="fa fa-check" aria-hidden="true"></i>Save Settings</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
</div>

<?php load_lib_js(array('jquery/jquery.form.min.js','jquery/jquery.validate.min.js'));?>
	<?php echo load_js(array('custom/profile_settings.js'));?>
