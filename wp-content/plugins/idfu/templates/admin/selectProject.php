<select id="choose-project" name="choose-project">
	<option>Assign to Project</option>
</select>
<script>
jQuery(document).ready(function() {
	var url = id_ajaxurl;
	var saved = "<?php echo $saved; ?>";
	jQuery.ajax({
		url: url,
		type: 'POST',
		data: {action: 'idfu_get_projects'},
		success: function(res) {
			var json = JSON.parse(res);
			//console.log(json);
			jQuery.each(json, function() {
				jQuery("#choose-project").append(jQuery('<option/>', {value: this.id, text: this.product_name}));
			});
			jQuery("#choose-project").val(saved);
		}
	});
});
</script>