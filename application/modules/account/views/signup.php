<!DOCTYPE>
<html>
<head>
  <?php echo get_template('layout/header-includes',''); ?>
</head>
<body>

<section>

<div class="landing_page">
        <div class="login_wrap">                      
         <div class="row" style="margin:auto; text-align:center;">

         <div>
            <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo skin_url(); ?>images/rx_leaf_logo.png" alt="logo"/>
            </a>
            <br>
         </div>

      <div class="home_login_form" style="margin:auto; text-align:center; width:600px;">

       <!-- Alert message start -->

       <div id="login_msg" style="display:none;"></div>

       <?php if(!empty($signup_form_error)) { ?>
       
       <div class="alert alert-danger alert-dismissible alert_fixed" style="display:block;" id="error_hide"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul class="fa-ul">
          <li>
            <i class="fa fa-times fa-lg fa-li"></i>
            <span class="error_msg"><?php echo $signup_form_error; ?></span>
          </li>
        </ul>
      </div>

      <?php } ?>
      
      <?php if($this->session->flashdata('error')) { ?>
      
      <div class="alert alert-danger alert-dismissible alert_fixed" style="display:block;" id="error_hide"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul class="fa-ul">
          <li>
            <i class="fa fa-times fa-lg fa-li"></i>
            <span class="error_msg"><?php echo $this->session->flashdata('error'); ?></span>
          </li>
        </ul>
      </div>

      <?php } ?>

      <?php if($this->session->flashdata('sucess')) {  ?>

      <div class="alert alert-success alert-dismissible alert_fixed" style="display:block;" id="success_hide"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul class="fa-ul">
          <li>
            <i class="fa fa-check fa-lg fa-li"></i>
            <span class="success_msg"><?php echo $this->session->flashdata('sucess'); ?></span>
          </li>
        </ul>
      </div>  

      <?php } ?>

      <!-- Alert message end -->
      <?php echo form_open(base_url()."account/registration",array('id'=>'signup_form','name'=>'keep_signin','autocomplete'=>'off'));?>
      <div class="center_formsec">


        <h3 class="title text-center" style="margin-top:25px;">Sign Up</h3>

        <div class="form-group">                        
          <input type="text" class="form-control required" placeholder="First Name" value="<?php echo set_value('fname');?>"  name="fname"  id="fname">
        </div>
        <div class="form-group">                        
          <input type="text" class="form-control required" placeholder="Last Name" value="<?php echo set_value('lname');?>"   name="lname" id="lanme">
        </div> 
        <div class="form-group">                        
          <input type="email" class="form-control required email" placeholder="Email Address" name="emailaddress" value="<?php echo set_value('emailaddress');?>" id="emailaddress">
        </div> 
      
        <div class="form-group"> 
			<?php
				$options = array(''=>'Select User Typ','Physician' => 'Physician', 'Public' => 'Public');
				echo form_dropdown('user_type', $options,set_value('user_type'),'class="form-control required" id="user_type"');			
			?>
        </div>         
        <div class="form-group">                        
          <input type="text" class="form-control required" placeholder="Username" name="username" value="<?php echo set_value('username');?>" id="username">
        </div> 

        <div class="form-group">                        
          <input type="password" class="form-control required" placeholder="Password"  value=""  name="password" id="password" minlength="6">
        </div> 

        <div class="form-group">                        
          <input type="password" class="form-control required" placeholder="Confirm Password" name="cpassword"  value="" id="cpassword" equalto="#password" minlength="6">
        </div>

        <div class="form-group">                        
          <input type="text" class="form-control required" placeholder="Phone Number" value="<?php echo set_value('pnumber');?>"  name="pnumber" onkeypress="return isNumber(event)"  id="pnumber" maxlength="10">
        </div>

        <div class="form-group">                        
          <input type="text" class="form-control" placeholder="Address" value="<?php echo set_value('address');?>"  name="address"  id="address">
        </div>

        <div class="text-center login_submitsec">
          <input type="submit" class="btn btn_green btn-lg" value="sign up"  name="submit" id="submit"/>
           <p><a href="<?php echo base_url('account/login'); ?>" class="btn btn_green btn-lg">Login</a></p>
        </div>
        
      </div>
     
       <?php form_close();?>

    </div>                
  </div>   
</div>
                <div class="copy_wrap">
                    <p><?php echo sprintf(get_label('copyrights'), date('Y'));?></p>
                </div>
</section>

<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo skin_url()?>js/logins.js"></script>
<script type="text/javascript" src="<?php echo skin_url()?>js/custom.js"></script>


</body>
</html> 
