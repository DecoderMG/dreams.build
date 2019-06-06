<?php global $current_user;?>
<div class="login-box" id="profile-box" style="display:none;">
	<div class="arrow-up"></div>
	<h5>
	<div class="row">
		<div class="col-lg-3 side">Dashboard</div>
		<div class="col-lg-9 main">
			<div class="row">
				<div class="col-lg-6">My Dreams</div>
				<div class="col-lg-6 desktop">Sponsored Dreams</div>
			</div>
		</div>
	</div>
	</h5>
	<div class="login-content">
		<div class="row">
			<div class="col-lg-3 side">
				<div class="profile-menu">
					<a href="/dashboard/?edit-profile=<?=$current_user->ID?>">Profile</a>
					<a href="/dashboard/?edit-account=<?=$current_user->ID?>">Account</a>
					<a href="/dashboard/?notifications=1<?php /*/members/$current_user->user_login?>/notifications*/?>">Notifications</a>
					<?php $message_count = fep_get_new_message_number(); 
					if ($message_count > 0) { ?>
					<a href="/messages">Messages</a><sup style="color: #ff0000;"><?php echo "$message_count"; ?></sup>
					<?php } else { ?>
					<a href="/messages">Messages</a>
					<?php } ?>
					<a href="/dashboard/?creator_projects=1">Dreams</a>
					<a href="/dashboard/?friends=1">Friends</a><sup>beta</sup>
				</div>
			</div>
			<div class="col-lg-9 main"><div class="row">
				<div class="col-lg-6">
					<?php $user_ID = get_current_user_id(); $args = array( 'post_type' => 'ignition_product', 'author' => $user_ID, 'posts_per_page' => 1, 'order'=>'DESC','orderby'=>'date' );
								$the_query = new WP_Query( $args );
					?>
					<?php if ($the_query->have_posts()) : $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
						<a class="dreambox" href="/dashboard/?creator_projects=1"><em style="background:url(<?=$image[0]?>) no-repeat 0 0 / cover">&nbsp;</em><span><?php the_title(); ?><i class="fa fa-angle-right"></i></span></a>
					<?php endwhile;endif; wp_reset_postdata();wp_reset_query(); ?>
				</div>
				<div class="col-lg-6">
					<?php $misc = ' WHERE user_id = "'.$user_id.'"';$listed = array();$wp_ids = array();
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
	}?>
					<?php $user_ID = get_current_user_id(); $args = array('post_type' => 'ignition_product',/*'author' => $user_id,*/ 'post__in' =>$wp_ids, 'post_status' => array('publish', 'closed'), 'posts_per_page' => 1, 'order'=>'DESC','orderby'=>'date' );
								$the_query = new WP_Query( $args );
					?>
					<?php if ($the_query->have_posts()) : $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
						<a class="dreambox" href="/dashboard/?creator_projects=1"><em style="background:url(<?=$image[0]?>) no-repeat 0 0 / cover">&nbsp;</em><span><?php the_title(); ?><i class="fa fa-angle-right"></i></span></a>
					<?php endwhile;endif; wp_reset_postdata();wp_reset_query(); ?>
					<?php /*<a class="dreambox" href="/dashboard"><em style="background:url(<?=get_stylesheet_directory_uri()?>/img/popular2.jpg) no-repeat 0 0 / cover">&nbsp;</em><span>Blueberry Farm<i class="fa fa-angle-right"></i></span></a>*/?>
				</div>
			</div></div>
		</div>
	</div>
</div>