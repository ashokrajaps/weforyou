<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
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
			<th><?php echo get_label('event_title_name');?><?php echo add_sort_by('event_title',$module); ?></th>
			<th><?php echo get_label('donar_event_team_name');?><?php echo add_sort_by('donar_event_team_name',$module); ?></th>
			<th><?php echo get_label('donar_refer_id');?><?php echo add_sort_by('donar_refer_id',$module); ?></th>
			<th><?php echo get_label('event_name');?></th>
			<th><?php echo get_label('event_email_address');?><?php echo add_sort_by('donar_email_address',$module); ?></th>
			<th><?php echo get_label('event_contact_no');?><?php echo add_sort_by('donar_contact_no',$module); ?></th>
			<th><?php echo get_label('event_alternative_contact_no');?><?php echo add_sort_by('donar_alternative_contact_no',$module); ?></th>
			<th><?php echo get_label('event_created_on');?></th>
			<th><?php echo get_label('actions');?></th>
		</tr>
	</thead>
	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['donar_id'],'',' class="multi_check" type="checkbox" id="'.$val['donar_id'].'"   ');?>
				<label for="<?php echo $val['donar_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['event_title']);?></td>
			<td><?php echo output_value($val['donar_event_team_name']);?></td>
			<td><?php echo output_value($val['donar_refer_id']);?></td>
			<td><?php echo output_value($val['donar_first_name'])." ".output_value($val['donar_last_name']);?></td>
			<td><?php echo output_value($val['donar_email_address']);?></td>
			<td><?php echo output_value($val['donar_contact_no']);?></td>
			<td><?php echo output_value($val['donar_alternative_contact_no']);?></td>
			<td><?php echo ($val['donar_created_on'] !='' && $val['donar_created_on'] !="NULL" && $val['donar_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['donar_created_on']):"N/A";?></td>
			<td><a href="<?php echo admin_url().$module.'/view/'.encode_value($val["donar_id"]);?>" class="ajax-popup"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a></td>
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
			<th><?php echo get_label('event_title_name');?><?php echo add_sort_by('event_title',$module); ?></th>
			<th><?php echo get_label('donar_event_team_name');?><?php echo add_sort_by('donar_event_team_name',$module); ?></th>
			<th><?php echo get_label('donar_refer_id');?><?php echo add_sort_by('donar_refer_id',$module); ?></th>
			<th><?php echo get_label('event_name');?></th>
			<th><?php echo get_label('event_email_address');?><?php echo add_sort_by('donar_email_address',$module); ?></th>
			<th><?php echo get_label('event_contact_no');?><?php echo add_sort_by('donar_contact_no',$module); ?></th>
			<th><?php echo get_label('event_alternative_contact_no');?><?php echo add_sort_by('donar_alternative_contact_no',$module); ?></th>
			<th><?php echo get_label('event_created_on');?></th>
			<th><?php echo get_label('actions');?></th>
		</tr>
	</thead>

</table>
</div>
    
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
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
		
