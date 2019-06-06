<?php
/*Template Name: Home Page*/
get_header(); global $wpdb;?>
<?php $pending = $wpdb->get_var( "SELECT SUM(prod_price) FROM wp_sHAbFYcUYmLV_ign_pay_info WHERE status_pay = 1 OR status_pay = 2" );?>
<?php //get_template_part('inc/home/slides', ''); ?>
<?php putRevSlider('homepage-main-head', 'homepage'); ?>
<div class="dream-links after-slides">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 bordered-both"><a class="scroll" href="#trending-dreams">Trending Dreams</a></div>
			<div class="col-lg-4 bordered"><a class="scroll" href="#explore-dreams">Explore Dreams</a></div>
			<div class="col-lg-4 bordered"><a class="scroll" href="#our-dream">Our Dream</a></div>
		</div>
	</div>
</div>
<div class="press-featured">
		<div class="container">
		<h4 style="text-align: center; color: #54bbd5;margin-bottom: -10px;">As seen in:</h4>
		<div class="row">
			<div class="col-md-12">
				<img src="/wp-content/uploads/press-featured/featuredpress.png" alt="As Seen In">
			</div>
		</div>
	</div>
</div>
<?php putRevSlider('mountain-parallax-header', 'homepage'); ?>
<div class="popular-dreams">
		<div class="container">
		<h2>Dream Of The Week</h2>
			<a name="featured"></a>
			
		    <?php $args = array( 'post_type' => 'ignition_product', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'post_tag','field' => 'slug', 'terms' => 'dream-of-the-day', 'operator' => 'IN')), 'posts_per_page' => 1  );
		        $the_query = new WP_Query( $args );?>
	        <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
					<div class="row">
						<div class="col-lg-12 category-post" id="post-<?php the_ID(); ?>">
							<div class="gridbox alt">
								<div class="row">
									<div class="col-lg-6" style="padding-right: 0px; padding-left: 0px;">
										<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
										<a href="<?php the_permalink(); ?>"><img class="image" src="<?echo $image[0]?>" /></a>
									</div>
									<div class="col-lg-6">
				            	<?php $aurl = get_author_posts_url( get_the_author_meta( 'ID' ) );$user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');?>
			            		<div class="avatar"><a href="<?=$aurl?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?><?php /*<img src="<?=get_stylesheet_directory_uri()?>/img/avatar.jpg">*/?></a><div class="name"><a href="<?=$aurl?>"><?=(empty($user_firstname))?get_the_author():$user_firstname.' '.$user_lastname;?></a></div></div>
										<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
										<?=apply_filters('the_content', get_post_meta($post->ID, 'ign_project_description', true));?>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="bottom">
											<div class="bottom-inner">
												<?php $summary = the_project_summary($post->ID);?>
												<div class="progress-sum"><?=$summary->total;?></div><div class="progress-goal"><strong><?=$summary->goal;?></strong> goal</div>
									    		<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?=$summary->percentage?>%"></div></div>
									    		<div class="progress-percent"><strong>%<?=$summary->percentage?></strong> funded</div><div class="progress-days"><strong><?=$summary->days_left?> </strong> to go</div><div class="progress-stage"><strong>Stage <?=$summary->stage?>/</strong>2</div>
									    	</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile;endif; 
				wp_reset_postdata();wp_reset_query(); ?>

		</div>
	</div>
<!--<div class="popular-dreams">
    <div class="shadow"></div>
	<div class="container">
		<a name="trending-dreams"></a>
		<a class="btn btn-blue float_h2" href="/explore/">Explore All Dreams</a>
		<h2><a href="/explore/">Trending Dreams</a></h2><br/>
	</div>
	<?php //do_shortcode('[project_page_widget product="4"]');?>
	<?php //get_template_part('inc/home/trending_dreams', ''); ?>
	</div>
	
</div> -->
<div class="explore-dreams">
	<div class="container">
		<a name="explore-dreams"></a>
		<a class="btn btn-blue float_h2" href="/explore/">Explore All Dreams</a>
		<h2><a href="/explore/">Explore Dreams</a></h2>
		<div class="row">
			<div class="col-lg-3"><a href="/category/music" class="category music"><em></em><span>Music<i class="fa fa-angle-right"></i></span></a></div>
			<div class="col-lg-6"><a href="/category/videos-and-media" class="category videos-and-media"><em></em><span>Videos and Media<i class="fa fa-angle-right"></i></span></a></div>
			<div class="col-lg-3"><a href="/category/design" class="category design"><em></em><span>Design<i class="fa fa-angle-right"></i></span></a></div>
		</div>
		<div class="row">
			<div class="col-lg-4"><a href="/category/space" class="category space"><em></em><span>Space<i class="fa fa-angle-right"></i></span></a></div>
			<div class="col-lg-3"><a href="/category/art" class="category art"><em></em><span>Art<i class="fa fa-angle-right"></i></span></a></div>
			<div class="col-lg-5"><a href="/category/technology" class="category technology"><em></em><span>Technology<i class="fa fa-angle-right"></i></span></a></div>
		</div>
		<div class="row">
			<div class="col-lg-9"><a href="/category/photography" class="category photography"><em></em><span>Photography<i class="fa fa-angle-right"></i></span></a></div>
			<div class="col-lg-3"><a href="/category/sports" class="category sports"><em></em><span>Sports<i class="fa fa-angle-right"></i></span></a></div>
		</div>
	</div>
</div>
<div class="dream-blocks">
	<div class="container">
		<a name="our-dream"></a>
		<div class="row">
			<div class="leftHalf"></div><div class="rightHalf"></div>
			<div class="col-lg-6 dream-blocks-left">
				<div class="inner">
					<h2>Our Dream</h2>
					<p>Our own dream is to create a platform that not only provides the means for obtaining project funding, but also helps those who for whatever reason are unable to pursue their dreams.</p>
					<p>That’s why we have made a commitment to give 5% of our revenue to well established and well known charities around the world, every month. </p>
					<p>We’re a family of innovators;  come join us in changing the world for the better and making a difference today!</p>
					<a href="<?=get_permalink(39); ?>" class="btn btn-blue">LEARN MORE</a>
				</div>
			</div>
			<div class="col-lg-6 dream-blocks-right">
				<div class="dream-popup">
					<h3>Total amount donated to charities<?php /*Pending Funded Dream */?></h3>
					<?php /*$pending=0;*/$sum = str_split(number_format((($pending * .05) * .05)));?>
					<strong>$<?php foreach($sum as $char):?>
						<?php if($char!=','):?>
							<span class="grayed"><?=$char?></span>
						<?php else:?>
							<?=$char?>
						<?php endif;?>
					<?php endforeach;?></strong>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shadow" />
<div class="press-featured">
		<div class="container">
		<h4 style="text-align: center; color: #54bbd5;">As seen in:</h4>
		<div class="row">
			<div style="position: relative;top: 50%;transform: translateY(50%);padding-top: 20px; padding-bottom: 20px;text-align: center;" class="col-md-2">
				<img align="middle" src="/wp-content/uploads/press-featured/MW-logo.png" alt="MarketWatch" height="35" width="300">
			</div>
			<div style="position: relative;top: 50%;transform: translateY(50%);padding-top: 20px; padding-bottom: 20px;text-align: center;" class="col-md-2">
				<img  src="/wp-content/uploads/press-featured/yahoo.png" alt="Yahoo" height="35" width="300">
			</div>
			<div style="position: relative;top: 50%;transform: translateY(50%);padding-top: 20px; padding-bottom: 20px;text-align: center;" class="col-md-2">
				<img src="/wp-content/uploads/press-featured/seeking-alpha.png" alt="Seeking Alpha" height="35" width="300">
			</div>
			<div style="position: relative;top: 50%;transform: translateY(50%);padding-top: 20px; padding-bottom: 20px;text-align: center;" class="col-md-2">
				<img src="/wp-content/uploads/press-featured/the-street.png" alt="The Street" height="35" width="300">
			</div>
			<div style="position: relative;top: 50%;transform: translateY(40%); padding-top: 20px; padding-bottom: 20px;text-align: center;" class="col-md-2">
				<img src="/wp-content/uploads/press-featured/startup-buzz.png" alt="Startup Buzz" height="40" width="300">
			</div>
			<div class="col-md-2" style="position: relative;top: 50%;transform: translateY(15%);padding-top: 20px; padding-bottom: 20px;text-align: center;">
				<img src="/wp-content/uploads/press-featured/1000four.png" alt="1000Four" height="75" width="300">
			</div>
		</div>
	</div>
</div>
<?php get_template_part('inc/bottom_links', ''); ?>
<?php get_footer(); ?>