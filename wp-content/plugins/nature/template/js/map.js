/*
* www.pooyaa.com
* Copyright (c) 2014 medhati;
*/
$(document).ready(function() {
	var latMap = $("#latMap").val();
	var langMap = $("#langMap").val();
var styles=[{featureType:'all',stylers:[{"visibility":"off"}]},{featureType:'landscape',stylers:[{'visibility':'on'},{color:'#999999'}]},{featureType:'water',stylers:[{'visibility':'on'},{color:'#333333'}]}];var options={mapTypeControlOptions:{mapTypeIds:['Styled']},center:new google.maps.LatLng(latMap,langMap),zoom:6,scrollwheel:false,disableDefaultUI:true,mapTypeId:'Styled'};var div=document.getElementById('mapcontent');var map=new google.maps.Map(div,options);var styledMapType=new google.maps.StyledMapType(styles,{name:'Styled'});map.mapTypes.set('Styled',styledMapType);var marker=new google.maps.Marker({position:new google.maps.LatLng(latMap,langMap),map:map,icon:"media/marker.png",animation:google.maps.Animation.BOUNCE});

});