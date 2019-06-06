<?php

function apphope_scripts_basic() { 
	/* ------------------------------------------------------------------------ */
	/* Register Scripts */
	/* ------------------------------------------------------------------------ */
	//wp_register_script('modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js', '', null, TRUE);
	//wp_register_script('gmaps', '//maps.google.com/maps/api/js?sensor=false', array(), null, $in_footer =false);
	//wp_register_script('basic', get_stylesheet_directory_uri() . '/js/sl_ea_tm_scr_fs_fb_val_ui_ms.js', array(), null, $in_footer =false);
	//wp_register_script('gmaps-custom',get_stylesheet_directory_uri() . '/js/gmaps.js', array(), null, $in_footer =false);
	//wp_register_script('google-api','//maps.googleapis.com/maps/api/js?v=3.exp', array(), null, $in_footer =false);
	wp_register_script('fancy',get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array(), null, $in_footer =false);
	//wp_register_script('jssor',get_stylesheet_directory_uri() . '/js/jssor.js', array(), null, $in_footer =false);
	wp_register_script('jssorslider',get_stylesheet_directory_uri() . '/js/jssor.slider.min.js', array(), null, $in_footer =false);
	wp_register_script('custom',get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, $in_footer =false);
	wp_register_script('anchors',get_stylesheet_directory_uri() . '/js/anchors.js', array(), null, $in_footer =false);
	wp_register_script('tooltipster',get_stylesheet_directory_uri() . '/js/jquery.tooltipster.min.js', array(), null, $in_footer =false);
	wp_register_script('formstyler',get_stylesheet_directory_uri() . '/js/jquery.formstyler.min.js', array(), null, $in_footer =false);
	wp_register_script('bootstrap',get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
	wp_register_script('chosen',get_stylesheet_directory_uri() . '/js/chosen.jquery.min.js', array(), null, $in_footer =false);
	wp_register_script('map','//maps.googleapis.com/maps/api/js?key=GOOGLE_API_KEY&sensor=false&libraries=places&language=en', array(), null, $in_footer =false);
	wp_register_script('additional',get_stylesheet_directory_uri() . '/js/additional.js', array(), null, $in_footer =false);
	//wp_register_script('cookie',get_stylesheet_directory_uri() . '/js/jquery.cookie.js', array(), null, $in_footer =false);
	//wp_register_script('infobox', '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js', array(), null, TRUE);
	//wp_register_script('typekit', '//use.typekit.net/nne0rkx.js', array(), null, $in_footer =false);
	//wp_register_script('jquery.scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array(), null, TRUE);
    /* -----------------------------------------------------------------S------- */
	/* Enqueue Scripts */
	/* ------------------------------------------------------------------------ */
	wp_enqueue_script('jquery', false, array(), null);
	//wp_enqueue_script('typekit');
	//wp_enqueue_script('basic');
	//wp_enqueue_script('google-api');
	//wp_enqueue_script('gmaps');
	//wp_enqueue_script('gmaps-custom');
	//wp_enqueue_script('about');
	wp_enqueue_script('fancy');
	//wp_enqueue_script('jssor');
	wp_enqueue_script('jssorslider');
	wp_enqueue_script('tooltipster');
	wp_enqueue_script('formstyler');
	wp_enqueue_script('chosen');
	wp_enqueue_script('custom');
	wp_enqueue_script('anchors');
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('map');
	wp_enqueue_script('additional');
	//wp_enqueue_script('cookie');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} 

if (!isset($_GET['purchaseform']) || !in_array($_GET['purchaseform'], array(1,500))) add_action('wp_enqueue_scripts' , 'apphope_scripts_basic'); 
?>