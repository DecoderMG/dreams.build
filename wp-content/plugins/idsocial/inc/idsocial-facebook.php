<?php

add_action('after_setup_theme', 'idsocial_fb_setup');

function idsocial_fb_setup() {
	add_image_size('idsocial_home_image', '470', '246');
}

add_action('wp_head', 'idsocial_fb_og', 1);

function idsocial_fb_og() {
	global $post;
	$app_id = idsocial_app_id();
	$is_project = false;
	if (is_home() || is_front_page() || is_404()) {
		$type = 'website';
		$description = get_bloginfo('description');
	}
	else if (isset($post->post_type) && $post->post_type == 'ignition_product') {
		$type = 'article';
		$description = get_post_meta($post->ID, 'ign_product_short_description', true);
	}
	else if(is_author()){
		$type = 'website';
		$description = get_bloginfo('description');
	}
	else {
		$type = 'article';
		$description = (!empty($post->post_excerpt) ? $post->post_excerpt : wp_trim_words($post->post_content));
	}
	if (isset($post)) {
		$post_content = $post->post_content;
		if ($post->post_type == 'ignition_product') {
			$post_id = $post->ID;
			$is_project = true;
		}
		else if (strpos($post_content, 'project_')) {
			$pos = strpos($post_content, 'product=');
			$project_id = absint(substr($post_content, $pos + 9, 1));
			if (isset($project_id) && $project_id > 0) {
				$project = new ID_Project($project_id);
				$post_id = $project->get_project_postid();
				$post = get_post($post_id);
				$is_project = true;
			}
		}
	}
	if($type=='article'){
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
		if (!empty($image)) {
			$image_url = $image[0];
		}
		else {
			$image_url = idsocial_home_image();
		}
	}
	if ($is_project) {
		$image_url = ID_Project::get_project_thumbnail($post->ID);
		$description = strip_tags(html_entity_decode(get_post_meta($post_id, 'ign_project_description', true)));
	}
	$current_site = get_option('blogname');
	$meta = '<meta property="fb:app_id" content="'.$app_id.'" />';
	$meta .= '<meta property="og:type" content="'.$type.'" />';
	$meta .= '<meta property="og:image" content="'.$image_url.'" />';
	$meta .= ($type == 'website' ? '<meta property="og:image:url" content="'.$image_url.'" />' : '');
	/*do smthng*/
	if($type=='article') $meta .= '<meta property="og:title" content="'.(!empty($post) ? $post->post_title : get_bloginfo('name')).'" />';
	if($type=='article') $meta .= '<meta property="og:url" content="'.(!empty($post) ? get_permalink($post->ID) : home_url()).'" />';
	$meta .= '<meta property="og:site_name" content="'.$current_site.'" />';
	$meta .= '<meta property="og:description" content="'.$description.'" />';
	echo $meta;
	wp_reset_query();
}

/**
 * Action to add FB login in WP-Login forms
 */
add_action('login_form', 'idsocial_wp_login_fb_login', 11, 1);
add_action('register_form', 'idsocial_wp_login_fb_login', 11, 1);
function idsocial_wp_login_fb_login($args) {
	echo '<div class="center idsocial-wp-fb-login"><div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false" onlogin="idsocial_fblogin_callback" scope="email, user_friends, public_profile"></div>'.
		'<div class="idsocial-fblogin-hidden">'.
			'<input type="hidden" name="idsocial-redirect-to" id="idsocial-redirect-to" value="'.home_url().'" />'.
			'<input type="hidden" name="idsocial-is-admin-login" id="idsocial-is-admin-login" value="no" />'.
		'</div>'.
	'</div>';
}

/**
 * Action to add FB Login in Helix menu
 */
//add_action('idhelix_below_login_form', 'idsocial_wp_login_fb_login');
?>