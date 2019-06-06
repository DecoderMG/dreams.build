<?php

//error_reporting(E_ALL);

//@ini_set('display_errors', 1);

/*
Plugin Name: IgnitionDeck Faq & Updates Extension
URI: http://IgnitionDeck.com
Description: An IgnitionDeck extension that creates two additional post types, FAQ and Updates, so that you may link to them in your project. 
Version: 1.0.2
Author: Virtuous Giant
Author URI: http://VirtuousGiant.com
License: GPL2
*/

require 'idfu-functions.php';

/**
 * Create FAQ post type
 */

add_action( 'init', 'id_create_faq' );

function id_create_faq() {
	register_post_type( 'ignition_faq',
	array(
		'labels' => array(
			'name' => 'FAQs',
			'singular_name' => 'FAQ',
			'add_new' => 'Add FAQ',
			'add_new_item' => 'Add New FAQ',
			'edit' => 'Edit FAQ',
			'edit_item' => 'Edit FAQ',
			'new_item' => 'NEW FAQ',
			'view' => 'View FAQ',
			'view_item' => 'View FAQ',
			'search_items' => 'Search FAQs',
			'not_found' => 'No FAQ Found',
			'not_found_in_trash' => 'No FAQs in Trash',
		),
            'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
		'hierarchical' => false,
		'menu_position' => 5,
		'capability_type' => 'post',
		'menu_icon' => plugins_url( 'ignitiondeck/images/ignitiondeck-menu.png', DIRNAME(__FILE__ )),
		'query_var' => true,
		'rewrite' => array( 'slug' => 'project-faqs', 'with_front' => true ),
		'has_archive' => 'project-faqs',
		'supports' => array('title', 'editor', 'comments'),
	));
}

add_action( 'init', 'id_create_updates' );

function id_create_updates() {
	$single_name = apply_filters('idfu_updates_name', __('Update', 'idfu'));
	$plural_name = apply_filters('idfu_updates_name_plural', __('Updates', 'idfu'));
	$slug = apply_filters('idfu_update_slug', 'project-updates');
	register_post_type( 'ignition_update',
	array(
		'labels' => array(
			'name' => $plural_name,
			'singular_name' => $single_name,
			'add_new' => __('Add', 'idfu').' '.$single_name,
			'add_new_item' => __('Add New', 'idfu').' '.$single_name,
			'edit' => __('Edit', 'idfu').' '.$single_name,
			'edit_item' => __('Edit', 'idfu').' '.$single_name,
			'new_item' => __('New', 'idfu').' '.$single_name,
			'view' => __('View', 'idfu').' '.$single_name,
			'view_item' => __('View', 'idfu').' '.$single_name,
			'search_items' => __('Search', 'idfu').' '.$plural_name,
			'not_found' => __('No', 'idfu').' '.$single_name.' '.__('Found', 'idfu'),
			'not_found_in_trash' => __('No', 'idfu').' '.$plural_name.' '.__('in Trash', 'idfu'),
		),
            'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
		'hierarchical' => false,
		'menu_position' => 5,
		'capability_type' => 'post',
		'menu_icon' => plugins_url( 'ignitiondeck/images/ignitiondeck-menu.png', DIRNAME(__FILE__ )),
		'query_var' => true,
		'rewrite' => array( 'slug' => $slug, 'with_front' => true ),
		'has_archive' => $slug,
		'supports' => array('title', 'editor', 'comments'),
	));
}

add_action('wp_enqueue_scripts', 'idfu_scripts');

function idfu_scripts() {
	wp_register_script('idfu', plugins_url('js/idfu.js', __FILE__));
	wp_register_style('idfu', plugins_url('css/idfu.css', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('idfu');
	wp_enqueue_style('idfu');
}

function distribute_updates($attrs) {
	//$update_array = array();
	$c = 1;
	$args = array('post_type' => 'ignition_update');
	$update_query = new WP_Query($args);
	if ( $update_query->have_posts() ) {?>
		<ul class="faq">
		<?php while ($update_query->have_posts()) {
			$update_query->the_post();
			$id = get_the_ID();
			$post = get_post($id);
			$meta = get_post_meta($id, 'idfu_project_update', true);
			if ($meta == $attrs['product']) {?>
			<li class="faq-entry whitebox">
				<a name="faq<?php echo $id; ?>"></a>
				<h4 class="entry">
				<?php _e('Project Update', 'idfu');?>#<?php echo $c; ?>:
					<?php the_title(); ?>
					<?php echo '<div class="update_posted">['.date('m/d/Y', strtotime($post->post_date)).']'.($post->post_date !== $post->post_modified ? '['.__('Edited: ', 'idfu').date('m/d/Y', strtotime($post->post_modified)) . ']': '').'</div>'; ?>

				</h4>
				<div class="entry_content">
					<?php the_content(); ?>
				</div>
				<!--
				<a href="<?php the_permalink(); ?>" class="update-link" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> <span class="update_posted">[<?php echo (date('m/d/Y', strtotime($post->post_date))); ?>] <?php echo ($post->post_date !== $post->post_modified ? '['.__('Edited: ', 'idfu').date('m/d/Y', strtotime($post->post_modified)).']' : ''); ?></span>
				-->
			</li>
		<?php }
		$c++;
		}
		echo '</ul>';
	}
	wp_reset_postdata();
}

add_action('id_updates', 'distribute_updates', 3, 1);

function distribute_faqs($attrs) {
	//$update_array = array();
	$args = array('post_type' => 'ignition_faq');
	$update_query = new WP_Query($args);
	if ( $update_query->have_posts() ) {?>
		<?php while ($update_query->have_posts()) {
			$update_query->the_post();
			$id = get_the_ID();
			$meta = get_post_meta($id, 'idfu_project_faq', true);
			if (isset($attrs['product']) && $meta == $attrs['product']) {	?>
			<a href="<?php the_permalink(); ?>" class="faq-link" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><br/><?php }
		}?>
	    <?php
	}
	wp_reset_postdata();
}

add_action('id_faqs', 'distribute_faqs', 3, 1);

add_action('add_meta_boxes_ignition_faq', 'idfu_faq_meta_box');
add_action('add_meta_boxes_ignition_update', 'idfu_update_meta_box');

function idfu_faq_meta_box() {
	add_meta_box('faq-project', 'Assign to Project', 'idfu_assign_faq_list', 'ignition_faq', 'side', 'default', null);
}

function idfu_update_meta_box() {
	add_meta_box('update-project', 'Assign to Project', 'idfu_assign_update_list', 'ignition_update', 'side', 'default', null);
}

function idfu_assign_faq_list($post) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'idfu_save_faq_to_post' );
	$url = site_url('wp-admin/admin-ajax.php');
	$saved = get_post_meta($post->ID, 'idfu_project_faq', true);
	include 'templates/admin/selectProject.php';
}

function idfu_assign_faq($post_id) {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if ( !isset( $_POST['idfu_save_faq_to_post'] ) || !wp_verify_nonce( $_POST['idfu_save_faq_to_post'], plugin_basename( __FILE__ ) ) ) {
      return;
  	}

  	if ( 'page' == $_POST['post_type'] ) {
	    if ( !current_user_can( 'edit_page', $post_id ) ) {
	        return;
		}
	}
  	else {
	    if ( !current_user_can( 'edit_post', $post_id ) ) {
	        return;
  		}
  	}

  	$post_ID = $_POST['post_ID'];
  	$faq_project = $_POST['choose-project'];
  	update_post_meta($post_ID, 'idfu_project_faq', $faq_project);
}

add_action('save_post', 'idfu_assign_faq');

function idfu_get_projects() {
	$projects = ID_Project::get_all_projects();
	print_r(json_encode($projects));
	exit;
}

add_action('wp_ajax_idfu_get_projects', 'idfu_get_projects');
add_action('wp_ajax_nopriv_idfu_get_projects', 'idfu_get_projects');

function idfu_assign_update_list($post) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'idfu_save_update_to_post' );
	$url = site_url('wp-admin/admin-ajax.php');
	$saved = get_post_meta($post->ID, 'idfu_project_update', true);
	include 'templates/admin/selectProject.php';
}

function idfu_assign_update($post_id) {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if ( !isset( $_POST['idfu_save_update_to_post'] ) || !wp_verify_nonce( $_POST['idfu_save_update_to_post'], plugin_basename( __FILE__ ) ) ) {
      return;
  	}

  	if ( 'page' == $_POST['post_type'] ) {
	    if ( !current_user_can( 'edit_page', $post_id ) ) {
	        return;
		}
	}
  	else {
	    if ( !current_user_can( 'edit_post', $post_id ) ) {
	        return;
  		}
  	}

  	$post_ID = $_POST['post_ID'];
  	$update_project = $_POST['choose-project'];
  	update_post_meta($post_ID, 'idfu_project_update', $update_project);
}

add_action('save_post', 'idfu_assign_update');

?>