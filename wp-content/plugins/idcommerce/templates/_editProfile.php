<?php 
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');
$attachment_id = media_handle_upload('photo', 0);

global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;
$shipping_info = get_user_meta($user_id, 'md_shipping_info', true);
?>
<div class="memberdeck">
	<?php include_once IDC_PATH.'templates/_mdProfileTabs.php'; ?>

<form action="?edit-profile=<?php echo (isset($current_user->ID) ? $current_user->ID : ''); ?>&amp;edited=1" method="POST" id="edit-profile" name="edit-profile" enctype="multipart/form-data">
	<div class="row mt">
		<div class="col-lg-2 dashboard-sidebar">
			<div class="whitebox parted">
				<a href="#basic_info" class="title scroll">Basic Info</a>
				<a href="#story" class="title scroll">Story</a>
				<a href="#photos" class="title scroll">Photos</a>
				<a href="#social" class="title scroll">Social</a>
			</div>
			<input type="submit" id="edit-profile-submit" class="button blue" name="edit-profile-submit" value="<?php _e('Update Profile', 'memberdeck'); ?>" />
		</div>
		<div class="col-lg-10">
			<?php echo (!empty($error) ? '<p class="error">'.$error.'</p>' : ''); ?>
			<?php echo (!empty($success) ? '<p class="success">'.$success.'</p>' : ''); ?>
			<div class="whitebox">
				<ul class="md-box-wrapper full-width cf">
					<li class="md-box">
						<div class="md-profile">
							<div id="logged-input" class="no">
								<div class="dashboard-block">
									<a name="basic_info"></a>
									<h2 class="border-bottom"><?php _e('Basic Info', 'memberdeck'); ?></h2>
									<div class="form-row half left">
										<label for="first-name"><?php _e('First Name', 'memberdeck'); ?></label>
										<input type="text" class="first-name" name="first-name" value="<?php echo (isset($user_firstname) ? $user_firstname : ''); ?>"/>
									</div>
									<div class="form-row half">
										<label for="last-name"><?php _e('Last Name', 'memberdeck'); ?></label>
										<input type="text" class="last-name" name="last-name" value="<?php echo (isset($user_lastname) ? $user_lastname : ''); ?>"/>
									</div>
				                </div>
								<div class="dashboard-block">
									<a name="story"></a>
									<h2 class="border-bottom"><?php _e('Your Story', 'memberdeck'); ?></h2>
									<div class="form-row full">
										<label for="description"><?php _e('Description', 'memberdeck'); ?></label>
										<input type="text" name="description" value="<?php echo (isset($description) ? $description : ''); ?>"/>
									</div>
									<div class="form-row full">
										<label for="full_description"><?php _e('About You', 'memberdeck'); ?></label>
										<p class="desc-note">This is your bio. Keep it short.</p>
										<textarea rows="10" name="full_description"><?php echo (isset($full_description) ? stripslashes(html_entity_decode($full_description)) : ''); ?></textarea>
									</div>
								</div>
								<div class="dashboard-block">
									<a name="photos"></a>
									<h2 class="border-bottom"><?php _e('Your Photos', 'memberdeck'); ?></h2>
									<div class="form-row half left">
										<label for="photo">Profile Photo</label>
										<div class="avatar"><?php echo get_avatar( $current_user->ID, 150 ); ?></div>
										<a class="btn btn-blue profile_popup" href="/members/<?=$current_user->user_login;?>/profile/change-avatar/" data-fancybox-type="iframe">Edit Photo</a>
										<?php /*<input type="file" id="photo" name="photo" value="" accept="image/*" />*/?>
									</div>
									<div class="form-row half"><?php echo ($photo ? '<img class="profile-photo" src="'.$photo.'" />' : ''); ?></div>
								</div>
								<div class="dashboard-block">
									<a name="social"></a>
									<h2 class="border-bottom"><?php _e('Social Links', 'memberdeck'); ?></h2>
				                    <div class="form-row full">
										<label for="facebook"><?php _e('Facebook URL', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="facebook" value="<?php echo (isset($facebook) ? $facebook : ''); ?>"/>
				                    </div>
									<div class="form-row full">
										<label for="twitter"><?php _e('Twitter URL', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="twitter" value="<?php echo (isset($twitter) ? $twitter : ''); ?>"/>
				                    </div>
				                   <div class="form-row full">
										<label for="google"><?php _e('Google+', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="google" value="<?php echo (isset($google) ? $google : ''); ?>"/>
									</div>
									<div class="form-row full">
										<label for="linkedin"><?php _e('LinkedIn', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="linkedin" value="<?php echo (isset($linkedin) ? $linkedin : ''); ?>"/>
				                    </div>
									<div class="form-row full">
										<label for="instagram"><?php _e('Instagram', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="instagram" value="<?php echo (isset($instagram) ? $instagram : ''); ?>"/>
				                    </div>
									<div class="form-row full">
										<label for="url"><?php _e('Website URL', 'memberdeck'); ?></label>
										<input type="text" title="Full URL Link Please" name="url" value="<?php echo (isset($url) ? $url : ''); ?>"/>
									</div>
								</div>
								<?php echo do_action('md_profile_extrafields'); ?>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</form>
</div>