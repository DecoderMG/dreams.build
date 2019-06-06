jQuery(document).ready(function(){

	jQuery("#header-bar .search").on("click", "a.asearch", function(){
		jQuery("#search-bar").toggle();
	});
	jQuery(".popup-action").fancybox({
		padding: 0,
		/*maxWidth	: 800,
		maxHeight	: 600,*/
		fitToView	: false,
		/*width		: '550',
		height		: '70%',*/
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});