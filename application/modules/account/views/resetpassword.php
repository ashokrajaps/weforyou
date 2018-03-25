
<!DOCTYPE html>
<head>
	<?php echo get_template('layout/header');?>
  <script type="text/javascript">

  var RESET_KEY = "<?php echo $reset_key; ?>";

  </script>	
</head>
<body>
<header>
	<!----------------- header_top -----------------> 
	<div class="header_top">
		<?php echo get_template('layout/header-top');?>
    </div>
	<!----------------- header_top ----------------->
	<!----------------- header_bottom ----------------->	    		
	<div class="header_bottom">
    </div>
	<!----------------- header_bottom ----------------->    	
</header>
<section>
    <div class="container">
	
        <div class="forgot_password_wrap">
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
            <h3><?php echo get_label('reset_password'); ?></h3>
                        <?php
                        echo form_open("",array('id'=>'reset_form', 'class'=>'reset_form', 'name'=>'reset_form','autocomplete'=>'off'));
                        ?>            
				<div class="form-group">
					<div class="input_field">
						<input type="password" class="form-control required" placeholder="New Password"  value=""  name="reset_pass" id="reset_pass" minlength="6">
					</div>				
					<div class="input_field">
							  <input type="password" class="form-control required" placeholder="Confirm Password" name="reset_cpass"  value="" id="cpassword" equalto="#password" minlength="6">
					</div>
					<div class="btnn-group">
							  <input type="submit" class="btn btn_green btn-lg" id="reset_submit" value="Submit" name="submit" />
					</div>
				</div>
                        <?php echo form_close(); ?>        
        </div>
    </div>
</section>
<footer>

	<!----------------- footer_bottom ----------------->	    
    <div class="footer_bottom">
		<?php echo get_template('layout/footer-bottom');?>
    </div>
	<!----------------- footer_bottom ----------------->    
</footer>
  
	<!----------------- footer-includes ----------------->
	<?php echo get_template('layout/footer-includes');?>
	<!----------------- footer-includes ----------------->	
	<?php load_lib_js(array('jquery/jquery.form.min.js','jquery/jquery.validate.min.js'));?>
	<?php echo load_js(array('custom/account.js'));?>
</body>
</html>
