<div class="memberdeck">
	<?php get_template_part('inc/dash', ''); ?>

<form action="?edit-account=<?php echo (isset($current_user->ID) ? $current_user->ID : ''); ?>&amp;edited=1" method="POST" id="edit-account" name="edit-account" enctype="multipart/form-data">
	<div class="row mt">
		<div class="col-lg-2 dashboard-sidebar">
			<div class="whitebox parted">
				<a href="#change_email" class="scroll title">Email</a>
				<a href="#change_password" class="scroll title">Password</a>
				<a href="#payments" class="scroll title">Payments</a>
				<a href="#delete" class="scroll title">Delete</a>
			</div>
			<button type="submit" id="edit-account-submit" class="button blue" name="edit-account-submit"><?php _e('Update Account', 'memberdeck'); ?></button>
		</div>
		<div class="col-lg-10">
			<?php echo (!empty($error) ? '<p class="error">'.trim($error,'<br/>').'</p>' : ''); ?>
			<?php echo (!empty($success) ? '<p class="success">'.$success.'</p>' : ''); ?>
			<div class="whitebox">
				<ul class="md-box-wrapper full-width cf">
					<li class="md-box">
						<div class="md-profile">
							<div id="logged-input" class="no">
								<div class="dashboard-block">
									<div class="form-row">
										<label for="nicename"><?php _e('Display Name <span class="starred">*</span>', 'memberdeck'); ?></label>
										<input type="text" size="20" class="nicename" name="nicename" value="<?php echo (isset($nicename) ? $nicename : ''); ?>"/>
									</div>
								</div>
								<div class="dashboard-block">
					                <a name="change_email"></a>
									<h2 class="border-bottom"><?php _e('Email', 'memberdeck'); ?></h2>
									<?php /*<p class="desc-note"><strong><?php _e('Note: ', 'memberdeck'); ?></strong><?php _e('Fields marked with <span class="starred">*</span> may display publicly.', 'memberdeck'); ?></p>*/?>
									<div class="form-row full">
										<label for="email"><?php _e('Your Email', 'memberdeck'); ?></label>
										<input type="email" size="20" class="email" name="email" value="<?php echo (isset($email) ? $email : ''); ?>"/>
									</div>
									<div class="form-row full">
										<label for="cemail"><?php _e('Confirm Your Email', 'memberdeck'); ?></label>
										<input type="email" size="20" class="email" name="cemail" value="<?php echo (isset($cemail) ? $cemail : ''); ?>"/>
									</div>
								</div>
								<div class="dashboard-block">
					                <a name="change_password"></a>
									<h2 class="border-bottom"><?php _e('Password', 'memberdeck'); ?></h2>
									<p class="desc-note"><strong><?php _e('Note:', 'memberdeck'); ?></strong> <?php _e('changing your password will clear login cookies. You will need to login again after saving.', 'memberdeck'); ?></p>
									<div class="form-row full">
										<label for="pw"><?php _e('New Password', 'memberdeck'); ?></label>
										<input type="password" title="To ensure a secure password please include a symbol and number. The password should be atleast 8 characters long" size="20" class="pw" name="pw"/>
									</div>
									<div class="form-row full">
										<label for="cpw"><?php _e('Confirm New Password', 'memberdeck'); ?></label>
										<input type="password" size="20" class="cpw" name="cpw"/>
									</div>
								</div>
								<div class="dashboard-block">
					                <a name="payments"></a>
									<h2 id="instantcheckout" class="border-bottom"><?php _e('Payments', 'memberdeck'); ?></h2>
									<a class="button blue" href="/dashboard/?payment_settings=1">Payment Account</a><br/>
									
									<?php if ($show_subscriptions) { ?>
										<strong><?php _e('Subscriptions', 'memberdeck'); ?></strong>
										<p class="desc-note"><?php _e('Manage active subscriptions', 'memberdeck'); ?></p>
										<div class="form-row"><p class="sub_response"></p></div>
										<div class="form-row half">
											<span class="idc-dropdown">
												<select name="sub_list" title="Lorem ipsum dolor sit amet, consectetur adipisicing elita." class="idc-dropdown__select .idc-dropdown__select--white" data-userid="<?php echo $user_id; ?>">
													<option value="0"><?php _e('Select Subscription', 'memberdeck'); ?></option>
													<?php if (isset($plans)) { foreach ($plans as $plan) { echo '<option value="'.$plan['id'].'" data-gateway="'.$plan['gateway'].'">'.$plan['plan_id'].'</option>'; } } ?>
												</select>
											</span>
										</div>
										<div class="form-row half">&nbsp;<button name="cancel_sub" class="hidden invert inline" disabled><?php _e('Cancel Subscription', 'memberdeck'); ?></button></div>
									<?php } ?>
									<br/><p><strong><?php _e('Instant Checkout', 'memberdeck'); ?></strong></p>
									<p class="desc-note">	<?php _e('With instant checkout enabled, you can pay with your credit card without re-entering information. To enable, simply use your credit card to checkout once, and then select &lsquo;enable instant checkout&rsquo; from this screen, and click \'Update Account\' below.', 'memberdeck'); ?><br>
										<?php _e('Your credit card information is never stored on our servers, and is always processed securely.', 'memberdeck'); ?>
									</p>
									<?php if (!empty($show_icc)) { ?>
									<p class="form-check" style="margin-left: 0;">
										<input type="checkbox" class="instant_checkout" name="instant_checkout" <?php echo (isset($instant_checkout) && $instant_checkout == 1 ? 'checked="checked"' : ''); ?> value="1"/>
										&nbsp;
										<label for="instant_checkout"><?php _e('Enable Instant Checkout', 'memberdeck'); ?></label>
									</p>
									<?php do_action('md_profile_extrasettings'); ?>
									<?php } ?>
								</div>
				                <div class="dashboard-block nb">
					                <a name="delete"></a>
									<h2 class="border-bottom">Delete Account</h2>
									<a class="button gray" href="/members/<?=$current_user->user_login;?>/settings/delete-account/">Delete my dreams.build account</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</form>
</div>