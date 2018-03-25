<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
?>
<div class="innerbanner">
    <img src="
        <?php echo base_url('media/images/default-banner.jpg');?>" alt="">
    </div>
    <div class="content-area">
        <div class="middle-align">
            <div class="site-main sitefull">
                <article id="post-15" class="post-15 page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <?php echo "Payment status ".$transaction_details['transaction_status_message']; ?>
                        </h1>
                    </header>
                    <!-- .entry-header -->
                    <!-- content section -->
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cards">
                                    <div class="body">
                                        <table>
                                            <tbody>
                                                <tr><th>Donate Reference No</th>
                                                    <td><?php echo $transaction_details['transaction_refer_id']; ?></td> 
                                                </tr>
                                                <tr><th>Donar Email</th>
                                                    <td><?php echo $transaction_details['donar_email_address']; ?></td> 
                                                </tr>
                                                <tr><th>Causes Title</th>
                                                    <td><?php echo output_val($transaction_details['causes_title']); ?></td> 
                                                </tr>
                                                <tr><th>Donate Date</th>
                                                    <td><?php echo $transaction_details['transaction_date_of_transfer']; ?></td> 
                                                </tr>
                                                <tr><th>Donate Status</th>
                                                    <td><?php echo output_val($transaction_details['transaction_status_message']); ?></td> 
                                                </tr>                                                
                                                <tr><th>Donate Amount</th>
                                                    <td><?php echo $transaction_details['transaction_amount']; ?></td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

