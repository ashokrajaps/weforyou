
<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
    
?>
								<div class="innerbanner">
									<img src="<?php echo base_url('media/images/default-banner.jpg');?>" alt="">
									</div>
									<div class="content-area">
										<div class="middle-align">
											<div class="site-main sitefull">
												<article id="post-15" class="post-15 page type-page status-publish hentry">
													<header class="entry-header">
														<h1 class="entry-title">Contact Us</h1>
													</header>
													<!-- .entry-header -->
													<div class="entry-content">
														<!-- content section -->

        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">


                    <div class="body">
                    <form   class='dt_generate_coupon_code_list_form' name='dt_generate_coupon_code_list_form' id='dt_generate_coupon_code_list' onsubmit='return false;'  enctype="multipart/form-data" method="post" accept-charset="utf-8">

                        <div class="custom_msg"></div>                
                            
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="coupon_prefix"  id="coupon_prefix" data-display="Coupon prefix" data-rule="required">
                                    <label class="form-label">Coupon prefix <span class="star-red">*</span></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="coupon_coupon_length" id="coupon_coupon_length" data-display="Coupon length" data-rule="required" onkeypress="return isNumber(event);">
                                    <label class="form-label">Coupon length <span class="star-red">*</span></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control datetimepicker" name="coupon_valid_from" id="coupon_valid_from" data-display="Coupon valid from" data-rule="required">
                                    <label class="form-label">Coupon valid from <span class="star-red">*</span></label>
                                </div>
                            </div> 
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control datetimepicker" name="coupon_valid_to" id="coupon_valid_to" data-display="Coupon valid to" data-rule="required">
                                    <label class="form-label">Coupon valid to <span class="star-red">*</span></label>
                                </div>
                            </div>                             
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="coupon_limit" id="coupon_limit" data-display="No of Coupon" data-rule="required" onkeypress="return isNumber(event);">
                                    <label class="form-label">Number of coupons <span class="star-red">*</span></label>
                                </div>
                            </div>                                                                                              
                            <div class="form-group dt_generate_coupon_code_list_div">
                                <button class="btn btn-primary waves-effect dt_generate_coupon_code_list_submit" type="submit">Generate Coupons</button>
                            </div>
                        </form>                    </div>
                </div>
            </div>
        </div>

<!-- 														<div class="section-donatorsmember">
															<div class="ourclasses_col ">
																<div class="ourclasses_thumb">
																	<a href="../our-donators/stev-smith/index.html" title="Stev Smith">
																		<img width="270" height="201" src="../wp-content/uploads/2015/12/ourdonators-1.jpg" class="attachment-270x320 size-270x320 wp-post-image" alt="ourdonators-1" />
																	</a>
																</div>
																<div class="title_day_time">
																	<a href="../our-donators/stev-smith/index.html">
																		<h6>Stev Smith</h6>
																	</a>
																	<div class="day_time">
																		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean&#8230;</p>
																	</div>
																</div>
																<div class="member-desination">Donated : $1100</div>
															</div>
															<div class="ourclasses_col ">
																<div class="ourclasses_thumb">
																	<a href="../our-donators/nick-jackson/index.html" title="Nick Jackson">
																		<img width="270" height="201" src="../wp-content/uploads/2015/12/ourdonators-2.jpg" class="attachment-270x320 size-270x320 wp-post-image" alt="ourdonators-2" />
																	</a>
																</div>
																<div class="title_day_time">
																	<a href="../our-donators/nick-jackson/index.html">
																		<h6>Nick Jackson</h6>
																	</a>
																	<div class="day_time">
																		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean&#8230;</p>
																	</div>
																</div>
																<div class="member-desination">Donated : $1800</div>
															</div>
															<div class="ourclasses_col ">
																<div class="ourclasses_thumb">
																	<a href="../our-donators/sarah-watson/index.html" title="Sarah Watson">
																		<img width="270" height="201" src="../wp-content/uploads/2015/12/ourdonators-3.jpg" class="attachment-270x320 size-270x320 wp-post-image" alt="ourdonators-3" />
																	</a>
																</div>
																<div class="title_day_time">
																	<a href="../our-donators/sarah-watson/index.html">
																		<h6>Sarah Watson</h6>
																	</a>
																	<div class="day_time">
																		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean&#8230;</p>
																	</div>
																</div>
																<div class="member-desination">Donated : $1500</div>
															</div>
															<div class="ourclasses_col  last">
																<div class="ourclasses_thumb">
																	<a href="../our-donators/media/index.html" title="Media">
																		<img width="270" height="201" src="../wp-content/uploads/2015/12/ourdonators-4.jpg" class="attachment-270x320 size-270x320 wp-post-image" alt="ourdonators-4" />
																	</a>
																</div>
																<div class="title_day_time">
																	<a href="../our-donators/media/index.html">
																		<h6>Media</h6>
																	</a>
																	<div class="day_time">
																		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean&#8230;</p>
																	</div>
																</div>
																<div class="member-desination">Donated : $1300</div>
															</div>
															<div class="clear"></div>
														</div> -->
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

