<?php
$success_msg="";
$error_msg="";
if($this->session->flashdata('account_success_msg') !="")
{
	$success_msg=$this->session->flashdata('account_success_msg');
}
if($this->session->flashdata('account_error_msg') !="")
{
	$error_msg=$this->session->flashdata('account_error_msg');
}	
?>
<div id="loginpopup" class="modal without_header_popup fade loginpopup login-popup-new " tabindex="-1" role="dialog" aria-labelledby="loginpopup">

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
          </div>
				<!------ login section ----->          
          <div class="modal-body login_popup">
                <div class="notify_message">
                    <h3><span id="title_div">Welcome to RxLeaf</span></h3>
                </div>
              <span class="form-disp-txt">Lorem Ipsum is simply dummy text of the printing and typesetting</span>
			<!------ success msg----->
				<div class="alert alert-success" id="success_div" style="display: <?php echo  ($success_msg !="")? 'block' : 'none'; ?>;">
					<strong><span  class="success_msg"><?php echo $success_msg;?></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div>              
				<!------ success msg----->                                       
				<!------ Error msg----->
				<div class="alert alert-danger" id="error_div" style="display: <?php echo  ($error_msg !="")? 'block' : 'none'; ?>;">
					<strong><span  class="error_msg"><?php echo $error_msg;?></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div> 				
				<!------ Error msg-----> 
	
                    <div class="login_wrap" id="login_wrap">
          				<!------ login section ----->						
						<div class="" id="login_section">	
							<?php echo form_open(base_url()."account/login",'id="login_form" autocomplete= "'.form_autocomplte().'" '); ?>	
							<div class="button_group">
								<a href="javascript:void(0)" class="y_type active" id="sign_home_Physician">Physician</a>
								<a href="javascript:void(0)" class="sep_btn">|</a>
								<a href="javascript:void(0)" class="y_type" id="sign_non_home_Physician">Non Physician</a>
							</div>												   
							<input type="hidden" name="user_type" id="user_type"> 											
							<div class="form-group email_field">
							   <?php echo  form_input('email_address',set_value('email_address'),'placeholder="'. get_label('email_address') .'" required="required"');?>							
							</div>
							<div class="form-group password_field">
									<?php echo  form_password('password',set_value('password'),'placeholder="'. get_label('password') .'" required="required"');?>
							</div> 
							<input type="hidden" name="action" id="action" value="<?php echo get_label('action_login'); ?>">
                       
							<div class="form-group-btn">
							<?php echo form_submit('submit',get_label('sign_in'), 'id="login_submit"', 'class="btn btn-primary"');?>							
                        </div>
                        <div class="forgot_link">
                          <a href="javascript:void(0)" class="link_txt signup_btn" id="join_link" ><?php echo get_label('click_to_join'); ?> </a>							
                            <p><?php echo get_label('forgot_password'); ?> <a href="javascript:void(0)" class="link_txt forgot_btn" >Get help </a></p>
                        </div> 
                         <?php echo form_close();?>
                       </div>
          				<!------ login section ----->          				
          				<!------ registration section ----->                        
					   <div class="" id="registration_section" style="display:none"> 
							<?php echo form_open(base_url()."account/registration",array('id'=>'signup_form','name'=>'keep_signin','autocomplete'=>'off'));?>	
							<div class="button_group">
								<a href="javascript:void(0)" class="x_type active" id="sign_Physician">Physician</a>
								 <a href="javascript:void(0)" class="sep_btn">|</a>
								<a href="javascript:void(0)" class="x_type" id="sign_non_Physician">Non Physician</a>
							</div>												   
							<input type="hidden" name="users_type" id="users_type">  						   
							<div class="login_wrap" id="login_wrap">
								<div class="">
									<div class="input_field tow-colnm">
										<input type="text" class="form-control required" placeholder="First Name" value="<?php echo set_value('first_name');?>"  name="first_name"  id="first_name">
									</div>
									<div class="input_field tow-colnm">
										<input type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name');?>"   name="last_name" id="last_name">
									</div>																		
									<div class="input_field">
										<?php echo form_input('email_address',set_value('email_address'),' class="form-control required" placeholder="Email Address"  ');?>
									</div>
									<div class="input_field">
										<input type="password" class="form-control required" placeholder="Password"  value=""  name="password" id="password" minlength="6">
									</div>
                                    <div class="input_field">
											  <input type="text" class="form-control required" placeholder="Physician Certificate Number">
									</div>
									<!--<div class="input_field">
											  <input type="password" class="form-control required" placeholder="Confirm Password" name="cpass"  value="" id="cpass" equalto="#password" minlength="6">
									</div>									
									<div class="input_field">
										<?php // echo form_input('phone_no',set_value('phone_no'),' class="form-control required" placeholder="Phone No" onkeypress="return isNumber(event)"  maxlength="10" minlength="10"');?>
									</div>
									<div class="input_field">
										<?php // echo form_input('users_zipcode',set_value('users_zipcode'),' class="form-control required" placeholder="Zip Code"  onkeypress="return isNumber(event)"  minlength="6" maxlength="6"');?>
									</div>-->																		
								</div>
							   
								<div class="form-group-btn">
									<?php echo form_submit('signin','Sign up', 'id="signin_submit"', 'class="btn btn-primary"');?>							
								</div>
							</div>
                        <div class="forgot_link">
                          <a href="javascript:void(0)" class="link_txt signin_btn" id="back_to_home" > <?php echo get_label('login'); ?> </a>							
                            <p><?php echo get_label('forgot_password'); ?> <a href="javascript:void(0)" class="link_txt forgot_btn" >Get help </a></p>
                        </div>	
						<?php echo form_close();?>                        												   
					   </div>
          				<!------ registration section -----> 
          				<!------ forgot section ----->           									   
					   <div class="" id="forgot_section" style="display:none"> 
						  <?php
						  echo form_open(base_url()."account/forgotpassword",array('id'=>'forgot_form', 'class'=>'forgot_form', 'name'=>'forgot_form','autocomplete'=>'off'));
						  ?>						   
							<div class="login_wrap" id="login_wrap">
								<div class="form-group">
								   <?php echo  form_input('forgot_email_address',set_value('forgot_email_address'),'placeholder="'. get_label('email_address') .'" required="required"');?>							
								</div>
								<div class="form-group-btn">
									<?php echo form_submit('forgot','Send', 'id="forgot_submit"', 'class="btn btn-primary"');?>							
								</div>
							</div>	
							<div class="forgot_link">
                             <a href="javascript:void(0)" class="link_txt signin_btn" >
								 <?php echo get_label('login'); ?> </a> <br>								
							<!--<a href="javascript:void(0)" class="link_txt signup_btn" ><?php echo get_label('click_to_join'); ?></a> -->							

							</div>													   
						 <?php echo form_close(); ?>
					   </div> 
          				<!------ forgot section -----> 			
          				<div id="social_icon" style="display:none;">		    					                         
                        <h4 class="seperator"><span>or</span></h4>
                        <a href="<?php echo $twitter_authUrl."&scope=email"; ?>" class="twit_btn"><i class="fa fa-twitter" aria-hidden="true"></i><?php echo get_label('twitter_link'); ?></a>
                        <a href="<?php echo $loginurl."&scope=email"; ?>" class="face_btn"><i class="fa fa-facebook" aria-hidden="true"></i> <?php echo get_label('facebook_link'); ?></a>
                  <a href="<?php echo $google_authUrl; ?>" class="google_btn"><span><i class="fa fa-google-plus" aria-hidden="true"></i></span><?php echo get_label('google_link'); ?></a>                        
                    </div> </div>
          				<!------ Reset section ----->
						<div class="login_wrap" id="reset_wrap" style="display:none">
						  <?php
							echo form_open("",array('id'=>'reset_form', 'class'=>'reset_form', 'name'=>'reset_form','autocomplete'=>'off'));
						  ?>						
						  <script type="text/javascript">
								var RESET_KEY = "<?php echo $this->session->userdata('resetpassword_key'); ?>";
						  </script>							     
							<div class="login_wrap" id="login_wrap">
								<div class="input_field">
									<input type="password" class="form-control required" placeholder="New Password"  value=""  name="reset_pass" id="reset_pass" minlength="6">
								</div>				
								<div class="input_field">
										  <input type="password" class="form-control required" placeholder="Confirm Password" name="reset_cpass"  value="" id="cpassword" equalto="#password" minlength="6">
								</div>
								<div class="form-group-btn">
									<?php echo form_submit('Submit','Submit', 'id="reset_submit"', 'class="btn btn-primary"');?>							
								</div>
							</div>	
												   
						 <?php echo form_close(); ?>							
						</div>							          				
          				<!------ Reset section ----->          				
                    
                <p class="serv_text">Creating an account means you’re OK with RxLeaf’s <a href="terms-conditions" target="_blank">Terms of Service</a> and <a href="privacy-policy" target="_blank">Privacy Policy</a></p>
          </div>
           				          				          				
          
        </div>
      </div>
</div>

<script>
	$(document).ready(function() { 
		$('#join_link,#sign_home_Physician,#sign_Physician').on('click', function() {
			$('#social_icon').hide();
			$('#sign_non_home_Physician').removeClass('x_type active');
			$('#sign_non_home_Physician').addClass('x_type');
			$('#sign_home_Physician').addClass('x_type active');
			
			$('#sign_non_Physician').removeClass('x_type active');
			$('#sign_non_Physician').addClass('x_type');
			$('#sign_Physician').addClass('x_type active');
		
		});
	
		$('#sign_non_home_Physician,#sign_non_Physician').on('click', function() { 
			$('#social_icon').show();
			$('#sign_home_Physician').removeClass('x_type active');
			$('#sign_home_Physician').addClass('x_type');
			$('#sign_non_home_Physician').addClass('x_type active');
			
			$('#sign_Physician').removeClass('x_type active');
			$('#sign_Physician').addClass('x_type');
			$('#sign_non_Physician').addClass('x_type active');
			
		});
	});
</script>
