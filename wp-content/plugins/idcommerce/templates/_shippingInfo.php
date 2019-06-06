<div class="dashboard-block nb">
<h2 class="border-bottom"><?php _e('Shipping Address', 'memberdeck'); ?></h2>
<p class="desc-note"><?php _e('Please provide your up-to-date shipping address.  Your First and Last name will be used as well.', 'memberdeck'); ?>
</p>


<h4>Location</h4>
<p class="form-row"><input type="text" placeholder="Search Places" id="search_new_places" value=""></p>
	<div id="map_container"><div id="map_canvas"></div></div>
<input id="user_map_lat" type="hidden" value="<?php echo (isset($user_map_lat) ? $user_map_lat : ''); ?>" name="user_map_lat">
<input id="user_map_lng" type="hidden" value="<?php echo (isset($user_map_lng) ? $user_map_lng : ''); ?>" name="user_map_lng">
<p><a id="plot_marker" class="btn btn-blue">Select Place</a></p>

<div class="form-row full ">
	<label for="address"><?php _e('Address Line 1', 'memberdeck'); ?></label>
	<input type="text" size="20" class="address" name="address" value="<?php echo (isset($shipping_info['address']) ? $shipping_info['address'] : ''); ?>"/>
</div>
<div class="form-row full">
	<label for="address_two"><?php _e('Address Line 2', 'memberdeck'); ?></label>
	<input type="text" size="20" class="address_two" name="address_two" value="<?php echo (isset($shipping_info['address_two']) ? $shipping_info['address_two'] : ''); ?>"/>
</div>
<div class="form-row half left">
	<label for="city"><?php _e('City / Town', 'memberdeck'); ?></label>
	<input type="text" size="20" class="city" name="city" value="<?php echo (isset($shipping_info['city']) ? $shipping_info['city'] : ''); ?>"/>
</div>
<div class="form-row half">
	<label for="state"><?php _e('State / Province / Region / Municipality', 'memberdeck'); ?></label>
	<input type="text" size="20" class="state" name="state" value="<?php echo (isset($shipping_info['state']) ? $shipping_info['state'] : ''); ?>"/>
</div>
<div class="form-row half left">
	<label for="zip"><?php _e('ZIP / Postal Code', 'memberdeck'); ?></label>
	<input type="text" size="20" class="zip" name="zip" value="<?php echo (isset($shipping_info['zip']) ? $shipping_info['zip']: ''); ?>"/>
</div>
<div class="form-row half">
	<label for="country"><?php _e('Country', 'memberdeck'); ?></label>
	<input type="text" size="20" class="country" name="country" value="<?php echo (isset($shipping_info['country']) ? $shipping_info['country'] : ''); ?>"/>
</div>
</div>