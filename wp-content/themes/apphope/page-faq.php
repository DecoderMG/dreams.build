<?php
/*Template Name: FAQ*/
get_header(); ?>
<style>
.page-template-page-faq .top_banner{background:url(<?=get_field( "top_banner" )?>) no-repeat 0 0 /cover;}
</style>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<a href="/faqs"><h1>Frequently Asked Questions</h1></a>
			</div>
			<?php /*<div class="col-lg-5">
				<div class="row">
					<div class="col-lg-5"></div>
					<div class="col-lg-7">
						<form><input id="faq-search-input" type="text" placeholder="Search the FAQ" value="" name="query"></form>
					</div>
				</div>
			</div>*/?>
		</div>
	</div>
</div>


<div class="wide_content gray">
	<div class="container">
	<div class="toppadding33"/>
		<div class="row mb-20">
			<div class="col-lg-12">
				<?php $cur_query = get_query_var('search');$entry = get_query_var('entry');$cur_cat = !empty($entry) ? -1 : (get_query_var('category')?get_query_var('category'):'all');//global $wp_rewrite;print_r($wp_rewrite->rules);?>
				<form method="post" action="<?=(!empty($entry))?'/faqs':'';?>" class="search">
					<div class="formrow">
						<input id="search-input" class="search-input" type="text" placeholder="Search" value="<?=$cur_query?>" name="search">
						<input type="submit" class="submit" name="faqsubmit" />
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 sidebar">
				<div class="row">
					<?php get_template_part('inc/faq/leftmenu', ''); ?>
				</div>
			</div>
			<div class="col-lg-9 main entries">
				<?php global $categories,$gcats;?>
				<?php $total=0;foreach($gcats as $category): if( $cur_cat==$category->slug || $cur_cat== 'all'):$j=0;?>
					<?php foreach($categories as $subcategory):  if($subcategory->parent == $category->cat_ID):?>
						<?php $args = array( 'post_type' => 'faq', 'post_status'=>'publish', 'posts_per_page' => -1, 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'faq_category','field' => 'slug', 'terms' => $subcategory->slug)));
							if(!empty($cur_query)) $args['s'] = $cur_query;
						$the_query = new WP_Query( $args );?>
						<?php if ( $the_query->have_posts() ) : $total++;?>
							<?php if(!$j):?><h5><?=$category->cat_name?></h5><?php endif;?>
							<a name="cat<?=$subcategory->cat_ID?>"></a>
							<h3><?=$subcategory->cat_name?></h3>
							<div class="whitebox entry">
								<?php $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
									<a name="faq<?php the_ID()?>"></a>
									<h4 class="entry"><?php the_title();?></h4>
									<div class="entry_content"><?php the_content();?></div>
								<?php endwhile; ?>
							</div>
						<?php endif; wp_reset_postdata();wp_reset_query();?>
					<?php $j++;endif;endforeach;?>
				<?php endif;endforeach;?>
				<?php if( !empty($entry)):?>
					<?php $args = array( 'post_type' => 'faq', 'post_status'=>'publish', 'posts_per_page' => 1, 'page_id'=>$entry );
					$the_query = new WP_Query( $args );?>
					<?php if ( $the_query->have_posts() ) :$total++;?>
						<div class="whitebox entry">
							<?php $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
								<a name="faq<?php the_ID()?>"></a>
								<h4 class="entry"><?php the_title();?></h4>
								<div class="entry_content active"><?php the_content();?></div>
							<?php endwhile; ?>
						</div>
					<?php endif; wp_reset_postdata();wp_reset_query();?>
				<?php endif;?>
				<?php if(!$total):?>
					<p>No results found.</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>