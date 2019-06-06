<?php
global $post;
$id = $post->ID;
$content = the_project_content($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
?>
<?php /*<div id="site-description">
	<h1><?php echo $content->name; ?> </h1>
	<h2><?php echo $content->short_description; ?></h2> 
</div>*/?>
<?php //get_template_part( 'project', 'hDeck' ); ?>

<div id="ign-project-content" class="ign-project-content">
	<div class="entry-content content_tab_container content_tab_campaign active">
		<a name="about"></a>
		<h3>About</h3>
		<?php //do_action('id_before_content_description', $project_id, $id); ?>
		<?php echo apply_filters('the_content', $content->long_description); ?>
		<hr class="full"/>
		<a name="challenges"></a>
		<h3>Challenges</h3>
		<p><?php echo get_post_meta($id, 'ign_challenges', true);?></p>
		<hr class="full"/>
		<a name="faq"></a>
		<h3>FAQ</h3>
		<?php echo apply_filters('fivehundred_faq', do_shortcode( '[project_faq product="'.$project_id.'"]')); ?>
		<p><strong>Do you have more questions?</strong></p>
		<?php global $authordata; ?>
		<a class="btn btn-blue large" href="mailto:<?=$authordata->user_email?>">Contact the Innovator</a>
		<hr class="full"/>
		<a name="follow"></a>
		<h3>Follow</h3>
		<?php $facebook = esc_html(get_post_meta($id, 'ign_follow_facebook', true));
					$twitter = esc_html(get_post_meta($id, 'ign_follow_twitter', true));
					$google = esc_html(get_post_meta($id, 'ign_follow_google', true));
					$in = esc_html(get_post_meta($id, 'ign_follow_in', true));
					$instagram = esc_html(get_post_meta($id, 'ign_follow_instagram', true));
					$website = esc_html(get_post_meta($id, 'ign_follow_website', true));
		?>
		<?php if(!empty($facebook)||!empty($twitter)||!empty($google)||!empty($in)||!empty($instagram)||!empty($website)):?>
			<p>Find this dream on:</p>
			<div class="follow_links">
			<?php if(!empty($facebook)):?><a href="<?=$facebook?>" class="icon_facebook"></a><?php endif;?>
			<?php if(!empty($twitter)):?><a href="<?=$twitter?>" class="icon_twitter"></a><?php endif;?>
			<?php if(!empty($google)):?><a href="<?=$google?>" class="icon_google"></a><?php endif;?>
			<?php if(!empty($in)):?><a href="<?=$in?>" class="icon_in"></a><?php endif;?>
			<?php if(!empty($instagram)):?><a href="<?=$instagram?>" class="icon_instagram"></a><?php endif;?>
			<?php if(!empty($website)):?><a href="<?=$website?>" class="icon_website"></a><?php endif;?>
			</div>
		<?php endif;?>
		<hr class="full"/>
		<a name="share"></a>
		<h3>Share</h3>
		<div class="share_link"><span><?=get_permalink( $post->ID );?></span><a>copy link</a></div>
		<hr class="full"/>
		<a name="needs"></a>
		<h3>Needs</h3>



<style>
#map_container{ width:600px;height:500px;margin:0 0 20px;}
#map_canvas{height: 100%;border: 1px solid darkgrey;}
</style>
<p>
<label for="search_new_places">Search Places</label>
<input type="text" placeholder="Search New Places" id="search_new_places" value="" autofocus>
</p>
<div id="map_container">
  <div id="map_canvas"></div>
</div>

<input type="hidden" name="place_id" id="place_id"/>
<input type="hidden" name="map_lat" id="map_lat"/>
<input type="hidden" name="map_lng" id="map_lng"/>

<?php /*<p>
<label for="place">Name</label>
<input type="text" name="n_place" id="n_place"/>  
</p>

<p>
<label for="description">Description</label>
<input type="text" name="n_description" id="n_description"/>  
</p>*/?>

<p>
<?php /*<a class="btn btn-blue" id="btn_save">Save Place</a>*/?>
<a class="btn btn-blue" id="plot_marker">Select Place</a>
</p>



	</div>
	<div class="entry-content content_tab_container content_tab_updates">
		<a name="updates"></a>
		<?php echo apply_filters('fivehundred_updates', do_shortcode( '[project_updates product="'.$project_id.'"]')); ?>
	</div>
	<div class="entry-content content_tab_container content_tab_comments">
		<h3>Comments</h3>
		<?php comments_template('/comments.php', true); ?>
	</div>
	<div class="entry-content content_tab_container content_tab_funders">
		<?php do_action('fh_below_project', $project_id, $id); ?>
		<?php get_template_part( 'project', 'sidebar' ); ?>
	</div>
	<div class="entry-content content_tab_container content_tab_gallery">
		<h3>Gallery</h3>
		<?php  $img2 = esc_html(get_post_meta($id, 'ign_product_image2', true));
					$img3 = esc_html(get_post_meta($id, 'ign_product_image3', true));
					$img4 = esc_html(get_post_meta($id, 'ign_product_image4', true));?>
		<?php if(!empty($img2)):?><img src="<?=$img2?>" /><?php endif;?>
		<?php if(!empty($img3)):?><img src="<?=$img3?>" /><?php endif;?>
		<?php if(!empty($img4)):?><img src="<?=$img4?>" /><?php endif;?>
	</div>
	<div class="clear"></div>
</div>