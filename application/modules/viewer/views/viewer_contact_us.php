<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
    
?>
							
<div class="content-area">
	<div class="middle-align">
		<h1 >Contact Us</h1>
		<div class="panel panel-default">
			<div class="panel-body">
			<div class="col-sm-12">
			<!-- <iframe src="http://maps.google.com/?ll=39.774769,-74.86084" 
			width="100%" height="300" frameborder="0"></iframe> -->
				</div>
			<div class="col-sm-6">
				<!-- success msg -->
				<strong><span><ul id="custom_msg" class="alert"></ul></span></strong>
				<!-- Error msg -->

				<div class="" id="frm_contactform_main">
					<form name="contactform" id="contactform" class="form" action="contactform_main" method="post">
						<div class="col-sm-12">
						<div class="form-group">
							<input type="text" class="form-control" name="enquiry_name" placeholder="Name *" required="">
						</div>
						</div>
						<div class="col-sm-12">
						
						<div class="form-group">
								<input type="email" class="form-control" name="enquiry_email" placeholder="Email *" required="">
								</div>
								</div>
						<div class="col-sm-12">
								
								<div class="form-group">
									<input type="tel" class="form-control" name="enquiry_phone" placeholder="Phone *" required="">
									</div>
									</div>
						<div class="col-sm-12">
									
									<div class="form-group">
											<textarea class="form-control" rows=5 name="enquiry_comment" placeholder="Message *" required=""></textarea>
									</div>
									</div>
						<div class="col-sm-12">
									
									<div class="form-group pull-right">
													<input type="submit" name="c_submit" value="Submit" class="btn btn-primary">
												
									<input type="hidden" name="action" value="Add" placeholder="Phone" required="">
									</div>
									</div>
							</form>
					</div>
				</div>
									
								

			
			
			<!-- .entry-header -->
		
			<div class="col-sm-6">
											<div class="panel panel-default">
											<div class="panel-body">
											<p>No 50, ECR Main Road, Near RTO Office, Thiruvanmiyur, Chennai-41 </p>
												<div class="phone-no">
													<p>
														<strong>Phone:</strong>+91 9551203896
													</p>
													<p>
														<strong>E-mail:</strong>
														<a href="mailto:contact@weforyou.com">contact@weforyou.ngo</a>
													</p>
													<p>
														<strong>Website:</strong>
														<a href="<?php echo base_url();?>" target="_blank">www.weforyou.ngo</a>
													</p>
												</div>
												<!-- <h6>Follow Us</h6>
												<div class="social-icons">
													<a href="#" target="_blank" class="fa fa-facebook fa-lg" title="facebook"></a>
													<a href="#" target="_blank" class="fa fa-twitter fa-lg" title="twitter"></a>
													<a href="#" target="_blank" class="fa fa-linkedin fa-lg" title="linkedin"></a>
													<a href="#" target="_blank" class="fa fa-pinterest fa-lg" title="pinterest"></a>
													<a href="#" target="_blank" class="fa fa-google-plus fa-lg" title="google-plus"></a>
													<a href="#" target="_blank" class="fa fa-youtube fa-lg" title="youtube"></a>
													<a href="#" target="_blank" class="fa fa-instagram fa-lg" title="instagram"></a>
												</div> -->
											</div>
											</div>
											
											</div>

										
			
				<!-- .contact_left -->
				
				</div>					
			
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d971.9870338266118!2d80.25806972594681!3d12.975169118312426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d43be267b5b%3A0xe5c4bb65b60d44ca!2s50%2C+SH+49%2C+Valmiki+Nagar%2C+Kannappa+Nagar%2C+Thiruvanmiyur%2C+Chennai%2C+Tamil+Nadu+600041!5e0!3m2!1sen!2sin!4v1521999786854" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen ></iframe>			
			
			
			
			
			
			
			
			
			
			
				</div>
				</div>
				</div>
				</div>

				
				</div>
				<?php 
   echo get_template('layout/footer_include');

    echo get_template('layout/footer');
?>

<script type="text/javascript">
$("#contactform").validate({
    ignore: "",
    submitHandler: function() {
        $('#contactform').ajaxSubmit({
            url: base_url + "viewer/contactus",
            data: $('#contactform').serialize(),
            type: 'POST',
            dataType: "json",
            success: function(data) { 
                if (data.status == "success") 
                {
		                show_success_error(data.status,data.message);				
						document.getElementById("contactform").reset();
                } 
                else if (data.status == "error") 
                {
		                show_success_error(data.status,data.message);				
						return false;
                }
            }
        });

    }
});	

</script>