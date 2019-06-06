<div class="wrap ignitiondeck">
	<div class="icon32" id=""></div><h2 class="title"><?php _e('Social Settings', 'idsocial'); ?></h2>
	<div class="help">
		<a href="http://forums.ignitiondeck.com" alt="IgnitionDeck Support" title="IgnitionDeck Support" target="_blank"><button class="button button-large"><?php _e('Support', 'idsocial'); ?></button></a>
		<a href="http://docs.ignitiondeck.com" alt="IgnitionDeck Documentation" title="IgnitionDeck Documentation" target="_blank"><button class="button button-large"><?php _e('Documentation', 'idsocial'); ?></button></a>
	</div>
	<div class="id-settings-container">
		<div class="postbox-container" style="width:45%;">
			<div class="metabox-holder">
				<div class="meta-box-sortables" style="min-height:0;">
					<div class="postbox">
						<h3 class="hndle"><span><?php _e('IgnitionDeck Social Settings', 'idsocial'); ?></span></h3>
						<div class="inside" style="width: 50%; min-width: 400px;">
							<form action="" method="POST" id="idsocial_settings">
								<h4><?php _e('Social Login', 'idsocial'); ?></h4>
									<div class="form-input third left">
										<label for="app_id"><?php _e('Facebook Application ID', 'idsocial'); ?></label>
										<input id="app_id" name="app_id" value="<?php echo (isset($settings['app_id']) ? $settings['app_id'] : ''); ?>" />
										<a href="https://developers.facebook.com/apps/"><?php _e('Create App', 'idsocial'); ?></a>
									</div>
								<hr />	<br>
								<h4><?php _e('Website Settings', 'idsocial'); ?></h4>
									<div class="form-input half wp-media-buttons">
										<label for="home_image"><?php _e('Home Image for Facebook', 'idsocial'); ?></label>
										<button name="home_image_selector" id="home_image_selector" class="button insert-media add_media" data-input="home_image"><?php _e('Select Image', 'idsocial'); ?></button>
										<input type="hidden" id="home_image" name="home_image" class="main-setting" value="<?php echo (!empty($settings['home_image']) ? $settings['home_image'] : ''); ?>" />
									</div>
									<?php if (!empty($settings['home_image'])) { ?>
									<div class="idsocial-website-image">
										<img src="<?php echo $settings['home_image_url']; ?>" style="max-width:100%;" />
									</div>
									<?php } ?>
								<h4><?php _e('Social Sharing Settings', 'idsocial'); ?></h4>	
									<div class="left"><a href="#" id="check-all-settings">Check All</a>&nbsp;<a href="#" id="clear-all-settings">Clear All</a></div>
										
									<div class="form-input third left">
										<input <?php echo (isset($settings['social_checks']['prod_page_fb']) && $settings['social_checks']['prod_page_fb'] == 1 ? 'checked="checked"' : ''); ?> name="social_checks[prod_page_fb]" type="checkbox" id="prod_page_fb" class="main-setting" value="1" />
										<label for="prod_page_fb"><img src="<?php echo plugins_url('/images/facebook.png', dirname(dirname(__FILE__))); ?>"><?php _e('Facebook on Project Page', 'idsocial'); ?></label>
										<a href="javascript:toggleDiv('hFB');" class="idMoreinfo">[?]</a>
										<div id="hFB" class="idMoreinfofull"><img src="<?php echo plugins_url('/images/fblike.jpg', dirname(dirname(__FILE__))); ?>"><?php _e('Want people to share via Facebook from your project page? Use this.', 'idsocial'); ?></div>
									</div>
									<div class="form-input third left inline">
										<input <?php echo (isset($settings['social_checks']['prod_page_twitter']) && $settings['social_checks']['prod_page_twitter'] == 1 ? 'checked="checked"' : ''); ?> name="social_checks[prod_page_twitter]" type="checkbox" id="prod_page_twitter" class="main-setting"value="1" />
										<label for="prod_page_twitter"><img src="<?php echo plugins_url('/images/twitter.png', dirname(dirname(__FILE__))); ?>"><?php _e('Twitter on Project Page', 'idsocial'); ?></label>
										<a href="javascript:toggleDiv('hTwit');" class="idMoreinfo">[?]</a>
										<div id="hTwit" class="idMoreinfofull"><img src="<?php echo plugins_url('/images/tweet.jpg', dirname(dirname(__FILE__))); ?>"><?php _e('Want people to share via Twitter from your project page? Use this. ', 'idsocial'); ?></div>
									</div>
									<div class="form-input third left">
										<input <?php echo (isset($settings['social_checks']['prod_page_linkedin']) && $settings['social_checks']['prod_page_linkedin'] == 1 ? 'checked="checked"' : ''); ?> name="social_checks[prod_page_linkedin]" type="checkbox" id="prod_page_linkedin" class="main-setting" value="1" />
										<label for="prod_page_linkedin"><img src="<?php echo plugins_url('/images/linkedin.png', dirname(dirname(__FILE__))); ?>"><?php _e('LinkedIn on Project Page', 'idsocial'); ?></label>
										<a href="javascript:toggleDiv('hLinked');" class="idMoreinfo">[?]</a>
										<div id="hLinked" class="idMoreinfofull"><?php _e('Want people to share via LinkedIn from your project page? Use this. ', 'idsocial'); ?></div>
									</div>
									<div class="form-input third left">
										<input <?php echo (isset($settings['social_checks']['prod_page_google']) && $settings['social_checks']['prod_page_google'] == 1 ? 'checked="checked"' : ''); ?> name="social_checks[prod_page_google]" type="checkbox" id="prod_page_google" class="main-setting" value="1" />
										<label for="prod_page_google"><img src="<?php echo plugins_url('/images/google-plus.png', dirname(dirname(__FILE__))); ?>"><?php _e('Google+ on Project Page', 'idsocial'); ?></label>
										<a href="javascript:toggleDiv('hGoog');" class="idMoreinfo">[?]</a>
										<div id="hGoog" class="idMoreinfofull"><?php _e('Want people to share via Google+ from your project page? Use this. ', 'idsocial'); ?></div>
									</div>
									<div class="form-input third left">
										<input <?php echo (isset($settings['social_checks']['prod_page_pinterest']) && $settings['social_checks']['prod_page_pinterest'] == 1 ? 'checked="checked"' : ''); ?> name="social_checks[prod_page_pinterest]" type="checkbox" id="prod_page_pinterest" class="main-setting" value="1" />
										<label for="prod_page_pinterest"><img src="<?php echo plugins_url('/images/pinterest.png', dirname(dirname(__FILE__))); ?>"><?php _e('Pinterest on Project Page', 'idsocial'); ?></label>
										<a href="javascript:toggleDiv('hPinterest');" class="idMoreinfo">[?]</a>
										<div id="hPinterest" class="idMoreinfofull"><?php _e('Want people to share via Pinterest from your project page? Use this. ', 'idsocial'); ?></div>
									</div>
									<br />
									<div class="form-input third left">
										<input <?php echo (isset($settings['show_social_on_post']) && $settings['show_social_on_post'] == 1 ? 'checked="checked"' : ''); ?> name="show_social_on_post" type="checkbox" id="show_social_on_post" value="1" />
										<label for="show_social_on_post"><?php _e('Enable sharing on posts', 'idsocial'); ?></label>
									</div>
									<div class="form-input third left">
										<input <?php echo (isset($settings['show_social_on_pages']) && $settings['show_social_on_pages'] == 1 ? 'checked="checked"' : ''); ?> name="show_social_on_pages" type="checkbox" id="show_social_on_pages" value="1" />
										<label for="show_social_on_pages"><?php _e('Enable sharing on pages', 'idsocial'); ?></label>
									</div>
								<br />
									<?php 
										$theme = wp_get_theme();
										if ($theme->get('Name') == '500 Framework' || $theme->get('Template') == 'fivehundred') { ?>
								<hr /> <br>
								<h4><?php _e('Theme 500 Social Settings', 'idsocial'); ?></h4>
									<p><?php _e('Check to show on theme home page, uncheck to hide.', 'idsocial'); ?></p>
									<div class="form-input third left">
										<input class="fh_social" type="checkbox" id="twitter-button" name="theme_500[twitter]" value="1" <?php echo (isset($settings['theme_500']['twitter']) && $settings['theme_500']['twitter'] == 1 ? 'checked="checked"' : ''); ?>/>
										<label for="twitter-button"><img src="<?php echo plugins_url('/images/twitter.png', dirname(dirname(__FILE__))); ?>"><?php _e('Twitter', 'idsocial'); ?></label>
									</div>
									<div class="form-input third left" style="display: none;">
										<label for="twitter-via"><?php _e('Twitter Username', 'idsocial'); ?></label>
										<input type="text" id="twitter-via" name="theme_500[twitter_via]" value="<?php echo (isset($settings['theme_500']['twitter_via']) ? $settings['theme_500']['twitter_via'] : ''); ?>" />
									</div>
									<div class="form-input third left">
										<input class="fh_social" type="checkbox" id="fb-button" name="theme_500[fb]" value="1" <?php echo (isset($settings['theme_500']['fb']) && $settings['theme_500']['fb'] == 1 ? 'checked="checked"' : ''); ?> />
										<label for="fb-button"><img src="<?php echo plugins_url('/images/facebook.png', dirname(dirname(__FILE__))); ?>"><?php _e('Facebook', 'idsocial'); ?></label>
									</div>
									<div class="form-input third left" style="display: none;">
										<label for="fb-via"><?php _e('Facebook Username', 'idsocial'); ?></label>
										<input type="text" id="fb-via" name="theme_500[fb_via]" value="<?php echo (isset($settings['theme_500']['fb_via']) ? $settings['theme_500']['fb_via'] : ''); ?>"/><br/>
									</div>
									<div class="form-input third left">
										<input class="fh_social" type="checkbox" id="g-button" name="theme_500[google]" value="1" <?php echo (isset($settings['theme_500']['google']) && $settings['theme_500']['google'] == 1 ? 'checked="checked"' : ''); ?> />
										<label for="g-button"><img src="<?php echo plugins_url('/images/google-plus.png', dirname(dirname(__FILE__))); ?>"><?php _e('Google+', 'idsocial'); ?></label>
									</div>
									<div class="form-input third left" style="display: none;">
										<label for="g-via"><?php _e('Google+ User Number', 'idsocial'); ?></label>
										<input type="text" id="g-via" name="theme_500[g_via]" value="<?php echo (isset($settings['theme_500']['g_via']) ? $settings['theme_500']['g_via'] : ''); ?>"/><br/>
									</div>
									<div class="form-input third left">
										<input class="fh_social" type="checkbox" id="li-button" name="theme_500[li]" value="1" <?php echo (isset($settings['theme_500']['li']) && $settings['theme_500']['li'] == 1 ? 'checked="checked"' : ''); ?> />
										<label for="li-button"><img src="<?php echo plugins_url('/images/linkedin.png', dirname(dirname(__FILE__))); ?>"><?php _e('LinkedIn', 'idsocial'); ?></label>
									</div>
									<div class="form-input third left" style="display: none;">
										<label for="li-via"><?php _e('LinkedIn Username', 'idsocial'); ?></label>
										<input type="text" id="li-via" name="theme_500[li_via]" value="<?php echo (isset($settings['theme_500']['li_via']) ? $settings['theme_500']['li_via'] : ''); ?>"/><br/>
									</div>
							
									<br />
									<?php } ?>
									<div class="form-row">
										<button class="button button-primary" id="submit_social_settings" name="submit_social_settings"><?php _e('Save', 'idsocial'); ?></button>
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>