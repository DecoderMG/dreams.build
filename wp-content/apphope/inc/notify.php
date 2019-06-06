<?php wp_enqueue_script( 'notify_action', get_stylesheet_directory_uri(). '/js/ajax-notify.js', array( 'jquery'), '', true ); 
wp_localize_script( 'notify_action', 'notify_settings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
function notify_action(){
    $post_id = intval($_POST['post_id']);
    if(!$post_id || !is_user_logged_in()) die();
    header("Content-Type: text/html");
		$args = array( 'post_type' => 'ignition_product', 'post_status'=>'publish', 'p' => $post_id);
    $loop = new WP_Query($args);?>
    <?php $i=0; if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $i++;$loop->the_post(); 
	    $project_id = get_post_meta($post_id, 'ign_project_id', true);
			$project = new ID_Project($project_id);
			$end_date = $project->end_date();
			global $wpdb;global $current_user;
			$check = $wpdb->get_row( "SELECT id,active FROM wp_ign_notify WHERE user_id = '".$current_user->ID."' AND product_id = '".$post_id."'");
			if(!$check && !$check->id) {
				$wpdb->insert( 'wp_ign_notify', array( 'user_id' => $current_user->ID, 'product_id' => $post_id, 'send' => date('Y-m-d',strtotime("-2 days", strtotime($end_date))) ), array( '%d', '%d', '%s' ));
				echo 'on';
				wp_schedule_single_event( strtotime("-2 days", strtotime($end_date)), 'notify_event',array( $current_user->ID, $post_id ));
			}
			else{
				if($check->active){
					$wpdb->update( 'wp_ign_notify', array( 'active' => 0), 
					array( 'user_id' => $current_user->ID, 'product_id' => $post_id ), 
					array( '%d'), array('%d', '%d'));
					echo 'off';
					wp_unschedule_event( strtotime("-2 days", strtotime($end_date)), 'notify_event', array( $current_user->ID, $post_id ) );
				}
				else{
					$wpdb->update( 'wp_ign_notify', array( 'active' => 1,'send' => date('Y-m-d',strtotime("-2 days", strtotime($end_date)))), 
					array( 'user_id' => $current_user->ID, 'product_id' => $post_id ), 
					array( '%d','%s'), array('%d', '%d'));
					echo 'on';
					wp_schedule_single_event( strtotime("-2 days", strtotime($end_date)), 'notify_event',array( $current_user->ID, $post_id ));
				}
			}
			endwhile;endif; wp_reset_postdata();
		die();
}

add_action('wp_ajax_nopriv_notify_action', 'notify_action');
add_action('wp_ajax_notify_action', 'notify_action');
function do_notify($user_id, $post_id) {
	// create message
	$text = get_option('remind_me_later');
	if (empty($text)) {
		$text = get_option('remind_me_later_default');
	}
	if (!empty($text)) {
		// get project info
		$project_id = get_post_meta($post_id, 'ign_project_id', true);
		$project = new ID_Project($project_id);
		$the_project = $project->the_project();
		$end = get_post_meta($post_id, 'ign_fund_end', true);
		$post = get_post($post_id);
		if (!empty($post)) {$project_name = $post->post_title;}
		else {$project_name = $the_project->product_name;}
		$project_link = get_the_permalink($post_id);
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'grid-thumb' );
		$user_info = get_userdata($user_id);
		// filter merge tags
		$merge_swap = array(
			array(
				'tag' => '{{PROJECT_NAME}}',
				'swap' => $project_name
				),
			array(
				'tag' => '{{END_DATE}}',
				'swap' => $end
				),
			array(
				'tag' => '{{PROJECT_LINK}}',
				'swap' => $project_link
				),
			array(
				'tag' => '{{PROJECT_IMAGE}}',
				'swap' => $image
				),
			);
		foreach ($merge_swap as $swap) {
			$text = str_replace($swap['tag'], $swap['swap'], $text);
		}
		$message = '<html><body width="100%" bgcolor="#fff" style="margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;mso-line-height-rule: exactly;">';
		$message .= wpautop($text);
		$message .= '</body></html>';
		$subject = __('Remind Me Later: '.$project_name, 'memberdeck');
		$mail = new ID_Member_Email($user_info->user_email, $subject, $message, (isset($user_id) ? $user_id : ''));
		$send_mail = $mail->send_mail();
		global $wpdb;
		$wpdb->update( 'wp_ign_notify', array( 'sent' => 1), 
					array( 'user_id' => $user_id, 'product_id' => $post_id ), 
					array( '%d'), array('%d', '%d'));
	}
}
add_action( 'notify_event','do_notify', 10, 2 );