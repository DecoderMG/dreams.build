<?php
global $post;
$id = $post->ID;
$content = the_project_content($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
?>
<?php /*<div id="site-description">
	<h1><?php echo $content->name; ?> </h1>
	<h2><?php echo $content->short_description; ?></h2> 
</div>*/?>
<?php //get_template_part( 'project', 'hDeck' ); ?>
<script>
    jQuery(document).ready(function ($) {
    	var width = jQuery(document).width();
    	var contentheight = jQuery('.content_tab_campaign .ignition_project').outerHeight()+250;
		var rightheight = jQuery('.content_tab_campaign .right-sidebar').outerHeight()+250;
		var height = 0;
		if(rightheight > contentheight) {
			jQuery('#dashboard-slides').css('height',rightheight);
			height = rightheight;
		} else {
			jQuery('#dashboard-slides').css('height',contentheight);
			height = contentheight;
		}
    	
    	/*jQuery('.slider2_container .slides').css('height',height);*/
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
        var jssor_slider2 = new $JssorSlider$("dashboard-slides", options);

        jssor_slider2.$On($JssorSlider$.$EVT_PARK,  function(slideIndex)
		{jQuery('#dashboard-slides .slide').removeClass('active');
			jQuery('#dashboard-slides .slide').eq(slideIndex).addClass('active');
		});
    });
</script>
<a name="top"></a>
<!-- Jssor Slider Begin -->
<div id="ign-project-content" class="ign-project-content">
	<!-- To move inline styles to css file/block, please specify a class name for each element. --> 
	<div id="dashboard-slides" class="slider2_container jssor">
	     <!-- Loading Screen -->
	    <div class="loading" u="loading"><div class="over"></div><div class="load"></div></div>
	    <div u="slides" class="slides">

			<div class="slide entry-content content_tab_container content_tab_campaign">
				<div class="row" style="overflow:hidden">
					<?php $GLOBALS['section'] = 'campaign';?>
					<?php get_template_part('nav', 'project-sidebar'); ?>
					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-9">
								<article <?php /*id="content"*/ ?>class="ignition_project">
									<div class="whitebox">
										<a name="about"></a>
										<h3>About</h3>
										<?php do_action('id_before_content_description', $project_id, $id);do_action('id_after_content_description', $project_id, $id); ?>
										<span class="notranslate"><?php echo apply_filters('the_content', $content->long_description); ?></span>
										<hr class="full"/>
										<a name="challenges"></a>
										<h3>Challenges</h3>
										<p class="notranslate"><?php echo get_post_meta($id, 'ign_challenges', true);?></p>
										<hr class="full"/>
										<a name="faq"></a>
										<h3>FAQ</h3>
										<span class="notranslate"><?php echo apply_filters('fivehundred_faq', do_shortcode( '[project_faq product="'.$project_id.'"]')); ?></span>
										<p><strong>Do you have more questions?</strong></p>
										<?php global $authordata; ?>
										<?php $to_id=get_the_author_meta( 'ID' );$from = get_current_user_id();?>
										<?php if($to_id!=$from && !empty($from)){?>
											<a class="btn btn-blue large popup-new-message" href="#new-message-popup">Contact the Innovator</a>
										<?php } else if (!empty($from)) {?>
											<p class="btn btn-blue large">You can not message yourself</p>
										<?php } else {?>
											<p class="btn btn-blue large">Please login to message this innovator</p>
										<?php } ?>
										<hr class="full"/>
										<a name="follow"></a>
										<h3>Follow</h3>
										<?php $facebook = esc_html(get_post_meta($id, 'ign_follow_facebook', true));
													$twitter = esc_html(get_post_meta($id, 'ign_follow_twitter', true));
													$google = esc_html(get_post_meta($id, 'ign_follow_google', true));
													$in = esc_html(get_post_meta($id, 'ign_follow_in', true));
													$instagram = esc_html(get_post_meta($id, 'ign_follow_instagram', true));
													$website = esc_html(get_post_meta($id, 'ign_follow_website', true));
										?>
										<?php if(!empty($facebook)||!empty($twitter)||!empty($google)||!empty($in)||!empty($instagram)||!empty($website)):?>
											<p>Find this dream on:</p>
											<div class="follow_links">
											<?php if(!empty($facebook)):?><a href="<?=$facebook?>" class="icon_facebook"></a><?php endif;?>
											<?php if(!empty($twitter)):?><a href="<?=$twitter?>" class="icon_twitter"></a><?php endif;?>
											<?php if(!empty($google)):?><a href="<?=$google?>" class="icon_google"></a><?php endif;?>
											<?php if(!empty($in)):?><a href="<?=$in?>" class="icon_in"></a><?php endif;?>
											<?php if(!empty($instagram)):?><a href="<?=$instagram?>" class="icon_instagram"></a><?php endif;?>
											<?php if(!empty($website)):?><a href="<?=$website?>" class="icon_website"></a><?php endif;?>
											</div>
										<?php endif;?>
										<hr class="full"/>
										<a name="share"></a>
										<h3>Share</h3>
										<div class="share_link"><span><?=get_permalink( $post->ID );?></span><a>copy link</a></div>
										<div id="ign-hDeck-social">
											<?php
											$social_settings = get_option('idsocial_settings');
											$post_id = $id;
											include_once plugin_dir_path(dirname(__FILE__)).'../plugins/ignitiondeck-crowdfunding/templates/_socialButtons.php';
											?>
										</div>
										<hr class="full"/>
										<a name="needs"></a>
										<h3>Needs</h3>
										<span class="notranslate"><?=get_post_meta($post->ID, 'ign_project_needs', true);?></span>
									</div>
								</article>
							</div>
							<div class="col-lg-3 right-sidebar">
								<?php get_template_part('project','right-sidebar');?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slide entry-content content_tab_container content_tab_updates">
				<div class="row" style="overflow:hidden">
					<?php $GLOBALS['section'] = 'updates';?>
					<?php get_template_part('nav', 'project-sidebar'); ?>
					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-9">
								<article <?php /*id="content"*/ ?>class="ignition_project">
									<!-- <div class="whitebox"> -->
										<a name="updates"></a>
										<?php echo apply_filters('fivehundred_updates', do_shortcode( '[project_updates product="'.$project_id.'"]')); ?>
									<!-- </div> -->
								</article>
							</div>
							<div class="col-lg-3 right-sidebar">
								<?php get_template_part('project','right-sidebar');?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slide entry-content content_tab_container content_tab_comments">
				<div class="row" style="overflow:hidden">
					<?php $GLOBALS['section'] = 'comments';?>
					<?php get_template_part('nav', 'project-sidebar'); ?>
					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-9">
								<article <?php /*id="content"*/ ?>class="ignition_project">
									<div class="whitebox">
										<h3>Comments</h3>
										<?php if(empty($_REQUEST['preview'])) comments_template('/comments.php', true); ?>
									</div>
								</article>
							</div>
							<div class="col-lg-3 right-sidebar">
								<?php get_template_part('project','right-sidebar');?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slide entry-content content_tab_container content_tab_funders">
				<div class="row" style="overflow:hidden">
					<?php $GLOBALS['section'] = 'sponsors';?>
					<?php get_template_part('nav', 'project-sidebar'); ?>
					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-9">
								<article <?php /*id="content"*/ ?>class="ignition_project">
									<div class="whitebox">
										<?php if(empty($_REQUEST['preview'])) do_action('fh_below_project', $project_id, $id); ?>
										<?php if(empty($_REQUEST['preview'])) get_template_part( 'project', 'sidebar' ); ?>
									</div>
								</article>
							</div>
							<div class="col-lg-3 right-sidebar">
								<?php get_template_part('project','right-sidebar');?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slide entry-content content_tab_container content_tab_gallery">
				<div class="row" style="overflow:hidden">
					<?php $GLOBALS['section'] = 'gallery';?>
					<?php get_template_part('nav', 'project-sidebar'); ?>
					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-12">
								<article <?php /*id="content"*/ ?>class="ignition_project">
									<div class="whitebox">
										<h3>Gallery</h3>
										<?php  $img2 = esc_html(get_post_meta($id, 'ign_product_image2', true));
													$img3 = esc_html(get_post_meta($id, 'ign_product_image3', true));
													$img4 = esc_html(get_post_meta($id, 'ign_product_image4', true));?>
										<?php if(!empty($img2)):?><img src="<?=$img2?>" /><?php endif;?>
										<?php if(!empty($img3)):?><img src="<?=$img3?>" /><?php endif;?>
										<?php if(!empty($img4)):?><img src="<?=$img4?>" /><?php endif;?>
									</div>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
        <div u="navigator" class="jssorb01">
            <!-- bullet navigator item prototype --><div u="prototype"></div>
        </div>
	</div>
	<!-- Jssor Slider End -->
</div>