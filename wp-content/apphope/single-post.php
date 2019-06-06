<?php get_header(); ?>
<?php $category = get_the_category();?>
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
<div class="gray_content">
	<div class="post-meta"><time datetime="<?php the_time('M. d, Y'); ?>"><?php the_time('M. d, Y'); ?></time> | <?=$category[0]->name;?></div>
	<?php if(has_post_thumbnail()):?>
		<a href="<?=the_permalink();?>"><figure class="featured-thumbnail"><span class="img-wrap"><?=the_post_thumbnail();?></span></figure></a>
	<?php endif;?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php the_content();?>
			</div>
		</div>
	</div>
</div>
<?php endwhile;?>
<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>