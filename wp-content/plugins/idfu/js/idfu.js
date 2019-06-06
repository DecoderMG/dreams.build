jQuery(document).ready(function() {
	jQuery('a.edit_update').click(function(e) {
		e.preventDefault();
		//jQuery('.prior_update').hide();
		var updateID = jQuery(this).data('update-id');
		jQuery('#update_' + updateID + '_wrapper').toggle();
		jQuery('[name=idfu_is_updated_'+updateID+']').val(1);
	});
	jQuery('ol.updates_fes .prior_update').each(function(e){
		var $this = jQuery(this);
		jQuery("textarea", jQuery(this)).on("change", function(){
			jQuery(".has_updated", $this).attr('value',1);
		});
	});
});