if(jQuery('.page-template-page-blog').length){
	
var pageNumber = 1;
function preload_posts(){
    var category = jQuery('#ajax-params input[name=category]').val();;/*jQuery('#ajax-params input[name=category]').val();*/
    load_posts(category);
}

function load_posts(category){
    jQuery(".loading-box").show();
    pageNumber++;
    var str = '&pageNumber=' + pageNumber + '&action=more_blog_post_ajax&category=' + category;
    var total = jQuery('#ajax-params input[name=total]').val();
    jQuery.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_blog_posts.ajaxurl,
        data: str,
        success: function(data){
            var $data = jQuery(data);
            jQuery(".loading-box").hide();
            if($data.length){
            	jQuery(".ajax-posts").append($data);
            	if(jQuery(".ajax-posts .entry-content").length < total) jQuery(".loadmore").show();
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

jQuery(".loadmore").on("click",function(){ // When btn is pressed.
    jQuery(".loadmore").hide(); // Disable the button, temp.
    preload_posts();
});

}


