<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="row"><div class="col-lg-12"><div class="whitebox">
<div class="bbp-forum-header">
	<a href="<?php bbp_forum_permalink(); ?>" class="bbp-forum-permalink">#<?php bbp_forum_id(); ?></a>
	<div class="bbp-forum-title">
		<?php do_action( 'bbp_theme_before_forum_title' ); ?>
		<h3><?php _e( 'Forum: ', 'bbpress' ); ?><a href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h3>
		<div class="bbp-meta"><span class="bbp-forum-post-date"><?php printf( __( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ); ?></span>	</div>
		<?php do_action( 'bbp_theme_after_forum_title' ); ?>
	</div><!-- .bbp-forum-title -->
</div><!-- .bbp-forum-header -->

<?php /*<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>
	<!-- .bbp-meta -->
	<div class="bbp-forum-content">
		<?php do_action( 'bbp_theme_before_forum_content' ); ?>
		<?php bbp_forum_content(); ?>
		<?php do_action( 'bbp_theme_after_forum_content' ); ?>
	</div><!-- .bbp-forum-content -->
</div><!-- #post-<?php bbp_forum_id(); ?> -->*/?>
</div></div></div>