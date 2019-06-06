<?php
class ID_Project {
	var $id;

	function __construct($id=null) {
		$this->id = $id;
	}

	function the_project() {
		global $wpdb;
		$sql = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'ign_products WHERE id = %d', $this->id);
		$res = $wpdb->get_row($sql);
		return $res;
	}

	function update_project($args) {
		global $wpdb;
		$sql = $wpdb->prepare('UPDATE '.$wpdb->prefix.'ign_products SET product_name = %s, ign_product_title = %s, ign_product_limit = %d, product_details = %s, product_price = %s, goal = %s WHERE id = %d',
            $args['product_name'],
            $args['ign_product_title'],
            $args['ign_product_limit'],
            $args['product_details'],
            $args['product_price'],
            $args['goal'],
            $this->id);
		$res = $wpdb->query($sql);
	}

	function update_project_goal($goal) {
		global $wpdb;
		$sql = $wpdb->prepare('UPDATE '.$wpdb->prefix.'ign_products SET goal = %s WHERE id = %d',
            $goal,
            $this->id);
		$res = $wpdb->query($sql);
	}

	function get_project_settings() {
		global $wpdb;
		$sql = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'ign_product_settings WHERE product_id = %d', $this->id);
		$res = $wpdb->get_row($sql);
		return $res;
	}

	function currency_code() {
		$project_settings = self::get_project_settings();
		if (empty($project_settings)) {
			$project_settings = self::get_project_defaults();
		}
		if (!empty($project_settings)) {
			$currencyCodeValue = $project_settings->currency_code;
		}
		else {
			$currencyCodeValue = 'USD';
		}
		$cCode = setCurrencyCode($currencyCodeValue);
		return $cCode;
	}

	function get_project_postid() {
		global $wpdb;	
		$sql = $wpdb->prepare('SELECT post_id FROM '.$wpdb->prefix.'postmeta WHERE meta_key = "ign_project_id" AND meta_value = %d ORDER BY meta_id DESC LIMIT 1', $this->id);
		$res = $wpdb->get_row($sql);
		if (!empty($res)) {
			return $res->post_id;
		}
		else {
			return null;
		}
	}

	function short_description() {
		$post_id = self::get_project_postid();
		$long_desc = get_post_meta($post_id, 'ign_project_description', true);
		return $long_desc;
	}

	function the_goal() {
		$goal = 0;
		$project = self::the_project();
		if (!empty($project)) {
			$goal = $project->goal;
		}
		return $goal;
	}

	function level_count() {
		$post_id = self::get_project_postid();
		$level_count = get_post_meta($post_id, 'ign_product_level_count', true);
		return $level_count;
	}

	function get_level_price($level_id) {
		$post_id = self::get_project_postid();
		if ($level_id == 1) {
			$price = get_post_meta($post_id, 'ign_product_price', true);
		}
		else if ($level_id > 1) {
			$price = get_post_meta($post_id, 'ign_product_level_'.$level_id.'_price', true);
		}
		return $price;
	}

	function get_project_orders() {
		global $wpdb;
        $sql = $wpdb->prepare('SELECT COUNT(*) AS count FROM '.$wpdb->prefix.'ign_pay_info WHERE product_id = %d AND status_pay=0', $this->id);
		$res = $wpdb->get_row($sql);
		if (!empty($res)) {
			return $res->count;
		}
		else {
			return 0;
		}
	}

	function update_project_orders($id_order) {
		global $wpdb;
        $sql = $wpdb->prepare('UPDATE '.$wpdb->prefix.'ign_pay_info SET status_pay=%d WHERE id = %d', 1, $id_order);
		$res = $wpdb->get_row($sql);
	}

	function get_project_raised() {
		global $wpdb;

        $sql = 'Select SUM(prod_price) AS raise from '.$wpdb->prefix.'ign_pay_info where product_id = "'.$this->id.'" AND status_pay=0';
		$res = $wpdb->get_row($sql);
		if (!empty($res->raise)) {
			return str_replace(',', '', $res->raise);
		}
		else {
			return '0';
		}
	}

	function percent() {
		$project = self::the_project();
		$project_goal = self::the_goal();
		$project_orders = self::get_project_orders();
		$project_raised = self::get_project_raised();

		$percent = 0;
		if ($project_raised > 0 && $project_goal > 0) {
			$raw_percent = $project_raised/$project_goal*100;
			$percent = number_format($raw_percent, 2, '.', '');
		}
		return $percent;
	}

	function successful() {
		$post_id = self::get_project_postid();
		$success = get_post_meta($post_id, 'ign_project_success', true);
		return $success;
	}

	function end_date() {
		$post_id = self::get_project_postid();
		$end_date = get_post_meta($post_id, 'ign_fund_end', true);
		return $end_date;
	}
	function end_date2() {
		$post_id = self::get_project_postid();
		$end_date = get_post_meta($post_id, 'ign_fund_end2', true);
		return $end_date;
	}

	function days_left($end_date = null) {
		if (empty($end_date)) {
			$end_date = self::end_date();
		}
		if (!empty($end_date)) {
			$tz = get_option('timezone_string');
			if (empty($tz)) {
				$tz = 'UTC';
			}
			date_default_timezone_set($tz);
			$days_left = str_replace("/", "-", $end_date);
			$days_left = explode("-", $days_left);
			$days_left = $days_left[2]."-".$days_left[0]."-".$days_left[1]." 23:59:59";

            $days_left = self::secondsToWords(strtotime($days_left) - time());

//          $days_left = ( strtotime($days_left) - time() )/60/60/24;
//			if ($days_left < 1) {
//				$days_left = number_format($days_left, 2);
//			}
//			else {
//				$days_left = number_format($days_left);
//			}
//			if (empty($days_left) || $days_left == '' || $days_left < 0) {
//				$days_left = 0;
//			}
		}
		else {
			$days_left = 0;
		}
		return $days_left;
	}

    function secondsToWords($seconds)
    {
        $ret = 0;

//        unlink('/home/betadreams/public_html/wp-content/my_log_cron.txt');

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days > 0)
        {
            $ret = "$days days";
        }

        if($ret == ''){
            /*** get the hours ***/
            $hours = (intval($seconds) / 3600) % 24;
            if($hours > 0)
            {
                if($hours == 1){
                    $ret = "$hours hour";
                } else {
                    $ret = "$hours hours";
                }
            }
        }

        if($ret == ''){
            /*** get the minutes ***/
            $minutes = (intval($seconds) / 60) % 60;
            if($minutes > 0)
            {
                $ret = "$minutes minutes";
            }
        }

//        /*** get the seconds ***/
//        $seconds = intval($seconds) % 60;
//        if ($seconds > 0) {
//            $ret .= "$seconds seconds";
//        }

        return $ret;
    }

	function days_left_2($end_date = null) {
		if (empty($end_date)) {
			$end_date = self::end_date2();
		}
		if (!empty($end_date)) {
			$tz = get_option('timezone_string');
			if (empty($tz)) {
				$tz = 'UTC';
			}
			date_default_timezone_set($tz);
			$days_left = str_replace("/", "-", $end_date);
			$days_left = explode("-", $days_left);
			$days_left = $days_left[2]."-".$days_left[0]."-".$days_left[1]." 23:59:59";

            $days_left = self::secondsToWords(strtotime($days_left) - time());

//          $days_left = ( strtotime($days_left) - time() )/60/60/24;
//			if ($days_left < 1) {
//				$days_left = number_format($days_left, 2);
//			}
//			else {
//				$days_left = number_format($days_left);
//			}
//			if (empty($days_left) || $days_left == '' || $days_left < 0) {
//				$days_left = 0;
//			}
		}
		else {
			$days_left = 0;
		}
		return $days_left;
	}
	function end_month() {
		$end_date = self::end_date();
		if (!empty($end_date)) {
			$tz = get_option('timezone_string');
			if (empty($tz)) {
				$tz = 'UTC';
			}
			date_default_timezone_set($tz);
			$end = str_replace('/', ' ', $end_date);
			$end = explode(' ', $end);
			$end_string = $end[2].'-'.$end[0].'-'.$end[1];
			$end_time = strtotime($end_string);
			$month = date('F', $end_time);
		}
		else {
			$month = date('F', time('now'));
		}
		return $month;
	}

	function end_day() {
		$end_date = self::end_date();
		if (!empty($end_date)) {
			$tz = get_option('timezone_string');
			if (empty($tz)) {
				$tz = 'UTC';
			}
			date_default_timezone_set($tz);
			$end = str_replace('/', ' ', $end_date);
			$end = explode(' ', $end);
			$end_string = $end[2].'-'.$end[0].'-'.$end[1];
			$end_time = strtotime($end_string);
			$day = date('d', $end_time);
		}
		else {
			$day = date('d', time('now'));
		}
		return $day;
	}

	function end_year() {
		$end_date = self::end_date();
		if (!empty($end_date)) {
			$tz = get_option('timezone_string');
			if (empty($tz)) {
				$tz = 'UTC';
			}
			date_default_timezone_set($tz);
			$end = str_replace('/', ' ', $end_date);
			$end = explode(' ', $end);
			$end_string = $end[2].'-'.$end[0].'-'.$end[1];
			$end_time = strtotime($end_string);
			$year = date('Y', $end_time);
		}
		else {
			$year = date('Y', time('now'));
		}
		return $year;
	}

	function project_closed($post_id = null) {
		if (empty($post_id)) {
			$post_id = self::get_project_postid();
		}
		return get_post_meta($post_id, 'ign_project_closed', true);
	}

	function clear_project_settings() {
		global $wpdb;
		$sql = "DELETE FROM ".$wpdb->prefix."ign_product_settings WHERE product_id = '".$this->id."'";
		$res = $wpdb->query($sql);
	}

	function get_lvl1_name() {
		global $wpdb;
		$sql = $wpdb->prepare('SELECT ign_product_title FROM '.$wpdb->prefix.'ign_products WHERE id = %d', $this->id);
		$res = $wpdb->get_row($sql);
		return $res->ign_product_title;
	}

	function get_fancy_description($level_id) {
		$the_project = $this->the_project();
		$post_id = $this->get_project_postid();
		$project_title = get_the_title($post_id);
		if ($level_id > 1) {
			$post_id = $this->get_project_postid();
			$level_title = get_post_meta($post_id, 'ign_product_level_'.$level_id.'_title', true);
		}
		else if ($level_id == 1) {
			$level_title = $the_project->ign_product_title;
		}
		return $project_title.': '.$level_title;
	}

	function get_level_data($post_id, $no_levels) {
		$this->post_id = $post_id;
		$level_data = array();
		for ($i=2; $i <= $no_levels; $i++) {
			$meta_title = html_entity_decode(get_post_meta( $this->post_id, "ign_product_level_".($i)."_title", true ));
			$meta_limit = get_post_meta( $this->post_id, "ign_product_level_".($i)."_limit", true );
			$meta_order = get_post_meta($this->post_id, 'ign_product_level_'.$i.'_order', true);
			$meta_price = get_post_meta( $this->post_id, "ign_product_level_".($i)."_price", true );
			$meta_desc = html_entity_decode(get_post_meta( $this->post_id, "ign_product_level_".($i)."_desc", true ));
			$meta_short_desc = html_entity_decode(get_post_meta( $this->post_id, "ign_product_level_".($i)."_short_desc", true ));
			$meta_count = getCurrentLevelOrders($this->id, $this->post_id, $i);
			$level_invalid = getLevelLimitReached($this->id, $this->post_id, $i);
			$level_data[$i] = new stdClass;
			$level_data[$i]->id = $i;
			$level_data[$i]->meta_title = $meta_title;
			$level_data[$i]->meta_limit = $meta_limit;
			$level_data[$i]->meta_order = $meta_order;
			$level_data[$i]->meta_price = $meta_price;
			$level_data[$i]->meta_desc = $meta_desc;
			$level_data[$i]->meta_short_desc = $meta_short_desc;
			$level_data[$i]->meta_count = $meta_count;
			$level_data[$i]->level_invalid = $level_invalid;
		}
		return $level_data;
	}

	function get_end_type() {
		$post_id = $this->get_project_postid();
		return get_post_meta($post_id, 'ign_end_type', true);
	}

	public static function get_project_thumbnail($post_id, $size = null) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size);
		if (empty($src)) {
			$url = get_post_meta($post_id, 'ign_product_image1', true);
		}
		else {
			$url = $src[0];
		}
		return $url;
	}

	public static function insert_project($args) {
		global $wpdb;
		$tz = get_option('timezone_string');
		if (empty($tz)) {
			$tz = 'UTC';
		}
		date_default_timezone_set($tz);
		$date = date('Y-m-d H:i:s');
		$sql = $wpdb->prepare('INSERT INTO '.$wpdb->prefix.'ign_products (
			product_name,
			ign_product_title,
			ign_product_limit,
			product_details,
			product_price,
			goal,
			created_at) VALUES (%s, %s, %d, %s, %s, %s, %s)',
		$args['product_name'],
		$args['ign_product_title'],
		$args['ign_product_limit'],
		$args['product_details'],
		$args['product_price'],
		$args['goal'],
		$date);
		$insert_id = null;
		try {
			$res = $wpdb->query($sql);
			$insert_id = $wpdb->insert_id;
		}
		catch(error $e) {
			// some error
		}
		return $insert_id;
	}

	public static function get_all_projects() {
		global $wpdb;
		$sql = 'SELECT * FROM '.$wpdb->prefix.'ign_products';
		$res = $wpdb->get_results($sql);
		return $res;
	}

	public static function get_project_posts() {
		$args = array('post_type' => 'ignition_product', 'posts_per_page' => -1);
		$posts = get_posts($args);
		return $posts;
	}

	public static function get_project_defaults() {
		global $wpdb;
		$sql = 'SELECT * FROM '.$wpdb->prefix.'ign_prod_default_settings WHERE id = 1';
		$settings = $wpdb->get_row($sql);
		return $settings;
	}

	public static function get_id_settings() {
		global $wpdb;
		$sql = 'SELECT * FROM '.$wpdb->prefix.'ign_settings WHERE id = 1';
		$res = $wpdb->get_row($sql);
		return $res;
	}

	public static function get_days_left($project_end) {
		return self::days_left($days_left);
	}

	public static function set_raised_meta() {
//		$projects = self::get_all_projects();
//		foreach ($projects as $a_project) {
//			$project = new ID_Project($a_project->id);
//			$post_id = $project->get_project_postid();
//			$raised = floatval($project->get_project_raised());
//			update_post_meta($post_id, 'ign_fund_raised', $raised);
//		}
	}

	public static function set_percent_meta() {
		$projects = self::get_all_projects();
		foreach ($projects as $a_project) {
			$project = new ID_Project($a_project->id);
			$post_id = $project->get_project_postid();
			$percent = floatval($project->percent());
//			$post = get_post($post_id);
//			$percent = floatval($project->percent());
//			$current_user = get_userdata($post->post_author);

			if ($percent >= 100) {
				$successful = get_post_meta($post_id, 'ign_project_success', true);
				if (empty($successful) || !$successful) {
					do_action('idcf_project_success', $post_id, $a_project->id);
				}
				update_post_meta($post_id, 'ign_project_success', 1);
				self::writeCronLog('===Project percent set: Project ID: '.$a_project->id.'===');
			}
			else {
                delete_post_meta($post_id, 'ign_project_success');
            }
//			update_post_meta($post_id, 'ign_percent_raised', $percent);
		}
	}

    public static function set_status_for_all_project() {
        $projects = self::get_all_projects();
        self::writeCronLog('=========================== New cron run =================== data '.date('Y-m-d h:s')."\n");
        self::writeCronLog('=== project count = '.count($projects)."\n");
        foreach ($projects as $a_project) {
            $project = new ID_Project($a_project->id);
            $post_id = $project->get_project_postid();
			$order_counter = ID_Order::get_total_orders_by_project($a_project->id);
			update_post_meta($post_id, 'ign_sponsor_count', $order_counter);
            $status_project = get_post_status( $post_id );

            if( $status_project == 'closed' ) continue;


            $post_data = get_post($post_id);

            $md_sc_creds = get_sc_params($post_data->post_author);
            if (!empty($md_sc_creds)) {
                $sc_accesstoken = $md_sc_creds->access_token;
            }

            if (empty($sc_accesstoken)) {
                self::writeCronLog('Not connect stripe account! Project:'. $a_project->id.'; --- Post id:'.$post_id."\n");
                continue;
            }

            $stage = get_post_meta($post_id, 'ign_stage', true);

            if($stage == '') {
                $end = get_post_meta($post_id, 'ign_fund_end', true);
                if( self::isFuture( $end )) {
                    update_post_meta($post_id, 'ign_stage', 2);
                } else {
                    update_post_meta($post_id, 'ign_stage', 1);
                }
            }




            self::writeCronLog('Project:'. $a_project->id.'; --- Post id:'.$post_id.' --- Stage:'. $stage."\n");

            if($stage == 1){
                $end = get_post_meta($post_id, 'ign_fund_end', true);
                if( self::isFuture( $end )){
                    self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- Ending reached'."\n");
                    $percent = floatval($project->percent());
                    if ($percent >= 100) {
                        self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- End --- Percent:'.$percent."\n");
                        $all_orders = self::getAllSponsors( $project->id );
						self::writeCronLog('---All Sponsors Loaded---'."\n");

                        foreach ($all_orders as $key => $charger){
                            if($charger['stripe'] != '' && $charger['customer_id'] != ''){

                                $create_charge = self::createCharger(
                                    $charger['customer_id'],
                                    $charger['price'],
                                    $charger['email'],
                                    $charger['curr'],
                                    $charger['stripe'],
                                    $sc_accesstoken
                                );
								self::writeCronLog('Charge Created: CustomerID: '.$charger['customer_id'].' ---Price: '.$charger['price'].' ---Email: '.$charger['email'].' ---Currency '.$charger['curr'].'Last4: '.$charger['stripe'].'Stripe Access Token: '.$sc_accesstoken."\n");
                                $project->update_project_orders($key);
                                self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- Order:'.$key.' --- Pay'."\n");
                            }
                        }

                        update_post_meta($post_id, 'ign_stage', 2);
                        $goal2 = get_post_meta($post_id, 'ign_fund_goal2', true);
                        $project->update_project_goal($goal2);

                        $post = get_post($post_id);
                        $user_data = get_userdata($post->post_author);

                        idc_custom_email($user_data->ID, $user_data->user_email, $props = array(
                            'template' => 'project_stage_change',
                            'subject' => 'Dream moves from stage one to stage two',
                            'post_id' => $post_id,
                            'user' => $user_data
                        ));

                        self::writeCronLog('Send email to author:'. $user_data->user_email."\n");

                        do_action('idc_send_notifications_sponsors', array($a_project->id, 'project_sponsor_stage_change', 'Project Moved from Stage 1 to Stage 2'));

                        self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- End --- Percent:'.$percent.' --- Update to stage 2'."\n");
                    } else {
                        $_post = array( 'ID' => $post_id, 'post_status' => 'closed' );
                        wp_update_post($_post);

                        $post = get_post($post_id);
                        $user_data = get_userdata($post->post_author);

                        idc_custom_email($user_data->ID, $user_data->user_email, $props = array(
                            'template' => 'project_not_funded',
                            'subject' => 'Dream was not successfully funded',
                            'post_id' => $post_id,
                            'user' => $user_data
                        ));

                        self::writeCronLog('Send email to author:'. $user_data->user_email."\n");

                        do_action('idc_send_notifications_sponsors', array($a_project->id, 'project_sponsor_failed', 'Project Funding Failed'));

                        self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- End --- Percent:'.$percent.' --- Close project'."\n");
                    }
                }
            } else if($stage == 2){
                $end = get_post_meta($post_id, 'ign_fund_end2', true);
                if( self::isFuture( $end )){
                    $percent = floatval($project->percent());
                    self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- End --- Percent:'.$percent."\n");
                    $all_orders = self::getAllSponsors( $project->id );

                    foreach ($all_orders as $key => $charger){
                        if($charger['stripe'] != '' && $charger['customer_id'] != ''){

                            $create_charge = self::createCharger(
                                $charger['customer_id'],
                                $charger['price'],
                                $charger['email'],
                                $charger['curr'],
                                $charger['stripe'],
                                $sc_accesstoken
                            );
                            $project->update_project_orders($key);
                            self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- Order:'.$key.' --- Pay'."\n");
                        }
                    }

                    $_post = array( 'ID' => $post_id, 'post_status' => 'closed' );
                    wp_update_post($_post);

                    $post = get_post($post_id);
                    $user_data = get_userdata($post->post_author);

                    idc_custom_email($user_data->ID, $user_data->user_email, $props = array(
                        'template' => 'project_complete_stage2',
                        'subject' => 'Dreams Stage Two is Completed',
                        'post_id' => $post_id,
                        'user' => $user_data
                    ));

                    self::writeCronLog('Send email to author:'. $user_data->user_email."\n");

                    do_action('idc_send_notifications_sponsors', array($a_project->id, 'project_sponsor_complete_stage2', 'Project Stage Two is Completed'));

                    self::writeCronLog('Project:'. $a_project->id.'; --- Stage:'. $stage.' --- End --- Percent:'.$percent.' --- Close project'."\n");
                }
            }
        }
        update_option('cron_script_is_run', 0);
    }

    public static function createCharger($custid, $price, $email, $stripe_currency, $last4, $sc_accesstoken){
        global $stripe_api_version;
        $settings = get_option('memberdeck_gateways');
//        $stripe_currency = 'USD';
        if (!empty($settings)) {
            if (is_array($settings)) {
                $mc = (isset($settings['manual_checkout']) ? $settings['manual_checkout'] : 0);
                $test = (isset($settings['test']) ? $settings['test'] : 0);
                $sk = (isset($settings['sk']) ? $settings['sk'] : '');
                $tsk = (isset($settings['tsk']) ? $settings['tsk'] : '');
                $es = (isset($settings['es']) ? $settings['es'] : 0);
                $esc = (isset($settings['esc']) ? $settings['esc'] : 0);
                $eb = (isset($settings['eb']) ? $settings['eb'] : 0);
                $ecb = (isset($settings['ecb']) ? $settings['ecb'] : 0);
                $eauthnet = (isset($settings['eauthnet']) ? $settings['eauthnet'] : 0);
                if (!empty($settings['stripe_currency'])) {
                    $stripe_currency = $settings['stripe_currency'];
                }
                if (isset($first_data) && $first_data) {
                    $gateway_id = $settings['gateway_id'];
                    $fd_pw = $settings['fd_pw'];
                    $key_id = $settings['key_id'];
                    $hmac = $settings['hmac'];
                    $efd = $settings['efd'];
                }
            }
        }

        if (!class_exists('Stripe')) {
            $dir = '/home/betadreams/public_html/wp-content/plugins/idcommerce/';
            require_once $dir.'lib/Stripe.php';
        }

        if ($test == '1') {
            $apikey = $tsk;
            Stripe::setApiKey($tsk);
            Stripe::setApiVersion($stripe_api_version);
			self::writeCronLog('Using Test keys'."\n");
        }
        else {
            $apikey = $sk;
            Stripe::setApiKey($sk);
            Stripe::setApiVersion($stripe_api_version);
			self::writeCronLog('Using Production keys'."\n");
        }

        $fee = 0;
        $sc_settings = get_option('md_sc_settings');
        if (!empty($sc_settings)) {
            if (!is_array($sc_settings)) {
                $sc_settings = unserialize($sc_settings);
            }
            if (is_array($sc_settings)) {
                $app_fee = $sc_settings['app_fee'];
                $fee_type = $sc_settings['fee_type'];
                if ($fee_type == 'flat') {
                    $fee = $app_fee;
                }
                else {
                    $fee = round($price * ($app_fee / 100), 2);
                }

            }
        }

        try {
            $card_id = Stripe_Token::create(array(
                "customer" => $custid),
                $sc_accesstoken);
//            $cards = Stripe_Customer::retrieve($custid)->cards->all();
        }
        catch (Exception $e) {
            // could not retrieve a customer, so we need to create one
            $message = $e->json_body['error']['message'];
//            print_r($settings);
            self::writeCronLog(json_encode(array('response' => __('failure', 'memberdeck'), 'message' => $message)));
            exit;
        }
//        if (isset($cards)) {
//            $list = $cards['data'];
//
//            foreach ($list as $card) {
//                if ($last4 == $card->last4 && $card->exp_year >= date('Y',time())) {
//                    // card exists, we don't need to create it
//                    $card_id = $card->id;
//                    break;
//                }
//            }
//        }

        try {
			$userbalance = mycred_display_users_total_balance( $custid );
			self::writeCronLog('Using a Fee of: '."\n");
			self::writeCronLog('User points and rank: '."$userbalance \n");
            if(isset($card_id)){
                $price = str_replace(',', '', round($price, 2)) * 100;
                $newcharge = Stripe_Charge::create(array(
                    'amount' => $price,
                    'card' => $card_id->id,
                    'description' => $email,
                    'currency' => $stripe_currency,
                    'application_fee' => $fee * 100),
                    $sc_accesstoken);
            } else {
                self::writeCronLog('Card is not found on custumer. Email:'.$email);
                return false;
            }
        }
        catch (Stripe_CardError $e) {
            // Card was declined
            $jsonbody = $e->getJsonBody();
            $message = $jsonbody['error']['message'].' '.__LINE__;
            self::writeCronLog('Card');
            self::writeCronLog(json_encode(array('response' => __('failure', 'memberdeck'), 'message' => $message)));
            exit;
        }
        catch (Stripe_InvalidRequestError $e) {
            $jsonbody = $e->getJsonBody();
            $message = $jsonbody['error']['message'].' '.__LINE__;
            self::writeCronLog('Card2');
            self::writeCronLog(json_encode(array('response' => __('failure', 'memberdeck'), 'message' => $message)));
            exit;
        }
		catch (Stripe_ApiError $e) {
			$jsonbody = $e->getJsonBody();
            $message = $jsonbody['error']['message'].' '.__LINE__;
            self::writeCronLog('Card3');
            self::writeCronLog(json_encode(array('response' => __('failure', 'memberdeck'), 'message' => $message)));
            exit;
		}
		catch (Stripe_Error $e) {
			$jsonbody = $e->getJsonBody();
            $message = $jsonbody['error']['message'].' '.__LINE__;
            self::writeCronLog('Card4');
            self::writeCronLog(json_encode(array('response' => __('failure', 'memberdeck'), 'message' => $message)));
            exit;
		}
        return $newcharge;
    }

    public static function getAllSponsors($project_id){
		self::writeCronLog('--- Getting all Sponsors ---'."\n");
        $project_orders = ID_Order::get_orders_by_project($project_id, 'AND status_pay=0');
        $arr_return = [];
        if (!empty($project_orders)) {
			self::writeCronLog('---Project Orders Found!---'."\n");
            // We have the project orders, now search mdid_orders for pay ids we have and add them all into array
            $mdid_orders = array();
            foreach ($project_orders as $idcf_order) {
                $mdid_order = mdid_payid_check($idcf_order->id);
                if (!empty($mdid_order)) {
                    array_push($mdid_orders, $mdid_order);
                    $arr_return[$idcf_order->id]['stripe'] = $idcf_order->stripe_card_id;
                    $arr_return[$idcf_order->id]['email'] = $idcf_order->email;
                    $arr_return[$idcf_order->id]['price'] = $idcf_order->prod_price;
					self::writeCronLog('---Order: '.$idcf_order->id.' Details: --- Stripe Card Id: '.$idcf_order->stripe_card_id.'--- Order email: '.$idcf_order->email.'--- Order Price: '.$idcf_order->prod_price."\n");
                } else {
					self::writeCronLog('---Order: '.$idcf_order->id.' Empty!---'."\n");
				}
            }

            if (!empty($mdid_orders)) {
				self::writeCronLog('---Orders Loaded!---');
                foreach ($mdid_orders as $key => $mdid_order) {
                    $order = new ID_Member_Order($mdid_order->order_id);
                    $idc_order = $order->get_order();
                    if (!empty($idc_order)) {
                        // Getting level/product info for price and name
                        $level = ID_Member_Level::get_level($idc_order->level_id);
                        if ($idc_order->transaction_id != 'pre') {
                            // Getting the meta for currency
                            $order_meta = ID_Member_Order::get_order_meta($order->id, 'gateway_info', true);
                            $price = $idc_order->price;

                            // Getting user info
                            $user_info = apply_filters('idc_backer_userdata', get_userdata($idc_order->user_id), $idc_order->id);
                            // Writing into table

                            $customer_id = customer_id_ajax($user_info->ID);

                            $arr_return[$mdid_order->pay_info_id]['customer_id'] = $customer_id;
                            $arr_return[$mdid_order->pay_info_id]['curr'] = $order_meta['currency_code'];
//                            $arr_return[$mdid_order->pay_info_id]['price'] = $price;
                        }
                    }
                }
            }
        }
		self::writeCronLog('---Orders Processed!---');
        return $arr_return;
    }

    public static function isFuture($time)
    {
        $days_left = str_replace("/", "-", $time);
        $days_left = explode("-", $days_left);
        $days_left = $days_left[2]."-".$days_left[0]."-".$days_left[1]." 23:59:59";
//        return true;
        return (strtotime($days_left) < time());
    }

    public static function writeCronLog($text){
//        write_log($text);
        file_put_contents('/home/dreams/public_html/wp-content/my_log_cron.txt', date('Y-m-d h:s').' - '.trim($text).PHP_EOL , FILE_APPEND);
    }

	public static function set_days_meta() {
		$projects = self::get_all_projects();
		foreach ($projects as $a_project) {
			$project = new ID_Project($a_project->id);
			$post_id = $project->get_project_postid();
			$days_left = $project->days_left();
			update_post_meta($post_id, 'ign_days_left', $days_left);
		}
	}

	public static function set_closed_meta() {
		$projects = self::get_all_projects();
		foreach ($projects as $a_project) {
			$project = new ID_Project($a_project->id);
			$post_id = $project->get_project_postid();
			$days_left = $project->days_left_2();
			$end_type = $project->get_end_type();
			if ($days_left <= 0 && $end_type == 'closed') {
				update_post_meta($post_id, 'ign_project_closed', true);
			} else {
				update_post_meta($post_id, 'ign_project_closed', false);
			}
		}
	}

	public static function level_sort($a, $b) {
		return $a->meta_order == $b->meta_order ? 0 : ($a->meta_order > $b->meta_order) ? 1 : -1;
	}

	public static function get_project_images($post_id, $project_id) {
		$project_image1 = self::get_project_thumbnail($post_id);
		$project_image2 = get_post_meta($post_id, 'ign_product_image2', true);
		$project_image3 = get_post_meta($post_id, 'ign_product_image3', true);
		$project_image4 = get_post_meta($post_id, 'ign_product_image4', true);
		$images = array($project_image1, $project_image2, $project_image3, $project_image4);
		return $images;
	}

	public static function delete_project_posts() {
		global $wpdb;
		$post_query = 'SELECT * FROM '.$wpdb->prefix.'posts WHERE post_type = "ignition_product"';
		$post_res = $wpdb->get_results($post_query);
		if (!empty($post_res)) {
			foreach ($post_res as $res) {
				wp_delete_post($res->ID, true);
			}
		}
	}

	public static function count_user_projects($user_id) {
		global $wpdb;
		$sql = $wpdb->prepare('SELECT COUNT(*) AS count FROM '.$wpdb->prefix.'posts WHERE post_author = %d AND post_type = "ignition_product"', $user_id);
		$res = $wpdb->get_row($sql);
		return (!empty($res) ? $res->count : '0');
	}

	function get_project_raised_by_dates($start_date, $end_date) {
		global $wpdb;
		$tz = get_option('timezone_string');
		if (empty($tz)) {
			$tz = 'UTC';
		}
		date_default_timezone_set($tz);
		$sql = $wpdb->prepare('SELECT SUM(prod_price) AS raise FROM '.$wpdb->prefix.'ign_pay_info WHERE product_id = %d
				AND (created_at >= %s AND created_at <= %s) ',
				$this->id, $start_date." 00:00:00", $end_date." 23:59:59");
		$res = $wpdb->get_row($sql);
		if (!empty($res->raise)) {
			return str_replace(',', '', $res->raise);
		}
		else {
			return '0';
		}
	}

	function get_project_orders_by_dates($start_date, $end_date) {
		global $wpdb;
		$tz = get_option('timezone_string');
		if (empty($tz)) {
			$tz = 'UTC';
		}
		date_default_timezone_set($tz);
		$sql = $wpdb->prepare('SELECT COUNT(*) AS count FROM '.$wpdb->prefix.'ign_pay_info WHERE product_id = %d' .
				' AND (created_at >= %s AND created_at <= %s)',
				$this->id, $start_date." 00:00:00", $end_date." 23:59:59");
		$res = $wpdb->get_row($sql);
		if (!empty($res)) {
			return $res->count;
		}
		else {
			return 0;
		}
	}
}
?>