<script>
    jQuery(document).ready(function ($) {
    	var width = jQuery(document).width();
    	var container = jQuery('.container:first').width();
    	var _CaptionTransitions = [];
    	var slideWidth = ((width-120)/4<290)?290:(width-120)/4;
    	var pieces = Math.floor(width/(slideWidth+30));
        var options = {
            $AutoPlay: true,
            $AutoPlayInterval : 8000,
            $SlideDuration: 1000,
            $PauseOnHover: 1,  //[Optional] Whether to pause when mouse over if a slideshow is auto playing, default value is false
            $ArrowKeyNavigation: true,   			            //Allows arrow key to navigate or not
            $SlideWidth: slideWidth,                                   //[Optional] Width of every slide in pixels, the default is width of 'slides' container
            $SlideHeight: 525,                                  //[Optional] Height of every slide in pixels, the default is width of 'slides' container
            $SlideSpacing:30, 					                //Space between each slide in pixels
            $Cols: 3, //Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
            $ParkingPosition: (pieces>3)?parseInt((width-container-120)/2):0, //The offset position to park slide (this options applys only when slideshow disabled).
            $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                $AutoCenter: 2, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
            }
        };
        var jssor_slider2 = new $JssorSlider$("popular-slides", options);
		
		//responsive code begin
        //remove responsive code if you don't want the slider scales
        //while window resizing
        function ScaleSlider() {
            var parentWidth = $(window).width();
            if (parentWidth) {
                jssor_slider2.$SlideWidth(parentWidth);
            }
            else
                window.setTimeout(ScaleSlider, 30);
        }
        //Scale slider after document ready
        ScaleSlider();
                                        
        //Scale slider while window load/resize/orientationchange.
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end

        jssor_slider2.$On($JssorSlider$.$EVT_PARK,  function(slideIndex)
		{
			var left_slide = (slideIndex > 0) ? (slideIndex - 1): (slideIndex + 4);
			var right_slide = (slideIndex < 2)? (slideIndex + 3) : (slideIndex + 3 - 5);
			/*console.log(slideIndex+': '+left_slide+'/'+right_slide);*/
		   jQuery('#popular-slides .slide').fadeTo(1,1);
           jQuery('#popular-slides .slide:eq('+left_slide+'), #popular-slides .slide:eq('+right_slide+')').fadeTo('fast',0.4);
		});
        
    });
</script>
<!-- Jssor Slider Begin -->
<!-- To move inline styles to css file/block, please specify a class name for each element. --> 
<div id="popular-slides" class="slider2_container jssor" style="height: 532px;">
     <!-- Loading Screen -->
    <div class="loading" u="loading"><div class="over"></div><div class="load"></div></div>
    <div u="slides" class="slides">
        <?php 
	        $args = array( 'post_type' => 'ignition_product', 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'/*'tax_query' => array('relation' => 'AND', array('taxonomy' => 'post_tag','field' => 'slug', 'terms' => 'trending', 'operator' => 'IN'))*/,'post_status'=>'publish', 'posts_per_page' => 8  );
	        $the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) : $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>

					<div class="slide num<?=$i?>">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
		            	<a href=""><img class="image" u="image" src="<?=$image[0]?>" /></a>
		            	<div class="box">
			            	<?php $aurl = get_author_posts_url( get_the_author_meta( 'ID' ) );$user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');?>
		            		<div class="avatar"><a href="<?=$aurl?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?><?php /*<img src="<?=get_stylesheet_directory_uri()?>/img/avatar.jpg">*/?></a><div class="name"><a href="<?=$aurl?>"><?=(empty($user_firstname))?get_the_author():$user_firstname.' '.$user_lastname;?></a></div></div>
		            		<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
		            		<p><?=esc_html(get_post_meta($post->ID, 'ign_project_description', true));?></p>
		            		<div class="bottom">
		            			<div class="bottom-inner">
		            				<?php $summary = the_project_summary($post->ID); $summary_int = intval(str_replace(',','',str_replace('$','',$summary->goal)));?>
			            			<div class="progress-sums"><div class="progress-sum"><?=$summary->total;?></div><div class="progress-goal <?=($summary_int>10000000)?'small':''?>"><strong><?=$summary->goal;?></strong> goal</div></div>
				            		<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?=$summary->percentage?>%"></div></div>
				            		<div class="progress-percent"><strong>%<?=$summary->percentage?></strong> funded</div><div class="progress-days"><strong><?=$summary->days_left?> </strong> to go</div><div class="progress-stage"><strong>Stage <?=$summary->stage?>/</strong>2</div>
				            	</div>
		            		</div>
		            	</div>
		            </div>
					
					
					
			<?php endwhile;endif; 
			wp_reset_postdata();wp_reset_query(); ?>
    </div>
    <span u="arrowleft" class="jssora13l"></span>
    <span u="arrowright" class="jssora13r"></span>
</div>
<!-- Jssor Slider End -->