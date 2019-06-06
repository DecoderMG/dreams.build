<?php
/**
* Plugin Name: Nature
* Plugin URI: https://themeforest.net/user/medhati/portfolio?ref=medhati
* Description: Nature - Responsive Coming Soon WordPress Plugin 
* Version: 2.1
* Author: Medhati
* Domain Path: /languages/
* Author URI: https://themeforest.net/user/medhati?ref=medhati
* Copyright 2016  MEDHATI Themes
*/

add_action( 'plugins_loaded', 'nature_textdomain' );
function nature_textdomain() {load_plugin_textdomain( 'nature',false,  dirname( plugin_basename( __FILE__ ) ) . '/languages' ); }

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' );
    require_once( plugin_dir_path(__FILE__) . '/admin/inc/social/social.php' );
}
if ( !isset( $artabaz_nature ) && file_exists( dirname( __FILE__ ) . '/admin/config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/config.php' );
	require_once( dirname( __FILE__ ) . '/admin/shortcodes.php' );
}

function nature_comming_soon_template()
{
	global $artabaz_nature;
	if($artabaz_nature['plugin_mode']==1){
		return;
	}
	else if($artabaz_nature['plugin_mode']==2){
			 if ( current_user_can( ''.$artabaz_nature['can_edit_theme'].'' ) ) {
                        return;
				} else {
								include( dirname( __FILE__ ) . '/template/functions.php');
								include( dirname( __FILE__ ) . '/template/index.php');
								die();
						}
	}
}
add_action( 'template_redirect', 'nature_comming_soon_template' );
function increase_upload( $bytes ){
    return 33554432; // 32 megabytes
}
add_filter( 'upload_size_limit', 'increase_upload' );

?>