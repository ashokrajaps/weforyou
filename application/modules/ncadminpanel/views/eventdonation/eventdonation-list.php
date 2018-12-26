
<div class="container-fluid">
	<div class="side-body">
		<?php echo get_template('layout/notifications','')?>
		<div class="page-title">
		     <div class="tt_left">
                <span class="title"><?php echo $module_labels; ?></span>
            
            </div>
             <div class="pull-right">

                </div>
                        
        </div>



		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-header">

                        <div class="card-body"> 
                            
                           <?php echo form_open('',' id="common_search" class="form-inline"');?>
                            <div class="form-group">
                             <?php  $search_array = array(
                             		 '' => get_label('select'),
                             	     'event_title' => get_label('causes_title'),
                             	     'donar_contact_no' => get_label('donar_contact_no'),
                                     'transaction_refer_id' => get_label('transaction_refer_id'),
                                     'transaction_txnid' => get_label('transaction_txnid'),
                             	     'transaction_payment_gateway' => get_label('transaction_payment_gateway'),
                                 );
                             echo form_dropdown('search_field',$search_array,get_session_value($module."_search_field"),'style="width:200px"');
                             
                             ?>
                            </div>
                               <div class="form-group">
                                <?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control"');?>
                                </div>
                               <div class="form-group">
                                <?php echo form_input('donation_start_date',get_session_value($module."_donation_start_date"),'class="form-control date_time_picker" placeholder="Start Date" ');?>
                                </div>
                               <div class="form-group">
                                <?php echo form_input('donation_end_date',get_session_value($module."_donation_end_date"),'class="form-control date_time_picker" placeholder="End Date" ');?>
                                </div>                       
                            <div class="form-group">
                                 <?php echo get_donation_status_dropdown(get_session_value($module."_search_status"),'',' style="width:150px; " placeholder="Select Transaction Status" ');?>
                            </div>                                         
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo admin_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; <?php echo get_label('reset'); ?></a> 
                             <?php echo form_close(); ?>                        </div>
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(admin_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
						<input  type="hidden"  name="multiaction"  id="multiaction"  value="">
					    <input  type="hidden"  name="page_id"  id="page_id" value="0">
						<div class="cntloading_wrapper min_height" > <?php echo loading_image('cnt_loading');?> <div class="append_html"></div></div>
							
                         <?php // echo $paging;?>
                         <?php echo form_close();?>  
                                             
                                </div>
				</div>
			</div>
		</div>

	</div>
</div>
    <script type="text/javascript" src="<?php echo admin_skin('js/donation.js')?>"></script>

<script>
/*  load initial content.. */
$(window).load(function(){
	get_content({paging:"true"});
});

</script>

