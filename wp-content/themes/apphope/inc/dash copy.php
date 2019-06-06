<?php 
if (is_user_logged_in() && !isset($current_user)) {
	global $current_user;get_currentuserinfo();
}
?>
<div class="dashboardmenu">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 <?php echo (isset($_GET['edit-profile']) ? 'active' : ''); ?>"><a href="/dashboard/?edit-profile=<?=$current_user->ID?>">Profile</a></div>
			<div class="col-lg-2 <?php echo (isset($_GET['edit-account']) ? 'active' : ''); ?>"><a href="/dashboard/?edit-account=<?=$current_user->ID?>">Account</a></div>
			<div class="col-lg-2 <?=bp_is_user_notifications()?'active':''?>"><a href="/members/<?=$current_user->user_login;?>/notifications/">Notifications</a></div>
			<div class="col-lg-2 <?=is_page(16964)?'active':''?>"><a href="/messages">Messages</a></div>
			<?php /*<li><a href="/dashboard/?backer_profile=<?=$current_user->ID?>">My Backed Dreams</a></li>*/?>
			<div class="col-lg-2 <?php echo (isset($_GET['creator_projects']) ? 'active' : ''); ?>"><a href="/dashboard/?creator_projects=1">Dreams</a></div>
			<div class="col-lg-2 <?=bp_is_user_friends()?'active':''?>"><a href="/members/<?=$current_user->user_login;?>/friends/">Friends</a></div>
		</div>
	</div>
</div>