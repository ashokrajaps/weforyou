<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
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
                            <img width="226" height="219" src="<?php echo $event_details['event_image']; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image not suuport">
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
                            <div class="eventlocation">
                                <i class="fa fa-lg fa-map-marker"></i> <?php echo output_val($event_details['event_address'])."<br> ".output_val($event_details['event_city_town'])." ".output_val($event_details['event_state_country'])."<br> ".output_val(get_country_name($event_details['event_country'])); ?>
                            </div>
                        </div>                        
<?php        
     }    
?>

                                                    </div>
                                                    <!-- .entry-content -->
                                                </article>
                                                <!-- #post-## -->
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>

                                    <div class="clear"></div>
<?php 
    echo get_template('layout/footer');
?>

