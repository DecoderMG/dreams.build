<?php

$lock_file = '/public_html/wp-content/yourlock.pid';

$welcome_email = file_get_contents($lock_file);

if($welcome_email != ''){
    die;
}

file_put_contents($lock_file, getmypid());

/**
 * WordPress Cron Implementation for hosts, which do not offer CRON or for which
 * the user has not set up a CRON job pointing to this file.
 *
 * The HTTP request to this file will not slow down the visitor who happens to
 * visit when the cron job is needed to run.
 *
 * @package WordPress
 */

ignore_user_abort(true);

if ( !empty($_POST) || defined('DOING_AJAX') || defined('DOING_CRON') )
	die();

/**
 * Tell WordPress we are doing the CRON task.
 *
 * @var bool
 */

if ( !defined('ABSPATH') ) {
	/** Set up WordPress environment */
	require_once( dirname( __FILE__ ) . '/wp-load.php' );
}

do_action_ref_array( 'schedule_hourly_id_cron', array() );
//do_action_ref_array( 'idc_hourly_event', array() );
//do_action( 'idc_daily_event', array() );
file_put_contents($lock_file, '');

die();