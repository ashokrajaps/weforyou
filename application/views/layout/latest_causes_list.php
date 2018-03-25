<?php 
		if(!empty($home_causes_lists))
		{
$causes_count=count($home_causes_lists);
?>
								<div id="wrapOne">
									<div class="container">
										<div class="services-wrap">
								<?php foreach($home_causes_lists as $key=>$causes) 
									  {
									  	$causes_url=base_url()."donation/".$causes['causes_id'];
								?>
										<div class="one_four_page <?php echo ($causes_count == $key) ? 'last_column' : ''; ?>">
												<div class="thumb_four_icon">
													<img src="<?php echo constant('donation_bg_image_path').'/donation-image-1.png';?>" alt="" />
												</div>
												<h4><?php echo output_val($causes['causes_title']); ?></h4><?php echo word_limit(output_val($causes['causes_description']),50); ?>           
												<div class="view-all-btn">
													<a href="<?php echo $causes_url; ?>">Donate Now!</a>
												</div>
											</div>
								<?php }	?>
											<div class="clear"></div>
										</div>
										<!-- .services-wrap-->
										<div class="clear"></div>
									</div>
									<!-- .container -->
								</div>
								<!-- #wrapOne -->
<?php } ?>								