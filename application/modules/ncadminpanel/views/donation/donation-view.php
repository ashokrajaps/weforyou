
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
			<td><?php echo get_label('donar_name');?></td>
			<td><?php echo  get_output_value($result['donar_name']);?></td>
		</tr>
		 <tr>
			<td><?php echo get_label('donar_contact_no');?></td>
			<td><?php echo  get_output_value($result['donar_contact_no']);?></td>
		</tr>		
		<tr>
			<td> <?php echo get_label('transaction_total_amount');?></td>
			<td><?php echo  get_output_value($result['transaction_total_amount']);?></td>
		</tr>
		<tr>
			<td><?php echo get_label('transaction_refer_id');?></td>
			<td><?php echo output_value($result['transaction_refer_id']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('transaction_txnid');?></td>
			<td><?php echo output_value($result['transaction_txnid']); ?></td>
		</tr>
		
		<tr>
			<td><?php echo get_label('payment_gateway_title');?></td>
			<td><?php echo output_value($result['payment_gateway_title']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('transaction_status_message');?></td>
			<td><?php echo output_value($result['transaction_status_message']); ?></td>
		</tr>
		<tr>
			<td><?php echo get_label('transaction_remarks');?></td>
			<td><?php if($result['transaction_reason_code']) 
						{
							echo output_value($result['transaction_reason_code'])." - ".output_value($result['transaction_remarks']);
						} 
						else
						{
							echo "N/A";
						} ?></td>
		</tr>		
		<tr>
			<td><?php echo get_label('transaction_ip');?></td>
			<td><?php echo output_value($result['transaction_ip']); ?></td>
		</tr>		
		<tr>
			<td> <?php echo get_label('transaction_currency_code');?></td>
			<td><?php echo  output_value($result['transaction_currency_code'])?></td>
		</tr>
		<tr>
			<td> <?php echo get_label('transaction_currency_paid_amount');?></td>
			<td><?php echo  output_value($result['transaction_currency_paid_amount'])?></td>
		</tr>
		<tr>
			<td> <?php echo get_label('transaction_exchange_rate');?></td>
			<td><?php echo  output_value($result['transaction_exchange_rate'])?></td>
		</tr>		
		<tr>
			<td> <?php echo get_label('transaction_date_of_transfer');?></td>
			<td><?php echo  get_date_formart(($result['transaction_date_of_transfer']))?></td>
		</tr>
		
	
<?php } else { echo get_label ( 'no_records_found' ); 	} 	?>
    </table>
</div>
