<div class="memberdeck checkout-wrapper">
	<div class="checkout-title-bar">
		<?php $project = new ID_Project($project_id);?>
    	<?php /*<span class="active checkout-payment"><a>Payment</a></span>*/?>
        <span class="checkout-confirmation"><a>Payment</a></span>
        <span class="checkout-project-title"><?php echo wp_trim_words(isset($level_name) ? $level_name : '', $num_words = 3, $more = null); ?> <?php //print_r($project->get_project_postid())?></span>
<!--        <span class="currency-symbol"><sup>--><?php //echo $pp_symbol; ?><!--</sup>-->
        <span class="currency-symbol"><sup><?php echo getSymbolCurr(); ?></sup>
            <span class="product-price"><?php echo (isset($level_price) ?  $level_price : ''); ?></span>
           	<div class="checkout-tooltip"><i class="fa fa-info-circle"></i></div>
         </span>
    </div>
    <div class="tooltip-text">
        <?php include_once '_checkoutTooltip.php'; ?>
    </div>
	<form action="" method="POST" id="payment-form" data-currency-code="<?php echo getSymbolCode(); ?>" data-product="<?php echo (isset($product_id) ? $product_id : ''); ?>" data-type="<?php echo (isset($type) ? $type : ''); ?>" <?php echo (isset($type) && $type == 'recurring' ? 'data-recurring="'.$recurring.'"' : ''); ?> data-free="<?php echo ($level_price == 0 ? 'free' : 'premium'); ?>" data-txn-type="<?php echo (isset($txn_type) ? $txn_type : 'capture'); ?>" data-renewable="<?php echo (isset($renewable) ? $renewable : 0); ?>" data-limit-term="<?php echo (isset($type) && $type == 'recurring' ? $limit_term : 0); ?>" data-term-limit="<?php echo(isset($limit_term) && $limit_term ? $term_length : ''); ?>" data-scpk="<?php echo (isset($sc_pubkey) ? apply_filters('idc_sc_pubkey', $sc_pubkey) : ''); ?>" data-claimedpp="<?php echo (isset($claimed_paypal) ? apply_filters('idc_claimed_paypal', $claimed_paypal) : ''); ?>" <?php echo ($es == 1 || $eb == 1 ? 'style="display: none;"' : ''); ?> data-pay-by-credits="<?php echo ((isset($paybycrd) && $paybycrd == 1) ? '1' : '') ?>">
    <h3 class="checkout-header"><?php /* echo (isset($level_name) ? $level_name : ''); ?> <?php _e('Checkout', 'memberdeck'); */?> 
			<?php _e('Select Payment Method', 'memberdeck'); ?></h3>
		<div id="extra_fields" class="form-row">
		<?php echo do_action('md_purchase_extrafields'); ?>
		</div>
		<?php if ($level_price !== '' && $level_price > 0) { ?>
		<div class="payment-type-selector">
			<?php if ($epp == 1) { ?>
			<div><a id="pay-with-paypal" class="pay_selector" href="#">
            	<i class="fa fa-paypal"></i>
				<span><?php _e('Paypal', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($eppadap) && $eppadap == 1) { ?>
			<div><a id="pay-with-ppadaptive" class="pay_selector" href="#">
            	  <i class="fa fa-paypal"></i>
				<span><?php _e('PayPal', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if ($es == 1) { ?>
			<div><a id="pay-with-stripe" class="pay_selector" href="#">
           		 <i class="fa fa-credit-card"></i>
				<span><?php _e('Credit Card', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if ($eb == 1) { ?>
			<div><a id="pay-with-balanced" class="pay_selector" href="#">
            	<i class="fa fa-credit-card"></i>
				<span><?php _e('Credit Card', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($efd) && $efd == 1) { ?>
			<div><a id="pay-with-fd" class="pay_selector" href="#">
            	<i class="fa fa-credit-card"></i>
				<span><?php _e('Credit Card', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($eauthnet) && $eauthnet == 1) { ?>
			<div><a id="pay-with-authorize" class="pay_selector" href="#">
            	<i class="fa fa-credit-card"></i>
				<span><?php _e('Credit Card', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($mc) && $mc == 1) { ?>
			<div><a id="pay-with-mc" class="pay_selector" href="#">
            	 <i class="fa fa-power-off"></i>
				<span><?php _e('Offline Checkout', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($paybycrd) && $paybycrd == 1) { ?>
			<div><a id="pay-with-credits" class="pay_selector" href="#">
            	 <i class="fa fa-usd"></i>
				<span><?php _e(ucwords(apply_filters('idc_credits_label', 'Credits', true)), 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
			<?php if (isset($ecb) && $ecb == 1) { ?>
			<div><a id="pay-with-coinbase" class="pay_selector" href="#">
            	<i class="fa fa-btc"></i>
				<span><?php _e('Bitcoin', 'memberdeck'); ?></span>
			</a></div>
			<?php } ?>
		</div>
		<?php } ?>
        <div class="confirm-screen" style="display:none;">
		<?php if (!is_user_logged_in()) { ?>
			<span class="login-help"><a href="#" class="reveal-login" style="color: #24aaf2;"><?php _e('Already have an account?', 'memberdeck'); ?></a></span>
			<div id="logged-input" class="no">
				<div class="form-row third left">
					<label for="first-name"><?php _e('First Name', 'memberdeck'); ?> <span class="starred">*</span></label>
					<input type="text" size="20" class="first-name required" name="first-name"/>
				</div>
				<div class="form-row twoforth">
					<label for="last-name"><?php _e('Last Name', 'memberdeck'); ?> <span class="starred">*</span></label>
					<input type="text" size="20" class="last-name required" name="last-name"/>
				</div>
				<div class="form-row">
					<label for="email"><?php _e('Email Address', 'memberdeck'); ?> <span class="starred">*</span></label>
					<input type="email" pattern="[^ @]*@[^ @]*" size="20" class="email required" name="email"/>
				</div>
				<div class="form-row full ">
					<label for="address"><?php _e('Address Line 1', 'memberdeck'); ?></label>
					<input type="text" size="20" class="address required" name="address" value="<?php echo (isset($shipping_info['address']) ? $shipping_info['address'] : ''); ?>"/>
				</div>
				<div class="form-row full ">
					<label for="address"><?php _e('Address Line 2', 'memberdeck'); ?></label>
					<input type="text" size="20" class="address2" name="address2" value=""/>
				</div>
				<div class="form-row third left">
					<label for="city"><?php _e('City / Town', 'memberdeck'); ?></label>
					<input type="text" size="20" class="city required" name="city" value="<?php echo (isset($shipping_info['city']) ? $shipping_info['city'] : ''); ?>"/>
				</div>
				<div class="form-row twoforth">
					<label for="state"><?php _e('State / Province / Region / Municipality', 'memberdeck'); ?></label>
					<input type="text" size="20" class="state" name="state" value="<?php echo (isset($shipping_info['state']) ? $shipping_info['state'] : ''); ?>"/>
				</div>
				<div class="form-row third left">
					<label for="zip"><?php _e('ZIP / Postal Code', 'memberdeck'); ?></label>
					<input type="text" size="20" class="zip required" name="zip" value="<?php echo (isset($shipping_info['zip']) ? $shipping_info['zip']: ''); ?>"/>
				</div>
				<div class="form-row twoforth">
					<label for="country"><?php _e('Country', 'memberdeck'); ?></label>
					<input type="text" size="20" class="country required" name="country" value="<?php echo (isset($shipping_info['country']) ? $shipping_info['country'] : ''); ?>"/>
				</div>
				<?php //if (!$guest_checkout) { ?>
				<div class="form-row">
					<label for="pw"><?php _e('Password', 'memberdeck'); ?> <span class="starred">*</span></label>
					<input type="password" size="20" class="pw required" name="pw"/>
				</div>
				<div class="form-row">
					<label for="cpw"><?php _e('Re-enter Password', 'memberdeck'); ?> <span class="starred">*</span></label>
					<input type="password" size="20" class="cpw required" name="cpw"/>
				</div>
				<div class="form-row">
					<p>By backing this project, a Dreams.Build account will be created for you. By signing up for an account on Dreams.Build you agree to our <a href="https://dreams.build/terms-of-service/" style="color: #24aaf2;">Terms of Service</a> and <a href="https://dreams.build/privacy-policy/" style="color: #24aaf2;">Privacy Policy</a></p>
				</div>
				<!-- <?php// }	else { ?>
					<a href="#" class="reveal-account"><?php _e('Create an account', 'memberdeck'); ?></a>
					<div id="create_account" style="display: none">
						<div class="form-row">
							<label for="pw"><?php _e('Password', 'memberdeck'); ?> <span class="starred">*</span></label>
							<input type="password" size="20" class="pw required" name="pw"/>
						</div>
						<div class="form-row">
							<label for="cpw"><?php _e('Re-enter Password', 'memberdeck'); ?> <span class="starred">*</span></label>
							<input type="password" size="20" class="cpw required" name="cpw"/>
						</div>
					</div> -->
				<?php// } ?>
			</div>
		<?php }
		else { ?>
		<div id="logged-input" class="yes">
			<div class="form-row third" style="display: none;">
				<label for="first-name"><?php _e('First Name', 'memberdeck'); ?> <span class="starred">*</span></label>
				<input type="text" size="20" class="first-name required" name="first-name" value="<?php echo (isset($fname) ? $fname : ''); ?>"/>
			</div>
			<div class="form-row twothird" style="display: none;">
				<label for="last-name"><?php _e('Last Name', 'memberdeck'); ?> <span class="starred">*</span></label>
				<input type="text" size="20" class="last-name required" name="last-name" value="<?php echo (isset($lname) ? $lname : ''); ?>"/>
			</div>
			<div class="form-row" style="display: none;">
				<label for="email"><?php _e('Email Address', 'memberdeck'); ?> <span class="starred">*</span></label>
				<input type="email" pattern="[^ @]*@[^ @]*" size="20" class="email required" name="email" value="<?php echo (isset($email) ? $email : ''); ?>"/>
			</div>
		</div>
		<?php } ?>
        </div> <!-- confirm screen -->
		<div id="stripe-input" data-idset="<?php echo (isset($instant_checkout) && $instant_checkout == true ? true : false); ?>" data-symbol="<?php echo (isset($stripe_symbol) ? $stripe_symbol : ''); ?>" data-customer-id="<?php echo ((isset($customer_id) && !empty($customer_id)) ? $customer_id : '') ?>" style="display:none;">
        	<div class="row">		
            	<h3 class="checkout-header"><?php _e('Credit Card Info', 'memberdeck'); ?></h3>
            </div>
            <?php 
				global $current_user;$user_id = $current_user->ID;
				$shipping_info = get_user_meta($user_id, 'md_shipping_info', true);
				$empt = (empty($shipping_info['address']) || empty($shipping_info['city'])||empty($shipping_info['zip'])||empty($shipping_info['state'])||empty($shipping_info['country']))?1:0;
				if (is_user_logged_in() && $empt) { ?>
					<div id="payment-form">
						<div class="pad16">Please update your shipping address below in order to sponsor this dream.</div>
					</div>

                    <div class="form-row full ">
                        <label for="address"><?php _e('Address Line 1', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="address required" name="address" value="<?php echo (isset($shipping_info['address']) ? $shipping_info['address'] : ''); ?>"/>
                    </div>
                    <div class="form-row full ">
                        <label for="address"><?php _e('Address Line 2', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="address2" name="address2" value=""/>
                    </div>
                    <div class="form-row third left">
                        <label for="city"><?php _e('City / Town', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="city required" name="city" value="<?php echo (isset($shipping_info['city']) ? $shipping_info['city'] : ''); ?>"/>
                    </div>
                    <div class="form-row twoforth">
                        <label for="state"><?php _e('State / Province / Region / Municipality', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="state" name="state" value="<?php echo (isset($shipping_info['state']) ? $shipping_info['state'] : ''); ?>"/>
                    </div>
                    <div class="form-row third left">
                        <label for="zip"><?php _e('ZIP / Postal Code', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="zip required" name="zip" value="<?php echo (isset($shipping_info['zip']) ? $shipping_info['zip']: ''); ?>"/>
                    </div>
                    <div class="form-row twoforth">
                        <label for="country"><?php _e('Country', 'memberdeck'); ?></label>
                        <input type="text" size="20" class="country required" name="country" value="<?php echo (isset($shipping_info['country']) ? $shipping_info['country'] : ''); ?>"/>
                    </div>
			<?php } ?>
            <h3>Stage <strong><?=get_post_meta($project->get_project_postid(), 'ign_stage', true);?></strong></h3>
            <p><?=($stage==='2')?'Payments are processed immediately':'Payments are not processed until the funding goal is reached'?></p>
			<div class="form-row">
				<label><?php _e('Card Number', 'memberdeck'); ?> <span class="starred">*</span> <span class="cards"><img src="https://ignitiondeck.com/id/wp-content/themes/id2/images/creditcards-full2.png" alt="<?php _e('Credit Cards Accepted', 'memberdeck'); ?>" /></span></label>
				<input type="text" size="20" autocomplete="off" class="card-number required" /><span class="error-info" style="display:none;"><?php _e('Incorrect Number', 'memberdeck'); ?></span>
			</div>
			<div class="form-row half left">
				<label><?php _e('CVC', 'memberdeck'); ?> <span class="starred">*</span></label>
				<input type="text" size="4" maxlength="4" autocomplete="off" class="card-cvc required"/><span class="error-info" style="display:none;"><?php _e('CVC number required', 'memberdeck'); ?></span>
			</div>
			<div class="form-row half date">
				<label><?php _e('Expiration (MM/YYYY)', 'memberdeck'); ?> <span class="starred">*</span></label>
				<input type="text" size="2" maxlength="2" class="card-expiry-month required"/><span> / </span><input type="text" size="4" maxlength="4" class="card-expiry-year required"/>
			</div>
		</div>
		<?php $currency = get_post_meta($project->get_project_postid(), 'ign_currency', true) ?>
		<?php echo apply_filters('idc_checkout_descriptions', '', $return, $level_price, (isset($user_data) ? $user_data : ''), $settings, $general, $currency); ?>
		
		<div><?php echo apply_filters('md_purchase_footer', ''); ?></div>
		<span class="payment-errors"></span>
		<input type="hidden" name="reg-price" value="<?php echo (isset($return->level_price) ? $return->level_price : ''); ?>"/>
		<input type="hidden" name="pwyw-price" value="<?php echo (isset($pwyw_price) && $pwyw_price > 0 ? $pwyw_price : ''); ?>"/>
		<?php if (isset($upgrade_level) && $upgrade_level) { ?>
		<input type="hidden" name="upgrade-level-price" value="<?php echo (isset($level_price) && $level_price > 0 ? $level_price : ''); ?>"/>
		<?php } ?>
        <div class="checkout-terms-wrapper">
        <?php if ($receipt_settings['show_terms'] == 1) { ?>
		<div class="idc-terms-checkbox" style="display:none;">
			<div class="form-row checklist">
				<input type="checkbox" class="terms-checkbox-input required"/>
				<label><?php _e('By checking this box, I agree to the', 'memberdeck'); ?> <span class="link-terms-conditions"><a href="#"><?php echo $terms_content->post_title; ?></a></span> &amp; <span class="link-privacy-policy"><a href="#"><?php echo $privacy_content->post_title; ?></a></span></label>
				<input type="hidden" id="idc-hdn-error-terms-privacy" value="<?php echo $terms_content->post_title; ?> &amp; <?php echo $privacy_content->post_title; ?>" />
			</div>
		</div>
		<?php } ?>
        <div class="main-submit-wrapper" style="display:none;">
		<button type="submit" id="id-main-submit" class="btn btn-blue" style="padding: 8px 8px;"><?php _e('Submit Payment', 'memberdeck'); ?></button>
		<button type="button" id="reset" class="btn btn-blue" style="padding: 8px 8px;">Choose a different Incentive</button>
        </div>
       </div>
	</form>
	<div class="md-requiredlogin login login-form" style="display: none;">
		<h3 class="checkout-header"><?php _e('Login', 'memberdeck'); ?></h3>
		<span class="login-help"><a href="#" class="hide-login"><?php _e('Need to register?', 'memberdeck'); ?></a></span>
		<?php
		$args = array('redirect' => $url);
		echo wp_login_form($args);
		?>
	</div>

	<?php if ($receipt_settings['show_terms'] == 1) { ?>
	<div class="idc-terms-conditions idc_lightbox mfp-hide">
		<div class="idc_lightbox_wrapper">
			<?php echo wpautop($terms_content->post_content); ?>
		</div>
	</div>
	<div class="idc-privacy-policy idc_lightbox mfp-hide">
		<div class="idc_lightbox_wrapper">
			<?php echo wpautop($privacy_content->post_content); ?>
		</div>
	</div>
	<?php } ?>
</div>
<!-- 
    The easiest way to indicate that the form requires JavaScript is to show
    the form with JavaScript (otherwise it will not render). You can add a
    helpful message in a noscript to indicate that users should enable JS.
-->
<script>
/*if (window.Stripe) */jQuery("#payment-form").show();
</script>
<noscript><p><?php _e('JavaScript is required for the registration form', 'memberdeck'); ?>.</p></noscript>
<div id="ppload"></div>
<?php if ($ecb == 1) { ?>
<div id="coinbaseload" data-button-loaded="no" style="display:none;">
	<input type="hidden" name="id_coinbase_button_code" id="id_coinbase_button_code" value="" />
</div>
<?php } ?>
<?php if ($eb == 1) {
	echo '<script>balanced.init("'.$burl.'"); jQuery("#payment-form").show()</script>';
} ?>
<?php if ($eppadap == 1) {
	// For lightbox
	echo '<script src="https://www.paypalobjects.com/js/external/dg.js"></script>';
	// For mini browser
	/*echo '<script src="https://www.paypalobjects.com/js/external/apdg.js"></script>';*/
}
?>