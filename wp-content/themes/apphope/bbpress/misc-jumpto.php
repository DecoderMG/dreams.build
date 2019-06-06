<strong>Jump to <i class="fa fa-angle-down"></i></strong>
<span class="popup w330px">
	<span class="tri"></span>
	<?php
        $args = array(
		'post_parent'         => 0,
		'post_type'           => bbp_get_forum_post_type(),
		'post_status'         => 'publish',
		'posts_per_page'      => get_option( '_bbp_forums_per_page', 50 ),
		'orderby'             => 'menu_order title',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true
	);
	$forums_query = new WP_Query($args);
        ?>
	<span class="title">General</span>
	<?php while ( $forums_query->have_posts() ) : $forums_query->the_post(); ?>
		<?php $id = get_the_ID(); if(in_array($id, array(168,187,189,191))): ?>
		<a class="bbp-forum-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php endif;endwhile; ?>
	<span class="title">Dreams.Build Platform</span>
	<?php while ( $forums_query->have_posts() ) : $forums_query->the_post(); ?>
		<?php $id = get_the_ID(); if(in_array($id, array(176,193,195,197,199))): ?>
		<a class="bbp-forum-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php endif;endwhile; ?>
	<span class="title">The Whiteboard</span>
	<?php while ( $forums_query->have_posts() ) : $forums_query->the_post(); ?>
		<?php $id = get_the_ID(); if(in_array($id, array(179))): ?>
		<a class="bbp-forum-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php endif;endwhile; ?>
	<span class="title">Crowdfunding</span>
	<?php while ( $forums_query->have_posts() ) : $forums_query->the_post(); ?>
		<?php $id = get_the_ID(); if(in_array($id, array(181,201,203))): ?>
		<a class="bbp-forum-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php endif;endwhile; ?>
	<span class="title">Forum Rules</span>
	<?php while ( $forums_query->have_posts() ) : $forums_query->the_post(); ?>
		<?php $id = get_the_ID(); if(in_array($id, array(184))): ?>
		<a class="bbp-forum-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php endif;endwhile; ?>
	<?php wp_reset_postdata(); ?>
</span>