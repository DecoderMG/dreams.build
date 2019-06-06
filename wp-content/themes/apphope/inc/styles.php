<?php 

function apphope_styles_basic()  
{  
	global $brad_data , $woocommerce;
	/* ------------------------------------------------------------------------ */
	/* Register Stylesheets */
	/* ------------------------------------------------------------------------ */
	wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
	//wp_register_style( '500style', get_template_directory_uri() . '/css/style.css');
	//wp_register_style( '500transitions', get_template_directory_uri() . '/css/transitions.css');
	wp_register_style( 'styles', get_stylesheet_directory_uri() . '/css/styles.css' /*, array('500style')*/);
	wp_register_style( 'fancy', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css' );
	wp_register_style( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css' );
	wp_register_style( 'awe', get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
	wp_register_style( 'tooltipster', get_stylesheet_directory_uri() . '/css/tooltipster.css' );
	wp_register_style( 'formstyler', get_stylesheet_directory_uri() . '/css/jquery.formstyler.css' );
	wp_register_style( 'chosen', get_stylesheet_directory_uri() . '/css/chosen.min.css' );
	wp_register_style( 'additional', get_stylesheet_directory_uri() . '/css/additional.css' );

	/* ------------------------------------------------------------------------ */
	/* Enqueue Stylesheets */
	/* ------------------------------------------------------------------------ */
	wp_enqueue_style( 'bootstrap' );
	//wp_enqueue_style( '500style' );
	//wp_enqueue_style( '500transitions' );
	wp_enqueue_style( 'styles' );
	wp_enqueue_style( 'fancy' );
	wp_enqueue_style( 'responsive' ); 
	wp_enqueue_style( 'tooltipster' );
	wp_enqueue_style( 'formstyler' );
	wp_enqueue_style( 'awe' );
	wp_enqueue_style( 'chosen' );
	wp_enqueue_style( 'additional' );
	
}  

if (!isset($_GET['purchaseform']) || !in_array($_GET['purchaseform'], array(1,500))) add_action( 'wp_enqueue_scripts', 'apphope_styles_basic'); 
?>