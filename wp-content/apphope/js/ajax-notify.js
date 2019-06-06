if(jQuery('.single-ignition_product').length){
	
	jQuery(".remind-me-later-trigger").fancybox({
		padding: 0,autoCenter: true
	});

function notify_action(category){
    jQuery(".loading-box").show();
    var post_id = jQuery('input[name=post_id]').val();
    var str = '&post_id=' + post_id + '&action=notify_action';
    jQuery.ajax({
        type: "POST",
        dataType: "html",
        url: notify_settings.ajaxurl,
        data: str,
        success: function(data){
            var $data = jQuery(data);
            if(data.search('on')!='-1'){
            	jQuery('.remind-me-later').addClass('active');
							jQuery(".remind-me-later-trigger").click();
            }
            else if(data.search('off')!='-1'){
            	jQuery('.remind-me-later').removeClass('active');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

jQuery(".remind-me-later").on("click",function(){ // When btn is pressed.
		notify_action();
});

}
