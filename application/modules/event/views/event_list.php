<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
    $current_date = strtotime(date('d-m-Y'));
?>
                                
<div class="content-area">
    <div class="middle-align">
        <div class="site-main sitefull">
            <article id="post-15" class="post-15 page type-page status-publish hentry">
<?php   if(!empty($event_lists))
        {
?>
            <header class="entry-header">
                <h1 class="entry-title"><?php echo $form_heading ; ?></h1>
            </header>
            <!-- .entry-header -->
            <div class="entry-content">
                <!-- content section -->
                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="timeline" >
                                <?php       
                                $e=1;     
                                            foreach($event_lists as $key=>$event )
                                            {
                                                $redirect_event_url=base_url()."event/".$event['event_id'];
                                ?> 
                                                <li class="<?php  echo ($e%2 ? '':'timeline-inverted'); ?>" style="list-style:none">
                                                    <div class="timeline-badge" style="font-size: 0.8em;"><?php echo get_day($event['event_start_date']); ?>
                                                    <span><?php echo get_month_name($event['event_start_date']); ?> </span>
                                                    </div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            
                                                            <h4 class="timeline-title"><a href="<?php echo $redirect_event_url; ?>"><?php  echo output_val($event['event_title']); ?></a></h4>

                                                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 
                                                             <?php  echo get_event_date_formart($event['event_start_date'],$event['event_end_date'],$event['event_each_day']); ?>
                                                             </small>
                                                            </p>
                                                            <p><small class="text-muted"><i class="fa fa-lg fa-map-marker"></i> 
                                                            <?php echo output_val($event['event_city_town'])." ".output_val($event['event_state_country'])." ".output_val(get_country_name($event['event_country'])); ?>
                                                             </small>
                                                            </p>
                                                        </div>
                                                        <div class="timeline-body">
                                                                <?php echo word_limit(output_val($event['event_description']),250); ?>
                                                                    <a class="btn btn-success" href="<?php echo $redirect_event_url; ?>">Read More ›</a>
                                                        </div>
                                                    </div>
                                                </li>
                                <?php   
                                                $e++; 
                                            }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        
<?php   
     }
     else if($event_id != "" && !empty($event_details))
     {
?>
        <header class="entry-header">
            <h1 class="entry-title">
                <?php echo output_val($event_details['event_title']); ?>
            </h1>
        </header>
        <!-- .entry-header -->
        <!-- content section -->
        <div class="entry-content">
            <!-- postmeta -->
            <div class="post-thumb">
<?php 
    if($event_details['event_image'] != '')
    {
        $image_array=array();
        foreach($image_array as $key=>$val)
        {
?>

<?php        
        }
    }    
?>   
<?php if($event_id == 12)
{?>
    <div class="row">
        <div class="col-md-6"> 
             <img width="500" height="700" src="<?php echo media_url()."weforeduction2020_1.jpg"?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $event_details['event_title']; ?>">                
        </div>
        <div class="col-md-6"> 
             <img width="500" height="700" src="<?php echo $event_details['event_image']; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $event_details['event_title']; ?>">    
        </div>
    </div>
<?php } else {                 ?>    


                <img width="226" height="219" src="<?php echo $event_details['event_image']; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $event_details['event_title']; ?>">
<?php }  ?>    

                </div>
                <p>
                    <?php echo output_val($event_details['event_description']); ?>
                </p>

                <!-- postmeta -->
        </div>
        <div class="eventtitlelocation">
                <div class="eventtiming">
                    <i class="fa fa-lg fa-clock-o"></i>&nbsp;<?php  echo get_event_date_formart($event_details['event_start_date'],$event_details['event_end_date'],$event_details['event_each_day']); ?> --
                    <?php echo get_event_time_formart($event_details['event_start_time'],$event_details['event_end_time']); ?>
                </div>
<?php if($event_details['event_have_phy_location'] == 'yes')
       {
    ?>
                <div class="eventlocation">
                    <i class="fa fa-lg fa-map-marker"></i> <?php echo output_val($event_details['event_address'])."<br> ".output_val($event_details['event_city_town'])." ".output_val($event_details['event_post_code'])." ".output_val($event_details['event_state_country'])."<br> ".output_val(get_country_name($event_details['event_country'])); ?>
                </div>
<?php    
      }                
?>
<?php if($event_id == 12)
{?>
                        <div class="col-md-12">
                                            <p><strong><span style="color:#4fa731;">Place Of Admission In Tamil Nadu
:</span></strong> Weforyou
3/28 C Sivan Kovil Street,<br>
<span class="addrcls">Viswambal Samuthiram (South),</span><br>
<span class="addrcls">Thuraiyur(TK), Trichy - 621003</span> </p>
                                    <div class="phone-no">
                                        <p> <strong>Date:</strong>07-09-2020 to 13-09-2020</p>
                                        <p> <strong>Eligiblity:</strong>10th Pass</p>
                                                <p>                                                 <strong>Phone:</strong>+91 99443 98056 / +91 90253 61213</span></p>
                                        <p> <strong>Course Details:</strong> <a target="_blank" href="<?php echo media_url()." Course Details.pdf "?>">Click Here</a> </p>
                                    </div>
                        </div>    
     <a href="<?php echo base_url()."viewer/educationreg"?>"><span class="col-md-4">Click Here To Register Now</span></a>
<?php }                 ?>    
<?php if($event_id == 11)
{?>
                <span class=iframcls><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124345.91209256!2d80.19411946045676!3d13.111235542005842!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52659192d1ae61%3A0xd1cbef152a7abf8f!2sDon%20Bosco%20Beatitudes%20Social%20Welfare%20Centre!5e0!3m2!1sen!2sin!4v1577522081082!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></span>
<?php }                 ?>
        </div> 
<?php
if($event_details['event_is_registration_need'] == "yes")
{
    if(($current_date>=strtotime(get_date_formart($event_details['event_registration_start_date']) ))&& ($event_details['event_registration_end_date'] != '0000-00-00'))
        {
            if(($current_date <=strtotime(get_date_formart($event_details['event_registration_end_date']))) && ($event_details['event_registration_end_date'] != '0000-00-00'))
             {            
?>                                
<div class="col-sm-12">
    <div class="cards">
        <div class="body">    
        <strong><span><ul id="custom_msg" class="alert"></ul></span></strong>
            <form id="donation_form" name="donation_form" class="form_validation" action="<?php echo base_url().'event/register/'.$event_id;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="custom_msg"></div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_event_team_name').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_event_team_name',set_value('donar_event_team_name'),'id="donar_event_team_name" class="form-control required" ');?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_first_name').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_first_name',set_value('donar_first_name'),'class="form-control required" id="donar_first_name" ');?>
                            </div>
                        </div>
                   </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_last_name').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_last_name',set_value('donar_last_name'),'id="donar_last_name" class="form-control required" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_email_address').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_email_address',set_value('donar_email_address'),' class="form-control required" id="donar_email_address" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_mobile_no').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_mobile_no',set_value('donar_mobile_no'),' class="form-control required" id="donar_mobile_no" onkeypress="return isNumber(event)" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_alternative_contact_no').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_alternative_contact_no',set_value('donar_alternative_contact_no'),' class="form-control " id="donar_alternative_contact_no" onkeypress="return isNumber(event)" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_address'); ?>
                                </label>
                                <?php echo form_input('donar_address',set_value('donar_address'),' class="form-control " id="donar_address" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_city').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_city',set_value('donar_city'),' class="form-control required" id="donar_city" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_zip_postal_code').get_required(); ?>
                                </label>
                                <?php echo form_input('donar_zip_postal_code',set_value('donar_zip_postal_code'),' class="form-control required" id="donar_zip_postal_code" ');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                            <label class="form-label">
                                <?php echo get_label('donar_country').get_required(); ?>
                            </label>
                            <?php  echo get_country_list_dd('donar_country','','class="form-control select_search required" ');?>

                            </div>
                        </div>
                    </div>
<?php      
        if($event_details['event_registration_max_member_count'] == 0)
        {
            $event_details['event_registration_max_member_count']=2;
        }                    
?>        
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">Registration max member count
                                    <?php //echo get_label('donar_college_name').get_required(); ?>
                                </label>
                                <?php echo get_member_dd($event_details['event_registration_max_member_count'],'event_registration_max_member_count',$event_details['event_registration_max_member_count'],'');?>
                            </div>
                        </div>
                   </div> 
                   <div id="member_list" >
                       <?php for($i=1;$i<=$event_details['event_registration_max_member_count'];$i++)
                       {
?>
            <div class="col-sm-6">
                <div class="form-group form-float">
                    <div class="input_fields">
                        <label class="form-label">Player Name <?php echo $i.get_required(); ?>
                        </label>
                        <?php echo form_input('event_register_member_name[]',set_value('event_register_member_name'),' class="form-control required" id="event_register_member_name'.$i.'" placeholder="Player Name '.$i.'" ');?>
                    </div>
                </div>
            </div>
  <?php                     }
                        ?>
                   </div>                   
                    <div class="col-sm-6" style="display: none">
                        <div class="form-group form-float">
                            <div class="input_fields">
                                <label class="form-label">
                                    <?php echo get_label('donar_image'); ?>
                                </label>
                                <?php echo form_upload('donar_image','id="donar_image" class="form-control');?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group donate_now_div pull-right">
                                <button class="btn btn-primary waves-effect dt_donate_now_submit" name="submit" type="submit" value="Add">Submit Now</button>
                                <button class="btn btn-primary waves-effect dt_clear_reset" type="reset">Clear</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="event_id" value="<?php echo encode_value($event_id); ?>">
                        <input type="hidden" name="action" value="Add">
                </form>
            </div>
        </div>
    </div> 
    <div id="member_count_temp"  style="display: none">
            <div class="col-sm-6">
                <div class="form-group form-float">
                    <div class="input_fields">
                        <label class="form-label">Player Name #id# <?php echo get_required(); ?></label>
                        <?php echo form_input('event_register_member_name[]',set_value('event_register_member_name'),' class="form-control required" id="event_register_member_name#id#" placeholder="Player Name #id#" ');?>
                    </div>
                </div>
            </div>
    </div>    
    <?php }
          else
          {
                echo "<span class='event_ended_msg'>Event registration time ended.</span>";
          }
      } 
      else
      {
            echo "<span class='event_ended_msg'>Event registration open coming soon.</span>";
      }        
    }                                                                                                

     }    
?>


                                                    </div>
                                                </article>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>

                                    <div class="clear"></div>
<?php 
    echo get_template('layout/footer');
?>

<script type="text/javascript">
$("#donation_form").validate({
        ignore : "",
        submitHandler : function() {
            $.ajax({
                url: base_url+"event/registration",
                data : $('#donation_form').serialize(),
                type :'POST', 
                dataType:"json",
                success:function(data){
                    if (data.status == "success") 
                    {
                        show_success_error_stay(data.status,data.message);               
                        document.getElementById("donation_form").reset();
                        var positiontop = $('#custom_msg').offset().top;
                        $('body,html').animate({scrollTop:positiontop}, 1000);                        
                    } 
                    else if (data.status == "error") 
                    {
                        show_success_error(data.status,data.message);               
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                  console.log('Error get data from ajax');
                }
            });
        }    
}); 
$(document).on("change","#event_registration_max_member_count",function() {
 membercount();
});
$(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images
 //alert("window is loaded");
 // membercount();
    //  var positiontop = $('#donation_form').offset().top;
    // $('body,html').animate({scrollTop:positiontop}, 800);
});
function membercount(count)
{
    $('#member_list').html('');
 var temp=$('#member_count_temp').html();
 var rmcount=parseInt($('#event_registration_max_member_count').val());
 console.log(rmcount);
  if(rmcount>0)
  {
    var c;
    for(c=1;c<=rmcount;c++)
    {
        $('#member_list').append(temp.split('#id#').join(c));
    }
  }
}
</script>