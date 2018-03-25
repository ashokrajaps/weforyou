<?php  if(!empty($event_lists)) 
		 { 
?>
									

<section class="cd-horizontal-timeline">
	<div class="timeline">
		<div class="events-wrapper">
			<div class="events">
			
				<ol>
				<?php 
			$e=1;
		 	foreach($event_lists as $key=>$event) 
		 	{ ?>
					<li><a href="#0" data-date="<?php echo date_format(date_create($event['event_start_date']),"m/d/Y");?>" 
					class="<?php  echo ($e==1 ? 'selected':''); ?>">
					<?php echo get_day($event['event_start_date']); ?> <?php echo get_month_name($event['event_start_date']); ?></a></li>
					<?php 
$e++;
}
?>
				</ol>

				<span class="filling-line" aria-hidden="true"></span>
			</div> <!-- .events -->
		</div> <!-- .events-wrapper -->
			
		<ul class="cd-timeline-navigation">
			<li><a href="#0" class="prev inactive">Prev</a></li>
			<li><a href="#0" class="next">Next</a></li>
		</ul> <!-- .cd-timeline-navigation -->
	</div> <!-- .timeline -->

	<div class="events-content">
		<ol>
		<?php 
			$e=1;
		 	foreach($event_lists as $key=>$event) 
		 	{ 
                $redirect_event_url=base_url()."event/".$event['event_id'];

?>
			<li class="<?php  echo ($e==1 ? 'selected':''); ?>" data-date="<?php echo date_format(date_create($event['event_start_date']),"m/d/Y");?>">
				<h2><a href="<?php echo $redirect_event_url; ?>"><?php  echo output_val($event['event_title']); ?></a></h2>
				<em><?php  echo get_event_date_formart($event['event_start_date'],$event['event_end_date'],$event['event_each_day']); ?></em>
				<em><i class="fa fa-lg fa-map-marker"></i> <?php echo output_val($event['event_city_town'])." ".output_val($event['event_state_country'])." ".output_val(get_country_name($event['event_country'])); ?></em>
				<p>	
				  <?php echo output_val($event['event_description']); ?>
					</p>
			</li>
<?php 
$e++;
}
?>
			
		</ol>
	</div> <!-- .events-content -->
</section>
								

											</div>
											<!-- middle-align -->
											<div class="clear"></div>
										</div>
										<!-- container -->
									</section>
<?php }  ?>									