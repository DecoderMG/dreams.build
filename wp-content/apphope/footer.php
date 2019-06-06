<?php /** The template for displaying the footer */ ?>
<?php if ( ! (bp_is_user_profile() && bp_current_action()=='change-avatar' ) ):?>
<footer class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6"><?php get_template_part('inc/subscription', ''); ?></div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row">
			<div class="col-lg-6 footer-explore">
				<h4>Explore</h4>
					<?php $categories = get_categories( array('type'  => 'ignition_product', 'taxonomy' => 'category','hide_empty'=>0,'exclude'=>'1,36,47,46,232,233,234') );
						$count = 25;shuffle($categories);
						$right_cats = array();
						foreach ($categories as $category):
							if(!is_numeric($category->slug)):
								array_push($right_cats, $category); 
							endif;
						endforeach;
						$collection = array_slice($right_cats, 0, 6, true);
					 ?> 
					<?php foreach ($collection as $category):?>
						<a href="<?=get_category_link( $category->term_id )?>" class="cat <?= $category->slug?>"><em></em><span><?=$category->cat_name?> <i class="fa fa-angle-right"></i></span></a>
					<?php endforeach;?>
					<br clear="both"/>
					<a class="white-button" href="<?=get_permalink(60);?>">Explore the other <?=$count-6?> categories</a>
			</div>
			<div class="col-lg-1"></div>
			<div class="col-lg-2 footer-links">
				<div class="first">
					<h4>Help</h4>
					<a href="<?=get_permalink(12); ?>">Guidebook</a>
					<a href="<?=get_permalink(46); ?>">Support</a>
					<a href="<?=get_permalink(52); ?>">How it Works</a>
					<a href="<?=get_permalink(8); ?>">FAQ</a>
				</div>
				<div class="second">
					<h4>Dreams.Build</h4>
					<a href="<?=get_permalink(39); ?>">About Us</a>
					<a href="/blog">Blog</a>
					<a href="<?=get_permalink(18082);?>">Press & Branding</a>
					<?php /*<a href="/contact-us">Contact Us</a>*/?>
					<a href="<?=get_permalink(18122);?>">Platform Comparisons</a>
				</div>
			</div>
			<div class="col-lg-3 footer-social">
				<div class="row">
					<div class="col-lg-10">
						<div class="first">
							<h4>Keep In Touch</h4>
							<a target="_blank" href="https://www.facebook.com/dreamsdotbuild" class="social-facebook"><em class="fa fa-facebook"></em> Like us on Facebook</a>
							<a target="_blank" href="https://twitter.com/DreamsdotBuild" class="social-twitter"><em class="fa fa-twitter"></em> Follow on Twitter</a>
							<a target="_blank" href="https://plus.google.com/+DreamsBuildFund" class="social-google"><em class="fa fa-google-plus"></em> Follow on Google+</a>
						</div>
						<div class="second">
							<h4>Language</h4>
							<?php echo do_shortcode('[gtranslate]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="divider" />
		<div class="row copy">
			<div class="col-lg-4">
				<a href="/"><img src="<?=get_stylesheet_directory_uri()?>/img/logo-white.png" width="195" height="33" class="logo" /></a>
				<p>&copy; <?=date('Y')?> Application Hope<sup>&trade;</sup>, LLC.</p>
			</div>
			<div class="col-lg-4 center">
				<p><a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms-of-service/">Terms of Service</a></p>
			</div>
			<div class="col-lg-4 badges">
				<a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=dreams.build','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/dreams.build" /></a>
			</div>
		</div>
	</div>
</footer>
<a id="scrollUp" title="Scroll to top"></a>
<?php endif;?>
<?php wp_footer();//global $wp_filter;print_r($wp_filter); ?>
	<script>
	jQuery(document).ready(function(){
		jQuery('input[type=checkbox]').styler({});

	
	})
	</script>
</body>
</html>