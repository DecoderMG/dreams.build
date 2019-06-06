<div class="wrap memberdeck">
	<div class="icon32" id="icon-md"></div><h2 class="title"><?php _e('Email Settings', 'memberdeck'); ?></h2>
	<div class="help">
		<a href="http://forums.ignitiondeck.com" alt="IgnitionDeck Support" title="IgnitionDeck Support" target="_blank"><button class="button button-large"><?php _e('Support', 'memberdeck'); ?></button></a>
		<a href="http://docs.ignitiondeck.com" alt="IgnitionDeck Documentation" title="IgnitionDeck Documentation" target="_blank"><button class="button button-large"><?php _e('Documentation', 'memberdeck'); ?></button></a>
	</div>
	<div class="md-settings-container">
	<div class="postbox-container" style="width:65%; margin-right: 3%">
		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
				<div class="postbox">
					<h3 class="hndle"><span><?php _e('Template Settings', 'memberdeck'); ?></span></h3>
					<div class="inside">
						<form method="POST" action="" id="gateway-settings" name="gateway-settings">
							<div class="form-row">
								<label for="template_select"><?php _e('Select Template', 'memberdeck'); ?></label>
								<select name="template_select" id="template_select">
<!--									<option name="registration_email">--><?php //_e('Registration Email (Paypal)', 'memberdeck'); ?><!--</option>-->
									<option name="welcome_email"><?php _e('Welcome Email', 'memberdeck'); ?></option>
									<option name="project_new"><?php _e('Dream was submitted for review', 'memberdeck'); ?></option>
									<option name="purchase_receipt"><?php _e('Purchase Receipt', 'memberdeck'); ?></option>
									<option name="preorder_receipt"><?php _e('Pre-Order Receipt', 'memberdeck'); ?></option>
									<option name="product_renewal_email"><?php _e('Product Renewal Notification Email', 'memberdeck'); ?></option>
									<option name="reset_password"><?php _e('Forgotten password', 'memberdeck'); ?></option>
									<option name="password_changed"><?php _e('Password Changed', 'memberdeck'); ?></option>
									<option name="account_deleted"><?php _e('Account deleted', 'memberdeck'); ?></option>
									<option name="project_approved"><?php _e('Dream was approved and live', 'memberdeck'); ?></option>
<!--									<option name="project_live">--><?php //_e('Project Live', 'memberdeck'); ?><!--</option>-->
									<option name="project_rejected"><?php _e('Dream was rejected', 'memberdeck'); ?></option>
									<option name="project_funded"><?php _e('Created dream is successfully funded', 'memberdeck'); ?></option>
									<option name="project_not_funded"><?php _e('Created dream is not successfully funded', 'memberdeck'); ?></option>
									<option name="project_stage_change"><?php _e('Dream moves from stage one to stage two', 'memberdeck'); ?></option>
									<option name="project_complete_stage2"><?php _e('Dream finished Stage 2', 'memberdeck'); ?></option>
									<option name="project_new_comment"><?php _e('New comment on a dream', 'memberdeck'); ?></option>

									<option name="project_sponsor_new_update"><?php _e('Sponsor - Sponsored dream posted an update', 'memberdeck'); ?></option>
									<option name="project_sponsor_failed"><?php _e('Sponsor - Sponsored dream is not successfully funded', 'memberdeck'); ?></option>
									<option name="project_sponsor_stage_change"><?php _e('Sponsor - Sponsored dream has progressed from Stage 1 to Stage 2', 'memberdeck'); ?></option>
									<option name="project_sponsor_complete_stage2"><?php _e('Sponsor - Sponsored dream finished Stage 2', 'memberdeck'); ?></option>
									<option name="project_sponsor_innovator_comment"><?php _e('Sponsor - New comment on a sponsored dream', 'memberdeck'); ?></option>
									<option name="project_sponsor_innovator_update"><?php _e('Sponsot - Project Has Been Updated', 'memberdeck'); ?></option>
									<option name="funding_reaches_50"><?php _e('Funding reached 50%', 'memberdeck'); ?></option>
									<option name="funding_reaches_75"><?php _e('Funding reaches 75%', 'memberdeck'); ?></option>
									<?php do_action('idc_email_template_option'); ?>
								</select>
							</div>
							<span><?php _e('Leave empty to use default template', 'memberdeck'); ?></span>
								<div class="form-row registration_email email_text" style="display: none"><?php wp_editor((isset($template_array['registration_email']) ? $template_array['registration_email'] : ''), "registration_email_text"); ?></div>
								<div class="form-row welcome_email email_text" style="display: none"><?php wp_editor((isset($template_array['welcome_email']) ? $template_array['welcome_email'] : ''), "welcome_email_text"); ?></div>
								<div class="form-row purchase_receipt email_text" style="display: none"><?php wp_editor((isset($template_array['purchase_receipt']) ? $template_array['purchase_receipt'] : ''), "purchase_receipt_text"); ?></div>
								<div class="form-row product_renewal_email email_text" style="display: none"><?php wp_editor((isset($template_array['product_renewal_email']) ? $template_array['product_renewal_email'] : ''), "product_renewal_email_text"); ?></div>
								<div class="form-row reset_password email_text" style="display: none"><?php wp_editor((isset($template_array['reset_password']) ? $template_array['reset_password'] : ''), "reset_password_text"); ?></div>

								<div class="form-row password_changed email_text" style="display: none"><?php wp_editor((isset($template_array['password_changed']) ? $template_array['password_changed'] : ''), "password_changed_text"); ?></div>

								<div class="form-row account_deleted email_text" style="display: none"><?php wp_editor((isset($template_array['account_deleted']) ? $template_array['account_deleted'] : ''), "account_deleted_text"); ?></div>

								<div class="form-row project_approved email_text" style="display: none"><?php wp_editor((isset($template_array['project_approved']) ? $template_array['project_approved'] : ''), "project_approved_text"); ?></div>

								<div class="form-row project_live email_text" style="display: none"><?php wp_editor((isset($template_array['project_live']) ? $template_array['project_live'] : ''), "project_live_text"); ?></div>

								<div class="form-row project_new email_text" style="display: none"><?php wp_editor((isset($template_array['project_new']) ? $template_array['project_new'] : ''), "project_new_text"); ?></div>

								<div class="form-row project_rejected email_text" style="display: none"><?php wp_editor((isset($template_array['project_rejected']) ? $template_array['project_rejected'] : ''), "project_rejected_text"); ?></div>

								<div class="form-row project_funded email_text" style="display: none"><?php wp_editor((isset($template_array['project_funded']) ? $template_array['project_funded'] : ''), "project_funded_text"); ?></div>

								<div class="form-row project_not_funded email_text" style="display: none"><?php wp_editor((isset($template_array['project_not_funded']) ? $template_array['project_not_funded'] : ''), "project_not_funded_text"); ?></div>

								<div class="form-row project_stage_change email_text" style="display: none"><?php wp_editor((isset($template_array['project_stage_change']) ? $template_array['project_stage_change'] : ''), "project_stage_change_text"); ?></div>

								<div class="form-row project_complete_stage2 email_text" style="display: none"><?php wp_editor((isset($template_array['project_complete_stage2']) ? $template_array['project_complete_stage2'] : ''), "project_complete_stage2_text"); ?></div>

								<div class="form-row project_new_comment email_text" style="display: none"><?php wp_editor((isset($template_array['project_new_comment']) ? $template_array['project_new_comment'] : ''), "project_new_comment_text"); ?></div>

								<div class="form-row project_sponsor_new_update email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_new_update']) ? $template_array['project_sponsor_new_update'] : ''), "project_sponsor_new_update_text"); ?></div>

								<div class="form-row project_sponsor_failed email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_failed']) ? $template_array['project_sponsor_failed'] : ''), "project_sponsor_failed_text"); ?></div>

								<div class="form-row project_sponsor_stage_change email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_stage_change']) ? $template_array['project_sponsor_stage_change'] : ''), "project_sponsor_stage_change_text"); ?></div>

								<div class="form-row project_sponsor_complete_stage2 email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_complete_stage2']) ? $template_array['project_sponsor_complete_stage2'] : ''), "project_sponsor_complete_stage2_text"); ?></div>

								<div class="form-row project_sponsor_innovator_comment email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_innovator_comment']) ? $template_array['project_sponsor_innovator_comment'] : ''), "project_sponsor_innovator_comment_text"); ?></div>

								<div class="form-row project_sponsor_innovator_update email_text" style="display: none"><?php wp_editor((isset($template_array['project_sponsor_innovator_update']) ? $template_array['project_sponsor_innovator_update'] : ''), "project_sponsor_innovator_update_text"); ?></div>

								<div class="form-row funding_reaches_50 email_text" style="display: none"><?php wp_editor((isset($template_array['funding_reaches_50']) ? $template_array['funding_reaches_50'] : ''), "funding_reaches_50_text"); ?></div>

								<div class="form-row funding_reaches_75 email_text" style="display: none"><?php wp_editor((isset($template_array['funding_reaches_75']) ? $template_array['funding_reaches_75'] : ''), "funding_reaches_75_text"); ?></div>




								<?php do_action('idc_email_template'); ?>


							<div class="form-row">
								<button name="edit_template" id="edit_template" class="button"><?php _e('Save Template', 'memberdeck'); ?></button> <button name="restore_default" id="restore_default" class="button"><?php _e('Restore Default', 'memberdeck'); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Begin Sidebar -->
	<div class="postbox-container" style="width:32%;">
		<div class="metabox-holder">
			<div class="meta-box-sortables" style="min-height:0;">
				<div class="postbox info">
					<h3 class="hndle"><span><?php _e('Merge Tags', 'memberdeck'); ?></span></h3>
					<div class="inside">
						<p><?php _e('Note: Some tags may not be available for certain template types', 'memberdeck'); ?>.</p>
						<?php do_action('idc_email_help_before'); ?>
						<h4><?php _e('Company Information', 'memberdeck'); ?></h4>
						<p><em><?php _e('Company Name', 'memberdeck'); ?></em>: {{COMPANY_NAME}}</p>
						<p><em><?php _e('Company Email', 'memberdeck'); ?></em>: {{COMPANY_EMAIL}}</p>
						<p><em><?php _e('Site Name', 'memberdeck'); ?></em>: {{SITE_NAME}}</p>
						<h4><?php _e('User Information', 'memberdeck'); ?></h4>
						<p><em><?php _e('Name', 'memberdeck'); ?></em>: {{NAME}}</p>
						<p><em><?php _e('Email Address', 'memberdeck'); ?></em>: {{EMAIL}}</p>
						<h4><?php _e('Order Information', 'memberdeck'); ?></h4>
						<p><em><?php _e('Product Name', 'memberdeck'); ?></em>: {{PRODUCT_NAME}}</p>
						<p><em><?php _e('Order Amount', 'memberdeck'); ?></em>: {{AMOUNT}}</p>
						<p><em><?php _e('Transaction ID', 'memberdeck'); ?></em>: {{TXN_ID}}</p>
						<p><em><?php _e('Order/Registration Date', 'memberdeck'); ?></em>: {{DATE}}</p>
						<h4><?php _e('Project Information', 'memberdeck'); ?></h4>
						<p><em><?php _e('Project Name', 'memberdeck'); ?></em>: {{PROJECT_NAME}}</p>
						<p><em><?php _e('End Date', 'memberdeck'); ?></em>: {{END_DATE}}</p>
						<h4><?php _e('Product Expiration Information', 'memberdeck'); ?> (<?php _e('For Product Renewal Notification Email template only', 'memberdeck'); ?>)</h4>
						<p><em><?php _e('Days left', 'memberdeck'); ?></em>: {{DAYS_LEFT}}</p>
						<p><em><?php _e('Weeks Left', 'memberdeck'); ?></em>: {{WEEKS_LEFT}}</p>
						<p><em><?php _e('Months Left', 'memberdeck'); ?></em>: {{MONTHS_LEFT}}</p>
						<p><em><?php _e('Renewal Checkout URL', 'memberdeck'); ?></em>: {{RENEWAL_CHECKOUT_URL}}</p>
						<?php do_action('idc_email_help_after'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Sidebar -->
</div>
</div>