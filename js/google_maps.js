$(document).ready(function() {

var map;
var initialize;
 
initialize = function(){
  var latLng = new google.maps.LatLng(14.694437, -17.461937); // Correspond au coordonnées de dakar, arc informatique
  var myOptions = {
    zoom      : 50,
    center    : latLng,
    mapTypeId : google.maps.MapTypeId.TERRAIN, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
  };
 
  map      = new google.maps.Map(document.getElementById('map'), myOptions);

  var marker = new google.maps.Marker({
    position : latLng,
    map      : map,
    title    : "Dakar"
});

  	var contentMarker = '<div style="text-align:center"><img src="images/logo_ARC.png"/></div>'+
  						'	<div><p style="text-align:center">Point E – Tour de L’œuf<br/>'+
  						'	Impasse Face Piscine Olympique<br/>'+
  						' 	B.P 3377</p></div>'+
  						'<div><p style="text-align:center">Tel : (221) 33 859 85 85 - Fax : (221) 33 859 85 84<br/>'+
  						'	Mail : arc@arc.sn </div>';
	var infoWindow = new google.maps.InfoWindow({
    content  : contentMarker,
    position : latLng
});

	google.maps.event.addListener(marker, 'click', function() {
    infoWindow.open(map,marker);
});

};
 
initialize();

});