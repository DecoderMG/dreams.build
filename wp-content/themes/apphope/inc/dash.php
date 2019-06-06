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
			<div class="col-lg-2 <?php echo (isset($_GET['notifications']) ? 'active' : ''); ?>"><a href="/dashboard/?notifications=1">Notifications</a></div>
			<div class="col-lg-2 <?=is_page(16964)?'active':''?>"><a href="/messages">Messages</a></div>
			<?php /*<li><a href="/dashboard/?backer_profile=<?=$current_user->ID?>">My Backed Dreams</a></li>*/?>
			<div class="col-lg-2 <?php echo (isset($_GET['creator_projects']) ? 'active' : ''); ?>"><a href="/dashboard/?creator_projects=1">Dreams</a></div>
			<div class="col-lg-2 <?php echo (isset($_GET['friends']) ? 'active' : ''); ?>"><a href="/dashboard/?friends=1">Friends (Beta)</a></div>
		</div>
	</div>
</div>