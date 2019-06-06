<?php
global $permalink_structure;
if (empty($permalink_structure)) { $prefix = '&amp;';}
else {$prefix = '?';}
if (is_user_logged_in() && !isset($current_user)) {
	global $current_user;get_currentuserinfo();
}
/*if (isset($current_user)) {
	$orders = ID_Member_Order::get_orders_by_user($current_user->ID);
	$orders = array_reverse($orders);
}*/
$durl = md_get_durl();
?>
<?php  if (!class_exists('Helix')&&!(isset($_GET['edit_project'])||isset($_GET['create_project']))) { ?>
<?php get_template_part('inc/dash', ''); ?>
<?php }  ?>