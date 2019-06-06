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
					<a href="/members/<?=$current_user->user_login?>/notifications">Notifications</a>
					<a href="/messages">Messages</a>
					<a href="/dashboard/?creator_projects=<?=$current_user->ID?>">Dreams</a>
					<a href="/members/<?=$current_user->user_login?>/friends">Friends</a>
				</div>
			</div>
			<div class="col-lg-9 main"><div class="row">
				<div class="col-lg-6">
					<?php $user_ID = get_current_user_id(); $args = array( 'post_type' => 'ignition_product', 'author' => $user_ID, 'posts_per_page' => 1, 'order'=>'DESC','orderby'=>'date' );
								$the_query = new WP_Query( $args );
					?>
					<?php if ($the_query->have_posts()) : $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
						<a class="dreambox" href="/dashboard/?creator_projects=<?=$current_user->ID?>"><em style="background:url(<?=$image[0]?>) no-repeat 0 0 / cover">&nbsp;</em><span><?php the_title(); ?><i class="fa fa-angle-right"></i></span></a>
					<?php endwhile;endif; wp_reset_postdata();wp_reset_query(); ?>
				</div>
				<div class="col-lg-6">
					<?php /*<a class="dreambox" href="/dashboard"><em style="background:url(<?=get_stylesheet_directory_uri()?>/img/popular2.jpg) no-repeat 0 0 / cover">&nbsp;</em><span>Blueberry Farm<i class="fa fa-angle-right"></i></span></a>*/?>
				</div>
			</div></div>
		</div>
	</div>
</div>