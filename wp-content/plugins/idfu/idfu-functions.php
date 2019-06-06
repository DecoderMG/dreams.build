<?php

function idfu_fes_enable() {
	//write_log( "idfu_fes_enable" );
	global $crowdfunding;
	$enable = false;
	if (function_exists('is_id_pro') && is_id_pro()) {
		if ($crowdfunding) {
			$enable = true;
		}
	}
	return $enable;
}

add_action('init', 'swap_fes_form');

function swap_fes_form() {
	//write_log( "swap_fes_form" );
	if (idfu_fes_enable()) {
		add_filter('fes_updates_form', function() {
			$subject = array(
				'before' => '<h3>'.apply_filters('idfu_project_updates', __('Project Updates', 'idfu')).'</h3>',
				'label' => apply_filters('idfu_update_subject', __('Update Subject', 'idfu')),
				'value' => '',
				'name' => 'new_update_subject',
				'id' => 'new_update_subject',
				'type' => 'text',
				'wclass' => 'form-row'
				);
			return $subject;
		});
		add_filter('fes_updates_after', function() {
			$content = array(
				'label' => apply_filters('idfu_update_content', __('Update Content', 'idfu')),
				'value' => '',
				'name' => 'new_update_content',
				'id' => 'new_update_content',
				'type' => 'wpeditor',
				'wclass' => 'form-row wpeditor'
				);
			return $content;
		});
		add_action('fes_new_update_content_after', 'fes_list_updates');
		add_action('ide_fes_submit', 'idfu_fes_submit', 10, 3);
		add_action('ide_fes_submit', 'idfu_fes_update', 10, 3);
	}
}

function fes_list_updates($post_id) {
	$updates = idfu_get_updates($post_id);
	if (!empty($updates)) {
		$c = count($updates);
		echo '<li class="form-row idfu_prevupdates">';
		echo '<h3>'.apply_filters('idfu_previous_updates', __('Previous Updates', 'idfu')).'</h3>';
		echo '<ol reversed class="updates_fes">';
		foreach ($updates as $update) {
			//print_r($update);
			echo '<li>'.__('Project Update', 'idfu').'#'.$c.' <a class="edit_update" data-update-id="'.$update->ID.'" href="#">'.$update->post_title.'</a>';
			echo '<span class="update_posted">['.date('m/d/Y', strtotime($update->post_date)).']'.($update->post_date !== $update->post_modified ? '['.__('Edited: ', 'idfu').date('m/d/Y h:s', strtotime($update->post_modified)) : '').']</span>';
			echo '<div data-id="'.$update->ID.'" class="prior_update" id="update_'.$update->ID.'_wrapper">';
			wp_editor($update->post_content, 'idfu_update_'.$update->ID);
			echo '<input type="hidden" value="0" class="has_updated" name="idfu_is_updated_'.$update->ID.'" />';
			echo '</div>';
			echo '</li>';
			$c--;
		}
		echo '</ol>';
		echo '</li>';
		echo '<br/>';
	}
}

function idfu_fes_submit($post_id, $project_id, $vars) {
	if (isset($_POST['new_update_subject'])) {
		$subject = stripslashes(strip_tags($_POST['new_update_subject']));
	}
	if (isset($_POST['new_update_content'])) {
		$content = wp_kses_post(balanceTags($_POST['new_update_content']));
	}
	//write_log( "idfu_fes_submit" );
	if (!empty($subject) && !empty($content)) {
		// we can post an update
		if (is_multisite()) {
			require (ABSPATH . WPINC . '/pluggable.php');
		}
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
		if (!empty($user_projects)) {
			if (!is_array($user_projects)) {
				$user_projects = unserialize($user_projects);
			}
			if (in_array($post_id, $user_projects)) {
				$args = array(
					'post_title' => $subject,
					'post_content' => $content,
					'post_status' => 'publish',
					'post_type' => 'ignition_update',
					'post_author' => $user_id
				);
				$post = wp_insert_post($args);
				if (!empty($post)) {
					update_post_meta($post, 'idfu_project_update', $project_id);
				}
				do_action('idfu_update_create', $post, $project_id);
				do_action('idfu_update_save', $post, $project_id);
			}
		}
	}
	return;
}

function idfu_fes_update($post_id, $project_id, $vars) {
	if (is_multisite()) {
		require (ABSPATH . WPINC . '/pluggable.php');
	}
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
	if (!empty($user_projects)) {
		if (!is_array($user_projects)) {
			$user_projects = unserialize($user_projects);
		}
		if (in_array($post_id, $user_projects)) {
			$post_array = array();
			foreach ($_POST as $k=>$v) {
				if (strpos($k, 'idfu_update_') !== FALSE) {
					$post_id = str_replace('idfu_update_', '', $k);
					if ($post_id > 0) {
						$post = array();
						$post['id'] = $post_id;
						$post['content'] = wp_kses_post($v);
						$old_post = get_post($post_id);
						$post_content = $old_post->post_content;
						if ($post_content !== $post['content']) {
							$post_array[] = $post;
						}
					}
				}
			}
			if (!empty($post_array)) {
				foreach ($post_array as $post) {
					$args = array(
						'ID' => $post['id'],
						'post_content' => $post['content']
						);
					wp_update_post($args);
					do_action('idfu_update_edit', $post['id'], $project_id);
					do_action('idfu_update_save', $post['id'], $project_id);
				}
			}
		}
	}
}

function idfu_get_updates($post_id) {
	$project_id = get_post_meta($post_id, 'ign_project_id', true);
	$args = array(
		'post_type' => 'ignition_update',
		'meta_key' => 'idfu_project_update',
		'meta_value' => $project_id
	);
	$posts = get_posts($args);
	return $posts;
}
?>