jQuery(function() {
  // scroll handler
  var scrollToAnchor = function( id ) {
    // grab the element to scroll to based on the name
    var elem = jQuery("a[name='"+ id +"']");
    // if that didn't work, look for an element with our ID
    if ( typeof( elem.offset() ) === "undefined" ) {
      elem = jQuery("#"+id);
    }
    // if the destination element exists
    if ( typeof( elem.offset() ) !== "undefined" ) {
      // do the scroll
      jQuery('html, body').animate({
              scrollTop: elem.offset().top - 30
      }, 1000 );
      location.hash = id;
    }
  };
  // bind to click event
  jQuery("a.scroll").click(function( event ) {
    if ( jQuery(this).attr("href").length){// only do this if it's an anchor link
	    if ( jQuery(this).attr("href").match("#") ) {
	      event.preventDefault();// cancel default event propagation
	      var href = jQuery(this).attr('href').replace('#', '')
	      scrollToAnchor( href );
	    }
    }
  });
  if (location.hash.length && !jQuery('#dashboard-slides').length) {
	  var hashv = location.hash.replace('#', '');
	  console.log(hashv);
	  if(hashv.match("faq")){ jQuery('a[name='+hashv+']').next('h4').trigger('click');}
	  scrollToAnchor(hashv);
        //location.href = location.hash;
    }
});