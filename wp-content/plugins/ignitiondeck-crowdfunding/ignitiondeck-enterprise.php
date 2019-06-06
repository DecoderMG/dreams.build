<?php

//!nikita add_action('id_before_content_description', 'ide_creator_profile', 5, 2);

 if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

function ide_creator_profile($project_id, $post_id) {
	$profile = ide_creator_info($post_id);
	if (!empty($profile['name'])) {
		$durl = md_get_durl();
		include_once ID_PATH.'templates/_projectCreatorProfile.php';
	}
}

function ide_creator_info($post_id) {
	$post = get_post($post_id);
	$author = $post->post_author;
	$company_name = get_post_meta($post_id, 'ign_company_name', true);
	$company_logo = get_post_meta($post_id, 'ign_company_logo', true);
	$company_location = get_post_meta($post_id, 'ign_company_location', true);
	$company_url = get_post_meta($post_id, 'ign_company_url', true);
	$company_fb = get_post_meta($post_id, 'ign_company_fb', true);
	$company_twitter = get_post_meta($post_id, 'ign_company_twitter', true);
	$profile = array(
		'author' => $author,
		'name' => $company_name,
		'logo' => $company_logo,
		'location' => $company_location,
		'url' => $company_url,
		'facebook' => $company_fb,
		'twitter' => $company_twitter
		);
	return $profile;
}

add_shortcode('project_submission_form', 'id_submissionForm');


function id_submissionForm($post_id = null) {
	global $vars;
	/*if($post_id) {
		$vars = load_vars($post_id);
	}*/
	//write_log( "id_submissionForm FORM" );
	$form = new ID_FES(null, (isset($vars) ? $vars : null));
	wp_enqueue_style('checkboxes');
	do_action('ide_before_fes_display');
	$output = '<div class="row"><div class="col-lg-2 dashboard-sidebar">';
	ob_start();get_template_part('sidebar', 'projectcreation');$ob_contentc = ob_get_contents();ob_end_clean();
	$output .= $ob_contentc.'</div><div class="col-lg-7 ignitiondeck"><form name="fes" id="fes" action="" method="POST" enctype="multipart/form-data">';
	//if(!empty($vars['errors'])) $output.= '<p class="error">The project is not saved. Please fill out all required fields.</p>';
	if(!empty($vars['errors'])) $output.= '<p class="error">Some fields are invalid. Please check out all fields.</p>';
	$output .= '<div class="whitebox'.(isset($vars['post_id']) ? ' mt-0':'').'">';
	$output .= '<div><div class="id-fes-form-wrapper">';
	$output .= $form->display_form();
	//$output .= '</div></div></div>';
	$output .='';
	$output .= '</form></div>';
	ob_start();get_template_part('entry', 'creation');$ob_contentc = ob_get_contents();ob_end_clean();
	$output .= $ob_contentc.'</div>';
	return apply_filters('ide_fes_display', $output);
}

//check for required
/*function check_vars($vars){
	$arr = array('project_name','project_start','project_end','project_goal');
	$errors = array();
	foreach($arr as $rule)
	if(empty($vars["$rule"])) {
		$errors["$rule"] = $rule;
	}
	return empty($errors)? 1 : $errors;
}*/
add_action('init', 'ide_check_create_project', 2);

function ide_check_create_project() {
	if (isset($_GET['create_project'])&& is_user_logged_in()) {
		//write_log( "ide_check_create_project" );
		add_action('wp_enqueue_scripts', 'enqueue_enterprise_js');
		add_filter('the_content', 'ide_create_project');
		if (class_exists('WPSEO_OpenGraph')) {
			remove_action('init', 'initialize_wpseo_front');
		}
		add_filter( 'jetpack_enable_open_graph', '__return_false', 99 );
	}
	else if (isset($_GET['edit_project'])) {
		$project_id = absint($_GET['edit_project']);
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
		if (!empty($user_projects)) {
			$user_projects = unserialize($user_projects);
			if (in_array($project_id, $user_projects)) {
				add_filter('the_content', 'ide_edit_project');
				add_action('wp_enqueue_scripts', 'enqueue_enterprise_js');
			}
		}
		if (class_exists('WPSEO_OpenGraph')) {
			remove_action('init', 'initialize_wpseo_front');
		}
		add_filter( 'jetpack_enable_open_graph', '__return_false', 99 );
	} else if (isset($_GET['export_project'])) {
		$project_id = get_post_meta($_GET['export_project'], 'ign_project_id', true);
		if ($project_id > 0)
			$force_download = ID_Member::export_members($project_id, true);
	}
}

function ide_create_project($content) {
	//write_log( "ide_create_project" );
	$content = id_submissionForm();
	return $content;
}


//add_action('init', 'ide_check_edit_project');

/*function ide_check_edit_project() {
	if (isset($_GET['edit_project']) && $_GET['edit_project'] > 0) {
		$project_id = absint($_GET['edit_project']);
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
		if (!empty($user_projects)) {
			$user_projects = unserialize($user_projects);
			if (in_array($project_id, $user_projects)) {
				add_filter('the_content', 'ide_edit_project');
			}
		}
	}
}*/

function ide_edit_project($content) {
	/*$edit_form = new ID_FES();
	$content = '<div class="ignitiondeck"><div class="id-purchase-form-wrapper">';
	$content .= '<form name="fes" id="fes" action="" method="POST">';
	$content .= $edit_form->display_form();
	$content .= '</form>';
	$content .= '</div></div>';*/
	$post_id = absint($_GET['edit_project']);
	if (isset($post_id) && $post_id > 0) {
		$drafturl = Share_Drafts_Publicly::make_draft_public($post_id);
		$post_status = get_post_status($post_id);
		$permalink = get_permalink($post_id);
		$status_open = '<div class="row"><div class="col-lg-12 notifications"><div class="ignitiondeck"><p class="notification green">';
		$status = '';
		if (strtoupper($post_status) == 'DRAFT') {
			$status .= '<strong>'. sprintf( __('Your project is currently saved as a draft. You can see a preview %s%s%s here%s', 'ignitiondeck'), '<a title="View Project" href="', $permalink, '&preview=1">', '</a>.' ) .'</strong><br/>';
			$status .= __('You can visit this page at any time in order to continue editing your project.<br/>', 'ignitiondeck');
			$status .= __('You can share this project with friends using this URL: '.$drafturl, 'ignitiondeck');
		}
		else if (strtoupper($post_status) == 'CLOSED') {
			$status .= '<strong>'. sprintf( __('Your project is currently closed. You can see a preview %s%s%s here%s', 'ignitiondeck'), '<a title="View Project" href="', $permalink,'">', '</a>.' ) .'</strong><br/>';
			$status .= __('You can visit this page at any time in order to continue editing your project.', 'ignitiondeck');
		}
		else if (strtoupper($post_status) == 'PENDING') {
			$status .= '<strong>'. sprintf( __('Your project has been submitted and is awaiting review. You can see a preview %s%s%s here%s', 'ignitiondeck'), '<a title="View Project" href="', $permalink, '&preview=1">', '</a>.' ) .'</strong><br/>';
			$status .= __('You can visit this page at any time in order to continue editing your project.<br/>', 'ignitiondeck');
			$status .= __('You can share this project with friends using this URL: '.$drafturl, 'ignitiondeck');
		}
		else if (strtoupper($post_status) == 'PUBLISH') {
			$status .= '<strong>'. sprintf( __('Your project is live. You can view it %s%s%s here%s', 'ignitiondeck'), '<a title="View Project" href="', $permalink, '">', '</a>.' ) .'</strong><br/>';
			$status .= __('You may continue to add levels or edit content available to you on this screen.', 'ignitiondeck');
		}
		$status_close = '</p></div></div></div>';
		$content = $status_open.apply_filters('ide_project_edit_status', $status, $post_id).$status_close.id_submissionForm($post_id);
	}
	return $content;
}

function enqueue_enterprise_js() {
	wp_register_script('fes', plugins_url('js/fes.js', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('fes');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_register_style('id-datepicker', plugins_url('ign_metabox/style.css', __FILE__));
	wp_enqueue_style('id-datepicker');
}

function set_user_projects($post_id, $user_id = null) {
	$post = get_post($post_id);
	if (isset($post)) {
		$post_type = $post->post_type;
		if ($post_type == 'ignition_product') {
			if (empty($user_id)) {
				$user_id = $post->post_author;
			}
			else {
				$user_id = 1;
			}
			if (isset($user_id)) {
				$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
				if (!empty($user_projects)) {
					$user_projects = unserialize($user_projects);
					if (is_array($user_projects)) {
						$user_projects[] = $post_id;
						$user_projects = array_unique($user_projects);
					}
					else {
						$user_projects = array($post_id);
					}
				}
				else {
					$user_projects = array($post_id);
				}
				$new_record = serialize($user_projects);
				update_user_meta($user_id, 'ide_user_projects', $new_record);
			}
		}
	}
}

add_action('save_post', 'set_user_projects', 500);

add_action('wp', 'ide_use_default_project_page');

function ide_use_default_project_page() {
	global $theme_base;
	if (empty($theme_base) || !in_array($theme_base, array('fivehundred', 'fundify', 'crowdpress'))) {
		global $post;
		if (isset($post)) {
			$post_id = $post->ID;
			$content = $post->post_content;
			if ($post->post_type == 'ignition_product') {
				add_filter('the_content', 'ide_default_shortcode');
			}
		}
	}
}

function ide_default_shortcode($content) {
	global $post;
	$post_id = $post->ID;
	$project_id = get_post_meta($post_id, 'ign_project_id', true);
	$content = do_shortcode('[project_page_complete product="'.$project_id.'"]');
	return $content;
}

add_action('wp', 'ide_check_show_preview');

function ide_check_show_preview() {
	global $post;
	if (isset($post)) {
		$post_id = $post->ID;
		if (isset($post_id)) {
			if (is_user_logged_in()) {
				global $current_user;
				get_currentuserinfo();
				$user_id = $current_user->ID;
				$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
				if (!empty($user_projects)) {
					$user_projects = unserialize($user_projects);
					if (in_array($post_id, $user_projects)) {
						//add_filter('pre_get_posts', 'ide_show_preview');
					}
				}
			}
		}
	}
}

//add_action('pre_get_posts', 'ide_show_preview');

function ide_show_preview_old($query) {
	if (!is_admin() && $query->is_main_query() && $query->is_singular()) {
		if (isset($_GET['p'])) {
			$post_id = $_GET['p'];
		}
	}
	if (isset($post_id)) {
		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			$user_id = $current_user->ID;
			$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
			if (!empty($user_projects)) {
				$user_projects = unserialize($user_projects);
				if (in_array($post_id, $user_projects)) {
					$query->set('post_status', 'publish, draft');
					add_filter('posts_results', 'test_some_stuff');
				}
			}
		}
	}
	return $query;
}

add_filter('posts_results', 'ide_show_preview');

function ide_show_preview($posts) {
	if (isset($posts)) {
		if (is_main_query() && !is_admin() && is_singular()) {
			if (!empty($posts)) {
				$post = $posts[0];
				if ($post->post_type == 'ignition_product') {
					$post_id = $post->ID;
				}
			}
		}
	}
	if (isset($post_id)) {
		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			$user_id = $current_user->ID;
			$user_projects = get_user_meta($user_id, 'ide_user_projects', true);
			if (!empty($user_projects)) {
				$user_projects = unserialize($user_projects);
				if (in_array($post_id, $user_projects)) {
					$posts[0]->post_status = 'publish';
				}
			}
		}
	}
	return $posts;
}

/* Start Tabs */

/* Backer Profile */

/*nikita add_action('md_profile_extratabs', 'ide_backer_profile_tab', 1);

function ide_backer_profile_tab() {
	global $current_user;
	global $permalink_structure;
	if (empty($permalink_structure)) {
		$prefix = '&';
	}
	else {
		$prefix = '?';
	}
	get_currentuserinfo();
	$user_id = $current_user->ID;
	if (isset($_GET['backer_profile'])) {
		$profile = absint($_GET['backer_profile']);
	}
	echo '<li '.(isset($profile) && $profile == $user_id ? 'class="active"' : '').'><a href="'.md_get_durl().$prefix.'backer_profile='.$user_id.'">'.__('My Backed Dreams', 'ignitiondeck').'</a></li>';
}*/

add_action('init', 'ide_backer_profile');

function ide_backer_profile() {
	if (isset($_GET['backer_profile'])) {
		$profile = absint($_GET['backer_profile']);
		if (isset($profile) && $profile > 0) {
			add_filter('the_content', 'ide_backer_profile_display');
			add_filter('the_title', 'ide_backer_profile_title', 10, 2);
			add_action('wp_head', 'ide_backer_profile_og');
			add_filter('wp_title', 'ide_backer_profile_tab_title', 10, 2);
		}
	}
}

function ide_backer_profile_display($content) {
	// we should really turn this into a template
	$content = '';
	if (isset($_GET['backer_profile'])) {
		$profile = absint($_GET['backer_profile']);
	}
	$user = get_user_by('id', $profile);
	if (is_user_logged_in() && !isset($current_user)) {
		global $current_user;get_currentuserinfo();
	}
	if (isset($current_user)) {
		$orders = ID_Member_Order::get_orders_by_user($current_user->ID);
		$orders = array_reverse($orders);
	}
	$durl = md_get_durl();
	//$name = $user->user_firstname.' '.$user->user_lastname;
	$name = apply_filters('ide_profile_name', $user->display_name, $user);
	$twitter_link = apply_filters('ide_profile_twitter_url', get_user_meta($profile, 'twitter', true), $user);
	$fb_link = apply_filters('ide_profile_fb_url', get_user_meta($profile, 'facebook', true), $user);
	$google_link = apply_filters('ide_profile_google_url', get_user_meta($profile, 'google', true), $user);
	$website_link = apply_filters('ide_profile_website_url', $user->user_url, $user);
	do_action('ide_before_backer_profile');
	$content .= '<div class="row"><div class="col-lg-12"><div class="whitebox"><div class="ignitiondeck backer_profile">';
	$content .= '<div class="backer_info">';
	$content .= '<div class="backer_avatar">'. apply_filters('ide_profile_avatar', get_avatar($profile, 70)) .'</div>';
	$content .= '<div class="backer_title"><h3>'.apply_filters('ide_backer_name', $name, $user).'</h3>';
	$content .= '<p>'.wpautop(apply_filters('ide_profile_description', $user->description, $user)).'</p></div></div>';
	// this would be so much more efficient if we attached a project ID to an mdid order or
	// to a pay info id
	if (class_exists('ID_Member_Order')) {
		$misc = ' WHERE user_id = "'.$profile.'"';
		$orders = ID_Member_Order::get_orders(null, null, $misc);
		if (!empty($orders)) {
			$mdid_orders = array();
			foreach ($orders as $order) {
				$mdid_order = mdid_by_orderid($order->id);
				if (!empty($mdid_order)) {
					$mdid_orders[] = $mdid_order;
				}
			}
			if (!empty($mdid_orders)) {
				$id_orders = array();
				foreach ($mdid_orders as $payment) {
					$order = new ID_Order($payment->pay_info_id);
					$the_order = $order->get_order();
					if (!empty($the_order)) {
						$id_orders[] = $the_order;
					}
				}
				$id_orders = apply_filters('ide_backer_profile_projects', $id_orders, $user);
				if (!empty($id_orders)) {
					$listed = array();
					$order_content = '<div class="cf"> </div>';
					if (!empty($orders)&& $profile==$current_user->ID) { $order_content .= '<br/><a href="'.$durl.'?idc_orders=1">Orders</a>';}
					$order_content .='<ul class="backer_projects">';
					foreach ($id_orders as $id_order) {
						$project = new ID_Project($id_order->product_id);
						$the_project = $project->the_project();
						if (!empty($the_project) && !in_array($id_order->product_id, $listed)) {
							$post_id = $project->get_project_postid();
							$url = getProjectURLfromType($id_order->product_id);
							$image = ID_Project::get_project_thumbnail($post_id, 'id_profile_image');
							if (empty($image)) {
								$image = idcf_project_placeholder_image('thumb');
							}
							$deck = new Deck($id_order->product_id);
							$mini_deck = $deck->mini_deck();
							$closed = $project->project_closed();
							$successful = $mini_deck->successful;
							ob_start();
							do_action('ide_before_backer_item', $id_order, $post_id);
							$ob_contenta = ob_get_contents();
							ob_end_clean();
							$order_content .= $ob_contenta;
							$order_content .= '<li class="backer_project_mini"><div class="backer_wrapper"><div class="inner_wrapper"><a href="'.$url.'">';
							ob_start();
							do_action('ide_above_backer_item', $id_order, $post_id);
							$ob_contentb = ob_get_contents();
							ob_end_clean();
							$order_content .= $ob_contentb;
							if (isset($image)) {
								$order_content .= '<a href="'.$url.'" class="backer_project_image" style="background-image: url('.$image.');"></a>';
							}
							if ($mini_deck->end_type !== 'open') {
								$order_content .='<div class="backers_days_left">'.(!$closed ? $mini_deck->days_left.' '.__('days to go', 'ignitiondeck') : ($successful ? __('Successful', 'ignitiondeck') : __('Ended', 'ignitiondeck'))).'</div>';
							}
							$order_content .= '<span class="backer_project_title"><a href="'.$url.'">'.get_the_title($post_id).'</a></span>';
							$order_content .='<div class="backers_funded">'.$mini_deck->p_current_sale.' '.__('Raised', 'ignitiondeck').'</div>';
							$order_content .='<a href="'.$url.'"><div class="backers_hover_content">';
							$order_content .= '<span class="backer_project_text">'.stripslashes(html_entity_decode($project->short_description())).'</span></div></a>';
					ob_start();
							do_action('ide_below_backer_item', $id_order, $post_id);
							$ob_contentc = ob_get_contents();
							ob_end_clean();
							$order_content .= $ob_contentc;
							$order_content .= '</a></div></div></li>';
							ob_start();
							do_action('ide_after_backer_item', $id_order, $post_id);
							$ob_contentd = ob_get_contents();
							ob_end_clean();
							$order_content .= $ob_contentd;
							$listed[] = $id_order->product_id;
						}
					}
					$order_content .= '</ul>';
					$order_count = count($listed);
				}
			}
		}
	$content .= (isset($order_count) && $order_count > 0 ? '<div class="backer_data">'.do_action('ide_before_backer_data').'<p class="backer_supported">'.__('Backed', 'ignitiondeck').'<span class="order_count">'.$order_count.'</span> '.__('projects', 'ignitiondeck').'</p>' : '<div class="backer_data">');
	$content .= '<p class="backer_joined">'.__('Joined', 'ignitiondeck').' '.date('n - j - Y', strtotime($user->user_registered)).'</p>
	<div class="id-backer-links">'.(!empty($website_link) ? '<a href="'.$website_link.'" class="website">'.__('Website', 'ignitiondeck').'</a>' : '').''.(!empty($twitter_link) ? '<a href="'.$twitter_link.'" class="twitter">'.__('Twitter', 'ignitiondeck').'</a>' : '').(!empty($fb_link) ? '<a href="'.$fb_link.'" class="facebook">'.__('Facebook', 'ignitiondeck').'</a>' : '').(!empty($google_link) ? '<a href="'.$google_link.'" class="googleplus">'.__('Google Plus', 'ignitiondeck').'</a>' : '').'</div>'.do_action('ide_after_backer_data').'</div>';
	$content .= (isset($order_content) ? $order_content : '');
	$content .= '</div>';
	$content .= '</div></div></div>';
	do_action('ide_after_backer_profile');
	}
	return $content;
}

function ide_backer_profile_title($title, $id = null) {
	$dash_settings = get_option('md_dash_settings');
	if (!empty($dash_settings)) {
		$dash_settings = maybe_unserialize($dash_settings);
		$durl = $dash_settings['durl'];
		if ($durl == $id){
			$user_id = absint($_GET['backer_profile']);
			$user = get_user_by('id', $user_id);
			if (!empty($user)) {
				$display = $user->display_name;
				$title = $display;
			}
		}
	}
	return $title;
}

function ide_backer_profile_og() {
	/*$user_id = absint($_GET['backer_profile']);
	$user = get_user_by('id', $user_id);
	$meta = null;
	if (!empty($user)) {
		$display = $user->display_name;
		$avatar = get_avatar($user_id);
		$current_site = get_option('blogname');
		$meta = '<meta property="og:image" content="'.$avatar.'" />';
		$meta .= '<meta property="og:title" content="'.$display.'&rsquo;s '.__("Backer Profile", "ignitiondeck").'" />';
		$meta .= '<meta property="og:url" content="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />';
		$meta .= '<meta property="og:site_name" content="'.$current_site.'" />';
	}
	if (!empty($meta)) {
		echo $meta;
	}*/
}

function ide_backer_profile_tab_title($title, $sep) {
	$user_id = absint($_GET['backer_profile']);
	$user = get_user_by('id', $user_id);
	if (!empty($user)) {
		$display = $user->display_name;
		$title = $display;
	}
	return $title." ".$sep." ".get_bloginfo('name');
}

/* Creator Profile */
/*
add_action('md_profile_extratabs', 'ide_creator_profile_tab', 1);

function ide_creator_profile_tab() {
	global $current_user;
	global $permalink_structure;
	if (current_user_can('create_edit_projects')) {
		if (empty($permalink_structure)) {
			$prefix = '&';
		}
		else {
			$prefix = '?';
		}
		get_currentuserinfo();
		$user_id = $current_user->ID;
		if (isset($_GET['creator_profile'])) {
			$profile = absint($_GET['creator_profile']);
		}
		echo '<li '.(isset($profile) && $profile == $user_id ? 'class="active"' : '').'><a href="'.md_get_durl().$prefix.'creator_profile='.$user_id.'">'.__('Creator Profile', 'ignitiondeck').'</a></li>';
	}
}

add_action('init', 'ide_creator_profile_init');

function ide_creator_profile_init() {
	if (isset($_GET['creator_profile'])) {
		$profile = absint($_GET['creator_profile']);
		if (isset($profile) && $profile > 0) {
			add_filter('the_content', 'ide_creator_profile_display');
			add_filter('the_title', 'ide_creator_profile_title', 10, 2);
			add_action('wp_head', 'ide_creator_profile_og');
			add_filter('wp_title', 'ide_creator_profile_tab_title', 10, 2);
		}
	}
}

function ide_creator_profile_display($content) {
	// we should really turn this into a template
	$content = '';
	if (isset($_GET['creator_profile'])) {
		$profile = absint($_GET['creator_profile']);
	}
	$user = get_user_by('id', $profile);
	//$name = $user->user_firstname.' '.$user->user_lastname;
	$name = apply_filters('ide_profile_name', $user->display_name, $user);
	$twitter_link = apply_filters('ide_profile_twitter_url', get_user_meta($profile, 'twitter', true), $user);
	$fb_link = apply_filters('ide_profile_fb_url', get_user_meta($profile, 'facebook', true), $user);
	$google_link = apply_filters('ide_profile_google_url', get_user_meta($profile, 'google', true), $user);
	$website_link = apply_filters('ide_profile_website_url', $user->user_url, $user);
	ob_start();
	do_action('ide_before_creator_profile');
	$ob_before_cp = ob_get_contents();
	ob_end_clean();
	$content .= $ob_before_cp;
	ob_start();
	do_action('ide_above_creator_info');
	$ob_above_ci = ob_get_contents();
	ob_end_clean();
	$content .= $ob_above_ci;
	$content .= '<div class="ignitiondeck backer_profile">';
	$content .= '<div class="backer_info">';
	$content .= '<div class="backer_avatar">'. apply_filters('ide_profile_avatar', get_avatar($profile, 70)) .'</div>';
	$content .= '<div class="backer_title"><h3>'.apply_filters('ide_creator_name', $name, $user).'</h3>';
	$content .= '<p>'.wpautop(apply_filters('ide_profile_description', $user->description, $user)).'</p></div></div>';
	ob_start();
	do_action('ide_below_creator_info');
	$ob_after_ci = ob_get_contents();
	ob_end_clean();
	$content .= $ob_after_ci;
	$creator_args = array(
		'post_type' => 'ignition_product',
		'post_status' => 'publish',
		'author' => $profile,
		'posts_per_page' => -1
	);
	$created_projects = apply_filters('id_creator_projects', get_posts(apply_filters('id_creator_args', $creator_args)));
	if (!empty($created_projects)) {
		$order_content = '<div class="cf"> </div><ul class="backer_projects">';
			foreach ($created_projects as $created_project) {
				$project_id = get_post_meta($created_project->ID, 'ign_project_id', true);
				$project = new ID_Project($project_id);
				$the_project = $project->the_project();
				if (!empty($the_project)) {
					$post_id = $created_project->ID;
					$deck = new Deck($project_id);
					$mini_deck = $deck->mini_deck();
					$closed = $project->project_closed();
					$successful = $mini_deck->successful;
					$url = get_permalink($post_id);
					$image = ID_Project::get_project_thumbnail($post_id, 'id_profile_image');
					if (empty($image)) {
						$image = idcf_project_placeholder_image('thumb');
					}
					ob_start();
					do_action('ide_before_creator_item', $post_id);
					$ob_contenta = ob_get_contents();
					ob_end_clean();
					$order_content .= $ob_contenta;
					$order_content .= '<li class="backer_project_mini"><div class="backer_wrapper"><div class="inner_wrapper">';
					ob_start();
					do_action('ide_above_creator_item', $post_id);
					$ob_contentb = ob_get_contents();
					ob_end_clean();
					$order_content .= $ob_contentb;
							if (isset($image)) {
								$order_content .= '<a href="'.$url.'" class="backer_project_image" style="background-image: url('.$image.');"></a>';
							}
							if ($mini_deck->end_type !== 'open') {
								$order_content .='<div class="backers_days_left">'.(!$closed ? $mini_deck->days_left.' '.__('days to go', 'ignitiondeck') : ($successful ? __('Successful', 'ignitiondeck') : __('Ended', 'ignitiondeck'))).'</div>';
							}
							$order_content .= '<span class="backer_project_title"><a href="'.$url.'">'.get_the_title($post_id).'</a></span>';
							$order_content .='<div class="backers_funded">'.$mini_deck->p_current_sale.' '.__('Raised', 'ignitiondeck').'</div>';
							$order_content .='<a href="'.$url.'"><div class="backers_hover_content">';
							$order_content .= '<span class="backer_project_text">'.stripslashes(html_entity_decode($project->short_description())).'</span></div></a>';
					ob_start();
					do_action('ide_below_creator_item', $post_id);
					$ob_contentc = ob_get_contents();
					ob_end_clean();
					$order_content .= $ob_contentc;
					$order_content .= '</div></div></li>';
					ob_start();
					do_action('ide_after_creator_item', $post_id);
					$ob_contentd = ob_get_contents();
					ob_end_clean();
					$order_content .= $ob_contentd;
				}
			}
			$order_content .= '</ul>';
			$order_count = count($created_projects);

	$content .= (isset($order_count) && $order_count > 0 ? '<div class="backer_data">'.do_action('ide_before_creator_data').'<p class="backer_supported"><span class="order_count">'.$order_count.'</span> '.__('Projects Created', 'ignitiondeck').'</p>' : '<div class="backer_data">');
	$content .= '<p class="backer_joined">'.__('Joined', 'ignitiondeck').' '.date('n - j - Y', strtotime($user->user_registered)).'</p>
	<div class="id-backer-links">'.(!empty($website_link) ? '<a href="'.$website_link.'" class="website">'.__('Website', 'ignitiondeck').'</a>' : '').''.(!empty($twitter_link) ? '<a href="'.$twitter_link.'" class="twitter">'.__('Twitter', 'ignitiondeck').'</a>' : '').(!empty($fb_link) ? '<a href="'.$fb_link.'" class="facebook">'.__('Facebook', 'ignitiondeck').'</a>' : '').(!empty($google_link) ? '<a href="'.$google_link.'" class="googleplus">'.__('Google Plus', 'ignitiondeck').'</a>' : '').'</div>'.do_action('ide_after_backer_data').'</div>';
	$content .= (isset($order_content) ? $order_content : '');
	$content .= '</div>';
	}
	ob_start();
	do_action('ide_after_creator_profile');
	$ob_after_cp = ob_get_contents();
	ob_end_clean();
	$content .= $ob_after_cp;
	return $content;
}

function ide_creator_profile_title($title, $id = null) {
	$dash_settings = get_option('md_dash_settings');
	if (!empty($dash_settings)) {
		if (!is_array($dash_settings)) {
			$dash_settings = unserialize($dash_settings);
		}
		$durl = $dash_settings['durl'];
		if ($durl ==  $id){
			$user_id = absint($_GET['creator_profile']);
			$user = get_user_by('id', $user_id);
			if (!empty($user)) {
				$display = $user->display_name;
				$lastchar = substr($display, -1);
				if (strtolower($lastchar) == 's') {
					$title = $display.__("' Projects", 'ignitiondeck');
				} 
				else {
					$title = $display.__("'s Projects", 'ignitiondeck');
				}
			}
		}
	}
	
	return $title;
}

function ide_creator_profile_og() {
	$user_id = absint($_GET['creator_profile']);
	$user = get_user_by('id', $user_id);
	$meta = null;
	if (!empty($user)) {
		$display = $user->display_name;
		$avatar = get_avatar($user_id);
		$current_site = get_option('blogname');
		$meta = '<meta property="og:image" content="'.$avatar.'" />';
		$meta .= '<meta property="og:title" content="'.$display.'&rsquo;s '.__("Creator Profile", "ignitiondeck").'" />';
		$meta .= '<meta property="og:url" content="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />';
		$meta .= '<meta property="og:site_name" content="'.$current_site.'" />';
	}
	if (!empty($meta)) {
		echo $meta;
	}
}

function ide_creator_profile_tab_title($title, $sep) {
	$user_id = absint($_GET['creator_profile']);
	$user = get_user_by('id', $user_id);
	if (!empty($user)) {
		$display = $user->display_name;
		$title = $display.__("'s Projects", 'ignitiondeck');
	}
	return $title." ".$sep." ".get_bloginfo('name');
}

function ide_creator_profile_projects($projects, $user) {
	$args = array(
		'author' => $user->ID,
		'post_type' => 'ignition_product',
		'post_status' => 'publish'
	);
	$posts = get_posts($args);
	if (!empty($posts)) {
		$projects = $posts;
	}
	return $projects;
}
*/
/* End Tabs */

add_filter('idc_order_level_title', 'ide_add_project_order_info', 10, 2);

function ide_add_project_order_info($title, $last_order) {
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
			if ($post_id > 0 && !is_id_pro()) {
				$project_title = get_the_title($post_id);
				$title = $project_title.': '.$title;
			}
		}
	}
	return $title;
}

add_filter('idc_order_level_url', 'ide_add_project_order_url', 10, 2);

function ide_add_project_order_url($url, $last_order) {
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
				$url = get_permalink($post_id);
			}
		}
	}
	return $url;
}

add_filter('idc_order_level_thumbnail', 'ide_add_project_order_thumbnail', 10, 2);

function ide_add_project_order_thumbnail($thumbnail, $last_order) {
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
				$thumbnail = ID_Project::get_project_thumbnail($post_id);
			}
		}
	}
	return $thumbnail;
}

function idcf_filter_wp_kses($allowedtags, $context) {
	$allowedtags['iframe'] = array(
		"src" => true,
		"width" => true,
		"height" => true,
		"frameborder" => true,
		"scrolling" => true
	);
	$allowedtags['embed'] = array(
		"src" => true,
		"width" => true,
		"height" => true,
		"type" => true
	);
	return $allowedtags;
}

add_action('idc_gateway_settings_after', 'ide_process_project_authorizations');

function ide_process_project_authorizations() {
	include_once('templates/admin/_projectPreauthSelect.php');
}
?>