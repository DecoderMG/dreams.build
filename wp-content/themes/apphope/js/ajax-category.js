if((jQuery(".category").length||jQuery(".page-template-page-category").length)&&!jQuery(".category-blog").length){

var pageNumber = 1;
function preload_posts(update){
    /*var category = jQuery('#ajax-params input[name=category]').val();
    var place = jQuery('#ajax-params input[name=place]').val();
    var orderby = jQuery('#ajax-params input[name=orderby]').val();*/
    if(!update) {jQuery(".ajax-posts").html('');pageNumber=1;}
    else{pageNumber++;}
    var keywords = jQuery('#search-bar input[name=query]').val();
    jQuery('#ajax-params input[name=key]').val(keywords);
    jQuery('#ajax-params input[name=pageNumber]').val(pageNumber);
	var Data = jQuery("#searchform").serialize();
    load_posts(/*category,orderby,place*/Data,update);
}
function load_posts(Data){
    jQuery(".loading-box").show();
    //var str = '&cat=' + category + '&orderby=' + orderby + '&place=' + place + '&pageNumber=' + pageNumber + '&action=more_post_ajax';
    var total = jQuery('#ajax-params input[name=total]').val();
    jQuery(".loadmore").hide();
    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_posts.ajaxurl,
        data: Data+'&action=more_post_ajax',
        success: function(data){
            var $data = jQuery(data.str);
            jQuery(".loading-box").hide();
            if($data.length){
            	jQuery(".ajax-posts").append($data);
            	if(jQuery(".ajax-posts .category-post").length < data.total && $data!='<p>No posts found</p>') {jQuery(".loadmore").show();}
            }
        }/*,
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }*/

    });
    return false;
}

jQuery(".loadmore").on("click",function(){ // When btn is pressed.
    jQuery(".loadmore").hide(); // Disable the button, temp.
    preload_posts(1);
});
if(jQuery(".category .ajax-posts").length||jQuery(".page-template-page-category .ajax-posts").length){
    var place = jQuery('#ajax-params input[name=place]').val();
    var orderby = jQuery('#ajax-params input[name=orderby]').val();
    jQuery(".category .searchbar span strong .popup[rel=place] strong").text(place);
    jQuery(".category .searchbar span strong .popup[rel=orderby] strong").text(orderby);
	preload_posts(0);
}

}