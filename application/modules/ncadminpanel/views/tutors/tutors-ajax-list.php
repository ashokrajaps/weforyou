<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
           <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
        </div>   
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
			<th><?php echo get_label('tutor_name');?><?php echo add_sort_by('tutor_name',$module); ?></th>
			<th><?php echo get_label('tutor_email');?><?php echo add_sort_by('tutor_email',$module); ?></th>
			<th><?php echo get_label('tutor_mobile');?><?php echo add_sort_by('tutor_mobile',$module); ?></th>
			<th><?php echo get_label('tutor_location');?><?php echo add_sort_by('tutor_location',$module); ?></th>
			<th><?php echo get_label('tutor_class');?></th>
			<th><?php echo get_label('tutor_created_on');?></th>
			<th><?php echo get_label('status');?></th>
			<th><?php echo get_label('actions');?></th>

		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['tutor_id'],'',' class="multi_check" type="checkbox" id="'.$val['tutor_id'].'"   ');?>
				<label for="<?php echo $val['tutor_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['tutor_name']);?></td>
			<td><?php echo output_value($val['tutor_email']);?></td>
			<td><?php echo output_value($val['tutor_mobile']);?></td>
			<td><?php echo output_value($val['tutor_location']);?></td>
			<td><?php echo output_value($val['tutor_class']);?></td>
			<td><?php echo ($val['tutor_created_on'] !='' && $val['tutor_created_on'] !="NULL" && $val['tutor_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['tutor_created_on']):"N/A";?></td>
			<td><a href="javascript:;"><?php echo show_status($val['tutor_status'],$val['tutor_id']);?></a>
			<td>
				
				<a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['tutor_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
				
				<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['tutor_id']);?>"
				data="Delete"><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a></td>
		</tr>
<?php  } } else { ?>
		<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>



	</tbody>
	<thead class="last">
		<tr>
			<th><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
                    <label for="mul_check_top" class="chk_box_label"></label>
                    </div>
            </th>
			<th><?php echo get_label('tutor_name');?><?php echo add_sort_by('tutor_name',$module); ?></th>
			<th><?php echo get_label('tutor_email');?><?php echo add_sort_by('tutor_email',$module); ?></th>
			<th><?php echo get_label('tutor_mobile');?><?php echo add_sort_by('tutor_mobile',$module); ?></th>
			<th><?php echo get_label('tutor_location');?><?php echo add_sort_by('tutor_location',$module); ?></th>
			<th><?php echo get_label('tutor_class');?></th>
			<th><?php echo get_label('tutor_created_on');?></th>
			<th><?php echo get_label('status');?></th>
			<th><?php echo get_label('actions');?></th>
		</tr>
	</thead>

</table>
</div>
    
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
                        <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
						<button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
                        <button class="btn btn-default multi_action" data="Delete" type="button"> <?php echo get_label('delete');?></button>
                        </div>      
                    </div>
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
		
