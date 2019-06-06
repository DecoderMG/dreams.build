<?php global $post; 
get_header(); ?>
<?php $category = get_the_category();$total = $category[0]->category_count; ?>
<style>
<?php $blog = get_post( 285);?>
.page-template-page-blog .top_banner, .category-blog .top_banner{background:url(<?=get_field( "top_banner" ,$blog->ID)?>) no-repeat 0 0 /cover;}
</style>
<div class="top_banner">
	<div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 title-column">
				<a href="/blog" class="back-blog"><i class="fa fa-angle-left"></i> &nbsp; Blog</a>
				<h1><?=$category[0]->name;?></h1>
			</div>
			<div class="col-lg-2 blog-jumpto">
				<?php get_template_part('misc', 'jumpto'); ?>
			</div>
		</div>
	</div>
</div>

<div class="graygrid">
	<div id="ajax-params">
		<input type="hidden" name="total" value="<?=$total;?>">
	</div>
	<div class="container ">
		<div class="ajax-posts">
			<?php $i=0; if ( have_posts() ) : while ( have_posts() ) : $i++;the_post();?>
				<?php if($i===1||$i===4):?><div class="row"><?php endif;?>
				<div class="col-lg-<?=($i<4)?'4':'3';?>">
					<div class="entry-content">
						<?php if(has_post_thumbnail()):?>
							<a href="<?=the_permalink();?>"><figure class="featured-thumbnail"><span class="img-wrap"><?=the_post_thumbnail();?></span></figure></a>
						<?php endif;?>
						<div class="desc">
							<h2><?php the_title();?></h2>
							<?php the_excerpt();?>
						</div>
					</div>
				</div>
				<?php if($i===3||$i===7):?></div><?php endif;?>
			<?php endwhile;endif; ?>
			<?php if($i<3):?></div><?php endif;?>
		</div>
		<?php wp_reset_postdata();?>
		<?php if($total>$i):?>
			<a class="btn btn-green loadmore">Load More Dreams</a>
			<div class="loading-box"><div class="loading">Loading More Dreams...</div></div>
		<?php endif;?>
	</div>
</div>

<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>