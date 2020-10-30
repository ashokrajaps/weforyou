<?php 
    echo get_template('layout/head_section');
    echo get_template('layout/header');
    echo get_template('layout/home_page_slider');
     echo get_template('layout/latest_event_list');
?>

									<!--<div class="clear"></div>-->

									<div class="clear"></div>
<?php 
    echo get_template('layout/our_donators');
?>
									<!--<div class="clear"></div>-->
<?php 
    //echo get_template('layout/need_your_help');
?>
									<!--<div class="clear"></div>-->
 <?php 
    //echo get_template('layout/latest_news');
?> 

									<div class="clear"></div>
<?php 
    echo get_template('layout/footer');
?>
<div id="appfromModal" class="modal fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Weforyou.ngo And Sahara Trust Run Together,
educational Opportunity Camp For Free Nursing Course </h4>
            </div>
            <div class="modal-body">
				<?php echo get_template('viewer_home_popup.php');
				?> 
            </div>

        </div>
    </div>
</div>
<script type='text/javascript' src="<?php echo skin_url('js/jquery.nivo.slider.js');?>"></script>
<script type='text/javascript' src="<?php echo skin_url('testimonialsrotator/js/jquery.quovolver.min.js');?>"></script>
<script type='text/javascript' src="<?php echo skin_url('testimonialsrotator/js/bootstrap.js');?>"></script>
<script type='text/javascript' src="<?php echo skin_url('js/home.js');?>"></script>


<script>
jQuery(window).bind('scroll', function() {
var wwd = jQuery(window).width();
if( wwd > 939 ){
var navHeight = jQuery( window ).height() - 0;
}
});
jQuery(window).load(function() {
jQuery('#slider').nivoSlider({
effect:'random', //sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse
animSpeed: 500,
pauseTime: 4000,
directionNav: false,
controlNav: true,
pauseOnHover: false,
});
});    
//jQuery.noConflict();
    jQuery(document).ready(function(){
        jQuery("#appfromModal").modal('show');
    });     
</script>