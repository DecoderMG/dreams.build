<?php
	// we need to hide/invalidate sold out levels
	if (isset($level)) {
		$level_invalid = getLevelLimitReached($project_id, $post_id, $level);
		if ($level_invalid) {
			$level = 0;
		}
	}
	$level_data = apply_filters('idcf_dropdown_level', $level_data, $project_id);
?>
<div class="ignitiondeck idc_lightbox mfp-hide">
	<div class="project_image" style="background-image: url(<?php echo $image; ?>);"><div class="aspect_ratio_maker"></div></div>
	<div class="lb_wrapper">
		<div class="form_header">
			<strong><?php _e('Step 1:', 'ignitiondeck'); ?></strong> <?php _e('Specify your contribution amount for', 'ignitiondeck'); ?> <em><?php echo get_the_title($post_id); ?></em>
		</div>
		<div class="form">
			<form action="<?php echo (isset($action) ? $action : ''); ?>" method="POST" name="idcf_level_select">
				<div class="form-row inline left twothird">
					<label for="level_select"><?php _e('Incentive', 'ignitiondeck'); ?></label>
					<span class="idc-dropdown <?php echo ($the_deck->disable_levels == 'on' ? 'disable_levels' : ''); ?>">
						<select name="level_select" id="incentive_selector" class="idc-dropdown__select level_select" data-currency-user="<?php echo getSymbolCode() ?>">
							<?php $project_currency = get_post_meta($post_id, 'ign_currency', true);
							foreach ($level_data as $level) {
								if(getSymbolCode() != $project_currency){
									$per = round($level->meta_price * (2 / 100), 2);
									$price = currencyNew($project_currency, getSymbolCode(), $level->meta_price + $per, null);
								} else {
									$per = 0;
									$price = $level->meta_price;
								}

								if (empty($level->level_invalid) || !$level->level_invalid) {
									if(!empty($level->meta_title))
										echo '<option value="'.$level->id.'" data-default-price="'.($level->meta_price != 0 ? floatval(round($price, 2)) : '').'" data-price="'.(isset($level->meta_price) ? floatval(round($price, 2)) : '').'" data-desc="'.$level->meta_short_desc.'" '.apply_filters('idcf_dropdown_option_attributes', '', $level).'>'.$level->meta_title.'</option>';
								}
							}
							?>
						</select>
					</span>
				</div>
				<div class="form-row inline third total">
					<label for="total"><?php _e('Total', 'ignitiondeck'); ?></label>
					<?php if (isset($pwyw) && $pwyw) { ?>
						<input type="text" class="total" name="total" id="total" value="<?php // echo total; ?>" />
					<?php } else { ?>
						<span name="total" class="total" data-value=""></span>
					<?php } ?>
				</div>
				<div class="form-row text">
					<p>
						<?php // echo description; ?>
					</p>
				</div>
				<div class="form-hidden">
					<input type="hidden" name="project_id" value="<?php echo $project_id; ?>"/>
				</div>
				<div class="form-row submit">
					<input type="submit" name="lb_level_submit" class="btn lb_level_submit" value="<?php _e('Next Step', 'ignitiondeck'); ?>"/>
				</div>
			</form>
		</div>
	</div>
</div>