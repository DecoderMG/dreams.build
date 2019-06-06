<?php global $post; ?>
<?php get_header(); ?>
<div class="top_banner "><div class="shadow"></div></div>
<?php get_template_part( 'searchbar' ); ?>
<div class="graygrid">
	<div class="container">
		<div style="display:none;"><?php print_r($current_category);?></div>
		<form role="search" name="searchform" id="searchform" action="" method="post">
			<?php get_template_part( 'advsearch' ); ?>
			<div id="ajax-params">
				<input type="hidden" name="category" value="<?=get_query_var('cat'); ?>">
				<input type="hidden" name="place" value="any">
				<input type="hidden" name="key" value="">
				<input type="hidden" name="pageNumber" value="">
				<input type="hidden" name="total" value="<?=$current_category->count?>">
				<input type="hidden" name="orderby" value="Popularity">
			</div>
		</form>
		<div class="ajax-posts">
				<?php 
					// Start the loop
					/*if ( have_posts() ) : $i=0; while ( have_posts() ) : the_post(); $i++;
						get_template_part('entry');
						endwhile;
						endif; 
					wp_reset_postdata();*/
					//next_posts_link(__('&laquo; Older Entries', 'fivehundred'));
					//previous_posts_link(__('Newer Entries &raquo;', 'fivehundred'));
				?>
				<?php //get_template_part( 'nav', 'below' ); ?>
		</div>
		<?php //if($i<$current_category->count):?>
		<a class="btn btn-green loadmore">Load More Dreams</a>
		<?php //endif;?>
		<div class="loading-box"><div class="loading">Loading More Dreams...</div></div>
	</div>
</div>
<?php get_footer(); ?>