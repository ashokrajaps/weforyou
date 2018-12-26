<div class="pagination_bar">
    <div class="btn-toolbar pull-left">

    </div>
    <div class="pagination_custom pull-right">
        <div class="pagination_txt">
            <?php echo show_record_info($total_rows,$start,$limit);?>
        </div>
        <?php echo $paging;?>
    </div>
    <div class="clear"></div>
</div>
<div class="table_overflow">
<table class="table ">
	<thead class="first">
		<tr>
			<th><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
                    <label for="mul_check_top" class="chk_box_label"></label>
                    </div>
            </th>
			<th><?php echo get_label('causes_title');?><?php echo add_sort_by('causes_title',$module); ?></th>
			<th><?php echo get_label('event_donar_contact_no');?><?php echo add_sort_by('donar_contact_no',$module); ?></th>
			<th><?php echo get_label('event_transaction_total_amount');?><?php echo add_sort_by('transaction_total_amount',$module); ?></th>
			<th><?php echo get_label('transaction_refer_id');?></th>
			<th><?php echo get_label('transaction_txnid');?></th>
			<th><?php echo get_label('payment_gateway_title');?></th>
			<th><?php echo get_label('transaction_status_message');?></th>
			<th><?php echo get_label('transaction_date_of_transfer');?></th>
			<th><?php echo get_label('actions');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['transaction_id'],'',' class="multi_check" type="checkbox" id="'.$val['transaction_id'].'"   ');?>
				<label for="<?php echo $val['transaction_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['event_title']);?></td>
			<td><?php echo get_output_value($val['donar_contact_no']);?></td>
			<td><?php echo output_value($val['transaction_total_amount']);?></td>
			<td><?php echo output_value($val['transaction_refer_id']);?></td>
			<td><?php echo output_value($val['transaction_txnid']);?></td>
			<td><?php echo output_value($val['payment_gateway_title']);?></td>
			<td><?php echo output_value($val['transaction_status_message']);?></td>
			<td><?php echo ($val['transaction_date_of_transfer'] !='' && $val['transaction_date_of_transfer'] !="NULL" && $val['transaction_date_of_transfer'] != '0000-00-00 00:00:00' )?get_date_time_formart($val['transaction_date_of_transfer']):"N/A";?></td>
			<td><a href="<?php echo admin_url().$module.'/view/'.encode_value($val["transaction_id"]);?>" class="ajax-popup"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp;
			</td>		
		</tr>
<?php  } } else { ?>
		<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>
	</tbody>
	<thead class="last">
		<tr>
			<th><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?>  <label for="mul_check_bottom" class="chk_box_label"></label></div></th>
			<th><?php echo get_label('causes_title');?><?php echo add_sort_by('causes_title',$module); ?></th>
			<th><?php echo get_label('event_donar_contact_no');?><?php echo add_sort_by('donar_contact_no',$module); ?></th>
			<th><?php echo get_label('event_transaction_total_amount');?><?php echo add_sort_by('transaction_total_amount',$module); ?></th>
			<th><?php echo get_label('transaction_refer_id');?></th>

			<th><?php echo get_label('transaction_txnid');?></th>
			<th><?php echo get_label('payment_gateway_title');?></th>
			<th><?php echo get_label('transaction_status_message');?></th>
			<th><?php echo get_label('transaction_date_of_transfer');?></th>
			<th><?php echo get_label('actions');?></th>			
		</tr>
	</thead>
</table>
</div>
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                    </div>
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
		
