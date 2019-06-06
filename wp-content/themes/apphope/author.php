<?php get_header(); ?>
<?php $authordata = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
<?php // the_post(); 
	global $the_query,$sp_query;
	$args = array( 'author' => $authordata->ID,'post_type' => 'ignition_product', /*'tax_query' => array('relation' => 'AND', array('taxonomy' => 'post_tag','field' => 'slug', 'terms' => 'trending', 'operator' => 'IN')),*/ /*'posts_per_page' => 1,*/'orderby' => 'modified','order'   => 'DESC','post_status' => array('publish', 'closed'));
	$the_query = new WP_Query( $args );
?>
<?php $misc = ' WHERE user_id = "'.$authordata->ID.'"';
		$listed = array();$wp_ids = array('-1');
	$orders = ID_Member_Order::get_orders(null, null, $misc);
	if (!empty($orders)) {
		$mdid_orders = array();
		foreach ($orders as $order) {
			$mdid_order = mdid_by_orderid($order->id);
			if (!empty($mdid_order)) {$mdid_orders[] = $mdid_order;}
		}
		if (!empty($mdid_orders)) {
			$id_orders = array();
			foreach ($mdid_orders as $payment) {
				$order = new ID_Order($payment->pay_info_id);$the_order = $order->get_order();
				if (!empty($the_order)) { $id_orders[] = $the_order;}
			}
		}
		foreach ($id_orders as $id_order) {
			$project = new ID_Project($id_order->product_id);
			if(!in_array($id_order->product_id, $listed)){
				$listed[] = $id_order->product_id;$wp_ids[] = $project->get_project_postid();
			}
		}
	}

$shipping_info = get_user_meta($authordata->ID, 'md_shipping_info', true);

	//echo '123';print_r($wp_ids);
	$args = array('post_type' => 'ignition_product', 'post__in' =>$wp_ids, 'post_status' => array('publish', 'closed'));
	$sp_query = new WP_Query( $args );$to =$authordata->user_login;$from = get_current_user_id();?>
<div class="top_banner">
	<div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 author-info">
				<?php //$user_info = get_userdata($authordata->ID); 
					//get_the_author_meta('user_firstname');
					//print_r($authordata);?>
				<div class="avatar"><?php echo get_avatar( $authordata->ID, 88 ); ?><?php /*<img src="<?=get_stylesheet_directory_uri()?>/img/avatar.jpg">*/?></div>
				<h1 style="margin: 16px 0 0;"><?=(empty($authordata->user_firstname))?$authordata->nickname:$authordata->user_firstname.' '.$authordata->user_lastname;?></h1>
				<div style="padding-bottom: 30px; padding-top: 5px;"><?php echo do_shortcode('[mycred_my_rank user_id="current" show_title=1 show_logo=1]'); ?></div>
				<div class="summary">
					<?php if(!empty($authordata->user_url)):?>
						<a href="<?=$authordata->user_url?>" class="summary-url"><i class="fa fa-globe"></i> &nbsp;<?=$authordata->user_url?></a>
					<?php endif;?>
					<?php if(!empty($shipping_info['city'])&&!empty($shipping_info['state'])&&!empty($shipping_info['country'])):?>
						<a class="summary-loc"><i class="fa fa-map-marker"></i> &nbsp;<?=$shipping_info['city']?>, <?=$shipping_info['state']?>, <?=$shipping_info['country']?></a>
					<?php endif;?>
					<a class="summary-role"><i class="fa fa-smile-o"></i> &nbsp;<?=$the_query->found_posts?'Innovator':'No Dreams Built'?></a>
					<a class="summary-sponsor"><i class="fa fa-usd"></i> &nbsp;<?=$sp_query->found_posts?'Sponsor':'No Dreams Sponsored'?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part('author', 'slides'); ?>
<div id="new-message-popup" style="display:none;">
	<form enctype="multipart/form-data" method="post" action="/messages/?fepaction=checkmessage">
		<input type="hidden" value="<?=$to?>" name="message_to" id="fep-message-to">
		<input type="hidden" value="<?=$from?>" name="message_from">
		<input type="hidden" value="0" name="parent_id">
		<input type="hidden" value="<?=fep_create_nonce('new_message');?>" name="token">
		<p><strong>Subject:</strong></p>
		<input type="text" value="" name="message_title" maxlength="65" />
		<p><strong>Message:</strong></p>
		<textarea name="message_content" rows="6"></textarea>
		<p><strong>Upon submission, you will be redirected to your dashboard</strong></p>
		<input type="submit" class="btn btn-blue" value="Send Message" name="new_message">
	</form>
</div>
<?php get_footer(); ?>