<?php
   $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );
	
	global $artabaz_nature;
	
	if(isset($_POST['email'])) {
        $data = $_POST['email'] . ";";
        $ret = file_put_contents('adress.txt', $data, FILE_APPEND | LOCK_EX);
        if($ret === false) {
            die('There was an error writing this file');
        }
        else {
            echo $artabaz_nature['subscribe_success_msg'];
        }
    }
    else {
        die('no post data to process');
    }
?>