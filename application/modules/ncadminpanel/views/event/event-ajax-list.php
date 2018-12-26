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
			<th><?php echo get_label('event_title');?><?php echo add_sort_by('event_title',$module); ?></th>
			<th><?php echo get_label('event_is_registration_need');?><?php echo add_sort_by('event_is_registration_need',$module); ?></th>
			<th><?php echo get_label('event_registration_fees');?><?php echo add_sort_by('event_registration_fees',$module); ?></th>
			<th><?php echo get_label('event_country');?><?php echo add_sort_by('event_country',$module); ?></th>
			<th><?php echo get_label('event_post_code');?><?php echo add_sort_by('event_post_code',$module); ?></th>
			<th><?php echo get_label('event_city_town');?><?php echo add_sort_by('event_city_town',$module); ?></th>
			<th><?php echo get_label('event_created_on');?></th>
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
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['event_id'],'',' class="multi_check" type="checkbox" id="'.$val['event_id'].'"   ');?>
				<label for="<?php echo $val['event_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['event_title']);?></td>
			<td><?php echo output_value($val['event_is_registration_need']);?></td>
			<td><?php echo output_value($val['event_registration_fees']);?></td>
			<td><?php echo output_value($val['country_name']);?></td>
			<td><?php echo output_value($val['event_post_code']);?></td>
			<td><?php echo output_value($val['event_city_town']);?></td>
			<td><?php echo ($val['event_created_on'] !='' && $val['event_created_on'] !="NULL" && $val['event_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['event_created_on']):"N/A";?></td>
			<td><a href="javascript:;"><?php echo show_status($val['event_status'],$val['event_id']);?></a>
			<td><a href="<?php echo admin_url().$module.'/view/'.encode_value($val["event_id"]);?>" class="ajax-popup"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp;
				<a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['event_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
				
				<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['event_id']);?>"
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
			<th><?php echo get_label('event_title');?><?php echo add_sort_by('event_title',$module); ?></th>
			<th><?php echo get_label('event_is_registration_need');?><?php echo add_sort_by('event_is_registration_need',$module); ?></th>
			<th><?php echo get_label('event_registration_fees');?><?php echo add_sort_by('event_registration_fees',$module); ?></th>
			
			<th><?php echo get_label('event_country');?><?php echo add_sort_by('event_country',$module); ?></th>
			<th><?php echo get_label('event_post_code');?><?php echo add_sort_by('event_post_code',$module); ?></th>
			<th><?php echo get_label('event_city_town');?><?php echo add_sort_by('event_city_town',$module); ?></th>
			<th><?php echo get_label('event_created_on');?></th>

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
		
