<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Apphope
 * @since Apphope 0.0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<title><?php wp_title(' | ', true, 'right'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=get_stylesheet_directory_uri()?>/img/favicon.ico">
	<link rel="icon" type="image/png" href="<?=get_stylesheet_directory_uri()?>/img/favicon.png">
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
    <link href='//fonts.googleapis.com/css?family=Roboto:100,400,700' rel='stylesheet' type='text/css'>
    	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1635740106724934', {
em: 'insert_email_variable,'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1635740106724934&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</head>

<body <?php body_class(); ?>>
<?php if (!isset($_GET['purchaseform']) || !in_array($_GET['purchaseform'], array(1,500))):?>

<?php if ( ! (bp_is_user_profile() && bp_current_action()=='change-avatar' ) ):?>
<div id="header-bar">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 logo"><a href="/"><img src="<?=get_stylesheet_directory_uri()?>/img/logo.png" alt="Logo" width="195" height="33" /></a></div>
			<div class="col-lg-1 search"><a class="asearch"><img src="<?=get_stylesheet_directory_uri()?>/img/ico-search.png" alt="Search" width="27" height="26" /></a></div>
			<div class="mobile-menu"><a>Menu</a></div>
			<div class="col-lg-8 menu"><?php include 'inc/menu.php' ?></div>
		</div>
	</div>
</div>
<div id="search-bar" <?php if(!empty($_POST['query'])) echo 'class="active"';?>>
	<?php $current_category = get_queried_object();?>
	<form action="/category/<?=get_query_var('cat')?$current_category->slug:''; ?>" method="post">
	<div class="container"><i class="fa fa-times"></i><input id="search-input" type="text" name="query" value="<?php echo $_POST['query'] ? htmlspecialchars($_POST['query']) : ''; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '|'" placeholder="|"></div>
	</form>
</div>
<?php include 'inc/mobile-menu.php' ?>
<?php else:?>
<style>
html { margin-top: 0 !important; }
	* html body { margin-top: 0 !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 0 !important; }
		* html body { margin-top: 0 !important; }
	}
</style>
<?php endif;?>

<?php if ( ! (bp_is_user_profile() && bp_current_action()=='change-avatar' ) ):?>
<?php if (!is_user_logged_in()) get_template_part('inc/login-box', ''); ?>
<?php if (!is_user_logged_in()) get_template_part('inc/signup-box', ''); ?>
<?php if (is_user_logged_in()) get_template_part('inc/profile-box', ''); ?>
<?php endif;?>

<?php endif;?>