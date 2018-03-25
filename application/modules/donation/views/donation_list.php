<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
?>
                                
                                    <div class="content-area">
                                        <div class="middle-align">
                                            <div class="site-main sitefull">
                                                <article id="post-15" class="post-15 page type-page status-publish hentry">
                                                    <header class="entry-header">
                                                        <h1 class="entry-title">Donate For Causes</h1>
                                                    </header>
                                                    <!-- .entry-header -->
                                                    <div class="entry-content">
                                                        <!-- content section -->
                                                        <div class="panel panel-default">
                                                        <div class="panel-body">
                                                        
        
<?php   if(!empty($causes_lists))
        {
?>
<div class="col-sm-9">
<?php
            foreach($causes_lists as $key=>$causes )
            {
                $redirect_causes_url=base_url()."donation/".$causes['causes_id'];
?>        
 
    <div class="panel panel-default"> 
    <div class="panel-body">
    <div class="col-sm-6">
    <a href="<?php echo $redirect_causes_url; ?>">
    <img width="226" height="219" src="<?php echo $causes['causes_image']; ?>" 
    class="alignleft wp-post-image" alt="post-img-1">
    </a>
    </div>
    <div class="col-sm-6">
        <a href="<?php echo $redirect_causes_url; ?>" rel="bookmark"><?php echo output_val($causes['causes_title']); ?></a>
        <p><?php echo word_limit(output_val($causes['causes_description']),250); ?></p>
        
        
            <a href="<?php echo $redirect_causes_url; ?>">Donate Now ›</a>
            </div>
      
</div>
</div>
<?php   
            }
            ?>
            </div>
            <div class="col-sm-3 panel-body"  >
            <form class="form" style="background-color:#f8f8f8;padding:10px 10px 10px 10px;">
           <h4> Bank Account Details</h4>
           <div class="form-group">
           <h4>Account Name</h4>We For You
           </div><div class="form-group">
           <h4>Account Number</h4>6611419866
           </div>
           <div class="form-group">
           <h4>IFSC Code</h4>IDIB000N089
           </div>
           <div class="form-group">
           <h4>MICR Code</h4>600019103
           </div>
           </form>
           </div>
            </div>
            <?php
     }    
?>

                                                    </div>
                                                    <!-- .entry-content -->
                                                    </div>
                                                    </div>
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

