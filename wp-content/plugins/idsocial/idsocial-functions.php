<?php
function idsocial_app_id() {
	$app_id = '';
	$settings = get_option('idsocial_settings');
	if (!empty($settings)) {
		$app_id = (!empty($settings['app_id']) ? $settings['app_id'] : '');
	}
	return $app_id;
}

function idsocial_fblogin() {
	$success = 0; 
	if (isset($_POST['User'])) {
		$fb_user = $_POST['User'];
		$email = $fb_user['email'];
		if (!empty($email)) {
			$wp_user = get_user_by('email', $email);
			if (!empty($wp_user)) {
				if (is_user_logged_in()) {
					$success = 1;
				}
				else {
					// would be better if we could perform this at beginning of an init hook
					$override = 0;
					if (isset($_POST['Override'])) {
						$override = $_POST['Override'];
					}
					$logged_out = get_transient('idsocial_logout_'.$wp_user->ID);
					if (!$logged_out || $override) {
						$signon = wp_set_auth_cookie($wp_user->ID, true);
					//if (is_user_logged_in ()) {
						$success = 1;
						if ($override) {
							delete_transient('idsocial_logout_'.$wp_user->ID);
						}
					//}
					}
				}
			}
			else {
				// user does not exist
				$user = array(
					'user_login' => $email,
					'user_email' => $email,
					'first_name' => $fb_user['first_name'],
					'last_name' => $fb_user['last_name'],
					'user_nicename' => $fb_user['name'],
					'nickname' => $fb_user['name'],
					'user_pass' => idf_pw_gen()
					);
				$user_id = wp_insert_user($user);
				if ($user_id > 0) {
					do_action('idc_register_success', $user_id, $email);

					$signon = wp_set_auth_cookie($user_id, true);
					//if (is_user_logged_in()) {
						$success = 1;
					//}
				}
			}
		}
	}
	echo $success;
	exit;
}
add_action('wp_ajax_idsocial_fblogin', 'idsocial_fblogin');
add_action('wp_ajax_nopriv_idsocial_fblogin', 'idsocial_fblogin');

function idsocial_logout() {
	$user = wp_get_current_user();
	if (!empty($user)) {
		set_transient('idsocial_logout_'.$user->ID, 1);
	}
}

add_action('clear_auth_cookie', 'idsocial_logout');

function idsocial_home_image() {
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings['home_image'])) {
		$home_image = wp_get_attachment_image_src($social_settings['home_image'], 'idsocial_home_image');
		return (isset($home_image[0]) ? $home_image[0] : null);
	} else {
		return null;
	}
}

function idf_idc_order_sharing_options($last_order) {
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings['social_checks'])) {
		$order_id = $last_order->id;
		$mdid_order = mdid_by_orderid($order_id);
		if (!empty($mdid_order)) {
			$pay_id = $mdid_order->pay_info_id;
			$id_order = new ID_Order($pay_id);
			$get_order = $id_order->get_order();
			if (!empty($get_order)) {
				$project_id = $get_order->product_id;
				$project = new ID_Project($project_id);
				$post_id = $project->get_project_postid();
				if ($post_id > 0) {
					include 'templates/_socialButtons.php';
				}
			}
		}
	}
	//include_once('templates/_socialSharing.php');
}
add_action('idc_order_sharing_after', 'idf_idc_order_sharing_options', 10, 1);

function idsocial_sharing_on_posts($content) {
	global $post_id, $post;
	$social_settings = get_option('idsocial_settings');
	if (!empty($social_settings)) {
		$show_social = false;
		// Check if this is a post and social icons are allowed on post
		if (!empty($post) && $post->post_type == "post") {
			if (isset($social_settings['show_social_on_post']) && $social_settings['show_social_on_post'] == 1) {
				$show_social = true;
			}
		}
		// If it's a page and social icons are allowed to be shown on a page in IDSocial settings
		if (!empty($post) && $post->post_type == "page") {
			if (isset($social_settings['show_social_on_pages']) && $social_settings['show_social_on_pages'] == 1) {
				$show_social = true;
			}
		}
		if ($show_social) {
			// Getting content from IDCF
			ob_start();
			include_once 'templates/_socialButtons.php';
			$new_content = ob_get_contents();
			ob_end_clean();

			$content .= '<div class="idsocial-post-icons">'.
					$new_content.
				'</div>';
		}
	}
	return $content;
}
add_filter('the_content', 'idsocial_sharing_on_posts');

function idsocial_embed_box() {
	global $post;
	if ($post->post_type == "ignition_product") {
		// Getting project id
		$project_id = get_post_meta($post->ID, 'ign_project_id', true);
		echo '<div id="share-embed" class="social-share"><i class="fa fa-code"></i></div>'.
				'<div class="embed-box social-share" style="display: none;"><code>&#60;iframe frameBorder="0" scrolling="no" src="'.home_url().'/?ig_embed_widget=1&product_no='.(!empty($project_id) ? $project_id : '').'" width="214" height="366"&#62;&#60;/iframe&#62;</code>
			</div>';
	}
}
add_action('id_social_sharing_after', 'idsocial_embed_box', 2);
?>