var customer;
var province;
var country;
function Customer() {

	this.verify_address_changes = function (street_aux, street_number_aux, locality_id_aux, latitude_aux, longitude_aux) {
		var street = document.getElementsByName('street')[0];
	  	var street_number = document.getElementsByName('street_number')[0];
	  	var locality_select = document.getElementsByName('locality_id')[0];
	  	if (street.value != street_aux || street_number.value != street_number_aux || locality_select.options[locality_select.selectedIndex].value != locality_id_aux) {
			var latitude = document.getElementsByName('latitude')[0];
			var longitude = document.getElementsByName('longitude')[0];
			document.getElementsByName('latitude_aux').value = latitude.value;
			document.getElementsByName('longitude_aux').value = longitude.value;
			latitude.value = "";
			longitude.value = "";
			document.getElementById('buttons_map').innerHTML = "<button type='button' class='btn btn-sm btn-info shadow-sm rounded w-100 text-white' onclick='customer.geolocation_customer();'>Geolocalizar</button>";
		}
		else if (document.getElementsByName('latitude_aux').value && document.getElementsByName('longitude_aux').value) {
			document.getElementsByName('latitude')[0].value = document.getElementsByName('latitude_aux').value;
			document.getElementsByName('longitude')[0].value = document.getElementsByName('longitude_aux').value;
			document.getElementById('buttons_map').innerHTML = "<button type='button' class='btn btn-sm btn-info shadow-sm rounded w-100 text-white' onclick='customer.open_map(\'latitude\', \'longitude\', \'map\');' >Ver en mapa</button>";
		}
	};

	this.geolocation_customer = function () {
	  	var street = document.getElementsByName('street')[0];
	  	var street_number = document.getElementsByName('street_number')[0];
	  	var locality_select = document.getElementsByName('locality_id')[0];
	  	var locality = locality_select.options[locality_select.selectedIndex].innerHTML;
	  	if (street.value == "") {
	  		return swal("Alto ahí...", "Tenés que completar el nombre de la calle.", "error");
	  	}
	  	if (street_number.value == "") {
	  		return swal("Alto ahí...", "Tenés que completar el número de la calle.", "error");
	  	}
	  	var latlng = new google.maps.LatLng(40.323892, -3.852782);
	  	var address = street.value + " " + street_number.value + ", " + locality + ", " + province + ", " + country;
		var mapOptions = {
			zoom: 15,
			center: latlng,
			scrollwheel: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var divMap = document.getElementById('map');
		var map = new google.maps.Map(divMap, mapOptions);
		var geocoder = new google.maps.Geocoder();
	  	geocoder.geocode({
	    	'address': address
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
		      	document.getElementsByName('latitude')[0].value = results[0].geometry.location.lat().toFixed(8);
		      	document.getElementsByName('longitude')[0].value = results[0].geometry.location.lng().toFixed(8);
		      	map.setCenter(results[0].geometry.location);
		      	var marker = new google.maps.Marker({
		        	map: map,
		        	position: results[0].geometry.location,
		        	animation: google.maps.Animation.DROP
		      	});
			  	//podemos personalizar el tooltip aqui
		      	infowindow = new google.maps.InfoWindow({
		        	content: results[0].formatted_address
		      	});
	      		infowindow.open(map, marker)
				$('#map').fadeIn(700);
				document.getElementById('buttons_map').innerHTML = "<button type='button' class='btn btn-sm btn-info shadow-sm rounded w-100 text-white' onclick='customer.open_map(\'latitude\', \'longitude\', \'map\', true);'>Ver en mapa</button>";
	    	}
			else {
				var error = "";
				if (status === "ZERO_RESULTS") {
					error = "No hubo resultados para la dirección ingresada.";
				} else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
					error = "Error general del mapa.";
				} else if (status === "INVALID_REQUEST") {
					error = "Error de la web. Contactese con soporte.";
				}
			    swal('Oops...', error + ": " + status, "error");
			}
		});
	}

	this.open_map = function(latitude_id, longitude_id, map_id) {
		var latitude = document.getElementsByName(latitude_id)[0];
		var longitude = document.getElementsByName(longitude_id)[0];
		var latlng = new google.maps.LatLng(latitude.value, longitude.value);
		var mapOptions = {
			zoom: 15,
			center: latlng,
			scrollwheel: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var divMap = document.getElementById(map_id);
		var map = new google.maps.Map(divMap, mapOptions);
	  	var marker = new google.maps.Marker({
	    	map: map,
	    	position: latlng
	  	});
	  	$('#'+map_id).fadeIn(1500);
	}

	this.geolocation_show = function (province, country, street, street_number, locality) {
		if (!(street && street_number && locality)){
			return swal("Aviso", "El mapa no pudo cargarse porque falta información del domicilio del cliente.", "error");
		}
		var customer_id = document.getElementById('customer_id').value;
	  	var latlng = new google.maps.LatLng(40.323892, -3.852782);
	  	var address = street + " " + street_number + ", " + locality + ", " + province + ", " + country;
		var mapOptions = {
			zoom: 15,
			center: latlng,
			scrollwheel: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var divMap = document.getElementById('map');
		var map = new google.maps.Map(divMap, mapOptions);
		var geocoder = new google.maps.Geocoder();
	  	geocoder.geocode({
	    	'address': address
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
		      	geolocated_lat = results[0].geometry.location.lat().toFixed(8);
		      	geolocated_lng = results[0].geometry.location.lng().toFixed(8);
		      	map.setCenter(results[0].geometry.location);
		      	var marker = new google.maps.Marker({
		        	map: map,
		        	position: results[0].geometry.location,
		        	animation: google.maps.Animation.DROP
		      	});
		      	infowindow = new google.maps.InfoWindow({
		        	content: results[0].formatted_address
		      	});
	      		infowindow.open(map, marker);
	      		axios.put('/customers/' + customer_id, {
	      			action_customer: 'SaveCoords',
	      			lat: geolocated_lat,
	      			lng: geolocated_lng
	      		}).then(function (res) {
	      			console.log("Coordenadas guardadas.");
	      		}).catch(function(err) {
	      			console.log("Coordenadas no guardadas.");
	      		});
	    	}
			else {
				var error = "";
				if (status === "ZERO_RESULTS") {
					error = "No hubo resultados para la dirección ingresada.";
				} else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
					error = "Error general del mapa.";
				} else if (status === "INVALID_REQUEST") {
					error = "Error de la web. Contactese con soporte.";
				}
			    swal('Oops...', error + ": " + status, "error");
			}
		});
	}

}