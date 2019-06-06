<div class="col-lg-2 guidebook-sidebar">
	<div class="whitebox parted">
		<?php global $categories,$the_query;$cur_cat = get_query_var('category')?get_query_var('category'):$post->post_name;$categories = get_categories(array('type'  => 'guide', 'taxonomy' => 'guide_category','hide_empty'=>0,'orderby'=>'name','order'  =>'ASC'));?>
		<?php //$curID = get_the_ID();$args = array('post_type' => 'page', 'posts_per_page'   => -1,'post_parent' => 12, 'orderby'=>'menu_order','order'=>'ASC'); $query = new WP_Query($args);?>

		<?php $i=0;foreach($categories as $category): ?>
			<?php $trans = array("-1-" => "","-2-" => "","-3-" => "","-4-" => "","-5-" => "",);?>
			<a <?=($cur_cat==$category->slug)?'':'href="/guidebook/'.$category->slug.'"';?> class="title <?=($cur_cat==$category->slug)?'active current':''?>"><?=strtr($category->cat_name,$trans);?></a>
			<?php if($cur_cat==$category->slug):?>
				<?php $args = array( 'post_type' => 'guide', 'post_status'=>'publish', 'posts_per_page' => -1,'orderby'=>'menu_order','order'=>'ASC', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'guide_category','field' => 'slug',  'terms' => $category->slug)));
					//if(!empty($cur_query)) $args['s'] = $cur_query;
					$the_query = new WP_Query( $args );?>
				<?php if ( $the_query->have_posts() ) :?>
				<div class="part <?=($cur_cat==$category->slug)?'active':'';?>">
					<?php while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
						<a href="/guidebook/<?=$category->slug?>/#<?=$post->post_name?>"><?php the_field('sidebar_title');?></a>
					<?php endwhile;?>
				</div>
				<?php endif;?>
			<?php endif;?>
		<?php $i++;endforeach;wp_reset_postdata();wp_reset_query();?>
		
		
		<?php /*if ( $query->have_posts() ) :?>
			<?php $i=0;while ($query-> have_posts() ) : $query->the_post();$i++;?>
				<?php $title = get_the_title(); $title = str_ireplace('a dream', '<br/><span>a dream</span>', $title);$title = str_ireplace('your dream', '<br/><span>your dream</span>', $title);?>
				<a <?=get_the_ID()==$curID?'':'href="'.get_the_permalink().'"';?> class="title<?=get_the_ID()==$curID?' current active':''?>"><?=$title;?></a>
				<div class="part<?=get_the_ID()==$curID?' active':''?>"><?php the_field('left_menu');?></div>
			<?php endwhile; ?>
		<?php endif; wp_reset_postdata();wp_reset_query();*/?>

		<?php /*<a class="title">Build<br/>your dream</span></a>
		<div class="part">
			<a href="/guidebook/build-your-dream/">What You’ll Need Detailed</a>
			<a href="/guidebook/build-your-dream/#funding-goal">Setting A Funding Goal</a>
			<a href="/guidebook/build-your-dream/#dream-tweet">Crafting A Dream Tweet</a>
			<a href="/guidebook/build-your-dream/#dream-story">Crafting The Dream Story</a>
			<a href="/guidebook/build-your-dream/#digital-files">Digital Files</a>
			<a href="/guidebook/build-your-dream/#digital-files-ideas">Ideas For Digital Files</a>
			<a href="/guidebook/build-your-dream/#digital-files-not-to-offer">What Not To Offer: Digital Files</a>
			<a href="/guidebook/build-your-dream/#incentives">Incentives</a>
			<a href="/guidebook/build-your-dream/#incentive-ideas">Ideas For Incentives</a>
			<a href="/guidebook/build-your-dream/#incentives-not-to-offer">What Not To Offer: Incentives</a>
			<a href="/guidebook/build-your-dream/#layer-your-incentives">Layering Incentives</a>
			<a href="/guidebook/build-your-dream/#time-frame">Time Frame</a>
			<a href="/guidebook/build-your-dream/#life-dream-content">Dream Content</a>
			<a href="/guidebook/build-your-dream/#two-stage-funding">Two-Stage Funding</a>
			<a href="/guidebook/build-your-dream/#dream-needs">Dream Needs</a>
		</div>
		<a class="title">Manage<span>your dream</span></a>
		<div class="part">
			<a href="/guidebook/manage-your-dream/">Why Managing Matters</a>
			<a href="/guidebook/manage-your-dream/#updates">Updates</a>
			<a href="/guidebook/manage-your-dream/#promoting">Promoting</a>
			<a href="/guidebook/manage-your-dream/#extended-goals-and-incentives">Goals And Incentives</a>
			<a href="/guidebook/manage-your-dream/#interact-with-your-community">Community</a>
			<a href="/guidebook/manage-your-dream/#track-your-performance">Tracking Performance</a>

		</div>
		<a class="title">Fulfill<span>your dream</span></a>
		<div class="part">
			<a href="/guidebook/fulfill-your-dream/">Following Through</a>
			<a href="/guidebook/fulfill-your-dream/#follow-through-incentives">Following Through: Incentives</a>
			<a href="/guidebook/fulfill-your-dream/#promote-dream">Promotion</a>
			<a href="/guidebook/fulfill-your-dream/#receiving-funds">Receiving Funds</a>
		</div>
		<a class="title">Sponsor<span>a dream</span></a>
		<div class="part">
			<a href="/guidebook/sponsor-a-dream/">What To Look For</a>
			<a href="/guidebook/sponsor-a-dream/#sponsor-discretion">Sponsor Discretion</a>
			<a href="/guidebook/sponsor-a-dream/#selecting-incentives">Selecting Incentives</a>
			<a href="/guidebook/sponsor-a-dream/#receiving-incentives">Receiving Incentives</a>
		</div>*/?>
	</div>
</div>