<script>
jQuery(document).ready(function ($) {
  	var width = jQuery(document).width();
  	var container = jQuery('.explore-dreams .container').outerWidth();
  	var _CaptionTransitions = [];
    var options = {
        $AutoPlay: true,
        $AutoPlayInterval : 8000,
        $SlideDuration: 1000,
        $PauseOnHover: 1,  //[Optional] Whether to pause when mouse over if a slideshow is auto playing, default value is false
        $ArrowKeyNavigation: true,   			            //Allows arrow key to navigate or not
        $SlideWidth: container,                                   //[Optional] Width of every slide in pixels, the default is width of 'slides' container
        $SlideHeight: 400,                                  //[Optional] Height of every slide in pixels, the default is width of 'slides' container
        $SlideSpacing: 0, 					                //Space between each slide in pixels
        $DisplayPieces: 1, //Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
        $ParkingPosition: parseInt((width-container)/2), //The offset position to park slide (this options applys only when slideshow disabled).
        $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
            $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
            $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
            $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
            $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
        },
        $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
            $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
            $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
            $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
            $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
            $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
        },
        $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
        }
    };
    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    /*function ScaleSlider() {
        var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
        if (parentWidth) jssor_slider1.$ScaleWidth(Math.min(parentWidth, 1400));
        else  window.setTimeout(ScaleSlider, 30);
    }
    ScaleSlider();

    $(window).bind("load", ScaleSlider); $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);*/
    //responsive code end
		jssor_slider1.$On($JssorSlider$.$EVT_PARK,  function(slideIndex){
			jQuery('#slider1_container .slide').not(':eq('+slideIndex+')').fadeTo('fast',0.4);
			jQuery('#slider1_container .slide:eq('+slideIndex+')').fadeTo('fast',1);
	});
});
</script>
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider1_container" style="height: 400px;">
    	<div class="shadow"></div>
         <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?=get_stylesheet_directory_uri()?>/img/loading.gif) no-repeat center center;top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
        <div u="slides" class="slides">
				<?php while (have_posts()) : the_post();?>
		        <div class="slide">
			        <?php the_post_thumbnail( 'full' );?>
	                <div u=caption t="*" class="caption"> 
		                <?php the_content();?>
	                	<div class="buttons-set">
		                	<?=get_field('buttons');?>
		                	<?php /*<a class="btn btn-blue" href="/dashboard/?create_project=1">BUILD YOUR DREAM</a><a class="btn btn-green" href="/explore/">SPONSOR A DREAM</a>*/?>
	                	</div>
	                </div>
	            </div>
			<?php endwhile;?>
        </div>
        <style>
            /* jssor slider bullet navigator skin 01 css */
            /* .jssorb01 div           (normal)   .jssorb01 div:hover     (normal mouseover)
            .jssorb01 .av           (active)  .jssorb01 .av:hover     (active mouseover)   .jssorb01 .dn           (mousedown)  */
        </style>
        <div u="navigator" class="jssorb01" style="bottom: 16px; right: 10px;">
            <!-- bullet navigator item prototype --><div u="prototype"></div>
        </div>
        <span u="arrowleft" class="jssora13l"></span>
        <span u="arrowright" class="jssora13r"></span>
    </div>
    <!-- Jssor Slider End -->