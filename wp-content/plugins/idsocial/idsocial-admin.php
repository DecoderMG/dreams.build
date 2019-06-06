<?php

add_action('admin_menu', 'idsocial_admin_menus', 11);

function idsocial_admin_menus() {
	$settings = add_submenu_page('idf', __('Social', 'idsocial'), __('Social', 'idsocial'), 'manage_options', 'idsocial', 'idsocial_menu');
	add_action('admin_print_styles-'.$settings, 'idf_admin_enqueues', 11);
}

function idsocial_menu() {
	$settings = get_option('idsocial_settings');
	if (isset($_POST['submit_social_settings'])) {
		$settings = array();
		foreach ($_POST as $k=>$v) {
			// If $v is an array, sanitize separately each value of that array then
			if (is_array($v)) {
				$sanitized_v = array();
				foreach ($v as $subkey => $subvalue) {
					$sanitized_v[$subkey] = sanitize_text_field($subvalue);
				}
				// Copying sanitized array into normal posted array
				$settings[$k] = $sanitized_v;
			}
			else {
				$settings[$k] = sanitize_text_field($v);
			}
		}
		update_option('idsocial_settings', $settings);
	}
	// Getting the image from attachment id
	if (!empty($settings['home_image'])) {
		$home_image = wp_get_attachment_image_src($settings['home_image'], 'idsocial_home_image');
		$settings['home_image_url'] = $home_image[0];
	}
	include IDSOCIAL_PATH.'templates/admin/_settingsMenu.php';
}
?>