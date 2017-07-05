var map;
var arrayMakers = [];
var arrayDistance = [];
var UserCoords = { lat: '', lng: '' };
var clickDes;
var DesCoords = { lat: '', lng: '' };
var slide;

var rad = function(x) {
  return x * Math.PI / 180;
};
var getDistance = function(p1, p2) {
  var R = 6378137;
  var dLat = rad(p2.lat() - p1.lat);
  var dLong = rad(p2.lng() - p1.lng);
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat())) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
};
function reloadLocation(){
	getLocation();

	setInterval(function(){
		if(UserCoords.lat == '' && UserCoords.lng == '') {
			getLocation();
		} else {
			map.removeMarkers();
			for(i = 0; i < arrayMakers.length; i ++){
				if(arrayMakers[i].infoWindow.content != 'Vị Trí Của Bạn' ){
					if(!slide) {map.addMarker(arrayMakers[i]);} else
					if(slide > getDistance(UserCoords,arrayMakers[i].position)){
						map.addMarker(arrayMakers[i]);
					}
				}
			}
			checkIn();
			if(clickDes){clickDes.infoWindow.close() };
		}
	},10000);
}
function checkIn(){
	GMaps.geolocate({
		success: function(position){
			my_marker = {
				lat: position.coords.latitude,			
				lng: position.coords.longitude,
				infoWindow: {
					content: 'Vị Trí Của Bạn',
				},
			}
			map.addMarker(my_marker);
		},
		error: function(error){
			alert('Geolocation failed: '+error.message);
		},
		not_supported: function(){
			alert("Your browser does not support geolocation");
		},
	});
}
function geocodeLatLng(geocoder, map) {
  	var input = document.getElementById('latlng').value;
  	var latlngStr = input.split(',', 2);
  	var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
  	geocoder.geocode({'location': latlng}, function(results, status) {
		if (status === 'OK') {
			if (results[1]) {
				map.setZoom(11);
				var marker = new google.maps.Marker({
	  				position: latlng,
	  				map: map
				});
			} else {
				window.alert('No results found');
			}
		} else {
			window.alert('Geocoder failed due to: ' + status);
		}
	});
}
function showNearestLocation(data) {
    if(data.longitude == null && data.latitude == null && data.address != null){
		GMaps.geocode({
			address: data.address.trim(),
			callback: function(results, status) {
				if (status == 'OK') {
					latlng = results[0].geometry.location;
					map.addMarker({
						lat: latlng.lat(),
						lng: latlng.lng(),
						animation: google.maps.Animation.DROP,
						icon: iconMarker,
						infoWindow: {
							content: '<div class="item-support-page" style="width:350px!important;"><img src="https://www.vietnamoto.net/'+ data.thumb + '"><div class="cover-info-support"><h4>' + data.title + '</h4><p>' + data.address + '</p><p class="p-phone"><a href="tel:'+ data.phone +'">' + data.phone + '</a></p></div></div>'
						},
						click: function(e) {
							map.cleanRoute();
    						map.removePolylines();
							map.travelRoute({
							  	origin: [UserCoords.lat, UserCoords.lng],
							  	destination: [e.position.lat(), e.position.lng()],
							  	travelMode: 'driving',
								step: function(e) {
								    map.drawPolyline({
								        path: e.path,
								        strokeColor: '#131540',
								        strokeOpacity: 0.6,
								        strokeWeight: 6
								    });
								}
							});
							clickDes = e;
					  	},
					});
				}
			}
		});
	} else {
		map.addMarker({
			lat: parseFloat(data.latitude),
			lng: parseFloat(data.longitude),
			animation: google.maps.Animation.DROP,
			icon: iconMarker,
			infoWindow: {
				content: '<div class="item-support-page" style="width:350px!important;"><img src="https://www.vietnamoto.net/'+ data.thumb + '"><div class="cover-info-support"><h4>' + data.title + '</h4><p>' + data.address + '</p><p class="p-phone"><a href="tel:'+ data.phone +'">' + data.phone + '</a></p></div></div>'
			},
			click: function(e) {
				map.travelRoute({
				  	origin: [UserCoords.lat, UserCoords.lng],
				  	destination: [e.position.lat(), e.position.lng()],
				  	travelMode: 'driving',
					step: function(e) {
						map.drawPolyline({
							path: e.path,
							strokeColor: '#131540',
							strokeOpacity: 0.6,
							strokeWeight: 6
						});
					}
				});
				clickDes = e;
		  	},
		});
	}
}
function getLocation(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            UserCoords.lat = position.coords.latitude;
            UserCoords.lng = position.coords.longitude;
            map.setCenter(position.coords.latitude, position.coords.longitude);
            map.setZoom(18);
            my_marker = {
				lat: position.coords.latitude,			
				lng: position.coords.longitude,
				infoWindow: {
					content: 'Vị Trí Của Bạn',
				},
			}
			map.addMarker(my_marker);
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}
function built_map(){
	map = new GMaps({
		el: '#map',
		lat: 10.1586824,
		lng: 106.0144933,
		zoom: 6,
		click: function(e) {
			map.removePolylines();
			map.cleanRoute();
			map.travelRoute({
			  	origin: [UserCoords.lat, UserCoords.lng],
			  	destination: [e.latLng.lat(), e.latLng.lng()],
			  	travelMode: 'driving',
				step: function(e) {
					map.drawPolyline({
						path: e.path,
						strokeColor: '#131540',
						strokeOpacity: 0.6,
						strokeWeight: 6
					});
				}
			});
	  	},
	  	disableDefaultUI: true,
	});
	
	$.get('map', function(result) {
		$.each(result, function(index,value) {
			showNearestLocation(value);
		});
	});
	arrayMakers = map.markers;
}

function slider () {
	$( "#slider" ).slider({
  		value:5000,
  		min: 500,
		max: 15000,
  		step: 500,
  		slide: function( event, ui ) {
    		$( "#amount" ).val( ui.value + 'm' );
  		}
	});
	$( "#amount" ).val($( "#slider" ).slider( "value" ) + 'm' );
	$('#change').on('click', function(){
		slide = $( "#slider" ).slider( "value" );
		map.removeMarkers();
		for(i = 0; i < arrayMakers.length; i ++){
			if(arrayMakers[i].infoWindow.content != 'Vị Trí Của Bạn' ){
				if(!slide) {map.addMarker(arrayMakers[i]);} else
				if(slide > getDistance(UserCoords,arrayMakers[i].position)){
					map.addMarker(arrayMakers[i]);
				}
			}
		}
		//checkIn();
		if(clickDes){clickDes.infoWindow.close() };
	});
}
$(document).ready(function() {
    built_map();
    reloadLocation();
	slider();
    var inputVal;
    var input = document.getElementById('searchInput');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    $('#direction').on('click', function(){
    	if(document.getElementById('searchInput').value != '' && document.getElementById('district').value == 0 && document.getElementById('city').value == 0){
    		inputVal = document.getElementById('searchInput').value;
    	} else {
    		district = ((document.getElementById('district').value != 0) ? document.getElementById('district').value : '');
    		city = 	((document.getElementById('city').value != 0) ? document.getElementById('city').value : '');
    		inputVal = district + city;
    	}
    	GMaps.geocode({
			address: inputVal.trim(),
			callback: function(results, status) {
				if (status == 'OK') {
					latlng = results[0].geometry.location;
					map.setCenter(latlng.lat(), latlng.lng());
        			map.setZoom(18);
        			map.travelRoute({
					  	origin: [UserCoords.lat, UserCoords.lng],
					  	destination: [latlng.lat(), latlng.lng()],
					  	travelMode: 'driving',
						step: function(e) {
						    map.drawPolyline({
						        path: e.path,
						        strokeColor: '#131540',
						        strokeOpacity: 0.6,
						        strokeWeight: 6
						    });
						}
					});
					map.addMarker({
						lat: latlng.lat(),
						lng: latlng.lng(),
						animation: google.maps.Animation.DROP,
						click: function(e) {
							map.cleanRoute();
    						map.removePolylines();
							map.travelRoute({
							  	origin: [UserCoords.lat, UserCoords.lng],
							  	destination: [e.position.lat(), e.position.lng()],
							  	travelMode: 'driving',
								step: function(e) {
								    map.drawPolyline({
								        path: e.path,
								        strokeColor: '#131540',
								        strokeOpacity: 0.6,
								        strokeWeight: 6
								    });
								}
							});
					  	},
					});	
				}
			}
		});
    });
    $('#findNearLocation').on('click', function(){
    	map.cleanRoute();
    	map.removePolylines();
    	for(i = 0; i < arrayMakers.length; i ++){
			if(arrayMakers[i].infoWindow.content != 'Vị Trí Của Bạn') {
				arrayDistance.push({index: i, distance: getDistance(UserCoords,arrayMakers[i].position)});
			}
		}
		arrayDistance.sort(function (a, b) {
		    return a.distance - b.distance;
		});
		map.setCenter( arrayMakers[arrayDistance[0].index].position.lat(), arrayMakers[arrayDistance[0].index].position.lng() );
        map.setZoom(12);
		map.travelRoute({
		  	origin: [UserCoords.lat, UserCoords.lng],
		  	destination: [arrayMakers[arrayDistance[0].index].position.lat(), arrayMakers[arrayDistance[0].index].position.lng()],
		  	travelMode: 'driving',
			step: function(e) {
				map.drawPolyline({
					path: e.path,
					strokeColor: '#131540',
					strokeOpacity: 0.6,
					strokeWeight: 6
				});
			}
		});
		
    });
});
