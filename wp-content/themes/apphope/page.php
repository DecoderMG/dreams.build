<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
<style>
.page-template-default .top_banner{background:url(<?=get_field( "top_banner" )?>) no-repeat 0 0 /cover;}
</style>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php the_title();?></h1>
			</div>
		</div>
	</div>
</div>
<div class="wide_content gray"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="whitebox"><?php the_content(); ?></div>
			</div>
		</div>
	</div>
</div>
<?php endwhile;?>

<?php get_footer(); ?>
