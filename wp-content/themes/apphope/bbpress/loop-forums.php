<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>
<a name="general"></a>
<ul class="bbp-forums">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'General', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Latest', 'bbpress' ); ?></li>
		</ul>
	</li><!-- .bbp-header --><li>
		<div class="row"><div class="col-lg-12"><div class="whitebox">
			<?php while ( bbp_forums() ) : bbp_the_forum();$id=bbp_get_forum_id();if(in_array($id, array(168,187,189,191))): ?>
				<ul><li class="bbp-body"><?php bbp_get_template_part( 'loop', 'single-forum' ); ?></li></ul><!-- .bbp-body -->
			<?php endif;endwhile; ?>
		</div></div></div>
	</li>
</ul><!-- .forums-directory -->
<a name="dreams-build"></a>
<ul class="bbp-forums">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'Dreams.Build Platform', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Latest', 'bbpress' ); ?></li>
		</ul>
	</li><!-- .bbp-header --><li>
		<div class="row"><div class="col-lg-12"><div class="whitebox">
			<?php while ( bbp_forums() ) : bbp_the_forum();$id=bbp_get_forum_id();if(in_array($id, array(176,193,195,197,199))): ?>
				<ul><li class="bbp-body"><?php bbp_get_template_part( 'loop', 'single-forum' ); ?></li></ul><!-- .bbp-body -->
			<?php endif;endwhile; ?>
		</div></div></div>
	</li>
</ul><!-- .forums-directory -->
<a name="whiteboard"></a>
<ul class="bbp-forums">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'The Whiteboard', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Latest', 'bbpress' ); ?></li>
		</ul>
	</li><!-- .bbp-header --><li>
		<div class="row"><div class="col-lg-12"><div class="whitebox">
			<?php while ( bbp_forums() ) : bbp_the_forum();$id=bbp_get_forum_id();if(in_array($id, array(179))): ?>
				<ul><li class="bbp-body"><?php bbp_get_template_part( 'loop', 'single-forum' ); ?></li></ul><!-- .bbp-body -->
			<?php endif;endwhile; ?>
		</div></div></div>
	</li>
</ul><!-- .forums-directory -->
<a name="crowdfunding"></a>
<ul class="bbp-forums">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'Crowdfunding', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Latest', 'bbpress' ); ?></li>
		</ul>
	</li><!-- .bbp-header --><li>
		<div class="row"><div class="col-lg-12"><div class="whitebox">
			<?php while ( bbp_forums() ) : bbp_the_forum();$id=bbp_get_forum_id();if(in_array($id, array(181,201,203))): ?>
				<ul><li class="bbp-body"><?php bbp_get_template_part( 'loop', 'single-forum' ); ?></li></ul><!-- .bbp-body -->
			<?php endif;endwhile; ?>
		</div></div></div>
	</li>
</ul><!-- .forums-directory -->
<a name="forum-rules"></a>
<ul class="bbp-forums">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-forum-info"><?php _e( 'Forum Rules', 'bbpress' ); ?></li>
			<li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
			<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
			<li class="bbp-forum-freshness"><?php _e( 'Latest', 'bbpress' ); ?></li>
		</ul>
	</li><!-- .bbp-header --><li>
		<div class="row"><div class="col-lg-12"><div class="whitebox">
			<?php while ( bbp_forums() ) : bbp_the_forum();$id=bbp_get_forum_id();if(in_array($id, array(184))): ?>
				<ul><li class="bbp-body"><?php bbp_get_template_part( 'loop', 'single-forum' ); ?></li></ul><!-- .bbp-body -->
			<?php endif;endwhile; ?>
		</div></div></div>
	</li>
</ul><!-- .forums-directory -->
<?php do_action( 'bbp_template_after_forums_loop' ); ?>