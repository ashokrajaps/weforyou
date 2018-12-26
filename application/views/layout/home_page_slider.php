
<?php 
$recent_event=get_event_registration_remainder_alert();
	if(!empty($recent_event))
	{
?>
		<div class="alert alert-info" style="display: block !important;">
		  <strong>Info!</strong> <a href="<?php echo base_url().'event/'.$recent_event['event_id']?>">"<?php echo ucwords($recent_event['event_title'])."-".date('Y',strtotime($recent_event['event_registration_end_date']));?>"  registration window remains open until <?php echo date('jS F Y',strtotime($recent_event['event_registration_end_date']));?>. click here for more info</a>
		</div>
<?php
	}
?>
								<!-- slider -->
								<div class="slider-main">
									<div id="slider" class="nivoSlider">
										<img src="<?php echo base_url('media/images/slider/slider1.jpg');?>" alt="" title="#slidecaption1"/>
										<img src="<?php echo base_url('media/images/slider/slider2.jpg');?>" alt="" title="#slidecaption2"/>
										<img src="<?php echo base_url('media/images/slider/slider3.jpg');?>" alt="" title="#slidecaption3"/>
										<img src="<?php echo base_url('media/images/slider/slider4.jpg');?>" alt="" title="#slidecaption4"/>
									</div>
									<div id="slidecaption1" class="nivo-html-caption">
										<div class="slide_info">
											<h2>
												<strong>
												In India 99.9% of Government school childrens intake bleached and unhealthy drinking water
												</strong> LET'S JOIN TOGETHER TO GIVE Biosand Filter
.
											</h2>
											<p>
											A biosand filter (BSF) is a point-of-use water treatment system adapted from traditional slow sand filters.
											</p>
 										</div>
									</div>
									<div id="slidecaption2" class="nivo-html-caption">
										<div class="slide_info">
											<h2>
												<strong>PLANT TREES</strong> LIVE NATURAL LIFE.
											</h2>
											<p>
											Trees contribute to their environment by providing oxygen, improving air quality, climate amelioration, conserving water, preserving soil, and all our lifes..
											</p>
<!-- 											<a class="sldbutton" href="#"> DONATE NOW!    </a> -->										 </div>
									</div>
									<div id="slidecaption3" class="nivo-html-caption">
									<div class="slide_info">
									<h2>
									<strong>WE NEED YOUR SUPPORT TO</strong> EDUCATE,ACCOMADATE FOR NEEDY.

									</h2>
									<p>
									Though Right to Education Act is in force there are many children who do not get proper education; the reasons behind this could be numerous such as financial condition of the family, child marriage, child labour, safety of the child and many more.</P></div>
									</div>
									<div id="slidecaption4" class="nivo-html-caption">
										
										<div class="slide_info">
									<h2>
									<strong>WE NEED YOUR SUPPORT TO</strong> GIVE HEALTHY ENVIRIONMENT FOR NEEDY.

									</h2>
									<p>
									India’s health-related out-of-pocket expenditure, which pushes families into indebtedness and deeper poverty, is among the world’s highest.
									</P></div>
									</div>
									<!-- </div>-->
									<div class="clear"></div>
									<!-- </div>-->
								</div>
								<!-- slider -->