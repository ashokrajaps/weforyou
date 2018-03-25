
<!-- CSS Libs -->

<div class="mfp_header">
        <?php echo $module_label;?>
</div>
<div class="mfp_body">
	<table class="table more_tableview" sytle="margin-bottom:0;">

     <?php if(!empty($result)) { 
	 ?>
        <tr>
			<td><?php echo get_label('causes_title');?></td>
			<td><?php echo  output_value($result['causes_title'])?></td>
		</tr>
		
		 <tr>
			<td><?php echo get_label('causes_description');?></td>
			<td><?php echo  output_value($result['causes_description'])?></td>
		</tr>
		
		<tr>
			<td> <?php echo get_label('causes_budget');?></td>
			<td><?php echo  output_value($result['causes_budget'])?></td>
		</tr>
		<tr>
			<td><?php echo get_label('causes_is_donation_need');?></td>
			<td><?php echo output_value($result['causes_is_donation_need']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('causes_how_much_donation_need');?></td>
			<td><?php echo output_value($result['causes_how_much_donation_need']); ?></td>
		</tr>
		
		<tr>
			<td><?php echo get_label('causes_is_volunteers_needed');?></td>
			<td><?php echo output_value($result['causes_is_volunteers_needed']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('causes_how_much_volunteers_need');?></td>
			<td><?php echo output_value($result['causes_how_much_volunteers_need']); ?></td>
		</tr>

		<?php if($result['causes_image']!='') { 
				$causes_image=constant('causes_path').str_replace(".", "_t.", $result['causes_image']);
			?>
		<tr>
			<td> <?php echo get_label('causes_image');?></td>
			<td>
				<img class="img-responsive" src="<?php echo $causes_image;?>">
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td> <?php echo get_label('causes_status');?></td>
			<td><?php echo  output_value($result['status_title'])?></td>
		</tr>

		<tr>
			<td> <?php echo get_label('causes_created_on');?></td>
			<td><?php echo  get_date_formart(($result['causes_created_on']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
