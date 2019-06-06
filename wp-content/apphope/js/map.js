
jQuery(document).ready(function() {
if(jQuery('#fes').length){
	
    var lat = 41.896136; //default latitude
    var lng = -87.648304; //default longitude
    var homeLatlng = new google.maps.LatLng(lat, lng); //set default coordinates
    var homeMarker = new google.maps.Marker({ //set marker
      position: homeLatlng, //set marker position equal to the default coordinates
      map: map, //set map to be used by the marker
      draggable: true //make the marker draggable
    });
    
    var myOptions = {
      center: new google.maps.LatLng(41.899836,-87.635304), //set map center
      zoom: 16, //set zoom level to 16
      mapTypeId: google.maps.MapTypeId.ROADMAP //set map type to road map
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions); //initialize the map
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
      jQuery('input[name=map_lng]').val(lng);
      jQuery('input[name=map_lat]').val(lat);
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

});