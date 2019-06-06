<?php global $authordata,$the_query,$sp_query;?>
<script>
    jQuery(document).ready(function ($) {
    	var width = jQuery(document).width();
    	var height1 = jQuery('.content_tab_about .row').height();
    	var height2 = jQuery('.content_tab_sponsored .row').height();
    	var height3 = jQuery('.content_tab_built .row').height();
    	height = Math.max(height1, height2, height3);
    	jQuery('#author-slides').css('height',height);
    	jQuery('.slider2_container .slides').css('height',height);
    	jQuery(".content_tab_built .cats_filter").prependTo(".content_tab_built");
    	var _CaptionTransitions = [];
        var options = {
            $AutoPlay: false,
            $ArrowKeyNavigation: false,   			            //Allows arrow key to navigate or not
            //$SlideWidth: width,                                   //[Optional] Width of every slide in pixels, the default is width of 'slides' container
            $SlideHeight: height,                                  //[Optional] Height of every slide in pixels, the default is width of 'slides' container
            $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
            }
        };
        var jssor_slider2 = new $JssorSlider$("author-slides", options);

        /*jssor_slider2.$On($JssorSlider$.$EVT_PARK,  function(slideIndex)
		{
			var left_slide = (slideIndex > 0) ? (slideIndex - 1): (slideIndex + 4);
			var right_slide = (slideIndex < 2)? (slideIndex + 3) : (slideIndex + 3 - 5);
		   jQuery('#popular-slides .slide').fadeTo(1,1);
           jQuery('#popular-slides .slide:eq('+left_slide+'), #popular-slides .slide:eq('+right_slide+')').fadeTo('fast',0.4);
		});*/
    });
</script>
<div class="dream-links linked author-links">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 bordered-both"><a class="gray active" rel="0">About</a></div>
			<div class="col-lg-4 bordered"><a class="gray" rel="1">Dreams Sponsored (<?=$sp_query->found_posts?>)</a></div>
			<div class="col-lg-4 bordered"><a class="gray" rel="2">Dreams Built (<?=$the_query->found_posts?>)</a></div>
		</div>
	</div>
</div>
<div class="wide_content gray">
<div class="shadow"></div>
<div class="container toppadding33">
	<div class="row">
		<!-- Jssor Slider Begin -->
		<div id="author-content">
			<!-- To move inline styles to css file/block, please specify a class name for each element. --> 
			<div id="author-slides" class="slider2_container jssor">
			     <!-- Loading Screen -->
			    <div class="loading" u="loading"><div class="over"></div><div class="load"></div></div>
			    <div u="slides" class="slides">
					<div class="slide entry-content content_tab_container content_tab_about">
						<div class="row">
							<div class="col-lg-8">
								<div class="whitebox np nm">
									<div class="whitebox-block bordered">
										<h3>Biography</h3>
										<?php $from = get_current_user_id();$authormeta = get_user_meta($authordata->ID); //print_r($authormeta);?>
										<?php if(!empty($authordata->description)):?><h4><?=$authordata->description?></h4><?php endif;?>
										<?php if(!empty($authordata->full_description)):?><p><?=nl2br($authordata->full_description)?></p><?php endif;?>
										<?php if($from!=$authordata->ID && !empty($from)):?>
											<a class="btn btn-blue popup-new-message" href="#new-message-popup">Contact User</a>
										<?php endif;?>
									</div>
									<div class="whitebox-block">
										<h4>Links</h4>
										<div class="follow_links">
											<?php if(!empty($authormeta['facebook'][0])):?><a href="<?=$authormeta['facebook'][0]?>" class="icon_facebook"></a><?php endif;?>
											<?php if(!empty($authormeta['twitter'][0])):?><a href="<?=$authormeta['twitter'][0]?>" class="icon_twitter"></a><?php endif;?>
											<?php if(!empty($authormeta['google'][0])):?><a href="<?=$authormeta['google'][0]?>" class="icon_google"></a><?php endif;?>
											<?php if(!empty($authormeta['linkedin'][0])):?><a href="<?=$authormeta['linkedin'][0]?>" class="icon_in"></a><?php endif;?>
											<?php if(!empty($authormeta['instagram'][0])):?><a href="<?=$authormeta['instagram'][0]?>" class="icon_instagram"></a><?php endif;?>
											<?php if(!empty($authordata->user_url)):?><a href="<?=$authordata->user_url?>" class="icon_website"></a><?php endif;?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 profile-sidebar">
								<?php if ($the_query->have_posts()) : ?>
									<h4>Most Recent Dream</h4>
									<?php $i=0;while ($the_query->have_posts()) : $the_query -> the_post();?>
										<?php if(!$i) get_template_part('entry', 'single'); ?>
									<?php $i++;endwhile;?>
								<?php else:?>
									<h4>No Dreams Built</h4>
								<?php endif;?>
							</div>
		
						</div>
					</div>
					<div class="slide entry-content content_tab_container content_tab_sponsored">
						<div class="row">
							<?php if ($sp_query->have_posts()) : ?>
								<?php $cats_array= array();$i=0;while ($sp_query->have_posts()) : $sp_query->the_post();?>
									<div class="col-lg-4 built-single<?php $cats = get_the_category(); foreach($cats as $cat) {$cats_array[] = $cat; echo ' '.$cat->slug;}?>"><?php get_template_part('entry', 'single'); ?></div>
								<?php $i++;endwhile;?>
							<?php else:?>
								<div class="col-lg-12"><h4>No Dreams Sponsored</h4></div>
							<?php endif;?>
						</div>
					</div>
					<div class="slide entry-content content_tab_container content_tab_built">
						<div class="row">
							<?php if ($the_query->have_posts()) : ?>
								<?php $cats_array= array();$i=0;while ($the_query->have_posts()) : $the_query->the_post();?>
									<div class="col-lg-4 built-single<?php $cats = get_the_category(); foreach($cats as $cat) {$cats_array[] = $cat; echo ' '.$cat->slug;}?>"><?php get_template_part('entry', 'single'); ?></div>
								<?php $i++;endwhile;?>
							<?php else:?>
								<div class="col-lg-12"><h4>No Dreams Built</h4></div>
							<?php endif;?>
						</div>
						<!--<div class="cats_filter">
							<?php// foreach($cats_array as $cat):?>
								<a rel="<?//=$cat->slug?>" class=""><i class="fa fa-tag"></i> <?//=$cat->name?></a>
							<?php //endforeach;?>
						</div> -->
					</div>
			    </div>
		        <div u="navigator" class="jssorb01"><!-- bullet navigator item prototype --><div u="prototype"></div></div>
			</div>
			<!-- Jssor Slider End -->
		</div>

	</div>
</div>
</div>