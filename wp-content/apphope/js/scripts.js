(function($) {

	$.fn.isBound = function(type, fn) {
    var data = this.data('events')[type];

    if (data === undefined || data.length === 0) {
        return false;
    }

    return (-1 !== $.inArray(fn, data));
	};
    $.fn.extend( {
        limiter: function(limit, elem) {
            $(this).on("keyup focus", function() {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                elem.html( (limit - chars)+'/'+limit);
            }
            setCount($(this)[0], elem);
        }
    });
})(jQuery);
function cats_filter(){
  jQuery('.content_tab_built .built-single').hide();
  jQuery("#author-content .cats_filter a:not(.off)").each(function(){ var rel = jQuery(this).attr('rel');	jQuery('.content_tab_built .built-single.'+rel).show();})
}
function filter_entries(obj){
	var cur_search = jQuery('input.search-input').val().toLowerCase();
	console.log(cur_search);
	jQuery('.entries div.entry').hide();
	jQuery('.entries div.entry').each(function(el){
		var fl = 1;
		var innertext = jQuery(this).text();
		if(cur_search.length>3){ if (innertext.toLowerCase().indexOf(cur_search) < 0) fl=0; }
		if(fl) jQuery(this).show();
	})
}

jQuery(document).ready(function(){


	//bbpress forum modal reply
    jQuery(".dr_reply_btn").click(function(){
        jQuery(".dr_reply_background").fadeIn();
        jQuery(".dr_reply").fadeIn();
		//jQuery("#bbp_reply_content_ifr").focus();
		tinyMCE.activeEditor.focus();
        return false;
    });
    jQuery(".dr_reply_single_form_btn").click(function(){
        jQuery(".dr_reply_single_form_background").fadeIn();
        jQuery(".dr_reply_single_form").fadeIn();
		jQuery("#bbp_topic_title").focus();
        return false;
    });
    jQuery(".dr_reply_background").click(function(){
        jQuery(".dr_reply_background").fadeOut();
        jQuery(".dr_reply").fadeOut();
		jQuery("#bbp_reply_content_ifr").blur();
    });
    jQuery(".dr_reply_single_form_background").click(function(){
        jQuery(".dr_reply_single_form_background").fadeOut();
        jQuery(".dr_reply_single_form").fadeOut();
		jQuery("#bbp_topic_title").blur();
    });

    jQuery(".dr_close_reply").click(function(){
        jQuery(".dr_reply_background").fadeOut();
        jQuery(".dr_reply").fadeOut();
		jQuery("#bbp_reply_content_ifr").blur();
    });

    jQuery(".dr_close_reply").click(function(){
        jQuery(".dr_reply_single_form_background").fadeOut();
        jQuery(".dr_reply_single_form").fadeOut();
		jQuery("#bbp_topic_title").blur();
    });
    /**
     * this workaround makes magic happen
     * thanks @harry: http://stackoverflow.com/questions/18111582/tinymce-4-links-plugin-modal-in-not-editable
     */

var global_width = jQuery(window).width();
//
if(global_width<600){
	jQuery('#mc_embed_signup .input, .signup-form .input').attr('placeholder','Enter your email here');
}
//
//
jQuery(".mobile-menu").on("click", "a", function(){
	if(jQuery(this).hasClass('active')) {jQuery(this).removeClass('active');jQuery('.mobile-menu-div').removeClass('active');}
	else{
		jQuery(this).addClass('active');jQuery('.mobile-menu-div').addClass('active');
	}
});
//
if(jQuery('.author-links').length){
	jQuery(".author-links").on("click", "a", function(){
		var rel = jQuery(this).attr('rel');
		jQuery(".author-links a").removeClass('active');jQuery(this).addClass('active');
		jQuery('#author-slides .jssorb01 div:eq("'+rel+'")').trigger('click');
	});
	jQuery("#author-content .cats_filter").on("click", "a", function(){
		jQuery(this).toggleClass('off');
		cats_filter();
	});
}
//
jQuery('.facebook_trigger').on("click", function(){
	jQuery('.idsocial-wp-fb-login .fb-login-button iframe').trigger('click');
});
//
if(jQuery('.bbpress').length){
	jQuery('.bbpress .forum-jumpto').on("click", "strong", function(){
		jQuery(this).parents('.forum-jumpto').find('.popup').toggle();
	});
}
//
if(jQuery('.blog-jumpto').length){
	jQuery('.blog-jumpto').on("click", "strong", function(){
		jQuery(this).parents('.blog-jumpto').find('.popup').toggle();
	});
}
	jQuery("#header-bar .search").on("click", "a.asearch", function(){ jQuery("#search-bar").toggle(); });
	jQuery("#search-bar .container").on("click", ".fa", function(){ jQuery("#search-bar").hide(); });
	jQuery(".searchbar span strong").on("click", "strong", function(){
		jQuery(this).parents('strong').find('.popup').toggle();
	});
	jQuery(".saveform").on("click", function(){
		jQuery('.superform').parents('form').submit();
	});
	if(jQuery(".graygrid .btn.showmore").length){
		/*jQuery(".graygrid").on("click",".btn.showmore", function(){
			var padtop = jQuery(".graygrid .grid-small-inner").css('padding-top');
			var height = jQuery(".graygrid .grid-small-inner").height();
			var curtop = jQuery(".graygrid .grid-small-inner").css('top').replace('px','');
			if((curtop-318) > (0 - height)) jQuery(".graygrid .grid-small-inner").stop().animate({top: "-=318"}, 800);
			else {
				jQuery(".graygrid .grid-small-inner").css('top','318px').animate({top: "0"}, 800);
			}
		});*/
		var grid_content = jQuery('.graygrid .grid-small-inner').html();
		jQuery(".graygrid").on("click",".btn.showmore", function(){
			var padtop = jQuery(".graygrid .grid-small-inner").css('padding-top');
			var height = jQuery(".graygrid .grid-small-inner").height();
			var curtop = jQuery(".graygrid .grid-small-inner").css('top').replace('px','');
			if((curtop-477) > (0 - height)) jQuery(".graygrid .grid-small-inner").stop().animate({top: "-=318"}, 800);
			else {
				jQuery(".graygrid .grid-small-inner").append(grid_content);
				jQuery(".graygrid .grid-small-inner").stop().animate({top: "-=318"}, 800);
			}
		});
	}
	jQuery(".page-template-page-faq .wide_content.gray .main .whitebox, .faq .whitebox").on("click", "h4.entry", function(){
		if(jQuery(this).hasClass('active')) {
			jQuery(this).removeClass('active');
			jQuery(this).next('.entry_content').slideUp();
		}
		else{
			jQuery(this).parents('.whitebox').find('.entry_content').hide();
			jQuery(this).parents('.whitebox').find('h4.entry').removeClass('active');
			jQuery(this).addClass('active');
			jQuery(this).next('.entry_content').slideDown();
		}
	});
	jQuery(".guidebook-sidebar .whitebox.parted").on("click", ".title.current", function(){
		if(jQuery(this).hasClass('active')) {jQuery(this).removeClass('active');jQuery(this).next('.part').slideUp();}
		else{
			jQuery(this).parents('.whitebox').find('.part').hide();jQuery(this).parents('.whitebox').find('.title').removeClass('active');
			jQuery(this).addClass('active');jQuery(this).next('.part').slideDown();
		}
	});
	jQuery(".faq-sidebar .whitebox.parted").on("click", ".title.current", function(){
		if(jQuery(this).hasClass('active')) {jQuery(this).removeClass('active');jQuery(this).next('.part').slideUp();}
		else{jQuery(this).parents('.whitebox').find('.part').hide();jQuery(this).parents('.whitebox').find('.title').removeClass('active');
			jQuery(this).addClass('active');jQuery(this).next('.part').slideDown();
		}
	});
	var width = jQuery(document).width();
	var cwidth = jQuery('#header-bar .container').outerWidth();
	if(global_width>768){
		jQuery(".login .popup-action.fancy").fancybox({
			live: false,padding: 0,autoCenter: false,
			beforeShow: function() {
				var position = this.element.offset();
				var box_width = jQuery('.login-box:first').width();
				var new_left = position.left - box_width/2;
				position.top += 65;
				if(new_left+box_width<=width) {
					position.left += 0 - box_width/2;
					jQuery(".login-box .arrow-up").css('margin-left','25px').css('left','50%');
				}
				else {
					position.left = width - box_width -30;
					var diffe = new_left - position.left;
					var new_arrow_left = (parseFloat(box_width/2)+diffe+30);
					jQuery(".login-box .arrow-up").css('margin-left',0).css('left',new_arrow_left+'px');
				}
				jQuery.fancybox._getPosition = function() { return position; }
			}
		});
		jQuery(".user_avatar.popup-action.fancy").fancybox({
			live: false,padding: 0,autoCenter: false,
			beforeShow: function() {
				var position = this.element.offset();
				var box_width = jQuery('.login-box:first').width();
				var new_left = position.left - box_width/2;
				position.top += 65;
				if(new_left+box_width<=width) {
					position.left += 0 - box_width/2;
					jQuery(".login-box .arrow-up").css('margin-left','20px').css('left','50%');
				}
				else {
					position.left = width - box_width -30;
					var diffe = new_left - position.left;
					var new_arrow_left = (parseFloat(box_width/2)+diffe+30);
					jQuery(".login-box .arrow-up").css('margin-left',0).css('left',new_arrow_left+'px');
				}
				jQuery.fancybox._getPosition = function() { return position; }
			}
		});
	}
	else{
		jQuery(".login .popup-action").addClass('bound');
	}
	
	jQuery('.bbp-admin-links .bbp-topic-reply-link,.bbp-admin-links .bbp-reply-to-link').on('click',function(){
		jQuery(".forum-fancy").trigger('click');
	});
	if(jQuery(".popup-new-message").length){
		jQuery(".popup-new-message").fancybox({
			padding: 0,autoCenter: true
		});
		jQuery('#new-message-popup form').on('submit',function(){
			var fl=0;var ta = jQuery('#new-message-popup form textarea[name=message_content]');
			var tav = ta.val();
			if(!tav.length){
				ta.addClass('error');
				fl=1;
			}
			var inp = jQuery('#new-message-popup form input[name=message_title]:visible');
			var inpv = inp.val();
			console.log(inp.length);
			if(inp.length){
				if(!inpv.length){
					console.log('add error');
					inp.addClass('error');
					fl=1;
				}
			}
			if(fl) return false;
		})
	}
	jQuery(".forum-fancy").fancybox({
		padding: 0,autoCenter: true
	});
	jQuery(".profile_popup").fancybox({
		padding: 0,autoCenter: true
	});
	jQuery(".wp-report-post-link").fancybox({
		padding: 0,autoCenter: true
	});
	jQuery(".login").on("click", "a.popup-action-login.bound", function(){
		jQuery('.login-box:not(#login)').hide();jQuery('#login').toggle();
	});
	jQuery(".login").on("click", "a.popup-action-signup.bound", function(){
		jQuery('.login-box:not(#signup)').hide();jQuery('#signup').toggle();
	});
	jQuery(".login").on("click", "a.user_avatar.popup-action.bound", function(){
		jQuery('.login-box:not(#profile-box)').hide();jQuery('#profile-box').toggle();
	});


	jQuery(document).scroll(function() {
  		if(jQuery(window).scrollTop() > (jQuery(window).height() - 180)){
  			jQuery('#scrollUp').removeClass('scrollOut').addClass('scrollIn');
  			jQuery("#scrollUp").css('display','block');
  		}
  		else if(jQuery(window).scrollTop() < (jQuery(window).height() - 180)){
   			jQuery('#scrollUp').removeClass('scrollIn').addClass('scrollOut');
  		}
	});
	jQuery("#scrollUp").on("click", function(event){
		jQuery("html, body").animate({ scrollTop: 0 }, 500);
	});


if(jQuery('#fes').length){
  
	  var geocoder;
/*  if (navigator.geolocation) {navigator.geolocation.getCurrentPosition(successFunction, errorFunction);}*/ 
    geocoder = new google.maps.Geocoder();
  function codeLatLng(lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
      var city, region, route, str_number, postal_code,country;
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) { //console.log(results);
        if (results[0]) {
            console.log(results);
            jQuery.each(results[0].address_components, function (k, v) {
                if (v.types[0] == "street_number") {
                    str_number = v.short_name;
                }
                if (v.types[0] == "route") {
                    route = v.long_name;
                }
                if (v.types[0] == "locality") {
                    city = v.long_name;
                }
                if (v.types[0] == "country") {
                    country = v.long_name;
                }
                if (v.types[0] == "administrative_area_level_1") {
                    region = v.short_name;
                }
                console.log(city);
                console.log(country);
                console.log(region);
                jQuery('#project_city').val(city);
                jQuery('#project_country').val(country);
                jQuery('#project_state').val(region);
            });



            } else {
             /* alert("No results found");*/
            }
      } else {
        /*alert("Geocoder failed due to: " + status);*/
      }
    });
  }
	jQuery('.add-level').on("click",function(){ // When btn is pressed.
		var curr =   parseInt(jQuery("input#project_levels").val());
	    jQuery("input#project_levels").val(curr+1); // Disable the button, temp.
	     jQuery("input#project_levels").trigger('change');
	});
	jQuery('.add-digital-level').on("click",function(){ // When btn is pressed.
		var curr =   parseInt(jQuery("input#digital_levels").val());
		console.log('curr:'+curr);
	    jQuery("input#digital_levels").val(parseInt(curr)+1); // Disable the button, temp.
	    jQuery("input#digital_levels").trigger('change');
	});
	
    var lat = jQuery('#project_map_lat').val();//41.896136; //default latitude
    var lng = jQuery('#project_map_lng').val();//-87.648304; //default longitude
    if(lat==0) lat = 41.896136;
    if(lng==0) lng = -87.648304;
    var homeLatlng = new google.maps.LatLng(lat, lng); //set default coordinates
    var myOptions = {
      center: new google.maps.LatLng(lat,lng), //set map center
      zoom: 16, //set zoom level to 16
      mapTypeId: google.maps.MapTypeId.ROADMAP //set map type to road map
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions); //initialize the map
    var homeMarker = new google.maps.Marker({ //set marker
      position: homeLatlng, //set marker position equal to the default coordinates
      map: map, //set map to be used by the marker
      draggable: true //make the marker draggable
    });
    
    //if the position of the marker changes set latitude and longitude to 
    //current position of the marker
    google.maps.event.addListener(homeMarker, 'position_changed', function(){
      var lat = homeMarker.getPosition().lat(); //set lat current latitude where the marker is plotted
      var lng = homeMarker.getPosition().lng(); //set lat current longitude where the marker is plotted
    });    
    
    //if the center of the map has changed
    google.maps.event.addListener(map, 'center_changed', function(){
      var lat = homeMarker.getPosition().lat(); //set lat to current latitude where the marker is plotted
      var lng = homeMarker.getPosition().lng(); //set lng current latitude where the marker is plotted
    });
    var input = document.getElementById('search_new_places'); //get element to use as input for autocomplete
    var autocomplete = new google.maps.places.Autocomplete(input); //set it as the input for autocomplete
    autocomplete.bindTo('bounds', map); //bias the results to the maps viewport
    
    //executed when a place is selected from the search field
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
        
        //get information about the selected place in the autocomplete text field
        var place = autocomplete.getPlace(); 
        
        if (place.geometry.viewport){ //for places within the default view port (continents, countries)
          map.fitBounds(place.geometry.viewport); //set map center to the coordinates of the location
        } else { //for places that are not on the default view port (cities, streets)
          map.setCenter(place.geometry.location);  //set map center to the coordinates of the location
          map.setZoom(16); //set a custom zoom level of 17
        }
        homeMarker.setMap(map); //set the map to be used by the  marker
        homeMarker.setPosition(place.geometry.location); //plot marker into the coordinates of the location 
  
    });
  jQuery('#plot_marker').click(function(e){ //used for plotting the marker into the map if it doesn't exist already
      e.preventDefault(); 
      homeMarker.setMap(map); //set the map to be used by marker
      homeMarker.setPosition(map.getCenter()); //set position of marker equal to the current center of the map
      map.setZoom(16);
      var lat = homeMarker.getPosition().lat();
      var lng = homeMarker.getPosition().lng();
      jQuery('#project_map_lng').val(lng);
      jQuery('#project_map_lat').val(lat);
      codeLatLng(lat, lng);
      /*jQuery('input[type=text], input[type=hidden]').val('');*/
  });
  
  
  /*jQuery('#search_ex_places').blur(function(){//once the user has selected an existing place
      var place = jQuery(this).val();
      //initialize values
      var exists = 0;
      var lat = 0; 
      var lng = 0;
      jQuery('#saved_places option').each(function(index){ //loop through the save places
        var cur_place = jQuery(this).data('place'); //current place description
        
        //if current place in the loop is equal to the selected place
        //then set the information to their respected fields
        if(cur_place == place){ 
          exists = 1;
          jQuery('#place_id').val(jQuery(this).data('id'));
          lat = jQuery(this).data('lat');
          lng = jQuery(this).data('lng');
          jQuery('#n_place').val(jQuery(this).data('place'));
          jQuery('#n_description').val(jQuery(this).data('description'));
        }
      });
      
      if(exists == 0){//if the place doesn't exist then empty all the text fields and hidden fields
        jQuery('input[type=text], input[type=hidden]').val('');
        
      }else{
        //set the coordinates of the selected place
        var position = new google.maps.LatLng(lat, lng);
        
        //set marker position
        homeMarker.setMap(map);
        homeMarker.setPosition(position);
        //set the center of the map
        map.setCenter(homeMarker.getPosition());
        map.setZoom(16);
        
      }
    });*/
    
    
    /*jQuery('#btn_save').click(function(){
      var place   = jQuery.trim(jQuery('#n_place').val());
      var description = jQuery.trim(jQuery('#n_description').val());
      var lat = homeMarker.getPosition().lat();
      var lng = homeMarker.getPosition().lng();
      jQuery.post('save_place.php', {'place' : place, 'description' : description, 'lat' : lat, 'lng' : lng}, 
        function(data){
          var place_id = data;
          var new_option = jQuery('<option>').attr({'data-id' : place_id, 'data-place' : place, 'data-lat' : lat, 'data-lng' : lng, 'data-description' : description}).text(place);
          new_option.appendTo(jQuery('#saved_places'));
        }
      );
      jQuery('input[type=text], input[type=hidden]').val('');
    });*/
	}
	/*jQuery('.page-template-page-guidebook-started #search-input,.page-template-page-faq #search-input').keyup(function(){
		filter_entries();
	})*/


    if (jQuery('#edit-profile').length) {

        var geocoder;
        /*  if (navigator.geolocation) {navigator.geolocation.getCurrentPosition(successFunction, errorFunction);}*/
        geocoder = new google.maps.Geocoder();
        function usercodeLatLng(lat, lng) {
            console.log('dsadsadsa');
            var latlng = new google.maps.LatLng(lat, lng);
            var arr_location = [
                'Australia',
                'Canada',
                'France',
                'Hong Kong',
                'Ireland',
                'Japan',
                'Luxembourg',
                'Singapore',
                'United Kingdom',
                'United States of America',
                'United States',
                'USA'
            ];
            var city = region = region2 = route = postal_code = country = '';
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    if (results[0]) {
                        jQuery('.zip').val('');
                        jQuery('.address').val('');
                        jQuery('.city').val('');
                        jQuery('.country').val('');
                        jQuery('.state').val('');
                        jQuery('.address_two').val('');

                        jQuery.each(results[0].address_components, function (k, v) {
                            if (v.types[0] == "street_number") {
                                str_number = v.short_name;
                            }
                            if (v.types[0] == "route") {
                                route = v.long_name;
                            }
                            if (v.types[0] == "locality") {
                                city = v.long_name;
                            }
                            if (v.types[0] == "country") {
                                country = v.long_name;
                            }
                            if (v.types[0] == "postal_code") {
                                postal_code = v.long_name;
                            }
                            if (v.types[0] == "administrative_area_level_1") {
                                region = v.long_name;
                            }
                            if (v.types[0] == "administrative_area_level_2") {
                                region2 = v.long_name;
                            }

                            if (postal_code) jQuery('.zip').val(postal_code);
                            if(country && arr_location.indexOf(country) != -1 ){
                                if (route && str_number) jQuery('.address').val(str_number + ' ' + route);
                            } else {
                                if (route && str_number) jQuery('.address').val(route + ' ' + str_number);
                            }

                            if (city) jQuery('.city').val(city);
                            if (country) jQuery('.country').val(country);
                            if (region && region2) jQuery('.state').val(region);

                        });



                    } else {
                        /* alert("No results found");*/
                    }
                } else {
                    /*alert("Geocoder failed due to: " + status);*/
                }
            });
        }

        var lat = jQuery('#user_map_lat').val();//41.896136; //default latitude
        var lng = jQuery('#user_map_lng').val();//-87.648304; //default longitude
        if (lat == 0) lat = 41.896136;
        if (lng == 0) lng = -87.648304;
        var homeLatlng = new google.maps.LatLng(lat, lng); //set default coordinates
        var myOptions = {
            center: new google.maps.LatLng(lat, lng), //set map center
            zoom: 16, //set zoom level to 16
            mapTypeId: google.maps.MapTypeId.ROADMAP //set map type to road map
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions); //initialize the map
        var homeMarker = new google.maps.Marker({ //set marker
            position: homeLatlng, //set marker position equal to the default coordinates
            map: map, //set map to be used by the marker
            draggable: true //make the marker draggable
        });

        //if the position of the marker changes set latitude and longitude to
        //current position of the marker
        google.maps.event.addListener(homeMarker, 'position_changed', function () {
            var lat = homeMarker.getPosition().lat(); //set lat current latitude where the marker is plotted
            var lng = homeMarker.getPosition().lng(); //set lat current longitude where the marker is plotted
            usercodeLatLng(lat, lng);
        });


        //if the center of the map has changed
        google.maps.event.addListener(map, 'center_changed', function () {
            var lat = homeMarker.getPosition().lat(); //set lat to current latitude where the marker is plotted
            var lng = homeMarker.getPosition().lng(); //set lng current latitude where the marker is plotted
            usercodeLatLng(lat, lng);
        });

        function initialize(){
            var input = document.getElementById('search_new_places'); //get element to use as input for autocomplete
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            //executed when a place is selected from the search field
            google.maps.event.addListener(autocomplete, 'place_changed', function () {

                //get information about the selected place in the autocomplete text field
                var place = autocomplete.getPlace();
                console.log('dsadsas');
                if (place.geometry.viewport) { //for places within the default view port (continents, countries)
                    map.fitBounds(place.geometry.viewport); //set map center to the coordinates of the location
                } else { //for places that are not on the default view port (cities, streets)
                    map.setCenter(place.geometry.location);  //set map center to the coordinates of the location
                    map.setZoom(16); //set a custom zoom level of 17
                }
                homeMarker.setMap(map); //set the map to be used by the  marker
                homeMarker.setPosition(place.geometry.location); //plot marker into the coordinates of the location

            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        
        jQuery('#plot_marker').click(function (e) { //used for plotting the marker into the map if it doesn't exist already
            e.preventDefault();
            homeMarker.setMap(map); //set the map to be used by marker
            homeMarker.setPosition(map.getCenter()); //set position of marker equal to the current center of the map
            map.setZoom(16);
            var lat = homeMarker.getPosition().lat();
            var lng = homeMarker.getPosition().lng();
            jQuery('#user_map_lng').val(lng);
            jQuery('#user_map_lat').val(lat);
            usercodeLatLng(lat, lng);
            /*jQuery('input[type=text], input[type=hidden]').val('');*/
        });
    }


	jQuery('#edit-profile input[type="text"],#edit-profile textarea,#edit-profile select,#edit-account input[type="email"],#edit-account input[type="password"],#edit-account input[type="text"],#edit-account textarea,#edit-account select').tooltipster({ 
        trigger: 'click', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });
	jQuery('.info').tooltipster({ 
        trigger: 'hover', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });
    if(jQuery(".project_creation").length){
	    jQuery("#project_tags").chosen({max_selected_options: 3});
		jQuery('.project_creation #fes .itooltip').tooltipster({ 
	        trigger: 'click', // default is 'hover' which is no good here
	        onlyOne: false,    // allow multiple tips to be open at a time
	        position: 'right'  // display the tips to the right of the element
	    });
	    /*var text_max = 135;
	    var text_length = jQuery('.project_creation #fes #project_short_description').val().length;
	    var text_remaining = text_max - text_length;
	    console.log(text_remaining);
	    jQuery('.project_creation #fes .textarea_feedback').text(text_remaining + '/' + text_max);
	    jQuery('.project_creation #fes #project_short_description').keyup(function() {
	        var text_length = jQuery('.project_creation #fes #project_short_description').val().length;
	        var text_remaining = text_max - text_length;
	        if(text_remaining<=0) return false;
	        jQuery('.project_creation #fes .textarea_feedback').text(text_remaining + '/' + text_max);
	    });*/
	    jQuery('.project_creation #fes #project_short_description').limiter(135, jQuery('.project_creation #fes .textarea_feedback'));
		jQuery(".project_creation .whitebox.parted").on("click", ".title", function(){
			var rel = jQuery(this).attr('rel');
			jQuery(".project_creation .whitebox.parted .title").removeClass('active');
			jQuery(this).addClass('active');
			jQuery(".project_creation #fes .id-fes-form-wrapper .fes_section").removeClass('active');
			jQuery(".project_creation #fes .id-fes-form-wrapper .fes_section."+rel).addClass('active');
			if(rel=='location') { map.getCenter(); google.maps.event.trigger(map, 'resize'); map.setCenter(map.getCenter()); }
		});
	}
	if(jQuery('.guidebook-sidebar').length&& global_width>1200){
	    var $sidebar   = jQuery(".guidebook-sidebar"), $window    = jQuery(window),  offset = $sidebar.offset(), topPadding = 15;
	    var $main = jQuery('.main-content .col-lg-10');$main_height = $main.height();$sidebar_height = $sidebar.height();
	    $window.scroll(function() {
		    if(global_width>1200){
	        if ($window.scrollTop() > offset.top) {
		        if($window.scrollTop()> ($main.offset().top+$main_height-$sidebar_height)){}
	            else $sidebar.stop().animate({  marginTop: $window.scrollTop() - offset.top + topPadding  });
	        } else {   $sidebar.stop().animate({   marginTop: 0    });   }
	      }
	      else $sidebar.css('marginTop',0);
	    }); 	
	}
	if(jQuery('.faq-sidebar').length&& global_width>1200){
	    var $sidebar   = jQuery(".faq-sidebar"), $window    = jQuery(window),  offset = $sidebar.offset(), topPadding = 15;
	    var $main = jQuery('.main.entries'), $main_height = $main.height(), $sidebar_height = $sidebar.height();
	    $window.scroll(function() {
		    var global_width = jQuery(window).width();
		    if(global_width>1200){
	        if ($window.scrollTop() > offset.top) {
		        if($window.scrollTop()> ($main.offset().top+$main_height-$sidebar_height)){}
	            else $sidebar.stop().animate({  marginTop: $window.scrollTop() - offset.top + topPadding  });
	        } else {   $sidebar.stop().animate({   marginTop: 0    });   }
	      }
	      else $sidebar.css('marginTop',0);
	    }); 	
	}
	if(jQuery('#ign-project-content .slides .sidebar-menu').length&& global_width>1200){
	    var $window    = jQuery(window), $slds  = jQuery("#ign-project-content .slides"), offset = $slds.offset(), topPadding = 90;
	    $window.scroll(function() {
		    var global_width = jQuery(window).width();
		    if(global_width>1200){
					var $sidebar  = jQuery("#ign-project-content .slides .slide.active .sidebar-menu"), $main = jQuery('.slides .slide.active .col-lg-10'), $main_height = $main.height(), $sidebar_height = $sidebar.find('.whitebox').height();
					//console.log($window.scrollTop()+'---');
					//console.log($window.scrollTop() + '---'+offset.top);
	        if ($window.scrollTop() > offset.top) {
		        if($window.scrollTop()> ($main.offset().top+$main_height-$sidebar_height)){}
	            else $sidebar.stop().animate({  paddingTop: $window.scrollTop() - offset.top + topPadding  });
	        } else {   $sidebar.stop().animate({   paddingTop: 0    });   }
	      }
	      else $sidebar.css('paddingTop',0);
	    }); 	
	}
	if(jQuery('.dashboard-sidebar').length&& global_width>1200){
	    var $sidebar   = jQuery(".dashboard-sidebar"), $window    = jQuery(window),  offset = $sidebar.offset(), topPadding = 15;
	    var $main = jQuery('.memberdeck .mt .col-lg-10').length?jQuery('.memberdeck .mt .col-lg-10'):jQuery('.wide_content.project_creation .ignitiondeck'), $main_height = $main.height(), $sidebar_height = $sidebar.height();
	    $window.scroll(function() {
		    if(global_width>1200){
	        if ($window.scrollTop() > offset.top) {
		        if($window.scrollTop()> ($main.offset().top+$main_height-$sidebar_height)){}
	            else $sidebar.stop().animate({  marginTop: $window.scrollTop() - offset.top + topPadding  });
	        } else {   $sidebar.stop().animate({   marginTop: 0    });   }
	      }
	      else $sidebar.css('marginTop',0);
	    }); 	
	}
	if(jQuery(".adv_search").length){
		jQuery(".adv_search .adv_search_popup .tags").on("click", ".tag", function(){
			var rel = jQuery(this).attr('rel');
			jQuery(this).toggleClass('active');
			var active = jQuery(this).hasClass('active')? 'checked':false;
			jQuery(".adv_search .adv_search_popup input.check_tags[value='"+rel+"']").prop('checked', active);
		});
		jQuery(".adv_search").on("click", "span", function(){
			jQuery(".adv_search .adv_search_popup").toggle();
		});
		jQuery(".searchbar span strong .popup").on("click", "span:not(.tri)", function(){
			var parent = jQuery(this).parents('strong');
			var rel =  jQuery(this).parents('.popup').attr('rel');
			var vtext = jQuery(this).text();
			var vurl = jQuery(this).attr('rel');
			/*if(rel=='category') window.location.href = "/category/"+vurl+"/";
			if(rel=='place') window.location.href = "/category/"+vurl+"/"+;*/
			//else{
			    /*var category = jQuery('#ajax-params input[name=category]').val();
			    var place = jQuery('#ajax-params input[name=place]').val();
			    var orderby = jQuery('#ajax-params input[name=orderby]').val();*/
				jQuery('input[name="'+rel+'"]').val(vtext);
				parent.find('strong').text(vtext);jQuery(this).parents('strong').find('.popup').hide();
				preload_posts(0);
			//}
		});
	}

	/*var string = window.location.pathname.substr(1);
	jQuery('#fep-menu').append('<a class="scroll title" href="http://dream.local.com/messages/?fepaction=announcements">Add Reply</a>');*/

});


jQuery(document).click( function(event) {
	if(!jQuery(event.target).closest('.forum-jumpto strong').length && !jQuery(event.target).closest('.blog-jumpto strong').length && !jQuery(event.target).closest('.category .searchbar span strong').length && !jQuery(event.target).is('.page-template-page-category .searchbar span strong') && !jQuery(event.target).is('.blog-jumpto strong') && !jQuery(event.target).is('.forum-jumpto strong')) {
        if(jQuery('.popup').is(":visible")) {
            jQuery('.popup').hide();
        }
    }
	if(!jQuery(event.target).closest('.adv_search').length && !jQuery(event.target).is('.adv_search')) {
        if(jQuery('.adv_search_popup').is(":visible")) {
            jQuery('.adv_search_popup').hide();
        }
    }
});
jQuery(window).on('resize', function(){
      var win = jQuery(this); //this = window
      if(win.width()<=768){
	      jQuery(".login .popup-action,.user_avatar.popup-action").removeClass('fancy');
	      jQuery('.login .popup-action,.user_avatar.popup-action').off("click.fb-start");
				jQuery(".login .popup-action").addClass('bound');
      }
      else{
	      jQuery(".login .popup-action,.user_avatar.popup-action").addClass('fancy');
				jQuery(".login .popup-action").removeClass('bound');
      }
});

 jQuery(document).ready(function(){

 });