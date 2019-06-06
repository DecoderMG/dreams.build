<?php 
function id_submissionForm_handler() {
	global $vars;global $current_user;
	if ( isset($_GET['create_project']) && is_user_logged_in()) {
		write_log( "id_submissionForm start" );
		//if (is_multisite()) { require (ABSPATH . WPINC . '/pluggable.php');}
		get_currentuserinfo();
		$wp_upload_dir = wp_upload_dir();
		//uploads
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		if (empty($post_id)) {
			if (isset($_GET['edit_project'])) {
				$post_id = $_GET['edit_project']; $post = get_post($post_id); $user_id = $current_user->ID;
				if (current_user_can('create_edit_projects')) {
					if ($user_id == $post->post_author) {
						add_filter('wp_kses_allowed_html', 'idcf_filter_wp_kses', 11, 2);// allows user to post iframe and embed code in long descriptions
					}
				}
			}
			else {
				if (isset($_GET['create_project']) && $_GET['create_project']) {
					if (current_user_can('create_edit_projects')) {
						// allows user to post iframe and embed code in long descriptions
						add_filter('wp_kses_allowed_html', 'idcf_filter_wp_kses', 11, 2);
					}
				}
			}
		}
		else {
			// post_id is coming in arguments, check that user can edit post, and it's his post as well
			$post = get_post($post_id); $user_id = $current_user->ID;
			if (current_user_can('create_edit_projects')) {
				if ($user_id == $post->post_author) {
					// allows user to post iframe and embed code in long descriptions
					add_filter('wp_kses_allowed_html', 'idcf_filter_wp_kses', 11, 2);
				}
			}
		}
		$vars = id_submissionForm_action($post_id=null);
	}
	else if (isset($_GET['edit_project'])) {
		$post_id = absint($_GET['edit_project']);
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
		if (!empty($user_projects)) {
			$user_projects = unserialize($user_projects);
			if (in_array($post_id, $user_projects)) {
				$vars = id_submissionForm_action($post_id);
			}
		}
	}
	
} 
add_action( 'init', 'id_submissionForm_handler' );

function load_vars($post_id){
	
	$memberdeck_gateways = get_option('memberdeck_gateways');
	$fund_types = get_option('idc_cf_fund_type');
	if (empty($fund_types)) { $fund_types = 'capture';}

	if (!empty($post_id) && $post_id > 0) {
		$post = get_post($post_id);
		$status = $post->post_status;
		$stage = get_post_meta($post_id, 'ign_stage', true);
		$company_name = get_post_meta($post_id, 'ign_company_name', true);
		$company_logo = get_post_meta($post_id, 'ign_company_logo', true);
		$company_location = get_post_meta($post_id, 'ign_company_location', true);
		$company_url = get_post_meta($post_id, 'ign_company_url', true);
		$company_fb = get_post_meta($post_id, 'ign_company_fb', true);
		$company_twitter = get_post_meta($post_id, 'ign_company_twitter', true);
		$project_name = get_the_title($post_id);
		$project_tags = wp_get_post_terms($post_id, 'post_tag');
		//$categories = wp_get_post_terms($post_id, 'project_category');
		$categories = wp_get_post_categories( $post_id );//wp_get_post_terms($post_id, 'category');
		if (!empty($categories) && is_array($categories)) {$project_category = $categories[0];}
		else { $project_category = null;}
		$project_start = get_post_meta($post_id, 'ign_start_date', true);
		$project_end = get_post_meta($post_id, 'ign_fund_end', true);
		$project_end2 = get_post_meta($post_id, 'ign_fund_end2', true);
		$project_goal = get_post_meta($post_id, 'ign_fund_goal', true);
		$project_goal2 = get_post_meta($post_id, 'ign_fund_goal2', true);
		/**/
		$project_short_description = get_post_meta($post_id, 'ign_project_description', true);
		$project_long_description = get_post_meta($post_id, 'ign_project_long_description', true);
		$project_faq = get_post_meta($post_id, 'ign_faqs', true);
		$project_updates = get_post_meta($post_id, 'ign_updates', true);
		$project_challenges = get_post_meta($post_id, 'ign_challenges', true);
		$project_follow_twitter = get_post_meta($post_id, 'ign_follow_twitter', true);
		$project_follow_facebook = get_post_meta($post_id, 'ign_follow_facebook', true);
		$project_follow_google = get_post_meta($post_id, 'ign_follow_google', true);
		$project_follow_in = get_post_meta($post_id, 'ign_follow_in', true);
		$project_follow_instagram = get_post_meta($post_id, 'ign_follow_instagram', true);
		$project_follow_website = get_post_meta($post_id, 'ign_follow_website', true);
		$project_collective_benefits = get_post_meta($post_id, 'ign_collective_benefits', true);
		$project_individual_rewards = get_post_meta($post_id, 'ign_individual_rewards', true);
		$project_business_plan = get_post_meta($post_id, 'ign_business_plan', true);
		$project_state = get_post_meta($post_id, 'ign_state', true);
		$project_city = get_post_meta($post_id, 'ign_city', true);
		$project_country = get_post_meta($post_id, 'ign_country', true);
		$project_map_lat = get_post_meta($post_id, 'ign_map_lat', true);
		$project_map_lng = get_post_meta($post_id, 'ign_map_lng', true);
		
		$project_video = get_post_meta($post_id, 'ign_product_video', true);
		$project_hero = ID_Project::get_project_thumbnail($post_id);
		$project_image2 = get_post_meta($post_id, 'ign_product_image2', true);
		$project_image3 = get_post_meta($post_id, 'ign_product_image3', true);
		$project_image4 = get_post_meta($post_id, 'ign_product_image4', true);
		$project_id = get_post_meta($post_id, 'ign_project_id', true);
		$project_type = get_post_meta($post_id, 'ign_project_type', true);
		//$project_end_type = get_post_meta($post_id, 'ign_end_type', true);
		$purchase_form = get_post_meta($post_id, 'ign_option_purchase_url', true);
		// levels
		$disable_levels = get_post_meta($post_id, 'ign_disable_levels', true);
		$project_levels = get_post_meta($post_id, 'ign_product_level_count', true);

		$levels = array();
		$levels[0] = array();
		$levels[0]['title']=get_post_meta($post_id, 'ign_product_title',true);/*level 1 */
		$levels[0]['price']=get_post_meta($post_id, 'ign_product_price',true); /*level 1 */
		$levels[0]['short']=get_post_meta($post_id, 'ign_product_short_description',true);/*level 1*/
		$levels[0]['long']=get_post_meta($post_id, 'ign_product_details', true);/*level 1*/
		$levels[0]['limit']=get_post_meta($post_id, 'ign_product_limit', true); /* level 1 */
		// Project fund type for the levels
		$levels_project_fund_type = get_post_meta($post_id, 'mdid_levels_fund_type', true);
		if (!empty($levels_project_fund_type)) {
			$levels[0]['fund_type'] = $levels_project_fund_type[0];
		}
		for ($i = 1; $i <= $project_levels - 1; $i++) {
			$levels[$i]=array();
			$levels[$i]['title']=get_post_meta($post_id,'ign_product_level_'.($i+1).'_title',true);
			$levels[$i]['price']=get_post_meta($post_id,'ign_product_level_'.($i+1).'_price',true);
			$levels[$i]['short']=get_post_meta($post_id,'ign_product_level_'.($i+1).'_short_desc',true);
			$levels[$i]['long']=get_post_meta($post_id,'ign_product_level_'.($i+1).'_desc',true);
			$levels[$i]['limit']=get_post_meta($post_id, 'ign_product_level_'.($i+1).'_limit',true);
			if (!empty($levels_project_fund_type[$i])) {
				$levels[$i]['fund_type'] = $levels_project_fund_type[$i];
			}
		}
		
		//array of loaded vars
		$vars = array(
			'fund_types' => $fund_types,
			'post_id' => $post_id,
			'company_name' => $company_name,
			'company_logo' => $company_logo,
			'company_location' => $company_location,
			'company_url' => $company_url,
			'company_fb' => $company_fb,
			'company_twitter' => $company_twitter,
			'project_name' => $project_name,
			'project_tags' => $project_tags,
			'project_category' => $project_category,
			'project_start' => $project_start,
			'project_end' => $project_end,
			'project_goal' => $project_goal,
			'project_goal2' => $project_goal2,
			'project_short_description' => $project_short_description,
			'project_long_description' => $project_long_description,
			'project_faq' => $project_faq,
			'project_challenges' => $project_challenges,
			'project_follow_twitter' => $project_follow_twitter,
			'project_follow_facebook' => $project_follow_facebook,
			'project_follow_google' => $project_follow_google,
			'project_follow_in' => $project_follow_in,
			'project_follow_instagram' => $project_follow_instagram,
			'project_follow_website' => $project_follow_website,
			'project_collective_benefits' => $project_collective_benefits,
			'project_individual_rewards' => $project_individual_rewards,
			'project_business_plan' => $project_business_plan,
			'project_state' => $project_state,
			'project_city' => $project_city,
			'project_country' => $project_country,
			'project_map_lat' => $project_map_lat,
			'project_map_lng' => $project_map_lng,
			'project_updates' => $project_updates,
			'project_video' => $project_video,
			'project_hero' => $project_hero,
			'project_image2' => $project_image2,
			'project_image3' => $project_image3,
			'project_image4' => $project_image4,
			'project_id' => $project_id,
			'project_type' => $project_type,
			//'project_end_type' => $project_end_type,
			'fund_types' => $fund_types,
			'disable_levels' => $disable_levels,
			'project_levels' => $project_levels,
			'levels' => $levels,
			'status' => $status
		);
	}
	//end of loading vars
	return $vars;
}


function id_submissionForm_action($post_id=null) {
	global $wpdb;global $permalink_structure; global $current_user;
	$vars = load_vars($post_id);
	//form handler
	if (isset($_POST['project_fesubmit']) || isset($_POST['project_fesave'])) {
		// prep for file inputs // Create team variables
		if(isset($_POST['company_name'])) $company_name = esc_attr($_POST['company_name']);
		if (isset($_FILES['company_logo']) && $_FILES['company_logo']['size'] > 0) {
			$company_logo = wp_handle_upload($_FILES['company_logo'], array('test_form' => false));
			$logo_filetype = wp_check_filetype(basename($company_logo['file']), null);
			if ($logo_filetype['ext'] == strtolower('png') || $logo_filetype['ext'] == strtolower('jpg') || $logo_filetype['ext'] == strtolower('gif') || $logo_filetype['ext'] == strtolower('jpeg')) {
				$logo_attachment = array(
			    	'guid' => $wp_upload_dir['url'] . '/' . basename( $company_logo['file'] ), 
			    	'post_mime_type' => $logo_filetype['type'],
			    	'post_title' => preg_replace('/\.[^.]+$/', '', basename($company_logo['file'])),
			    	'post_content' => '',
			    	'post_status' => 'inherit'
			  	);
			  	$company_logo_posted = true;
			}
			else {
				$company_logo_posted = false;
			}
		}
		else {
			$company_logo_posted = false;
			if (empty($vars['company_logo'])) { $company_logo = null; }
			else { $company_logo = $vars['company_logo'];}
		}
		if (isset($_POST['company_location'])) $company_location = esc_attr($_POST['company_location']);
		if (isset($_POST['company_url'])) $company_url = esc_attr($_POST['company_url']);
		if (isset($_POST['company_fb'])) $company_fb = esc_attr($_POST['company_fb']);
		if (isset($_POST['company_twitter']))$company_twitter = esc_attr($_POST['company_twitter']);
		
		
		if (isset($_POST['project_name'])) $project_name = esc_attr($_POST['project_name']);
		if (isset($_POST['project_category'])) $project_category = esc_attr($_POST['project_category']);
		else if (!empty($vars['project_category'])) $project_category = $vars['project_category'];
		else $project_category = null;
		
		if (isset($_POST['project_tags'])) {
			$project_tags = array_map( 'intval', $_POST['project_tags'] );
			$project_tags = array_unique( $project_tags );
		}
		else if (!empty($vars['project_tags'])) { $project_tags = $vars['project_tags'];}
		else { $project_tags = null;}
		if (isset($_POST['project_goal'])) {$project_goal = esc_attr(str_replace(',', '', $_POST['project_goal']));}
		if (isset($_POST['project_goal2'])) {$project_goal2 = esc_attr(str_replace(',', '', $_POST['project_goal2']));}
		$project_start = isset($_POST['project_start']) ? esc_attr($_POST['project_start']):'';
		$project_end = isset($_POST['project_end'])? esc_attr($_POST['project_end']):'';
		
		$project_short_description = esc_attr($_POST['project_short_description']);
		$project_long_description = wpautop(wp_kses_post(balanceTags($_POST['project_long_description'])));
		$project_faq = wpautop(wp_kses_post(balanceTags($_POST['project_faq'])));
		$project_challenges = wpautop(wp_kses_post(balanceTags($_POST['project_challenges'])));
		$project_collective_benefits = wpautop(wp_kses_post(balanceTags($_POST['project_collective_benefits'])));
		$project_individual_rewards = wpautop(wp_kses_post(balanceTags($_POST['project_individual_rewards'])));
		$project_business_plan = wpautop(wp_kses_post(balanceTags($_POST['project_business_plan'])));
		$project_follow_twitter = esc_url_raw($_POST['project_follow_twitter']);
		$project_follow_facebook = esc_url_raw($_POST['project_follow_facebook']);
		$project_follow_google = esc_url_raw($_POST['project_follow_google']);
		$project_follow_in = esc_url_raw($_POST['project_follow_in']);
		$project_follow_instagram = esc_url_raw($_POST['project_follow_instagram']);
		$project_follow_website = esc_url_raw($_POST['project_follow_website']);
		$project_state = esc_attr($_POST['project_state']);
		$project_city = esc_attr($_POST['project_city']);
		$project_country = esc_attr($_POST['project_country']);
		$project_map_lat = esc_attr($_POST['project_map_lat']);
		$project_map_lng = esc_attr($_POST['project_map_lng']);

		if (isset($_POST['project_updates'])) {
			$project_updates = wpautop(wp_kses_post(balanceTags($_POST['project_updates'])));
		}
		else { $project_updates = '';}
		write_log( "id_submissionForm variables" );

		$project_video = esc_attr($_POST['project_video']);

		if (isset($_FILES['project_hero']) && $_FILES['project_hero']['size'] > 0) {
			//$project_hero = esc_attr($_POST['project_hero']);
			$project_hero = wp_handle_upload($_FILES['project_hero'], array('test_form' => false));
			$hero_filetype = wp_check_filetype(basename($project_hero['file']), null);
			if ($hero_filetype['ext'] == strtolower('png') || $hero_filetype['ext'] == strtolower('jpg') || $hero_filetype['ext'] == strtolower('gif') || $hero_filetype['ext'] == strtolower('jpeg')) {
				$hero_attachment = array(
			    	'guid' => $wp_upload_dir['url'] . '/' . basename( $project_hero['file'] ), 
			    	'post_mime_type' => $hero_filetype['type'], 'post_title' => preg_replace('/\.[^.]+$/', '', basename($project_hero['file'])),
			    	'post_content' => '', 'post_status' => 'inherit');
			  	$hero_posted = true;
			}
			else { $hero_posted = false;}
		}
		else {
			$hero_posted = false;
			if (empty($vars['project_hero'])) { $project_hero = null;}
			else { $project_hero = $vars['project_hero']; }
			// Check if the already present image is removed
			if (isset($_POST['project_hero_removed']) && $_POST['project_hero_removed'] == "yes") {
				$project_hero_removed = true;
			}
		}
		if (isset($_FILES['project_image2']) && $_FILES['project_image2']['size'] > 0) {
			//$project_image2 = esc_attr($_POST['project_image2']);
			$project_image2 = wp_handle_upload($_FILES['project_image2'], array('test_form' => false));
			$image2_filetype = wp_check_filetype(basename($project_image2['file']), null);
			if ($image2_filetype['ext'] == strtolower('png') || $image2_filetype['ext'] == strtolower('jpg') || $image2_filetype['ext'] == strtolower('gif') || $image2_filetype['ext'] == strtolower('jpeg')) {
				$image2_attachment = array(
			    	'guid' => $wp_upload_dir['url'] . '/' . basename( $project_image2['file'] ), 
			    	'post_mime_type' => $image2_filetype['type'],'post_title' => preg_replace('/\.[^.]+$/', '', basename($project_image2['file'])),
			    	'post_content' => '','post_status' => 'inherit');
			  	$project_image2_posted = true;
			}
			else { $project_image2_posted = false;}
		}
		else {
			$project_image2_posted = false;
			if (empty($vars['project_image2'])) { $project_image2 = null;}
			else {$project_image2 = $vars['project_image2'];}
			// Check if the already present image is removed
			if (isset($_POST['project_image2_removed']) && $_POST['project_image2_removed'] == "yes") {
				$project_image2_removed = true;
			}
		}
		if (isset($_FILES['project_image3']) && $_FILES['project_image3']['size'] > 0) {
			//$project_image3 = esc_attr($_POST['project_image3']);
			$project_image3 = wp_handle_upload($_FILES['project_image3'], array('test_form' => false));
			$image3_filetype = wp_check_filetype(basename($project_image3['file']), null);
			if ($image3_filetype['ext'] == strtolower('png') || $image3_filetype['ext'] == strtolower('jpg') || $image3_filetype['ext'] == strtolower('gif') || $image3_filetype['ext'] == strtolower('jpeg')) {
				$image3_attachment = array(
			    	'guid' => $wp_upload_dir['url'] . '/' . basename( $project_image3['file'] ), 
			    	'post_mime_type' => $image3_filetype['type'],'post_title' => preg_replace('/\.[^.]+$/', '', basename($project_image3['file'])),
			    	'post_content' => '','post_status' => 'inherit');
			  	$project_image3_posted = true;
			}
			else { $project_image3_posted = false;}
		}
		else {
			$project_image3_posted = false;
			if (empty($vars['project_image3'])) { $project_image3 = null; }
			else { $project_image3 = $vars['project_image3']; }
			// Check if the already present image is removed
			if (isset($_POST['project_image3_removed']) && $_POST['project_image3_removed'] == "yes") {
				$project_image3_removed = true;
			}
		}
		if (isset($_FILES['project_image4']) && $_FILES['project_image4']['size'] > 0) {
			//$project_image4 = esc_attr($_POST['project_image4']);
			$project_image4 = wp_handle_upload($_FILES['project_image4'], array('test_form' => false));
			$image4_filetype = wp_check_filetype(basename($project_image4['file']), null);
			if ($image4_filetype['ext'] == strtolower('png') || $image4_filetype['ext'] == strtolower('jpg') || $image4_filetype['ext'] == strtolower('gif') || $image4_filetype['ext'] == strtolower('jpeg')) {
				$image4_attachment = array(
			    	'guid' => $wp_upload_dir['url'] . '/' . basename( $project_image4['file'] ), 
			    	'post_mime_type' => $image4_filetype['type'],'post_title' => preg_replace('/\.[^.]+$/', '', basename($project_image4['file'])),
			    	'post_content' => '','post_status' => 'inherit');
			  	$project_image4_posted = true;
			}
			else { $project_image4_posted = false; }
		}
		else {
			$project_image4_posted = false;
			if (empty($vars['project_image4'])) { $project_image4 = null; }
			else { $project_image4 = $vars['project_image4']; }
			// Check if the already present image is removed
			if (isset($_POST['project_image4_removed']) && $_POST['project_image4_removed'] == "yes") {
				$project_image4_removed = true;
			}
		}
		//$type = esc_attr($_POST['project_type']);
		$project_type = 'level-based';
	write_log( "id_submissionForm project type" );
		/*if (isset($_POST['project_end_type'])) { $project_end_type = esc_attr($_POST['project_end_type']); }*/
		if (isset($_POST['disable_levels'])) {
			$disable_levels = absint($_POST['disable_levels']);
			$project_levels = 0;
		}
		else {
			$disable_levels = 0;
		}
		if (isset($_POST['project_levels']) && !$disable_levels) {
			$project_levels = absint($_POST['project_levels']);
			$saved_levels = array();
			$saved_funding_types = array();

			// Removing last element of project_fund_type array posted, because that's of cloned level
			if (isset($_POST['project_fund_type'])) {
				array_pop($_POST['project_fund_type']);
			}
			for ($i = 0, $j = 0; $i <= $project_levels - 1; $i++) {
				$saved_levels[$i] = array();
				if (isset($_POST['project_level_title'][$i])) {
					$saved_levels[$i]['title'] = $_POST['project_level_title'][$i];
				}
				else {
					// project is live and title cannot be edited
					$saved_levels[$i]['title'] = $levels[$i]['title'];
				}
				if (isset($_POST['project_level_price'][$i])) {
					if (empty($_POST['project_level_price'][$i])) {
						$saved_levels[$i]['price'] = esc_attr($_POST['project_level_price'][$i]);
					}
					else {
						$saved_levels[$i]['price'] = floatval(str_replace(',', '', $_POST['project_level_price'][$i]));
					}
				}
				else {
					// project is live and price cannot be edited
					$saved_levels[$i]['price'] = $levels[$i]['price'];
				}
				$saved_levels[$i]['short'] = sanitize_text_field($_POST['level_description'][$i]);
				$saved_levels[$i]['long'] = wpautop(wp_kses_post(balanceTags($_POST['level_long_description'][$i])));
				if (isset($_POST['project_level_limit'][$i])) {
					$saved_levels[$i]['limit'] = absint($_POST['project_level_limit'][$i]);
				}
				else {
					// project is live and limit cannot be edited
					$saved_levels[$i]['limit'] = $levels[$i]['limit'];
				}

				if (isset($levels_project_fund_type[$i])) {
					$saved_funding_types[$i] = $levels_project_fund_type[$i];
				}
				else {
					$saved_funding_types[$i] = sanitize_text_field($_POST['project_fund_type'][$j]);
					$j++;
				}
			}
		}
		// Create user variables
		if (is_user_logged_in()) {
			write_log( "id_submissionForm user" );
			/*global $current_user; get_currentuserinfo(); USER DOUBLE*/
			$user_id = $current_user->ID;
			$comment_status = get_option('default_comment_status');
			// Create a New Post
			$args = array(
				'post_author' => $user_id, 'post_title' => $project_name,
				'post_name' => str_replace(' ', '-', $project_name),
				'post_type' => 'ignition_product', //'tax_input' => array('project_category' => $project_category),
				'post_tag' => $tags, 'post_category' => array($project_category),
				'comment_status' => $comment_status
			);
			if (isset($_POST['project_post_id'])) {
				$args['ID'] = absint($_POST['project_post_id']);
				$post = get_post($post_id);
				$status = $post->post_status;
				if ((strtoupper($status) == 'DRAFT') && (isset($_POST['project_fesubmit']))){
					$status = 'pending';//If the project was previously saved, and is now being submitted, update the status
				}
				$args['post_status'] = $status;
				$args['comment_status'] = $post->comment_status;
			}
			else {// NEW
				if (isset($_POST['project_fesave'])) { $args['post_status'] = 'draft'; }
				else if (isset($_POST['project_fesubmit'])) { $args['post_status'] = 'pending';}
			}
			$post_id = wp_insert_post($args);
			write_log( "Creation launched" );
			if (!current_user_can('manage_categories')) {
				wp_set_object_terms($post_id, $project_category, 'category');
			}//wp_set_object_terms($post_id, $project_tags, 'post_tag');
			if (isset($post_id)) {
				if ($company_logo_posted) {
					$logo_id = wp_insert_attachment($logo_attachment, $company_logo['file'], $post_id);
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$logo_data = wp_generate_attachment_metadata( $logo_id, $company_logo['file'] ); $metadata = wp_update_attachment_metadata( $logo_id, $logo_data );
				}
				if ($hero_posted) {
					$hero_id = wp_insert_attachment($hero_attachment, $project_hero['file'], $post_id);
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$hero_data = wp_generate_attachment_metadata( $hero_id, $project_hero['file'] ); $metadata = wp_update_attachment_metadata( $hero_id, $hero_data );
				}
				if ($project_image2_posted) {
					$image2_id = wp_insert_attachment($image2_attachment, $project_image2['file'], $post_id);
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$image2_data = wp_generate_attachment_metadata( $image2_id, $project_image2['file'] ); wp_update_attachment_metadata( $image2_id, $image2_data );
				}
				if ($project_image3_posted) {
					$image3_id = wp_insert_attachment($image3_attachment, $project_image3['file'], $post_id);
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$image3_data = wp_generate_attachment_metadata( $image3_id, $project_image3['file'] ); wp_update_attachment_metadata( $image3_id, $image3_data );
				}
				if ($project_image4_posted) {
					$image4_id = wp_insert_attachment($image4_attachment, $project_image4['file'], $post_id);
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$image4_data = wp_generate_attachment_metadata( $image4_id, $project_image4['file'] ); wp_update_attachment_metadata( $image4_id, $image4_data );
				}
				// Insert to ign_products
				$proj_args = array('product_name' => $project_name);
				if (isset($saved_levels[0])) {
					$proj_args['ign_product_title'] = $saved_levels[0]['title'];
					$proj_args['ign_product_limit'] = $saved_levels[0]['limit'];
					$proj_args['product_details'] = $saved_levels[0]['short'];
					$proj_args['product_price'] = $saved_levels[0]['price'];
				}
				$proj_args['goal'] = $project_goal;
				$proj_args['goal2'] = $project_goal2;
				$project_id = get_post_meta($post_id, 'ign_project_id', true);
				if (!empty($project_id)) {
					$project = new ID_Project($project_id); $project->update_project($proj_args);
				}
				else {
					$project_id = ID_Project::insert_project($proj_args);
				}
				if (isset($project_id)) {
					update_post_meta($post_id, 'ign_company_name', $company_name);
					if (isset($company_logo['url']) && is_array($company_logo)) {
						$company_logo = esc_attr($company_logo['url']);
						update_post_meta($post_id, 'ign_company_logo', $company_logo);
					}
					else if (!isset($company_logo)) {
						delete_post_meta($post_id, 'ign_company_logo');
					}
					update_post_meta($post_id, 'ign_company_location', $company_location);
					update_post_meta($post_id, 'ign_company_url', $company_url);
					update_post_meta($post_id, 'ign_company_fb', $company_fb);
					update_post_meta($post_id, 'ign_company_twitter', $company_twitter);
					//update_post_meta($post_id, 'ign_product_name', $project_name);
					update_post_meta($post_id, 'ign_start_date', $project_start);
					update_post_meta($post_id, 'ign_fund_end', $project_end);
					update_post_meta($post_id, 'ign_fund_end2', $project_end2);
					update_post_meta($post_id, 'ign_fund_goal', $project_goal);
					update_post_meta($post_id, 'ign_fund_goal2', $project_goal2);
					update_post_meta($post_id, 'ign_project_description', $project_short_description);
					update_post_meta($post_id, 'ign_project_long_description', $project_long_description);
					update_post_meta($post_id, 'ign_faqs', $project_faq);
					update_post_meta($post_id, 'ign_challenges', $project_challenges);
					update_post_meta($post_id, 'ign_collective_benefits', $project_collective_benefits);
					update_post_meta($post_id, 'ign_individual_rewards', $project_individual_rewards);
					update_post_meta($post_id, 'ign_business_plan', $project_business_plan);
					update_post_meta($post_id, 'ign_follow_twitter', $project_follow_twitter);
					update_post_meta($post_id, 'ign_follow_facebook', $project_follow_facebook);
					update_post_meta($post_id, 'ign_follow_google', $project_follow_google);
					update_post_meta($post_id, 'ign_follow_in', $project_follow_in);
					update_post_meta($post_id, 'ign_follow_instagram', $project_follow_instagram);
					update_post_meta($post_id, 'ign_follow_website', $project_follow_website);
					update_post_meta($post_id, 'ign_state', $project_state);
					update_post_meta($post_id, 'ign_city', $project_city);
					update_post_meta($post_id, 'ign_country', $project_country);
					update_post_meta($post_id, 'ign_map_lat', $project_map_lat);
					update_post_meta($post_id, 'ign_map_lng', $project_map_lng);
					update_post_meta($post_id, 'ign_updates', $project_updates);
					update_post_meta($post_id, 'ign_product_video', $project_video);
					if($stage) update_post_meta($post_id, 'ign_stage', $stage);
					wp_update_post(array('ID' => $post_id, 'post_category'=>array($project_category)));
					
					$cur_project_tags = wp_get_post_terms($post_id, 'post_tag');
					foreach($cur_project_tags as $cur_proj){
						if(in_array($cur_proj->term_id, array(39,40))) $project_tags[] = $cur_proj->term_id;
					}
					wp_set_object_terms($post_id, $project_tags,'post_tag');
					if (isset($project_hero['url']) && is_array($project_hero)) {
						$project_hero = esc_attr($project_hero['url']);
						//update_post_meta($post_id, 'ign_product_image1', $project_hero);
						$sql = $wpdb->prepare('SELECT ID FROM '.$wpdb->prefix.'posts WHERE guid = %s', $project_hero);
						$res = $wpdb->get_row($sql);
						if (!empty($res)) {
							$attachment_id = $res->ID;
							set_post_thumbnail($post_id, $attachment_id);
						}
					}
					else if (!isset($project_hero) || $project_hero_removed) {	
						//delete_post_meta($post_id, 'ign_product_image1');
						delete_post_thumbnail($post_id);
					}
					if (isset($project_image2['url']) && is_array($project_image2)) {
						$project_image2 = esc_attr($project_image2['url']);
						update_post_meta($post_id, 'ign_product_image2', $project_image2);
					}
					else if (!isset($project_image2) || $project_image2_removed) {
						delete_post_meta($post_id, 'ign_product_image2');
					}
					if (isset($project_image3['url']) && is_array($project_image3)) {
						$project_image3 = esc_attr($project_image3['url']);
						update_post_meta($post_id, 'ign_product_image3', $project_image3);
					}
					else if (!isset($project_image3) || $project_image3_removed) {
						delete_post_meta($post_id, 'ign_product_image3');
					}
					if (isset($project_image4['url']) && is_array($project_image4)) {
						$project_image4 = esc_attr($project_image4['url']);
						update_post_meta($post_id, 'ign_product_image4', $project_image4);
					}
					else if (!isset($project_image4) || $project_image4_removed) {
						delete_post_meta($post_id, 'ign_product_image4');
					}

					update_post_meta($post_id, 'ign_project_id', $project_id);
					update_post_meta($post_id, 'ign_project_type', $project_type);
					//update_post_meta($post_id, 'ign_end_type', $project_end_type);
					update_post_meta($post_id, 'ign_end_type', 'open');
					if (empty($purchase_form)) update_post_meta($post_id, 'ign_option_purchase_url', 'default');
					// levels
					update_post_meta($post_id, 'ign_disable_levels', $disable_levels);
					update_post_meta($post_id, 'ign_product_level_count', $project_levels);
					update_post_meta($post_id, 'ign_product_title', $saved_levels[0]['title']); /* level 1 */
					update_post_meta($post_id, 'ign_product_price', $saved_levels[0]['price']); /* level 1 */
					update_post_meta($post_id, 'ign_product_short_description', $saved_levels[0]['short']); /* level 1 */
					update_post_meta($post_id, 'ign_product_details', $saved_levels[0]['long']); /* level 1 */
					update_post_meta($post_id, 'ign_product_limit', $saved_levels[0]['limit']); /* level 1 */
					for ($i = 2; $i <= $project_levels; $i++) {
						update_post_meta($post_id, 'ign_product_level_'.($i).'_title', $saved_levels[$i-1]['title']);
						update_post_meta($post_id, 'ign_product_level_'.($i).'_price', $saved_levels[$i-1]['price']);
						update_post_meta($post_id, 'ign_product_level_'.($i).'_short_desc', $saved_levels[$i-1]['short']);
						update_post_meta($post_id, 'ign_product_level_'.($i).'_desc', $saved_levels[$i-1]['long']);
						update_post_meta($post_id, 'ign_product_level_'.($i).'_limit', $saved_levels[$i-1]['limit']);
					}
					// Saving project fund type for all the levels in postmeta
					update_post_meta($post_id, 'mdid_levels_fund_type', $saved_funding_types);

					// Attach product to user
					set_user_projects($post_id, $user_id);
					if (!isset($status)) {
						do_action('ide_fes_create', $user_id, $project_id, $post_id, $proj_args, $saved_levels, $saved_funding_types);
						if (isset($_POST['project_fesubmit'])) {
							do_action('ide_fes_notify', $user_id, $project_id, $post_id, $proj_args, $saved_levels, $saved_funding_types);//write_log('Notifying...');
						}
					}
					else {
						do_action('ide_fes_update', $user_id, $project_id, $post_id, $proj_args, $saved_levels, $saved_funding_types);
						if (isset($_POST['project_fesubmit'])) {
							do_action('ide_fes_notify', $user_id, $project_id, $post_id, $proj_args, $saved_levels, $saved_funding_types); //write_log('Notifying...');
						}
					}
					$vars = array('post_id' => $post_id,
						'company_name' => $company_name,
						'company_logo' => $company_logo,
						'company_location' => $company_location,
						'company_url' => $company_url,
						'company_fb' => $company_fb,
						'company_twitter' => $company_twitter,
						'project_name' => $project_name,
						'project_tags' => $project_tags,
						'project_category' => $project_category,
						'project_start' => $project_start,
						'project_end' => $project_end,
						'project_goal' => $project_goal,
						'project_goal2' => $project_goal2,
						'project_short_description' => $project_short_description,
						'project_long_description' => $project_long_description,
						'project_faq' => $project_faq,
						'project_challenges' => $project_challenges,
						'project_collective_benefits' => $project_collective_benefits,
						'project_individual_rewards' => $project_individual_rewards,
						'project_business_plan' => $project_business_plan,
						'project_follow_twitter' => $project_follow_twitter,
						'project_follow_facebook' => $project_follow_facebook,
						'project_follow_google' => $project_follow_google,
						'project_follow_in' => $project_follow_in,
						'project_follow_instagram' => $project_follow_instagram,
						'project_follow_website' => $project_follow_website,
						'project_state' => $project_state,
						'project_city' => $project_city,
						'project_country' => $project_country,
						'project_map_lat' => $project_map_lat,
						'project_map_lng' => $project_map_lng,
						'project_updates' => $project_updates,
						'project_video' => $project_video,
						'project_hero' => $project_hero,
						'project_image2' => $project_image2,
						'project_image3' => $project_image3,
						'project_image4' => $project_image4,
						'project_id' => $project_id,
						'project_type' => $project_type,
						/*'project_fund_type' => $project_fund_type,*/
						//'project_end_type' => $project_end_type,
						'disable_levels' => $disable_levels,
						'project_levels' => $project_levels,
						'levels' => $saved_levels
					);
					if ( ($errors = check_vars($vars))===1){
						do_action('ide_fes_submit', $post_id, $project_id, $vars);
						$prefix = empty($permalink_structure) ? '&' : '?';
						wp_redirect( home_url(apply_filters('ide_fes_submit_redirect', md_get_durl().$prefix.'edit_project='.$post_id)) ); exit;
					}
					else {
						$vars['errors'] = $errors;
					}
				}
				else {
					// return some error
				}
			}
			else {
				// return some error
			}
		}
	}
	return $vars;
}