function copyToClipboard(text) {window.prompt("Copy to clipboard: Ctrl+C, Enter", text);}
jQuery(document).ready(function() {
	jQuery('.share_link').on("click", "a", function(){
			var url = jQuery(this).parents('.share_link').find('span').text();
			copyToClipboard(url);
	});
	var hleft = jQuery('.project-left').height();
	jQuery('.project-right').height(hleft).css('line-height',hleft+'px');
	/*if(jQuery('.sidebar-menu').length){
		// grab the initial top offset of the navigation 
	   	var stickyNavOv = jQuery('.wide_content .sidebar-menu').offset();
	   	var stickyNavTop = stickyNavOv.top+30;
	   	var stickyNavLeft = 0;//stickyNavOv.left+15;
	   	var stickyWidth = jQuery('.wide_content .sidebar-menu').width();
	   	var stickyHeight = jQuery('.wide_content .sidebar-menu .whitebox.active').height();
	   	var stickyEnd = jQuery('.footer-bottom').offset().top -stickyHeight +20;
	   	// our function that decides weather the navigation bar should have "fixed" css position or not.
	   	var stickyNav = function(){
		    var scrollTop = jQuery(window).scrollTop(); // our current vertical position from the top
		    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
		    // otherwise change it back to relative
		    if (scrollTop > stickyNavTop && scrollTop < stickyEnd ) { 
		        jQuery('.wide_content .sidebar-menu .whitebox.active').addClass('sticky').css('left',stickyNavLeft).width(stickyWidth);
		    } else {
		    	jQuery('.wide_content .sidebar-menu .whitebox.active').removeClass('sticky'); 
		    }
		};
		stickyNav();
		// and run it again every time you scroll
		jQuery(window).scroll(function() {
			stickyNav();
		});
	}*/
	if(jQuery('.project-nav-above').length){
		/*jQuery(".project-nav-above").on("click", "a", function(){
			var rel = jQuery(this).attr('rel');
			jQuery(".project-nav-above a").removeClass('active');jQuery(this).addClass('active');
			jQuery('.sidebar-menu .whitebox').removeClass('active'); jQuery('.sidebar-menu .whitebox.sidebar-'+rel).addClass('active');
			jQuery('.content_tab_container').removeClass('active'); jQuery('.content_tab_container.content_tab_'+rel).addClass('active');
		});*/
		jQuery(".project-nav-above").on("click", "a", function(){
			var rel = jQuery(this).attr('rel');
			jQuery(".project-nav-above a").removeClass('active');jQuery(this).addClass('active');
			jQuery('#dashboard-slides .jssorb01 div:eq("'+rel+'")').trigger('click');
		});
	}
	
});