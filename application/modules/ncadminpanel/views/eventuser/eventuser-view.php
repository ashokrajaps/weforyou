
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
			<td><?php echo get_label('event_first_name');?></td>
			<td><?php echo  output_value($result['donar_first_name'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('event_last_name');?></td>
			<td><?php echo  output_value($result['donar_last_name'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('event_email_address');?></td>
			<td><?php echo  output_value($result['donar_email_address'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('event_contact_no');?></td>
			<td><?php echo  output_value($result['donar_contact_no'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('event_alternative_contact_no');?></td>
			<td><?php echo  output_value($result['donar_alternative_contact_no'])?></td>
		</tr>										
		 <tr>
			<td><?php echo get_label('event_participation_name');?></td>
			<td><?php echo  output_value($result['participation_name'])?></td>
		</tr>
		
		<tr>
			<td> <?php echo get_label('event_created_on');?></td>
			<td><?php echo  get_date_formart(($result['donar_created_on']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
