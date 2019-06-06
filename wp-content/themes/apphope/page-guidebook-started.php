<?php
/*Template Name: About/Guidebook/Internal*/
get_header(); ?>

<style>
.page-template-page-guidebook-started .top_banner{background:url(<?=get_field( "top_banner" )?>) no-repeat 0 0 /cover;}
</style>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="/guidebook"><h2>The Guidebook</h2></a>
				<h1><?php the_title();?></h1>
			</div>
		</div>
	</div>
</div>
<div class="container mt-28">
	<div class="row mb-20">
		<div class="col-lg-12">
			<?php $cur_query = get_query_var('search');$cur_cat = get_query_var('category')?get_query_var('category'):'all';//global $wp_rewrite;print_r($wp_rewrite->rules);?>
			<form method="post" action="" class="search">
				<div class="formrow">
					<input id="search-input" class="search-input" type="text" placeholder="Search" value="<?=$cur_query?>" name="search">
					<input type="submit" class="submit" name="guidesubmit" />
				</div>
			</form>
		</div>
	</div>
	<div class="row main-content">
		<?php get_template_part('inc/guidebook/leftmenu', ''); ?>
		<div class="col-lg-10">
			<div class="row">
				<div class="col-lg-9 entries">
					<?php $cur_cat = get_query_var('category')?get_query_var('category'):$post->post_name; $args = array( 'post_type' => 'guide', 'post_status'=>'publish', 'posts_per_page' => -1,'orderby'=>'menu_order','order'=>'ASC', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'guide_category','field' => 'slug',  'terms' => $cur_cat)));
							if(!empty($cur_query)) $args['s'] = $cur_query;
						$the_query = new WP_Query( $args );?>
					<?php if ( $the_query->have_posts() ) :?>
						<?php while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
							<a name="<?=$post->post_name?>"></a>
							<h3><strong><?php the_title();?></strong></h3>
							<?php the_content();?>
							<hr/>
						<?php endwhile;?>
					<?php endif;wp_reset_postdata();wp_reset_query();?>
					<?php while (have_posts()) : the_post();?>
						<?php the_content();?>
					<?php endwhile;?>
				</div>
				<?php get_template_part('inc/guidebook/popular', ''); ?>
			</div>
		</div>
	</div>
</div>

<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>