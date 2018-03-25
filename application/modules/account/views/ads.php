<div class="modal without_header_popup fade adspopup" tabindex="-1" role="dialog" aria-labelledby="uploadpopup">
      <div class="modal-dialog post-adv-popup" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3>Posting an Advertisement</h3>
          </div>
          <div class="modal-body uploadpopup_body">
                <div class="title_with_img">
                    <div class="img_pro">
                        <img src="<?php echo skin_url();?>images/camm.png" alt="" class="mCS_img_loaded">
                    </div>
                    <div class="text_pro">
                        <div class="form_field">
                            <input type="text" name="post_title" id="post_title" placeholder="Type your post heading" />
                        </div>
                        <div class="form_field">
                            <textarea name="post_description" id="post_description" placeholder="Type your text here ..."></textarea>
                        </div>
                        
                         <div id="div_x" style="position: relative;">
							 <span class="reset_cmt" style="right: 0;top: 0;">
								 <i class="fa fa-times-circle-o" aria-hidden="true"></i>
							 </span>
							 <img id="featured_preview" >
						</div>
                         
                              <!-- post images start -->
                              <div class="post_image_overflow">
                                 <div class="post_image image_upload">
                                    <div class="filelist queue"></div>
                                 </div>
                              </div>
                              <!--  post image end -->
                              <!--  video upload  -->
                              <div class="vide_upload_container" style="display: none">
                                 <div id="video_icon"></div>
                                 <div class="vide_process" style="display: none">
                                    <progress id="progressBar" value="0" max="100"></progress>
                                    <div class="progress_outer">
                                       <div class="progress_inner video_prg"></div>
                                    </div>
                                    <h3 id="status"></h3>
                                 </div>
                              </div>
                              <!--  video upload end-->                        
                    </div>
                </div>		
                
                <div id="og_part_ads"></div>
              <div class="clearfix"></div>
              
          </div>
        <div class="vid-pht-sec">
            <div class="left_upload_option">
                <ul>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Camera" class="up_images"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
                    <!--<li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Align" class="up_align"><i class="fa fa-align-left" aria-hidden="true"></i></a></li> -->
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="GIF" class="up_gif"><input type="file" name="gif_file" id="gif_file" title="Upload GIF" />GIF</a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Link" class="up_link"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" data-tooltip="tooltip" data-placement="top" title="Video" class="up_video"><input type="file" name="video_file" id="video_file" title="Upload Video" /><i class="fa fa-film" aria-hidden="true"></i></a></li>
                </ul>
            </div>    
            <div class="rgt_upload_btn">
                <div class="custom_radio">
                    <input type="radio" />
                    <label>send replies to my inbox</label>
                </div>
					<input type="hidden" name="upload_type" id="upload_type">  
                    <input type="hidden" name="upload" id="upload" value="" />					              
					<input type="hidden" name="og_data" id="og_data" value="" />
					<input type="hidden" name="list" id="list" value="" />
					<input type="hidden" id="og_request" value="" />   
            </div>     
        </div>
            
            <div class="popup-center-sec">
                  <h3>Choose Your Plan</h3>
                        <div class="form-group">
                               <label for="exampleInputName2">Country</label>
                                        <select class="form-control">
                                              <option>Select your country</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                        </select>
                      </div>
                
                <input type="text" name="somename" data-provide="slider" data-slider-ticks="[1, 2, 3,4,5,6,7,8,9,10]" data-slider-ticks-labels='["5,000", "10,000", "15,000","20,000","25,000", "30,000","35,000","40,000", "45,000","50,000"]' data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="10" data-slider-tooltip="hide">
                
                <div class="billing-info">
                    <div class="billing-info-inner">
                    <h3>BIlling information</h3>
                        </div>
                <form>
                            <div class="form-group">
                                <div class="row">
                              <div class="col-xs-6">
                                <label for="ex1">First Name</label>
                                <input class="form-control" id="ex1" type="text">
                              </div>
                              <div class="col-xs-6">
                                <label for="ex2">Last Name</label>
                                <input class="form-control" id="ex2" type="text">
                              </div>
                              </div>
                                <div class="row">
                                <div class="col-xs-12">
                                <label for="ex2">Company Name</label>
                                <input class="form-control" id="ex2" type="text" placeholder="your company name">
                              </div>
                              </div>
                                <div class="row">
                                 <div class="col-xs-12">
                                <label for="ex2">Address</label>
                                <input class="form-control" id="ex2" type="text" placeholder="Your Address, Line 1">
                                     <br>
                                <input class="form-control" id="ex2" type="text" placeholder="Your Address, Line 2">
                              </div>
                              </div>
                                <div class="row">
                                     <div class="col-xs-6">
                                <label for="ex1">City</label>
                                <input class="form-control" id="ex1" type="text" placeholder="type your user name here">
                              </div>
                              <div class="col-xs-6">
                               <div class="form-group">
                               <label for="exampleInputName2">Country</label>
                                        <select class="form-control">
                                              <option>Select your country</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                        </select>
                      </div>
                              </div>
                              </div>
                                <div class="row">
                                     <div class="col-xs-6">
                                <label for="ex1">State/Province</label>
                                <input class="form-control" id="ex1" type="text" placeholder="type your user name here">
                              </div>
                              <div class="col-xs-6">
                                <label for="ex2">Zip/Postal Code</label>
                                <input class="form-control" id="ex2" type="text" placeholder="type your user name here">
                              </div>
                              </div>
                                <div class="row">
                                     <div class="col-xs-6">
                                <label for="ex1">Phone Number</label>
                                         <div class="col-xs-3">
                                        <select class="form-control">
                                              <option>+91</option>
                                              <option>+92</option>
                                              <option>+93</option>
                                              <option>+94</option>
                                              <option>+95</option>
                                        </select>
                      </div>
                                <div class="col-xs-3">
                        <input name="phone" class="form-control" value="" size="3" maxlength="3" required="required" title="" type="tel" placeholder="888">
                    </div>
                                         <div class="col-xs-3">
                        <input name="phone" class="form-control" value="" size="4" maxlength="4" required="required" title="" type="tel" placeholder="8888">
                    </div>
                                         <div class="col-xs-3">
                        <input name="phone" class="form-control" value="" size="4" maxlength="4" required="required" title="" type="tel" placeholder="8888">
                    </div>
                              </div>
                              <div class="col-xs-6">
                                <label for="ex2">Email Address</label>
                                <input class="form-control" id="ex2" type="text" placeholder="youraddress@email.com">
                              </div>
                              </div>
                             
                            </div>
                    </form>
                    </div>
                
                <div class="payment-details">
                <div class="billing-info-inner">
                    <h3>Payment Details</h3>
                        </div>
                    <form>
                        <div class="row">
                   <div class="col-xs-6">
                <label>Cardholder’s Name</label>
                <div class="input-group"> 
                    <input class="form-control" id="ex1" type="text" placeholder="Jon Snow">
                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                </div>
            </div>
                        <div class="col-xs-6">
                <label>Credit/Debit Card Number</label>
                <div class="input-group"> 
                            <div class="col-xs-4">
                        <input class="form-control input-lg" size="4" maxlength="4" id="password" placeholder="8888" required="" type="password">
                    </div>
                                         <div class="col-xs-4">
                       <input class="form-control input-lg" size="4" maxlength="4" id="password" placeholder="8888" required="" type="password">
                    </div>
                                         <div class="col-xs-4">
                     <input class="form-control input-lg" size="4" maxlength="4" id="password" placeholder="8888" required="" type="password">
                    </div>
                </div>
            </div>
            </div>
                        <div class="row">
                        <div class="col-xs-6">
                <label>Select Card</label>
                <div class="input-group"> 
                      <a href=""><img src="../rxleaf/skin/frontend/images/master-card.png"></a>
                      <a href=""><img src="../rxleaf/skin/frontend/images/visa-card.png"></a>
                      <a href=""><img src="../rxleaf/skin/frontend/images/american-card.png"></a>
                </div>
            </div>
                        
                        <div class="col-xs-6">
                                <label for="ex1">Card Expiration</label>
                                         <div class="col-xs-3">
                                        <select class="form-control">
                                              <option>06</option>
                                              <option>07</option>
                                              <option>08</option>
                                              <option>08</option>
                                              <option>10</option>
                                        </select>
                      </div>
                                <div class="col-xs-4">
                                        <select class="form-control">
                                              <option>2017</option>
                                              <option>2018</option>
                                              <option>2019</option>
                                              <option>2020</option>
                                              <option>2021</option>
                                        </select>
                      </div>
                                         <div class="col-xs-4">
                                             <label>CVV</label>
                        <input name="phone" class="form-control" value="" size="4" maxlength="4" required="required" title="" type="tel" placeholder="8888">
                    </div>
                                         
                              </div>
                              </div>
                        
                </form>
                </div>
                
              </div>
            <div class="modal-footer">
					<button type="button" class="btn-danger btn-red"><i class="fa fa-trash-o" aria-hidden="true"></i>Remove</button>
                    <button type="button" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                    <button type="button" class="btn-saves-settings"><i class="fa fa-check" aria-hidden="true"></i>Post</button>
        </div>
        </div>
      </div>
</div>
  
   
