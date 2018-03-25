<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
?>

    <div class="content-area">
        <div class="middle-align">
            <div class="site-main sitefull">
                <article id="post-15" class="post-15 page type-page status-publish hentry">
                    <div class="blog-post-repeat">
                   
                        <h1 class="entry-title">
                            Donate For <?php echo output_val($causes_details['causes_title']); ?>
                        </h1>
                 
                    <!-- .entry-header -->
                    <!-- content section -->
                    <div class="entry-content">
                        <!-- postmeta -->
                        <div class="panel panel-default">
                         <div class="panel-body">
                       

                        <!-- Basic Validation -->
                        <div class="clearfix">
                        <div class="col-sm-6">
                         <div class="thumbnail">
      <a href="<?php echo $causes_details['causes_image']; ?>">
        <img src="<?php echo $causes_details['causes_image']; ?>" alt="" class="img img-rounded"/>
        <div class="caption">
            <p><?php echo output_val($causes_details['causes_description']); ?></p>
        </div>
      </a>
    </div>
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
                            <div class="col-sm-6">
                            
                                <div class="cards">
                                    <div class="body">
      <form id="donation_form" name="donation_form" class="form_validation" action="<?php echo base_url().'donation/pay/'.$causes_id;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                            <div class="custom_msg"></div>
                                           
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
                                                <div class="col-sm-6">
                                                    <div class="form-group form-float">
                                                        <div class="input_fields">
                                                            <label class="form-label">
                                                                <?php echo get_label('donar_image'); ?>
                                                            </label>
                                                            <?php echo form_upload('donar_image','id="donar_image" class="form-control');?>
                                                        </div>
                                                    </div>
                                                </div>

                                              <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="input_fields">
                                                            <label class="form-label">
                                                                <?php echo get_label('payment_method').get_required(); ?>
                                                            </label>                                               
                                                                <select name="payment_method" id="payment_method" class="form-control select_search" required="">
                                                                    <option value="2" selected="">Payumoney</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-float">
                                                        <div class="input_fields">
                                                                <label class="form-label">
                                                                    <?php echo get_label('amount').get_required(); ?>
                                                                    <span class="currency_symbol"></span>
                                                                </label>
                                                            <input type="text" class="form-control" name="amount" id="amount" data-display="No of Coupon" data-rule="required" onkeypress="return isNumber(event);" required>
                                                            </div>
                                                        </div>
                                                    </div>   

                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                            <h4><span style="color:red">Thanks for your interest. We will bring online payment soon. Until that kindly use our We For You account details.</span></h4>
                                                        </div>
                                                        <!-- <div class="form-group donate_now_div pull-right">
                                                            <button class="btn btn-primary waves-effect dt_donate_now_submit" type="submit">Donate Now</button>
                                                            <button class="btn btn-primary waves-effect dt_clear_reset" type="reset">Clear</button>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <input type="hidden" name="causes_id" value="<?php echo $causes_id; ?>">
                                                    <input type="hidden" name="causes_title" value="test">
                                                        <input type="hidden" name="currency_code" value="USD">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .entry-content -->
                                        </div>
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
   echo get_template('layout/footer_include');
?>
<?php 
    echo get_template('layout/footer');
?>

<script type="text/javascript">
$("#donation_form").validate({
     ignore: "",
   submitHandler: function(form) {
        console.log("Submitted!");
        form.submit();
    }
}); 
        // $('#donation_form').submit();

</script>
