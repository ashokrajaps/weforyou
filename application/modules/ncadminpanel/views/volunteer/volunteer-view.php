
<!-- CSS Libs -->

<div class="mfp_header">
        <?php echo $module_label;?>
</div>
<div class="mfp_body">
	<table class="table more_tableview" sytle="margin-bottom:0;">

     <?php if(!empty($result)) { 
	 ?>
        <tr>
			<td><?php echo get_label('volunteer_first_name');?></td>
			<td><?php echo  output_value($result['volunteer_first_name'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('volunteer_last_name');?></td>
			<td><?php echo  output_value($result['volunteer_last_name'])?></td>
		</tr>		
		 <tr>
			<td><?php echo get_label('volunteer_mobile_no');?></td>
			<td><?php echo  output_value($result['volunteer_mobile_no'])?></td>
		</tr>
		
		<tr>
			<td> <?php echo get_label('volunteer_email');?></td>
			<td><?php echo  output_value($result['volunteer_email'])?></td>
		</tr>
		<tr>
			<td><?php echo get_label('volunteer_gender');?></td>
			<td><?php echo output_value($result['volunteer_gender']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('volunteer_age');?></td>
			<td><?php echo output_value($result['volunteer_age']); ?></td>
		</tr>
		
		<tr>
			<td><?php echo get_label('volunteer_address');?></td>
			<td><?php echo output_value($result['volunteer_address']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('volunteer_way_to_contact');?></td>
			<td><?php echo output_value($result['volunteer_way_to_contact']); ?></td>
		</tr>
		<?php if($result['volunteer_profile_image']!='') { 
			?>
		<tr>
			<td> <?php echo get_label('volunteer_profile_image');?></td>
			<td>
				<img class="img-responsive" src="<?php echo constant('volunteer_path').$result['volunteer_profile_image'];?>">
			</td>
		</tr>
		<?php } ?>

		<tr>
			<td> <?php echo get_label('volunteer_status');?></td>
			<td><?php echo  output_value($result['status_title'])?></td>
		</tr>

		<tr>
			<td> <?php echo get_label('volunteer_created_on');?></td>
			<td><?php echo  get_date_formart(($result['volunteer_created_on']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
