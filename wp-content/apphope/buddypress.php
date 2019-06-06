<?php
get_header(); ?>
<?php while ( have_posts() ) : the_post();?>

<?php if ( ! (bp_is_user_profile() && bp_current_action()=='change-avatar' ) ):?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php $umeta = get_user_meta( bp_displayed_user_id());?>
				<h1><?=empty($current_user)?get_the_title():$umeta['first_name'][0].' '.$umeta['last_name'][0];?>
					<a class="view_public" href="<?=get_author_posts_url(bp_displayed_user_id())?>"><i class="fa fa-eye"></i> View Public Profile</a>
				</h1>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<?php if ( ! (bp_is_user_profile() && bp_current_action()=='change-avatar' ) ):?>
<div class="wide_content gray"><div class="shadow"></div>
	<div class="container">
		<div class="memberdeck"><?php get_template_part('inc/dash', ''); ?></div>
		<?php the_content(); ?>
	</div>
</div>
<?php else:?>
<div class="wide_content gray">	
	<div class="container">
		<?php the_content(); ?>
	</div>
</div>
<?php endif;?>
<?php endwhile;?>
<?php get_footer(); ?>