<?php
global $post;
$id = $post->ID;
$content = the_project_content($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
?>
<div class="col-lg-12">
	<article class="ignition_project">
		<div class="whitebox">
			<h3><?php echo $content->name; ?> </h3>
			<p><?php echo $content->short_description; ?></p>
			<div class="entry-content">
				<?php echo apply_filters('the_content', do_shortcode('[project_purchase_form]'));?>
			</div>
		</div>
	</article>
</div>