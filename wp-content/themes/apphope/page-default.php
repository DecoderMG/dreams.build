<?php
/*Template Name: Page Default*/
get_header(); ?>
<style>
.page-template-page-default .top_banner{background:url(<?=get_field( "top_banner" )?>) no-repeat 0 0 /cover;}
</style>
<?php while (have_posts()) : the_post();?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php the_title();?></h1>
			</div>
		</div>
	</div>
</div>
<div class="container mt-28">
	<div class="row main-content">
		<div class="col-lg-12">
			<?php the_content();?>
		</div>
	</div>
</div>
<?php endwhile;?>
<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>