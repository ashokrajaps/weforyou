
<!-- CSS Libs -->

<div class="mfp_header">
        <?php echo $module_label;?>
</div>
<div class="mfp_body">
	<table class="table more_tableview" sytle="margin-bottom:0;">

     <?php if(!empty($result)) { 
	 ?>
        <tr>
			<td><?php echo get_label('er_name');?></td>
			<td><?php echo  output_value($result['er_name'])?></td>
		</tr>
        <tr>
			<td><?php echo get_label('er_mobileno');?></td>
			<td><?php echo  output_value($result['er_mobileno'])?></td>
		</tr>		
		 <tr>
			<td><?php echo get_label('er_year_of_passing');?></td>
			<td><?php echo  output_value($result['er_year_of_passing'])?></td>
		</tr>
		
		<tr>
			<td> <?php echo get_label('er_ten_total_mark');?></td>
			<td><?php echo  output_value($result['er_ten_total_mark'])?></td>
		</tr>
		<tr>
			<td><?php echo get_label('er_twelve_total_mark');?></td>
			<td><?php echo output_value($result['er_twelve_total_mark']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('er_family_yearly_income');?></td>
			<td><?php echo output_value($result['er_family_yearly_income']); ?></td>
		</tr>
		
		<tr>
			<td><?php echo get_label('er_address');?></td>
			<td><?php echo output_value($result['er_address']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('er_pincode');?></td>
			<td><?php echo output_value($result['er_pincode']); ?></td>
		</tr>

		<tr>
			<td> <?php echo get_label('er_status');?></td>
			<td><?php echo  output_value($result['er_status'])?></td>
		</tr>

		<tr>
			<td> <?php echo get_label('er_created_on');?></td>
			<td><?php echo  get_date_formart(($result['er_created_on']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
