<?php //$collective_benefits = esc_html(get_post_meta($id, 'ign_collective_benefits', true));?>
<?php //$collective_benefits = get_post_meta($id, 'ign_collective_benefits', true);
	$digital_levels = get_post_meta($id, 'ign_digital_levels', true);
	$sponsor_access = false;
	if (is_user_logged_in()) { 
		$project_id = get_post_meta($id, 'ign_project_id', true);
		$p_orders = ID_Order::get_orders_by_project($project_id);
		$mdid_orders = array();
		foreach ($p_orders as $idcf_order) {
			$mdid_order = mdid_payid_check($idcf_order->id);
			if (!empty($mdid_order)) {
				array_push($mdid_orders, $mdid_order);
			}
		}
		if (!empty($mdid_orders)) {
			foreach ($mdid_orders as $mdid_order) {
				$order = new ID_Member_Order($mdid_order->order_id);
				$idc_order = $order->get_order();
				if (!empty($idc_order)) {
					if(get_current_user_id() == $idc_order->user_id) {
						$sponsor_access = true;							
						break;
					}
				}
			}
		}
	} ?>
<?php if($digital_levels>0):?>
	<h4>Digital Files</h4>
	<?php for($i=0;$i<$digital_levels;$i++):?>
		<?php $sponsor_locked = get_post_meta($id,'ign_digitals_'.$i.'_sponsor_lock',true);
		if($sponsor_locked == 'checked') {
			if($sponsor_access) { ?>
				<div class="whitebox-digital-unlocked">
					<h6 class="sponsor-unlocked"><strong>Unlocked</strong></h6>
					<h5 style="padding-right: 20px; padding-left: 20px;"><?=get_post_meta($id,'ign_digitals_'.$i.'_name',true);?></h5>
					<p><?=get_post_meta($id,'ign_digitals_'.$i.'_description',true);?></p>
					<p><a class="btn btn-green" style="width: 100%; margin-bottom: 20px;" href="<?=get_post_meta($id,'ign_digitals_'.$i.'_file',true);?>" class="button green">Download</a></p>
			</div>
			<?php } else { ?>
				<div class="whitebox-digital">
					<h6 class="sponsor-locked"><strong>Locked</strong></h6>
					<h5 style="padding-right: 20px; padding-left: 20px;"><?=get_post_meta($id,'ign_digitals_'.$i.'_name',true);?></h5>
					<p><?=get_post_meta($id,'ign_digitals_'.$i.'_description',true);?></p>
					<p class="sponsor-locked"><strong>Sponsor Dream to unlock</strong></p>
				</div>
			<?php } ?>
		<?php } else {?>
			<div class="whitebox">
				<h5><?=get_post_meta($id,'ign_digitals_'.$i.'_name',true);?></h5>
				<p><?=get_post_meta($id,'ign_digitals_'.$i.'_description',true);?></p>
				<a class="btn btn-green" style="width: 100%;" href="<?=get_post_meta($id,'ign_digitals_'.$i.'_file',true);?>" class="button green">Download</a>
			</div>
		<?php } ?>
	<?php endfor;?>
<?php endif;?>

<?php

// we need to hide/invalidate sold out levels

$project_id = get_post_meta($id,'ign_project_id', true);

$deck = new Deck($project_id);
$the_deck = $deck->the_deck();
$level_data = $the_deck->level_data;

?>
<style>
	.whitebox{
		cursor: pointer;
	}
	.sold-out{
		filter: alpha(opacity=70); 
		opacity:0.7; 
		position: absolute; 
		display: block;
		background-color: #000000; 
		top: 0; left: 0;
	}
	.incentive:hover{
		color: #fff;
		background: #54bbd5;
	}
	.incentive:hover .amount{
		color: #fff;
	}
	.incentive:hover .incentive-title{
		color: #fff;
	}
	.incentive:hover .incentive-symbol{
		color: #fff;
	}
	.incentive:hover .delivery{
		color: #fff;
	}
	.incentive-symbol{
		font-weight: normal;
	}
	.delivery{
		color: #54bbd5; 
		padding: 3px;
	}
	.amount {
		color: #60d554;
	}
	.incentive-title{
		text-align: center;
	}
</style>
<h4>Incentives</h4>
<?php global $wpdb;global $current_user;$check = $wpdb->get_row( "SELECT id,active,sent FROM wp_ign_notify WHERE user_id = '".$current_user->ID."' AND product_id = '".$post->ID."'");?>
<?php if(get_post_status($id) == 'publish'){?>
<?php $project_currency = get_post_meta($post->ID, 'ign_currency', true);
	foreach($level_data as $level){
//	print_r($level);
	$price = '';
	if(getSymbolCode() != $project_currency){
		$per = round($level->meta_price * (2 / 100), 2);
		$price = currencyNew($project_currency, getSymbolCode(), $level->meta_price + $per, null);
	} else {
		$per = 0;
		$price = $level->meta_price;
	}
//	print_r($per);
	if($level->meta_short_desc != '' && $level->meta_price != 0 && $level->meta_price > 0){
	?>
<?php if (is_user_logged_in()&&(!$check||!$check->sent)): ?>
	<?php if($level->meta_count >= $level->meta_limit && $level->meta_limit != 0): ?>
		<div class="whitebox <?php echo $level->level_invalid != 1 ? '' :  ''; ?>" style="opacity:0.6;" data-level-id="<?php echo $level->id; ?>">
	<?php else:?>
		<div class="whitebox incentive <?php echo $level->level_invalid != 1 ? 'clicalble' :  ''; ?>" data-level-id="<?php echo $level->id; ?>">
	<?php endif;?>
<?php else:?>
	<?php if($level->meta_count >= $level->meta_limit && $level->meta_limit != 0): ?>
		<div class="whitebox <?php echo $level->level_invalid != 1 ? '' :  ''; ?>" data-level-id="<?php echo $level->id; ?>">
	<?php else:?>
		<div class="whitebox incentive <?php echo $level->level_invalid != 1 ? 'clicalble' :  ''; ?>" data-level-id="<?php echo $level->id; ?>">
	<?php endif;?>
<?php endif;?>
	<h6><span class="amount"><?php echo getSymbolCurr(getSymbolCode()); ?><?php echo floatval(round($price, 2)); ?></span> <span class="incentive-symbol"><?php echo getSymbolCode() ?></span></h6>
	<h5><b class="incentive-title"><?php echo $level->meta_title; ?> </b></h5>
	<?=$level->meta_desc;?>
	<?php if($level->meta_limit == 0 || $level->meta_limit == ''){?>
		<p><strong style="padding: 3px;">Unlimited</strong></p>
	<?php } else if ($level->meta_count >= $level->meta_limit) {?>
		<?php echo "<p style='color:rgba(0,0,0,0.9);'><strong>Incentive sold out</strong></p>"; ?>
	<?php } else {?>
		<?php echo "<p><strong>$level->meta_count of $level->meta_limit claimed</strong></p>"; ?>
	<?php }?>
	<p><strong class="delivery">Estimated Delivery: <?php echo $level->meta_short_desc ?></strong></p>
	
</div>
<?php } }?>
<?php } else if(get_post_status($id) == 'draft') {?>
<p>Incentives disabled in draft mode</p>
<?php $project_currency = get_post_meta($post->ID, 'ign_currency', true);
	foreach($level_data as $level){
//	print_r($level);
	$price = '';
	if(getSymbolCode() != $project_currency){
		$per = round($level->meta_price * (2 / 100), 2);
		$price = currencyNew($project_currency, getSymbolCode(), $level->meta_price + $per, null);
	} else {
		$per = 0;
		$price = $level->meta_price;
	}
//	print_r($per);
	if($level->meta_short_desc != '' && $level->meta_price != 0 && $level->meta_price > 0){
	?>
	<div class="whitebox <?php echo $level->level_invalid != 1 ? '' :  ''; ?>" style="opacity:0.8;" data-level-id="<?php echo $level->id; ?>">
	<h6><span class="amount"><?php echo getSymbolCurr(getSymbolCode()); ?><?php echo floatval(round($price, 2)); ?></span> <span class="incentive-symbol"><?php echo getSymbolCode() ?></span></h6>
	<h5><b class="incentive-title"><?php echo $level->meta_title; ?> </b></h5>
	<?=$level->meta_desc;?>
	<?php if($level->meta_limit == 0 || $level->meta_limit == ''){?>
		<p><strong style="padding: 3px;">Unlimited</strong></p>
	<?php } else if ($level->meta_count >= $level->meta_limit) {?>
		<?php echo "<p style='color:rgba(0,0,0,0.9);'><strong>Incentive sold out</strong></p>"; ?>
	<?php } else {?>
		<?php echo "<p><strong>$level->meta_count of $level->meta_limit claimed</strong></p>"; ?>
	<?php }?>
	<p><strong class="delivery">Estimated Delivery: <?php echo $level->meta_short_desc ?></strong></p>
</div>
<?php } }?>
<?php } else {?>
<p>Project has finished funding, Incentives disabled</p>
<?php $project_currency = get_post_meta($post->ID, 'ign_currency', true);
	foreach($level_data as $level){
//	print_r($level);
	$price = '';
	if(getSymbolCode() != $project_currency){
		$per = round($level->meta_price * (2 / 100), 2);
		$price = currencyNew($project_currency, getSymbolCode(), $level->meta_price + $per, null);
	} else {
		$per = 0;
		$price = $level->meta_price;
	}
//	print_r($per);
	if($level->meta_short_desc != '' && $level->meta_price != 0 && $level->meta_price > 0){
	?>
	<div class="whitebox <?php echo $level->level_invalid != 1 ? '' :  ''; ?>" style="opacity:0.8;" data-level-id="<?php echo $level->id; ?>">
	<h6><span class="amount"><?php echo getSymbolCurr(getSymbolCode()); ?><?php echo floatval(round($price, 2)); ?></span> <span class="incentive-symbol"><?php echo getSymbolCode() ?></span></h6>
	<h5><b class="incentive-title"><?php echo $level->meta_title; ?> </b></h5>
	<?=$level->meta_desc;?>
	<?php if($level->meta_limit == 0 || $level->meta_limit == ''){?>
		<p><strong style="padding: 3px;">Unlimited</strong></p>
	<?php } else if ($level->meta_count >= $level->meta_limit) {?>
		<?php echo "<p style='color:rgba(0,0,0,0.9);'><strong>Incentive sold out</strong></p>"; ?>
	<?php } else {?>
		<?php echo "<p><strong>$level->meta_count of $level->meta_limit claimed</strong></p>"; ?>
	<?php }?>
	<p><strong class="delivery">Estimated Delivery: <?php echo $level->meta_short_desc ?></strong></p>
</div>
<?php } } }?>
<!-- The button that pulls out the form -->
<input type="button" class="wp-report-post-link button gray" href="#wp-report-post-body-popup" value="REPORT THIS PROJECT" />
<div id="wp-report-post-body-popup" style="display:none;">
<div class="wp-report-post-body"></div>
</div>