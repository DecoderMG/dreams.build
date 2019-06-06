<?php
function ajax_auth_init(){
	wp_register_script('validate-script', get_stylesheet_directory_uri() . '/js/jquery.validate.js', array('jquery') ); 
    wp_enqueue_script('validate-script');
    wp_register_script('ajax-auth-script', get_stylesheet_directory_uri() . '/js/ajax-auth-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-auth-script');
    wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirecturl' => get_permalink(), 'loadingmessage' => __('Please wait...') ));
    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) { add_action('init', 'ajax_auth_init'); }
function ajax_login(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
	auth_user_login(sanitize_text_field($_POST['username']), sanitize_text_field($_POST['password']), 'Login',$_POST['rememberme']); 

    // Nonce is checked, get the POST data and sign user on
    /*$info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = $_POST['rememberme'];

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }*/

    die();
}
function auth_user_login($user_login, $password, $login,$remember=true){

	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = $remember;
	if (filter_var($user_login, FILTER_VALIDATE_EMAIL)) {
		$user = get_user_by('email', $user_login);
		$info['user_login'] = $user->data->user_login;
	}
	$user_signon = wp_signon( $info );
    if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.').$info['user_login']));
    } else {
		wp_set_current_user($user_signon->ID); 
        echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...')));
    }
	die();
}
function ajax_register(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'signonsecurity' );
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['first_name'] = sanitize_text_field($_POST['first_name']);
    $info['last_name'] = sanitize_text_field($_POST['last_name']);
  	$info['display_name'] = $info['first_name'];
    $info['user_pass'] = sanitize_text_field($_POST['password']);
	$info['user_email'] = sanitize_email( $_POST['email']);
  	$info['user_login'] = $info['user_nicename'] = sanitize_text_field($_POST['username']);
	$info['role'] = 'user';
	
	// Register the user
    $user_register = wp_insert_user( $info );
 	if ( is_wp_error($user_register) ){	
		$error  = $user_register->get_error_codes();
		if(in_array('empty_user_login', $error))
			echo json_encode(array(/*'loggedin'=>false, */'message'=>__($user_register->get_error_message('empty_user_login'))));
		elseif(in_array('existing_user_login',$error))
			echo json_encode(array(/*'loggedin'=>false, */'message'=>__('This username is already registered.')));
		elseif(in_array('existing_user_email',$error))
			echo json_encode(array(/*'loggedin'=>false, */'message'=>__('This email address is already registered.')));
    } else {
		wp_new_user_notification( $user_register,null, 'admin' );
		//do_action('idc_register_success', $user_register, $info['user_email']);
		$echo = idc_welcome_email($user_register, $info['user_email']);
		//echo $echo;die();
	  auth_user_login($info['user_login'], $info['user_pass'], 'Registration');       
    }
    die();
}
/*
function ajax_auth_init(){
	wp_register_script('validate-script', get_stylesheet_directory_uri() . '/js/jquery.validate.js', array('jquery') ); 
    wp_enqueue_script('validate-script');
    wp_register_script('ajax-auth-script', get_stylesheet_directory_uri() . '/js/ajax-auth-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-auth-script');

    wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirecturl' => home_url(), 'loadingmessage' => __('Please wait...')
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) { add_action('init', 'ajax_auth_init'); }
  
function ajax_login(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    // Nonce is checked, get the POST data and sign user on
  	// Call auth_user_login
	auth_user_login($_POST['username'], $_POST['password'], 'Login',$_POST['rememberme']); 
    die();
}



*/