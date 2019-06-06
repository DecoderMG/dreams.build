<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

define( 'WP_ROCKET_ADVANCED_CACHE', true );
$rocket_cache_path = '/public_html/wp-content/cache/wp-rocket/';
$rocket_config_path = '/public_html/wp-content/wp-rocket-config/';

if ( file_exists( '/public_html/wp-content/plugins/wp-rocket/inc/front/process.php' ) ) {
	include( '/public_html/wp-content/plugins/wp-rocket/inc/front/process.php' );
} else {
	define( 'WP_ROCKET_ADVANCED_CACHE_PROBLEM', true );
}