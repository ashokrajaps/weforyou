   <script type="text/javascript" src="<?php echo skin_url('js/bootstrap.min.js');?>"></script>
<style type="text/css">
.plcmt_view_all {float: right;}
.m-b-20{
        margin-bottom: 10px;
}

fieldset {
      overflow: hidden
    }
    
    .radio-inline {
      float: left;
      clear: none;
    }
    
    label {
      float: left;
      clear: none;
      display: block;
      padding: 0px 1em 0px 8px;
    }
    
    input[type=radio],
    input.radio {
      float: left;
      clear: none;
      margin: 2px 0 0 2px;
    }
.success_msg{
    color:green;
    background-color: lightblue;
}
.error_msg{
    color:red;
    background-color: lightblue;
}    
.error,.required_star{
        color:red;
}
</style>
<div class="page-section " style="margin-top: 0px;margin-bottom: 0px;border-top: 0px #e0e0e0 solid;border-bottom: 0px #e0e0e0 solid;">
    <!-- Container Start -->
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="cs-plain-form cs_form_styling col-md-12">
                    <div class="form-style">
                        <h4><a href="<?php echo base_url()."viewer/educationreg"?>"><span class="col-md-4">&nbsp;</span>
<span class="col-md-4">Click Here To Register Now<span></a></h4><br>
                        <!-- success msg -->
                        <strong><span>
                                <ul id="custom_msg" class="alert"></ul>
                            </span></strong>
                        <!-- Error msg -->
                        <?php echo form_open_multipart(base_url() . 'applicationformreg', ' class="comment-form form-horizontal" id="applicationform" '); ?>
        <div class="row m-b-20">
  <a href="<?php echo base_url()."viewer/educationreg"?>">        
    <img src="<?php echo media_url()."weforeduction2020.jpg"?>" alt="">
        <div class="row">
          <span class="col-md-4">&nbsp;</span>
</div>
<span class="col-md-4">&nbsp;</span>
<span class="col-md-4">Click Here To Register Now<span>
</a>
        </div>
        
                        <?php
                        echo form_hidden('action', 'Add');
                        echo form_close();
                        ?>
                        <div id="loading_div"></div>
                        <div id="message24458641" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo load_lib() . 'jquery/jquery.validate.min.js'; ?>">
</script>
<script type="text/javascript" src="<?php echo skin_url() . 'js/custom.js'; ?>"></script>