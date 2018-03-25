
<!-- CSS Libs -->

<div class="mfp_header">
        <?php echo $module_label;?>
</div>
<div class="mfp_body">
	<table class="table more_tableview" sytle="margin-bottom:0;">

     <?php if(!empty($result)) { 
	 ?>
        <tr>
			<td><?php echo get_label('event_title');?></td>
			<td><?php echo  output_value($result['event_title'])?></td>
		</tr>
		
		 <tr>
			<td><?php echo get_label('event_description');?></td>
			<td><?php echo  output_value($result['event_description'])?></td>
		</tr>
		
		<tr>
			<td> <?php echo get_label('event_start_date');?></td>
			<td><?php echo  get_date_formart(($result['event_start_date']))?></td>
		</tr>
		<tr>
			<td><?php echo get_label('event_end_date');?></td>
			<td><?php echo  get_date_formart(($result['event_end_date']))?></td>
		</tr>
		<tr>
			<td><?php echo get_label('event_have_phy_location');?></td>
			<td><?php echo output_value($result['event_have_phy_location']); ?></td>
		</tr>
		
		<tr>
			<td><?php echo get_label('event_state_country');?></td>
			<td><?php echo output_value($result['event_state_country']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('event_country');?></td>
			<td><?php echo output_value($result['event_country']); ?></td>
		</tr>
		<?php if($result['event_image']!='') { 
				$event_image=constant('event_path').str_replace(".", "_t.", $result['event_image']);
			?>
		<tr>
			<td> <?php echo get_label('event_image');?></td>
			<td>
				<img class="img-responsive" src="<?php echo $event_image;?>">
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td> <?php echo get_label('event_status');?></td>
			<td><?php echo  output_value($result['status_title'])?></td>
		</tr>

		<tr>
			<td> <?php echo get_label('event_created_on');?></td>
			<td><?php echo  get_date_formart(($result['event_created_on']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
