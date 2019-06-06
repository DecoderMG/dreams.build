jQuery(document).ready(function(e) {
	jQuery("#check-all-settings").click(function(e) {
		e.preventDefault();
		jQuery(".main-setting").attr('checked', 'checked');
	});
	jQuery("#clear-all-settings").click(function(e) {
		e.preventDefault();
		jQuery(".main-setting").removeAttr('checked');
	});
	socialInput();
	jQuery('.fh_social').click(function() {
		socialInput();
	});
	if (jQuery('#loginform').length > 0 || jQuery('#registerform').length > 0) {
		jQuery('p.submit').after( jQuery('.idsocial-wp-fb-login') );
		jQuery('#idsocial-is-admin-login').val('yes');
	}
	jQuery(document).on('idfMediaSelected', function(e, attachment) {
		jQuery('.idsocial-website-image').children('img').attr('src', attachment.url);
	});
});
function socialInput() {
	jQuery.each(jQuery('.fh_social'), function() {
		if (jQuery(this).attr('checked') == 'checked') {
			jQuery(this).parent('div').next().show();
		}
		else {
			jQuery(this).parent('div').next().hide();
		}
	});
}