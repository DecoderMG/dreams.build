<div class="row">
	<div class="col-lg-12">
		<div class="whitebox">

<div class="md-requiredlogin login">
	<h3><?php _e('This content is restricted to members only', 'memberdeck'); ?>.</h3>
	<p><?php _e('Please login or register for access', 'memberdeck'); ?>.</p>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-4">
			<?php if (isset($_GET['login_failure']) && $_GET['login_failure'] == 1) {
				if (!isset($_GET['error_code'])) { echo '<p class="error">Invalid username or incorrect password</p>';}
				else if (isset($_GET['error_code']) && $_GET['error_code'] == "incorrect_password") { echo '<p class="error">'.__('Incorrect password', 'memberdeck').'</p>';}
				else if (isset($_GET['error_code']) && $_GET['error_code'] == "framework_missing") {
					echo '<p class="error">'.__('Critical Error: IgnitionDeck Framework is missing, please install and activiate IgnitionDeck Framework', 'memberdeck').'</p>';
				}
			} ?>
			<p class="error blank-field <?php echo ((isset($_GET['error_code']) && ($_GET['error_code'] == "empty_password" || $_GET['error_code'] == "empty_username")) ? '' : 'hide') ?>"><?php _e('Username or Password should be not be empty', 'memberdeck') ?></p>
			<?php if (!is_user_logged_in()) { ?>
				<?php
				$durl = md_get_durl(); $args = array('redirect' => $durl, 'echo' => false);
				echo wp_login_form($args); ?>
			<?php } 
			?>
		</div>
		<div class="col-lg-4 login-social">
				<?php do_action( 'wordpress_social_login' );?>
				<?php /*<a class="btn btn-navy" href="#"> <i class="fa fa-facebook"></i> Login Using Facebook</a>
				<a class="btn btn-lblue" href="#"><i class="fa fa-twitter"></i> Login Using Twitter</a>
				<a class="btn btn-red" href="#"> <i class="fa fa-google-plus"></i> Login Using Google+</a>*/?>
		</div>
		<div class="col-lg-2"></div>
	</div>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-4">
			<?php do_action('idc_below_login_form'); ?>
			<p><a class="lostpassword" href="<?php echo site_url(); ?>/wp-login.php?action=lostpassword"><?php _e('Lost Password', 'memberdeck'); ?></a> <?php /*<a class="register" href="<?php echo site_url(); ?>/wp-login.php?action=register">Registration</a>*/?><br clear="both"/></p>
		</div>
		<div class="col-lg-4 login-social-second"><p class="grey-small">We'll never post anything without your permission.</p></div>
		<div class="col-lg-2"></div>
	</div>
</div>

</div>
</div>
</div>