<?php /*Template Name: Blog */
 get_header();
global $current_category;$current_category= !empty(get_query_var('catslug'))?get_category_by_slug( get_query_var('catslug') ):get_category_by_slug('blog' );

 	$args = array( 'suppress_filters' => true, 'post_type' => 'post','posts_per_page' => 7, 'orderby'=>'date', 'order'=>'DESC');
 	if(!empty($current_category)) $args['cat'] = $current_category->term_id;
    $loop = new WP_Query($args);?>
<style>
.page-template-page-blog .top_banner, .category-blog .top_banner{background:url(<?=get_field( "top_banner" )?>) no-repeat 0 0 /cover;}
</style>
<div class="top_banner">
	<div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 title-column">
				<h1><a href="/blog">Blog</a> <?php if(!empty($current_category)&&$current_category->cat_name!='Blog'):?><?='| '.$current_category->cat_name?><?php endif;?></h1>
			</div>
			<div class="col-lg-2 blog-jumpto">
				<?php get_template_part('misc', 'jumpto'); ?>
			</div>
		</div>
	</div>
</div>

<div class="graygrid">
	<div id="ajax-params">
		<input type="hidden" name="category" value="<?=(!empty($current_category))?$current_category->slug:'blog';?>">
		<input type="hidden" name="total" value="<?php $category = get_the_category();echo $current_category->category_count;?>">
	</div>
	<div class="container ">
		<div class="ajax-posts">
			<?php $i=0; if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $fl=1; $i++;$loop->the_post();?>
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
				<?php if($i===3||$i===7): $fl=0;?></div><?php endif;?>
			<?php endwhile;endif; ?> <?php if($fl):?></div><?php endif;?>
		</div>
		<?php wp_reset_postdata();?>
		<?php if($current_category->category_count > $args['posts_per_page']):?><a class="btn btn-green loadmore">Load More Posts</a><?php endif;?>
		<div class="loading-box"><div class="loading">Loading More Posts...</div></div>
	</div>
</div>

<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>