<?php 
echo get_template('layout/head_section');
echo get_template('layout/header');
?>
<!-- <div class="innerbanner">
	<img src="<?php echo base_url('media/images/default-banner.jpg');?>" alt="">
</div> -->
<div class="content-area">
	<div class="middle-align">
				
						<h1>

							<?php echo output_val($form_heading); ?>
						</h1>
						<div class="panel panel-default" style="height:60%">
												
												<!-- .entry-header -->
												<div class="panel-body">
					<div class="entry-content">
					</div>
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="cards">
								<div class="body">
									<!-- success msg -->
									<strong><span><ul id="custom_msg" class="alert"></ul></span></strong>
									<!-- Error msg -->

									<form id="volunteer_form" name="donation_form" class="form_validation" action="
									<?php echo base_url().'service/volunteer/add';?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

									<div class="custom_msg"></div>
									<div class="row clearfix">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_first_name').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_first_name',set_value('volunteer_first_name'),'class="form-control required" id="volunteer_first_name" ');?>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_last_name').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_last_name',set_value('volunteer_last_name'),'class="form-control required" id="volunteer_last_name" ');?>
												</div>
											</div>
										</div>		
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_mobile_no').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_mobile_no',set_value('volunteer_mobile_no'),' class="form-control required" id="volunteer_mobile_no" onkeypress="return isNumber(event)" ');?>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_email'); ?>
													</label>
													<?php echo form_input('volunteer_email',set_value('volunteer_email'),' class="form-control " id="volunteer_email" ');?>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_age').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_age',set_value('volunteer_age'),' class="form-control required" id="volunteer_age" onkeypress="return isNumber(event)" ');?>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<div class="demo-radio-button">
														<label class="card-inside-title"><?php echo get_label('volunteer_gender').get_required();?></label>
														<input name="volunteer_gender" type="radio" id="male" value="male"  class="with-gap" checked="" required>
														<label for="male">Male</label>
														<input name="volunteer_gender" type="radio" id="female" value="female"  class="with-gap">
														<label for="female">Female</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<label class="form-label">
														<?php echo get_label('volunteer_city').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_city',set_value('volunteer_city'),' class="form-control required" id="volunteer_city" ');?>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<label class="form-label">
														<?php echo get_label('volunteer_zip_postal_code').get_required(); ?>
													</label>
													<?php echo form_input('volunteer_zip_postal_code',set_value('volunteer_zip_postal_code'),' class="form-control required" id="volunteer_zip_postal_code" ');?>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<label class="form-label">
														<?php echo get_label('volunteer_country').get_required(); ?>
													</label>
													<?php  echo get_country_list_dd('volunteer_country','','class="form-control select_search required" ');?>

												</div>
											</div>
										</div>
									</div>	

									<div class="row clearfix">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<label class="form-label">
														<?php echo get_label('volunteer_area_of_interest').get_required();?>
													</label>				
													<?php  echo get_area_of_interest_dropdown('1','','class="form-control select_search required" ');?>

												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<div class="demo-radio-button">
														<label class="card-inside-title"><?php echo get_label('volunteer_previous_experience');?></label>

														<?php echo form_input('volunteer_exp_if_yes_where',set_value('volunteer_exp_if_yes_where'),' class="form-control" id="volunteer_exp_if_yes_where" ');?>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_fields">
													<label class="form-label"><?php echo get_label('volunteer_profile_image');?>
													</label>
													<input type="file" name="volunteer_profile_image" id="volunteer_profile_image" class="form-control" >
												</div>
											</div>
										</div>						
									</div>
									<div class="row clearfix">
										<div class="col-md-4">
											<div class="form-group form-float">
												<div class="input_field">
													<label class="form-label">
														<?php echo get_label('volunteer_address'); ?>
													</label>
													<?php  echo form_input('volunteer_address',set_value('volunteer_address'),' class="form-control"  ');?>					</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-float">
													<div class="input_field">
														<label class="form-label"><?php echo get_label('volunteer_passionate_social_service');?>
														</label>
														<?php  echo form_input('volunteer_passionate_social_service',set_value('volunteer_passionate_social_service'),' class="form-control"  ');?>										</div>
													</div>
												</div>

											</div>
											<div class="row clearfix">
												<div class="col-md-10"></div>
												<div class="col-md-2">
													<div class="form-group donate_now_div">
														<button class="btn btn-primary waves-effect dt_donate_now_submit" name="action" value="Add" type="submit">Submit</button>
														<button class="btn btn-primary waves-effect dt_clear_reset" type="reset">Clear</button>
													</div>
												</div>
											</div>																							

											<input name="volunteer_way_to_contact" type="hidden" id="phone" value="Phone"  class="with-gap" checked="" >
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	<?php 
	echo get_template('layout/footer_include');
	?>
	<?php 
	echo get_template('layout/footer');
	?>
	<script type="text/javascript">
		$("#volunteer_form").validate({
			ignore: "",
			submitHandler: function() {
				$('#volunteer_form').ajaxSubmit({
					url: base_url + "service/volunteer/add",
					data: $('#volunteer_form').serializeArray(),
					type: 'POST',
					dataType: "json",
					success: function(data) { 
						if (data.status == "success") 
						{
							show_success_error(data.status,data.message);				
							document.getElementById("volunteer_form").reset();
						} 
						else if (data.status == "error") 
						{
							show_success_error(data.status,data.message);				
							return false;
						}
		            },
		            error: function(jqXHR, textStatus, errorThrown)
		            {
		              console.log('Error get data from ajax');
		            }
				});

			}
		});	

	</script>