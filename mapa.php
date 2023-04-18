$key = "AIzaSyDGjK7KQaMuBo1KcDnyaQbCNqKCCu8McHk";
$lat= "-8.093509851732062";
$lng= "-34.929007271936044";
$teste = 0;

if(isset($_GET['lat']) && isset($_GET['lng'])) {
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
}


echo '<span class="span" style="display: none;" id="latitude">'.$lat.'</span>';
echo '<span class="span" style="display: none;" id="longitude">'.$lng.'</span>';

//echo '<span class="span" id="latitude">'.$lat.'</span>';
//echo '<span class="span" id="longitude">'.$lng.'</span>';

?>
<!DOCTYPE html>
<html>
	<head>
		<script
      		src="https://maps.googleapis.com/maps/api/js?key=<?php echo $key; ?>&callback=initMap&libraries=&v=weekly"
      		async
		></script>
	</head>
	<style type="text/css">
		#map {
			height: 100%;
		}
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		.span {
			display: inline-block;
			border-style: solid;
			border-width: 1px;
			border-radius: 4px;
			border-color: #ABB1D9;
			background-color: #fff;
			width: 200px;
			height: 25px;
			margin: 20px;
		}
	</style>
	<script>
		var latitude = document.getElementById("latitude").innerText;
		var longitude = document.getElementById("longitude").innerText;
		var localizacao = { 
			lat: Number.parseFloat(latitude),
			lng: Number.parseFloat(longitude)
		};
		var markers = [];
		var map;
		
		function initMap() {
			map = new google.maps.Map(document.getElementById("map"), {
				zoom: 12,
				center: localizacao,
				//mapTypeId: "terrain",
		  	});
			
			map.addListener("click", (event) => {
				deleteMarkers();
				addMarker(event.latLng);
				setFields(event.latLng.toJSON().lat, event.latLng.toJSON().lng);
			});
			
			addMarker(localizacao);
		}

		
		
		
		function setFields(lat, lng) {
			document.getElementById("latitude").innerText = lat;
			document.getElementById("longitude").innerText = lng;
		}
		
		function addMarker(position) {
		  const marker = new google.maps.Marker({
			position,
			map,
		  });

		  markers.push(marker);
		}

		function setMapOnAll(map) {
		  for (let i = 0; i < markers.length; i++) {
			markers[i].setMap(map);
		  }
		}

		function hideMarkers() {
		  setMapOnAll(null);
		}

		function showMarkers() {
		  setMapOnAll(map);
		}

		function deleteMarkers() {
		  hideMarkers();
		  markers = [];
		}
	</script>
	<body>
		<div id="map"></div>
	</body>
</html>
<?php
