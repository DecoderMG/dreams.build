<?php
global $permalink_structure;
if (empty($permalink_structure)) { $prefix = '&amp;';}
else {$prefix = '?';}
if (is_user_logged_in() && !isset($current_user)) {
	global $current_user;get_currentuserinfo();
}
if (isset($current_user)) {
	$orders = ID_Member_Order::get_orders_by_user($current_user->ID);
	$orders = array_reverse($orders);
}
$durl = md_get_durl();
?>
<?php  if (!class_exists('Helix')&&!(isset($_GET['edit_project'])||isset($_GET['create_project']))) { ?>
<div class="dashboardmenu">
<div class="container-fluid">
<div class="row">
	<div class="col-lg-2 <?php echo (isset($_GET['edit-profile']) ? 'active' : ''); ?>"><a href="<?php echo (isset($current_user) ? the_permalink().$prefix.'edit-profile='.$current_user->ID : ''); ?>"><?php echo (isset($current_user) ? __('Profile', 'memberdeck') : ''); ?></a></div>
	<div class="col-lg-2 <?php echo (isset($_GET['edit-account']) ? 'active' : ''); ?>"><a href="<?php echo (isset($current_user) ? the_permalink().$prefix.'edit-account='.$current_user->ID : ''); ?>"><?php echo (isset($current_user) ? __('Account', 'memberdeck') : ''); ?></a></div>
	<div class="col-lg-2"><a href="/members/<?=$current_user->user_login;?>/settings/">Notifications</a></div>
	<div class="col-lg-2"><a href="/members/<?=$current_user->user_login;?>/messages/">Messages</a></div>
	<?php do_action('md_profile_extratabs'); ?>
	<div class="col-lg-2"><a href="/members/<?=$current_user->user_login;?>/friends/">Friends</a></div>
	<?php /*<li><a href="<?php echo $durl; ?>"><?php _e('Dashboard', 'memberdeck'); ?></a></li>*/?>
	<?php /*<li <?php echo (isset($_GET['edit-profile']) ? 'class="active"' : ''); ?>><a href="<?php echo (isset($current_user) ? the_permalink().$prefix.'edit-profile='.$current_user->ID : ''); ?>"><?php echo (isset($current_user) ? __('Profile', 'memberdeck') : ''); ?></a></li>*/?>
	<?php /*<li><a href="/members/<?=$current_user->user_login;?>/settings/">Account</a></li>*/?>
	<?php /*<!-- <li class="help"><a href="#"><i class="icon-question-sign"></i></a></li> -->
	*/?>
	
	<?php /* if (!empty($orders)) { ?>
	<li <?php echo (isset($_GET['idc_orders']) ? 'class="active"' : ''); ?>><a href="<?php echo the_permalink().$prefix.'idc_orders=1'; ?>"><?php _e('Orders', 'memberdeck'); ?></a></li>
	<?php } */?>
</div>
</div>
</div>
<?php }  ?>