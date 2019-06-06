<div class="login-box" id="signup" style="display:none;">
	<div class="arrow-up"></div>
	<h5>Sign Up</h5>
	<div class="login-content">
		<div class="row">
			<div class="col-lg-6">
				<form method="post" id="signupForm">
					<p class="status"></p>
					<input type="text" name="susername" id="susername" class="form-control" placeholder="Username" value="" />
					<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="" />
					<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="" />
					<input type="text" name="semail" id="semail" class="form-control" placeholder="Email" value="" />
					<input type="password" name="spassword" id="spassword" class="form-control" placeholder="Password" value="" />
					<input type="password" name="confirm_spassword" id="confirm_spassword" class="form-control" placeholder="Confirm Password" value="" />
					<input class="btn btn-block btn-blue" type="submit" value="Create My Account" />
					<div class="grey-small margin-top">By signing up, you agree to our<br/><a href="/terms-of-service/">terms of use</a> and <a href="/privacy-policy/">privacy policy</a>.</div>
					<?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
				</form>
			</div>
			<div class="col-lg-6">
				<?php do_action( 'wordpress_social_login' ); //idsocial_wp_login_fb_login(true);?>
				<?php /*<a class="btn btn-navy" href="#"> <i class="fa fa-facebook"></i> Login Using Facebook</a>
				<a class="btn btn-lblue" href="#"><i class="fa fa-twitter"></i> Login Using Twitter</a>
				<a class="btn btn-red" href="#"> <i class="fa fa-google-plus"></i> Login Using Google+</a>*/?>
				<p class="grey-small">We'll never post anything<br/>without your permission.</p>
			</div>
		</div>
	</div>
</div>