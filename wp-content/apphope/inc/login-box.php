<div class="login-box" id="login" style="display:none;">
	<div class="arrow-up"></div>
	<h5>Log In</h5>
	<div class="login-content">
		<div class="row">
			<div class="col-lg-6">
				<form method="post" id="login">
					<p class="status"></p>
					<input id="username" name="username" type="text" class="form-control required" placeholder="Username/Email" value="" />
					<div class="password-field"><input type="password" class="form-control required" id="password" name="password" placeholder="Password" value="" /><a href="<?=wp_lostpassword_url(); ?>">I forgot</a></div>
					<input class="btn btn-block btn-blue" type="submit" value="Login" />
					<div class="checkbox grey-small"><label><input type="checkbox" name="rememberme" id="rememberme" value="forever">Remember me</label></div>
					<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
				</form>
			</div>
			<div class="col-lg-6">
				<?php do_action( 'wordpress_social_login' ); //idsocial_wp_login_fb_login(true);?>
				<?php /*<a class="btn btn-navy facebook_trigger" onclick="fb_login()" href="#"> <i class="fa fa-facebook"></i> Login Using Facebook</a>
				<a class="btn btn-lblue twitter_trigger" href="#"><i class="fa fa-twitter"></i> Login Using Twitter</a>
				<a class="btn btn-red google_trigger" href="#"> <i class="fa fa-google-plus"></i> Login Using Google+</a>*/?>
				<p class="grey-small">We'll never post anything<br/>without your permission.</p>
			</div>
		</div>
	</div>
</div>