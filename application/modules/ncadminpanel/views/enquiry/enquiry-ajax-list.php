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
			<th><?php echo get_label('enquiry_name');?><?php echo add_sort_by('enquiry_name',$module); ?></th>
			<th><?php echo get_label('enquiry_phone');?><?php echo add_sort_by('enquiry_phone',$module); ?></th>
			<th><?php echo get_label('enquiry_email');?><?php echo add_sort_by('enquiry_email',$module); ?></th>
			<th><?php echo get_label('enquiry_comment');?></th>
			<th><?php echo get_label('enquiry_created_on');?></th>

		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['enquiry_id'],'',' class="multi_check" type="checkbox" id="'.$val['enquiry_id'].'"   ');?>
				<label for="<?php echo $val['enquiry_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['enquiry_name']);?></td>
			<td><?php echo output_value($val['enquiry_phone']);?></td>
			<td><?php echo output_value($val['enquiry_email']);?></td>
			<td><?php echo output_value($val['enquiry_comment']);?></td>
			<td><?php echo ($val['enquiry_created_on'] !='' && $val['enquiry_created_on'] !="NULL" && $val['enquiry_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['enquiry_created_on']):"N/A";?></td>
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
			<th><?php echo get_label('enquiry_name');?><?php echo add_sort_by('enquiry_name',$module); ?></th>
			<th><?php echo get_label('enquiry_phone');?><?php echo add_sort_by('enquiry_phone',$module); ?></th>
			<th><?php echo get_label('enquiry_email');?><?php echo add_sort_by('enquiry_email',$module); ?></th>
			<th><?php echo get_label('enquiry_comment');?></th>
			<th><?php echo get_label('enquiry_created_on');?></th>
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
		
