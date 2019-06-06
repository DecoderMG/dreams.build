<?php
/*Template Name: Contact Us*/
get_header(); ?>
<?php while (have_posts()) : the_post();?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12"><h1><?php the_title();?></h1></div>
		</div>
	</div>
</div>
<div class="container mt-28">
	<div class="row main-content">
		<div class="col-lg-7">
			<?=do_shortcode('[contact-form-7 id="386" title="Contact form"]');?>
		</div>
		<div class="col-lg-5">
		</div>
	</div>
</div>
<?php endwhile;?>
<?php get_footer(); ?>