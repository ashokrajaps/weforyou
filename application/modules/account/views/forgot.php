<div id="forgot_popup" class="modal without_header_popup fade" tabindex="-1" role="dialog" aria-labelledby="forgotpopup">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close-o" aria-hidden="true"></i></button>
          </div>
          <div class="modal-body forgotpopup">
				<!------ success msg----->
				<div class="alert alert-success" id="success_div_forgot">
					<strong><span  class="success_msg_forgot"></span></strong> 
					<a title="" class="upload_list_close" href="#"><i class="fa fa-remove"></i> </a>
				</div>              
				<!------ success msg----->                                       
				<!------ Error msg----->
				<div class="alert alert-danger" id="error_div_forgot">
					<strong><span  class="error_msg_forgot"></span></strong> 
					<a title="" class="upload_list_close" href="#"><i class="fa fa-remove"></i> </a>
				</div> 				
				<!------ Error msg-----> 			  
                <div class="notify_message">
                    <h3><?php echo get_label('forgot_password'); ?></h3>
                </div>
                 
                  <?php
                  echo form_open(base_url()."account/forgotpassword",array('id'=>'forgot_form', 'class'=>'forgot_form', 'name'=>'forgot_form','autocomplete'=>'off'));
                  ?>
                   
                  <!--  <div class="button_group">
                        <a href="javascript:void(0)" class="active x_type" id="sign_Physician">Physician</a>
                         <a href="javascript:void(0)" class="sep_btn">|</a>
                        <a href="javascript:void(0)" class="x_type" id="sign_non_Physician">Non Physician</a>
                    </div> -->
                    <div class="login_wrap" id="login_wrap">
                        <div class="form-group">
                           <?php echo  form_input('forgot_email_address',(isset($_COOKIE['forgot_email_address']) && $_COOKIE['forgot_email_address']!='' )? $_COOKIE['forgot_email_address'] : "",'placeholder="'. get_label('email_address') .'" required="required"');?>							
                        </div>
                       
                        <div class="form-group-btn">
							<?php echo form_submit('forgot','Send', 'id="forgot_button"', 'class="btn btn-primary"');?>							
                        </div>
                    </div>
                    <?php echo form_close(); ?>
          </div>
        </div>
      </div>
</div>

