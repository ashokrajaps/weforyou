<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
    
?>
<style type="text/css">
.addrcls{
	margin-left: 223px;
}
</style>
	<div class="content-area">
		<div class="middle-align">
			<h1>We for Education 2020</h1>
			<div class="panel panel-default">
				<div class="panel-body">
<div class="row">
	<div class="col-md-12"> 
Golden opportunity to students who willing to study Nursing who are from economically backward.
<br>
weforyou.ngo and sahara trust Run together,
Educational opportunity camp for free Nursing course.Absolutely free at the premier educational institution opportunity to studying nursing.
online admission
	</div>
	<div class="col-md-12">
		&nbsp;
	</div>	
	<div class="col-md-12"> 
கொரோனா காலத்தில் ஏழை மாணவர்களுக்கு பொன்னான வாய்ப்பு!!<br>
weforyou தொண்டு நிறுவனம் முன்னிருந்து நடத்தும் நர்சிங் படிப்பிற்கான இலவச கல்வி வாய்ப்பு முகாம்
தலை சிறந்த கல்வி நிறுவனத்தில் முற்றிலும் இலவசமாக நர்சிங் பயில்வதற்கான இலவச சேர்க்கை நடைபெறுகிறது.		
	</div>
	<div class="col-md-12">
		&nbsp;
	</div>		
</div>
						<div class="row">
						<div class="col-md-6">
							<!-- success msg --><strong><span><ul id="custom_msg" class="alert"></ul></span></strong>
							<!-- Error msg -->
							<div class="row" id="frm_contactform_main">
								<form name="educationform" id="educationform" class="form" action="educationformform_main" method="post">
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_name" placeholder="Name *" required=""> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_mobileno" placeholder="Mobile no *" required="" onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_year_of_passing" placeholder="Year Of Passing *" required="" onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_ten_total_mark" placeholder="10th Total Mark *" required="" onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_twelve_total_mark" placeholder="12th Total Mark " onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_family_yearly_income" placeholder="Family Yearly Income" onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<textarea class="form-control" rows=5 name="er_address" placeholder="Address *" required=""></textarea>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" name="er_pincode" placeholder="Pincode*" required="" onkeypress="return isNumber(event)"> </div>
									</div>
									<div class="col-sm-12">
										<div class="form-group pull-right">
											<input type="submit" name="c_submit" value="Submit" class="btn btn-primary">
										<input type="hidden" name="action" value="Add"> 
									</div>
									</div>
								</form>
							</div>
						</div>

						<!-- .entry-header -->
						<div class="col-md-6">
											<p><strong>Place Of Admission In Tamil Nadu
:</strong> Weforyou
3/28 C Sivan Kovil Street,<br>
<span class="addrcls">Viswambal Samuthiram (South),</span><br>
<span class="addrcls">Thuraiyur(TK), Trichy - 621003</span> </p><br>
									<div class="phone-no">
										<p> <strong>Date:</strong>07-09-2020 to 13-09-2020</p>
										<p> <strong>Eligiblity:</strong>10th Pass</p>
										<p> 												<strong>Phone:</strong>+91 99443 98056 / +91 90253 61213</span></p>
										<p> <strong>Course Details:</strong> <a target="_blank" href="<?php echo media_url()." Course Details.pdf "?>">Click Here</a> </p>
									</div>
						</div>
						<!-- .contact_left -->
					</div>
					</div>
						<div class="row">
        <div class="col-md-6"> 
             <img width="600" height="400" src="<?php echo media_url()."weforeduction2020_1.jpg"?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">                
        </div>	
        <div class="col-md-6"> 
             <img width="600" height="400" src="<?php echo media_url()."weforeduction2020.jpg"?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">                
        </div>	
    </div>        					
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d971.9870338266118!2d80.25806972594681!3d12.975169118312426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d43be267b5b%3A0xe5c4bb65b60d44ca!2s50%2C+SH+49%2C+Valmiki+Nagar%2C+Kannappa+Nagar%2C+Thiruvanmiyur%2C+Chennai%2C+Tamil+Nadu+600041!5e0!3m2!1sen!2sin!4v1521999786854" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
		$("#educationform").validate({
			ignore: "",
			submitHandler: function() {
				$('#educationform').ajaxSubmit({
					url: base_url + "viewer/educationreg",
					data: $('#educationform').serialize(),
					type: 'POST',
					dataType: "json",
					success: function(data) {
						if(data.status == "success") {
							show_success_error(data.status, data.message);
							document.getElementById("educationform").reset();
						} else if(data.status == "error") {
							show_success_error(data.status, data.message);
							return false;
						}
					}
				});
			}
		});
		</script>