var is_edit=false;
var _pcenter= new google.maps.LatLng(21.765478, 104.220212);
var myOptions = { 
	zoom: 13, 
	center: _pcenter, 
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	copyrights:"NXTUYEN.PRO@GMAIL.COM"
};
var _map=new google.maps.Map(document.getElementById("map-container"), myOptions);
var FirstMarker= new google.maps.Marker({
	map: _map,
	anchorPoint: new google.maps.Point(0, -29)
});
var infowindow = new google.maps.InfoWindow();
var geocoder = new google.maps.Geocoder;
ShowMarker();
if(is_edit==false) {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}else createMarker($('#point_start').val());

function showPosition(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  $('#point_start').val(lat+','+lng);
  _pcenter=coords=new google.maps.LatLng(lat,lng)
  _map.setCenter(_pcenter);
  var CurentMarker = new google.maps.Marker({
	  clickable: false,
      position: coords,
	  animation: google.maps.Animation.DROP,
      map: _map,
	  icon:new google.maps.MarkerImage('http://maps.gstatic.com/mapfiles/mobile/mobileimgs2.png',
			new google.maps.Size(22,22),
			new google.maps.Point(0,18),
			new google.maps.Point(11,11)),
      title:"You are here!"
  });
}

function ShowMarker() {
	var input = document.getElementById('txt_search');
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds',_map);
	
	autocomplete.addListener('place_changed', function() {
		infowindow.close();
		FirstMarker.setVisible(false);
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			window.alert("Autocomplete's returned place contains no geometry");
			return;
		}
		//Gán giá trị lat,lng tìm được vào textbox
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		$('#point_start').val(lat+','+lng);

		// If the place has a geometry, then present it on a map.
		if (place.geometry.viewport) {
			_map.fitBounds(place.geometry.viewport);
		} else {
			_map.setCenter(place.geometry.location);
			_map.setZoom(13);  // Why 17? Because it looks good.
		}
		FirstMarker.setIcon(/** @type {google.maps.Icon} */({
			url: place.icon,
			size: new google.maps.Size(71, 71),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(17, 34),
			scaledSize: new google.maps.Size(35, 35)
		}));
		FirstMarker.setPosition(place.geometry.location);
		FirstMarker.setVisible(true);
		FirstMarker.setDraggable(true);
		
		var address = '';
		if (place.address_components) {
		address = [
		  (place.address_components[0] && place.address_components[0].short_name || ''),
		  (place.address_components[1] && place.address_components[1].short_name || ''),
		  (place.address_components[2] && place.address_components[2].short_name || '')
		].join(' ');
		}
		
		infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		infowindow.open(_map, FirstMarker);
	});
	
	dragEndEvent();
}
function dragEndEvent() {
	google.maps.event.addListener(FirstMarker, 'dragend', function(x) { 
		//Gán giá trị lat,lng tìm được vào textbox
		var lat = x.latLng.lat();
		var lng = x.latLng.lng();
		$('#point_start').val(lat+','+lng);
	});
}
function showInfoEventClick(){
	infowindow.close();
	google.maps.event.addListener(FirstMarker, 'click', function(x) { 
		//infowindow.setContent('<div><strong>' + html + '</strong><br>');
		//infowindow.open(_map, FirstMarker);
		var geocoder = new google.maps.Geocoder();
		var address= name='';
		geocoder.geocode({
			latLng: _pcenter
		}, function(responses){
			if (responses && responses.length >0){
			  address=responses[0].formatted_address;
			  name=responses[0].address_components[0].long_name;
			} else{
			  //Cannot determine address at this location;
			  address="Unknown";
			  name="Unknown";
			}
			infowindow.setContent('<div><strong>' + name + '</strong><br>'+address);
			infowindow.open(_map, FirstMarker);
		});
	});
}
function createMarker(position){
	var arr = position.split(","); 
	var _lat = arr[0];
	var _lng = arr[1];
	_pcenter=new google.maps.LatLng(_lat,_lng);
	_map.setCenter(_pcenter);
	_map.setZoom(13); 
	
	FirstMarker.setPosition(_pcenter);
	FirstMarker.setVisible(true);
	FirstMarker.setDraggable(true);
	
	showInfoEventClick();
	dragEndEvent();
}