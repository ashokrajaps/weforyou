<div class="modal without_header_popup fade invitepopup" tabindex="-1" role="dialog" aria-labelledby="uploadpopup">
      <div class="modal-dialog invite-popup" role="document">
        <div class="modal-content">
            <div class="setting-tittle-top"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close-o" aria-hidden="true"></i></button></div>
          <div class="modal-header">
            <h3>Invite Users</h3>
              
          </div>
          <!--<div class="modal-body uploadpopup_body">
                <div class="title_with_img">
                    <div class="img_pro">
                        <img src="images/camm.png" alt="" class="mCS_img_loaded">
                    </div>
                    <div class="text_pro">
                        <div class="form_field">
                            <input type="text" placeholder="Type your post heading" />
                        </div>
                        <div class="form_field">
                            <textarea placeholder="Type your text here ..."></textarea>
                        </div>
                    </div>
                </div>
              <div class="clearfix"></div>
          </div>
        <div class="modal-footer">
            <div class="left_upload_option">
                <ul>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Camera"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Align"><i class="fa fa-align-left" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="GIF">GIF</a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Link"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Video"><i class="fa fa-film" aria-hidden="true"></i></a></li>
                </ul>
            </div>    
            <div class="rgt_upload_btn">
                <div class="custom_radio">
                    <input type="radio" />
                    <label>send replies to my inbox</label>
                </div>
                <input type="submit" value="Upload" />
            </div>    
        </div>-->
            
            
            <div class="invite-popup-form">
			<!------ success msg----->
				<div class="alert alert-success" id="success_div" style=""   class="success_msg"></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div>              
				<!------ success msg----->                                       
				<!------ Error msg----->
				<div class="alert alert-danger" id="error_div" style="">
					<strong><span  class="error_msg"></span></strong> 
					<a title="" class="upload_list_close" href="javascript:void(0)"><i class="fa fa-remove"></i> </a>
				</div> 				
				<!------ Error msg----->             
                <div class="form-inline">
                <div class="form-group">
							<?php echo form_open(base_url()."invite/invite_people",'id="invite_form" autocomplete= "'.form_autocomplte().'" '); ?>                  
                    
                        <input placeholder="Email Address" class="form-control required email" name="email" id="email" type="text">
                        
                 
                   
							<?php echo form_submit('invite','Invite', 'id="invite"', 'class="btn green-btnm btn-default"');?>                        
                   
                    
                         <?php echo form_close();?>                    
                </div>

                

            </div>
					<?php 
						

					?>                
                <div class="all-user-sec">
                    <h3>Invited User</h3>
                <ul class="mCustomScrollbar">
<?php
$profile_image_invite = user_profile_image('','thumb','');
$getinvite_userlist=getinviteuserlist(get_user_id()); 
if(!empty($getinvite_userlist))
{
 foreach ($getinvite_userlist as $invite_user ) { 
				
	 ?>						
                   <!-- <li>
                      <div class="search-result-inner">
                            <div class="search-result-img">
                            <img  class="img-rounded" src="<?php echo $profile_image_invite; ?>" class="profile-photo-sm pull-left mCS_img_loaded"></div>
                          <div class="search-result-heading">
                            <h5><?php echo output_value($invite_user['invite_mail_id'])  ?></h5>
                            
                        </div> 
                        </div> 
                    </li> -->
                    <li>
                      <div class="search-result-inner">
                          <div class="search-result-img">
                            <img src="<?php echo $profile_image_invite; ?>" class="profile-photo-sm pull-left mCS_img_loaded"></div>
                            <div class="search-result-heading">
                                <h5><?php echo output_value($invite_user['invite_mail_id']);  ?></h5>
                        <!--  <label>invited by Jon Snow</label> -->
                          </div>
                            
                        </div> 
                    </li>                    
<?php  } } else { ?>                       
                     
                                       <li>
                      <div class="search-result-inner">
                         <!-- <div class="search-result-img">
                            <img src="<?php echo $profile_image_invite; ?>" class="profile-photo-sm pull-left mCS_img_loaded"></div> -->
                            <div class="search-result-heading">
                                <h5>No Records Found</h5>
                          </div>
                            
                        </div> 
                    </li> 
<?php } ?>                    
                </ul>
                </div>
                
            </div>
            
            <div class="modal-footer">
    <!--  <ul>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>        
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>        
            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>        
        </ul>
                    <button type="button" class="btn-cancel">Cancel</button>
                    <button type="button" class="btn-saves-settings">Save</button>-->
        </div> 
        </div>
      </div>
</div>
