
<!-- CSS Libs -->

<div class="mfp_header">
        <?php echo $module_label;?>
</div>
<div class="mfp_body">
	<table class="table more_tableview" sytle="margin-bottom:0;">

     <?php if(!empty($result)) { 
	 ?>
        <tr>
			<td><?php echo get_label('cate_name');?></td>
			<td><?php echo  output_value($result['category_name'])?></td>
		</tr>
		
		 <tr>
			<td><?php echo get_label('created_on');?></td>
			<td><?php echo get_date_formart(($result['category_created_on']));?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
