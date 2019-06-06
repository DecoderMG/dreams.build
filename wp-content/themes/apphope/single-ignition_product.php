
<?php get_header();		//Problem code displays a blank project page, removing if-else allieviates this issue
?>
<?php
global $post;
$id = $post->ID;
//$hDeck = the_project_hDeck($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
if (class_exists('Deck')) {
	$new_hdeck = new Deck($project_id);
	if (method_exists($new_hdeck, 'hDeck')) {
		$hDeck = $new_hdeck->hDeck();
	}
	else {
		$hDeck = the_project_hDeck($id);
	}
	$permalinks = get_option('permalink_structure');
	$currency_data = get_post_meta($id, 'ign_currency', true);
	$summary = the_project_summary($id, $currency_data);
	do_action('fh_hDeck_before');
	$video = the_project_video($id);
	$title_data = get_the_title();
	$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
	
	$categories_data = wp_get_post_categories( $id );
	$state_data = get_post_meta($id, 'ign_state', true);
	$city_data = get_post_meta($id, 'ign_city', true);
	$country_data = get_post_meta($id, 'ign_country', true);
	$user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');
	$start_date_data = get_post_meta($id, 'ign_start_date', true);
	$flexible_funding_data = 'false';
	$end_date_date = get_post_meta($id, 'ign_fund_end', true);
	$funding_goal_data = get_post_meta($id, 'ign_fund_goal', true);
	if($summary->stage > 1) {
		$flexible_funding_data = 'true';
		$start_date_data = $end_date_date;
		$end_date_date = get_post_meta($id, 'ign_fund_end2', true);
		$funding_goal_data = get_post_meta($id, 'ign_fund_goal2', true);
	}
	if($image_data != '' || $image_data != null) {
		
	} else {
		$image_data[0] = 'https://dreams.build/wp-content/themes/apphope/img/noimage.jpg';
	}
	$all_orders_data = ID_Order::get_total_orders_by_project($project_id);
	$order_count_data = $all_orders_data->count;
	$twitter_data = get_post_meta($id, 'ign_follow_twitter', true);
	$facebook_data = get_post_meta($id, 'ign_follow_facebook', true);
	$google_data = get_post_meta($id, 'ign_follow_google', true);
	$website_data = get_post_meta($id, 'ign_follow_website', true);
}
?>
<?php wpb_set_post_views($id);?>
<script type='text/javascript' src="<?=get_stylesheet_directory_uri()?>/js/project.js"></script>
<script>
	var data_center = '{ "id":"<?php echo $project_id; ?>" , "url":"<?php echo the_permalink(); ?>" , "name":"<?php echo $title_data; ?>" , "images":"<?php echo $image_data[0]; ?>" , "creator_name":"<?php echo $user_firstname.' '.$user_lastname; ?>" , "category":"<?php echo get_cat_name($categories_data[0]);?>" , "description":"<?php echo get_post_meta($post->ID, 'ign_project_description', true); ?>" , "currency":"<?php echo $summary->currency_code; ?>" , "goal_amount":"<?php echo $funding_goal_data; ?>" , "raised_amount":"<?php echo $summary->total; ?>" , "funders":"<?php echo $order_count_data; ?>" , "flexible_funding":"<?php echo $flexible_funding_data; ?>" , "open_ended":"true" , "start_date":"<?php echo $start_date_data; ?>" , "end_date":"<?php echo $end_date_date; ?>" , "project_country":"<?php echo $country_data; ?>" , "project_state":"<?php echo $state_data; ?>" , "project_city":"<?php echo $city_data; ?>" , "facebook":"<?php echo $facebook_data; ?>" , "twitter":"<?php echo $twitter_data; ?>" , "youtube":"<?php echo $google_data; ?>" , "owner_www":"<?php echo get_post_meta($post_id, 'ign_follow_website', true);; ?>" , "cancelled":"false"}';
</script>
<?php if(!isset($_GET['purchaseform'])) { ?>
<div class="wide_content top_banner"><div class="shadow"></div>
	<div class="explore-block-full toppadding50">
		<div class="container">
				<?php  global $authordata; if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					<input type="hidden" name="post_id" value="<?php the_ID();?>" />
					<?php $aurl = get_author_posts_url( get_the_author_meta( 'ID' ) ); $user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');?>
					<h2 class="notranslate"><?php the_title(); ?></h2>
					<div class="summary">
						<?php if(!empty($authordata->user_url)):?>
							<a href="<?=$aurl;?>" class="summary-url notranslate"><i class="fa fa-user"></i> &nbsp;<?=(empty($user_firstname))?get_the_author():$user_firstname.' '.$user_lastname;?></a>
						<?php endif;?>
						<?php $city = get_post_meta($id, 'ign_city', true);$state = get_post_meta($id, 'ign_state', true); $country = get_post_meta($id, 'ign_country', true);?>
						<?php if($city == '' && $country == ''):?>
							<a class="summary-loc"><i class="fa fa-map-marker"></i> In a cosmos of innovation</a>
						<?php else: ?>
							<a class="summary-loc notranslate"><i class="fa fa-map-marker"></i> &nbsp;<?=$city?>, <?=$state?>, <?=$country?></a>
						<?php endif;?>
						<?php $categories = wp_get_post_categories( $id );?>
						<a class="summary-category"><i class="fa fa-tag"></i> &nbsp;<?=get_cat_name($categories[0])?></a>
					</div>
					<div class="row">
						<div class="col-lg-12 category-post" id="post-<?php the_ID(); ?>">
							<div class="gridbox alt">
								<div class="row">
									<div class="col-lg-6 project-left" style="padding-left: 0px;">
										<?php $youtube = get_post_meta($id, 'ign_product_video', true); if(!empty($youtube)):?>
											<?=convertYoutube($youtube);?>
										<?php else:?>
											<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large'); ?>
											<?php if($image != '' || $image != null):?>
												<img class="image" style="min-height: 300px;" src="<?=$image[0]?>" />
											<?php else: ?>
												<img class="image" src="https://dreams.build/wp-content/themes/apphope/img/noimage.jpg" />
											<?php endif; ?>
										<?php endif;?>
									</div>
									<div class="col-lg-6 project-right">
										<div class="project-right-int">
											<?php $title = get_the_title();$to =$authordata->user_login;$to_id=get_the_author_meta( 'ID' );$from = get_current_user_id();?>
											<div class="avatar"><a href="<?=$aurl;?>" title="learn more about "><?php echo get_avatar( $to_id, 68 ); ?></a><div class="name"><a href="<?=$aurl;?>"><?=(empty($user_firstname))?get_the_author():$user_firstname.' '.$user_lastname;?></a>
											<?php if($to_id!=$from && !empty($from)):?>
												<br/><a class="popup-new-message" href="#new-message-popup"><strong>Contact Me</strong></a>
											<?php endif;?>
											</div></div>
											<?php if(get_post_status($id) == 'publish'): //if(empty($_REQUEST['preview'])):?>
												<div class="sponsor-box ign-supportnow" style="display: block !important;">
												<a class="btn btn-green large" href=".idc_lightbox">SPONSOR THIS DREAM</a>
													<?php global $wpdb;global $current_user;$check = $wpdb->get_row( "SELECT id,active,sent FROM wp_ign_notify WHERE user_id = '".$current_user->ID."' AND product_id = '".$post->ID."'");?>
													<?php if (is_user_logged_in()&&(!$check||!$check->sent)): ?>
														<p><a class="remind-me-later <?=($check&&$check->active)?'active':'';?>"><i class="fa fa-clock-o"></i> Remind me later</a></p>
														<a href="#notify-box" class="remind-me-later-trigger" style="display:none;"></a>
														<div id="notify-box" style="display:none;">
															<p>OK! We’ll send you an email about this project 48 hours before it ends. Cool? Cool.</p>
														</div>													
													<?php endif;?>
												</div>
											<?php endif;?>
											<?php if(get_post_status($id) == 'draft'): //if(empty($_REQUEST['preview'])):?>
												<div>
													<p>Project is currently in a draft state, check back later for more!</p>
													<?php global $wpdb;global $current_user;$check = $wpdb->get_row( "SELECT id,active,sent FROM wp_ign_notify WHERE user_id = '".$current_user->ID."' AND product_id = '".$post->ID."'");?>
													<?php if (is_user_logged_in()&&(!$check||!$check->sent)): ?>
														<p><a class="remind-me-later <?=($check&&$check->active)?'active':'';?>"><i class="fa fa-clock-o"></i> Remind me later</a></p>
														<a href="#notify-box" class="remind-me-later-trigger" style="display:none;"></a>
														<div id="notify-box" style="display:none;">
															<p>OK! We’ll send you an email about this project 48 hours before it ends. Cool? Cool.</p>
														</div>
													<?php endif;?>
												</div>
											<?php endif;?>
											<?php if(get_post_status($id) == 'closed'): //if(empty($_REQUEST['preview'])):?>
												<div>
													<p>Funding for this dream is currently closed.</p>
												</div>
											<?php endif;?>
											
											<?php if($summary->stage == 1 || $summary->stage < 1) {?>
														<p style="color: #54bbd5;"><br>Dream is in stage 1 funding which is All-Or-Nothing. The Innovator will only receive funds if they hit their goal.</p>
														<?php } else {?>
														<p style="color: #54bbd5;"><br>Dream is in stage 2 funding which is All-Supportive. The dream has been successfully funded, any funds raised will be kept.</p>
														<?php }?>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="row">
										<div class="col-lg-6">
											<div class="project-bottom-desc"><p class="notranslate"><?=/*apply_filters('the_content', */get_post_meta($post->ID, 'ign_project_description', true)/*)*/; //apply_filters('the_content', $post->long_description); ?></p></div>
										</div>
										<div class="col-lg-6">
											<div class="project-bottom-goals">
												<?php //$summary = the_project_summary($post->ID);?>

												<?php $usd = floatval(str_replace('$', '', $summary->goal));
//												global $currency;
//												$currency = currencyConverter($summary->goal); ?>
												<div class="progress-sum"><?= $summary->total; ?></div><div class="progress-goal"><strong title=" EUR"><?= $summary->goal; ?></strong>
													goal
												</div>
												<div class="progress">
													<div class="progress-bar progress-bar-success" role="progressbar"
														 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
														 style="width:<?= (int)$summary->percentage ?>%"></div>
												</div>
												<?php if(get_post_status($id) == 'publish'): //if(empty($_REQUEST['preview'])):?>
													<div class="progress-percent"><strong>%<?= $summary->percentage ?></strong> funded</div><div class="progress-days"><strong><?= $summary->days_left ?></strong> to go</div><div class="progress-stage"><strong>Stage <?= $summary->stage ?> / </strong>2</div>
												<?php endif;?>
												<?php if(get_post_status($id) == 'draft'): //if(empty($_REQUEST['preview'])):?>
													<div class="progress-percent" style="text-align: center; width: 100%;"><strong> Project is currently in draft</strong></div>
												<?php endif;?>
												<?php if(get_post_status($id) == 'closed'): //if(empty($_REQUEST['preview'])):?>
													<div class="progress-percent" style="text-align: center; width: 100%;"><strong>This project is closed and is no longer accepting donations</strong></div>
												<?php endif;?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $ga = get_post_meta($post->ID, 'ign_ga', true);?>
					<?php if(!empty($ga)):?>
						<script>
						  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
						  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
						  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
						  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
						  ga('create', '<?=$ga?>', '<?=$_SERVER['HTTP_HOST'];?>', 'projectGaTracker');
						  ga('projectGaTracker.send', 'pageview');
						  ga(function(tracker) {console.log(tracker.get('clientId'));});
						  ga('projectGaTracker.require', 'ecommerce');
						</script>
					<?php endif;?>
					<?php $fa = get_post_meta($post->ID, 'ign_fa', true);
						  $fa_href = 'https://www.facebook.com/tr?id='.$fa.'&ev=PageView&noscript=1';?>
					<?php if(!empty($fa)):?>
						<!-- Facebook Pixel Code -->
						<script>
						!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
						n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
						n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
						t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
						document,'script','https://connect.facebook.net/en_US/fbevents.js');
						fbq('init', '<?=$fa?>'); // Insert your pixel ID here.
						fbq('track', 'PageView');
						</script>
						<noscript><img height="1" width="1" style="display:none"
						src="<?php echo $fa ?>"
						/></noscript>
						<!-- DO NOT MODIFY -->
						<!-- End Facebook Pixel Code -->
					<?php endif;?>
				<?php endwhile;endif; 
				wp_reset_postdata();wp_reset_query(); ?>	
		</div>
	</div>
</div>
<div class="dream-links linked">
	<div class="container-fluid">
		<div class="row">
			<?php get_template_part('nav', 'above-project'); ?>
		</div>
	</div>
</div>

<div class="wide_content gray">
	<div class="shadow"></div>
	<div class="container">
		<div class="row">
            <?php } ?>
			<?php get_template_part( 'loop', 'project' ); ?>
            <?php if(!isset($_GET['purchaseform'])) { ?>
		</div>
	</div>
</div>

<div id="new-message-popup" style="display:none;">
	<p><strong>Message:</strong></p>
	<form enctype="multipart/form-data" method="post" action="/messages/?fepaction=checkmessage">
		<input type="hidden" value="<?=$to?>" autocomplete="off" name="message_to" id="fep-message-to">
		<input type="hidden" value="<?=$title?>" maxlength="65" placeholder="Subject" name="message_title">
		<input type="hidden" value="<?=$from?>" name="message_from">
		<input type="hidden" value="0" name="parent_id">
		<input type="hidden" value="<?=fep_create_nonce('new_message');?>" name="token">
		<textarea name="message_content" rows="6"></textarea>
		<p><strong>Upon submission, you will be redirected to your dashboard</strong></p>
		<input type="submit" class="btn btn-blue" value="Send Message" name="new_message">
	</form>
</div>

<a href="#ignitiondeckchck" class="ignitiondeckchck"></a>
<div id="ignitiondeckchck" class="mfp-hide"></div>
<?php get_footer(); ?>
<?php } ?>
