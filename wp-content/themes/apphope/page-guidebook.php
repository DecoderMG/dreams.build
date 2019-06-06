<?php
/*Template Name: About/Guidebook*/
get_header(); ?>
<?php while (have_posts()) : the_post();?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php the_field('top_title');?></h1>
				<?php the_field('top_content');?>
			</div>
		</div>
	</div>
	<img src="<?php the_field('top_image');?>" />
</div>
<div class="common_content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"><?php the_content();?></div>
		</div>
	</div>
</div>
<div class="dream-links">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"><a href="<?=get_permalink(14); ?>" class="blue">Let’s Get Started &nbsp;&nbsp;<i class="fa fa-angle-right"></i></a></div>
		</div>
	</div>
</div>
<div class="dream-links no-border">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 bordered"><a class="gray" href="/guidebook/build-your-dream">Build Your Dream</a></div>
			<div class="col-lg-3 bordered"><a class="gray" href="/guidebook/manage-your-dream">Manage Your Dream</a></div>
			<div class="col-lg-3 bordered"><a class="gray" href="/guidebook/fulfill-your-dream">Fulfill Your Dream</a></div>
			<div class="col-lg-3 bordered"><a class="gray" href="/guidebook/sponsor-a-dream">Sponsor A Dream</a></div>
		</div>
	</div>
</div>
<?php endwhile;?>
<?php get_footer(); ?>