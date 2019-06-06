jQuery(document).ready(function() {
	jQuery(document).bind('idc_lightbox_general', function(e) {
		var selLevel = jQuery('.idc_lightbox:visible select[name="level_select"]').val();
		var levelDesc = jQuery('.idc_lightbox:visible select[name="level_select"] :selected').data('desc');
		var levelPrice = jQuery('.idc_lightbox:visible select[name="level_select"] :selected').data('price');
		jQuery('.idc_lightbox:visible .text p').text(levelDesc);
		jQuery('.idc_lightbox input[name="total"]').val(levelPrice);
		jQuery('.idc_lightbox:visible span.total').data('value', levelPrice).text(levelPrice);
		selectedLevel = jQuery('.idc_lightbox:visible select[name="level_select"] option').eq(selLevel).val();
		var readeronly = jQuery('.level_select option[value="'+ selectedLevel +'"]').text();
		if(readeronly == 'No Incentive, just sponsoring') {
			jQuery('#total').removeAttr('readonly');
		} else {
			jQuery('#total').attr('readonly', true);
		}
	});
	jQuery('.idc_lightbox select[name="level_select"]').change(function(e) {
		if (jQuery(this).has(':visible')) {
			//console.log(e);
			selLevel = jQuery(this).val();
			levelDesc = jQuery('.idc_lightbox:visible select[name="level_select"] :selected').data('desc');
			levelPrice = jQuery('.idc_lightbox:visible select[name="level_select"] :selected').data('price');
			jQuery('.idc_lightbox:visible .text p').text(levelDesc);
            if(levelPrice && jQuery(this).data('currency-user') != 'USD'){

                // var price = parseFloat(levelPrice) * (2 / 100);
                // price = price + parseFloat(levelPrice);
                levelPrice = levelPrice.toFixed(2);
                jQuery('.idc_lightbox #total').val(levelPrice).attr('data-default-price', levelPrice);
                // idc_lightbox_price_change(price);
            } else {
                levelPrice = levelPrice.toFixed(2);
                jQuery('.idc_lightbox input[name="total"]').val(levelPrice).removeAttr('data-default-price', levelPrice);
            }

			jQuery('.idc_lightbox:visible span.total').data('value', levelPrice).text(levelPrice);
		}
	});

    jQuery('.idc_lightbox input[name="total"]').change(function () {
        console.log(jQuery(this).data('default-price'));
        var levelPrice = jQuery('.idc_lightbox:visible select[name="level_select"] :selected').data('price');
        if(levelPrice > 0){
            if(jQuery(this).data('default-price') != jQuery(this).val()){
                if(jQuery('.idc_lightbox select[name="level_select"]').data('currency-user') != 'USD'){
                    var price = '';
                    if(levelPrice != ''){

                        if(levelPrice >= parseFloat(jQuery(this).val())){
                            // price = parseFloat(levelPrice) * (2 / 100);
                            price = parseFloat(levelPrice);
                            price = price.toFixed(2);
                            jQuery(this).val(price);
                        } else {
                            price = parseFloat(jQuery(this).val()) * (2 / 100);
                            price = price + parseFloat(jQuery(this).val());
                            // console.log(jQuery(this).val());
                            console.log(price);
                            price = price.toFixed(2);
                            jQuery(this).val(price);
                        }
                    } else {
                        jQuery(this).val(levelPrice);
                    }

                }
            }
        }
    });

	jQuery(document).bind('idc_lightbox_level_select', function(e, clickLevel) {
		selLevel = jQuery('.idc_lightbox:visible select[name="level_select"] option').eq(clickLevel).val();
		levelDesc = jQuery('.idc_lightbox:visible select[name="level_select"] option').eq(clickLevel).data('desc');
		levelPrice = jQuery('.idc_lightbox:visible select[name="level_select"] option').eq(clickLevel).data('price');
		jQuery('.idc_lightbox:visible .text p').text(levelDesc);
        if(levelPrice){
            var price = parseFloat(levelPrice) * (2 / 100);
            jQuery('.idc_lightbox input[name="total"]').val(levelPrice + price).attr('data-default-price', levelPrice);
        } else {
            jQuery('.idc_lightbox input[name="total"]').val(levelPrice).removeAttr('data-default-price', levelPrice);
        }
		jQuery('.idc_lightbox:visible span.total').data('value', levelPrice).text(levelPrice);
	});

    jQuery('body').on('click','.right-sidebar .clicalble',function() {
		if(jQuery(this).data('level-id') != jQuery('.idc_lightbox select[name="level_select"]').val()) {
			jQuery('.sponsor-box.ign-supportnow a.large').trigger('click');
			jQuery(document).find('.main-submit-wrapper #reset').trigger('click');
			jQuery('.idc_lightbox select[name="level_select"]').val(jQuery(this).data('level-id')).trigger('change');
			jQuery('.idc_lightbox input[name="total"]').trigger('focusout');
			if(jQuery('.idc_lightbox input[name="total"]').val() != '' && jQuery('.idc_lightbox input[name="total"]').val() != '0'){
				jQuery(document).find('.btn.lb_level_submit').trigger('click');
			}
		} else {
			jQuery('.sponsor-box.ign-supportnow a.large').trigger('click');
			jQuery('.idc_lightbox select[name="level_select"]').val(jQuery(this).data('level-id')).trigger('change');
			jQuery('.idc_lightbox input[name="total"]').trigger('focusout');
			if(jQuery('.idc_lightbox input[name="total"]').val() != '' && jQuery('.idc_lightbox input[name="total"]').val() != '0'){
				jQuery(document).find('.btn.lb_level_submit').trigger('click');
			}
		}
    });
});