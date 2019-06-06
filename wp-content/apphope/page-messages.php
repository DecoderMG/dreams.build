<?php
/*Template Name: Messages*/
get_header();?>
<?php while ( have_posts() ) : the_post();?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php $umeta = get_user_meta($current_user->ID); ?>
                        <?php if (!empty($current_user) && $current_user->ID): ?>
				<h1><?= empty($current_user) ? get_the_title() : $umeta['first_name'][0] . ' ' . $umeta['last_name'][0]; ?></h1><a class="view_public" href="<?= get_author_posts_url($current_user->ID) ?>"><i class="fa fa-eye"></i> View Public Profile</a>
                        <?php else: ?>
                            <h1><?= get_the_title() ?></h1>
                        <?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="wide_content gray"><div class="shadow"></div>
	<div class="container">
		<div class="memberdeck">
			<?php get_template_part('inc/dash', ''); ?>
			<div class="row mt">
				<?php $fep = new fep_main_class();$menu = $fep->Menu();?>
				
				<div class="col-lg-2 dashboard-sidebar">
					<div class="whitebox parted"><?=$menu?>

					</div>

					<?php 
						$request = $_SERVER['REQUEST_URI'];
						//echo $request;
						if (strpos($request, '/messages/?fepaction=viewmessage') !== false) {
 							echo '<a id="replydn" href="#wp-message_content-editor-tools" class="scroll title">Add reply</a>';
						}
					?>




					<?php if( isset($_GET['fepaction'] ) && $_GET['fepaction']=='announcements' ){
						if (current_user_can('manage_options'))
	  $msgsOut = "<a class='button blue' href='".fep_action_url('addannouncement')."'>".__('Add New', 'fep').'</a>';
	  else
	  $msgsOut = '';}?>
					<?php /*if ( '1' != fep_get_option('disable_new') || current_user_can('manage_options') ):?>
						<a href="/messages/?fepaction=newmessage" class="button blue">New Message</a>
					<?php endif;*/?>
				</div>
				<div class="col-lg-10">
					<div class="whitebox">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile;?>

<?php get_footer(); ?>
