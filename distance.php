<?php include 'head&nav.php';?>
	
	<div class="content">
		
		<h1>How far is my Bus?</h1>
		<br/><br/>
		<form class="below" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Choose bus: <select name="route" required id="buslocation" >
						<?php
							$server = "localhost";
							$user = "root"; 
							$pwd = ""; 
							$db = "bimtravel";
							
							
							$con = mysqli_connect($server, $user, $pwd, $db);							
							$sql = "SELECT route, location FROM vehicles";
							$q = mysqli_query($con, $sql);
							
							if(!$con ||!$q ){
								die('Error: '.mysqli_error($con));
							}
							else{
								while($row = mysqli_fetch_assoc($q)){
									echo '
									<option value="'.$row["location"].'">'.$row["route"].'</option>
									';
							
								}
							}		

							mysqli_close($con);		
						?>
						</select> 
			<br/><br/><br/><br/>
			
			Your Location <input type="text" name="userlocation" id="userlocation" />
			<br/><br/>
						
			<button class="form-button" style="float: left;" onclick="initMap2()">Find Distance</button> 
			
		</form>
		<br/><br/>
		<div id="map2" style="width:90%;height:500px; margin: 0 auto;"></div>
		<br/><br/>
		<div id="output" style="width:70%;height:500px; margin: 0 auto;"></div>
		<br/><br/>	<br/><br/>	<br/><br/>	
		<script>
			var lat2;
			var lon2;
			var loc = {
				lat: 0,
				lon: 0
			}

			window.onload = function() {
			  var startPos;
			  
			  var geoSuccess = function(position) {
				startPos = position;
				loccy.lat = startPos.coords.latitude;
				document.getElementById('userlocation').value = startPos.coords.latitude;
				loccy.lon = startPos.coords.longitude;
				document.getElementById('userlocation').value += ", " + startPos.coords.longitude;
			  };
			  navigator.geolocation.getCurrentPosition(geoSuccess);
			};
	
			/******************************************
			**************     MAP     ****************
			******************************************/
		
			function initMap2() {
				var bounds = new google.maps.LatLngBounds;
				var markersArray = [];

				var geoSuccess = function(position) {
					startPos = position;
					loc.lat = startPos.coords.latitude;
					loc.lon = startPos.coords.longitude;

					//console.log("LOccy: " + loc.lat);

					lat = startPos.coords.latitude;
					lon = startPos.coords.longitude;
					let arr = [lat, lon]
					return arr;
				};
				let loccy = navigator.geolocation.getCurrentPosition(geoSuccess);

				console.log("LOccy: " + loccy);

				if (document.getElementById('userlocation').value == null){
					lat2 = 13.1060;
					lon2 = -59.6132;
				}
				else{
					console.log("It's not null! It's " + document.getElementById('userlocation').value);
					loc = document.getElementById('userlocation').value.split(",");
					lat2 = loc[0];
					lon2 = loc[1];
				}
				
				console.log("lat: " + lat2 + ", lon2: " + lon2);

				var origin1 = {lat: lat2, lng: lon2};
				var origin2 = 'Christ Church, Barbados';
				var destinationA = 'Bridgetown, Barbados';
				var destinationB = {lat: 50.087, lng: 14.421};

				var destinationIcon = 'https://chart.googleapis.com/chart?' +
					'chst=d_map_pin_letter&chld=D|FF0000|000000';
				var originIcon = 'https://chart.googleapis.com/chart?' +
					'chst=d_map_pin_letter&chld=O|FFFF00|000000';
				var map = new google.maps.Map(document.getElementById('map2'), {
				center: {lat: 13.0963789, lng: -59.5478358},
				zoom: 10
				});
			var geocoder = new google.maps.Geocoder;

			var service = new google.maps.DistanceMatrixService;
			service.getDistanceMatrix({
			  origins: [origin1, origin2],
			  destinations: [destinationA, destinationB],
			  travelMode: 'DRIVING',
			  unitSystem: google.maps.UnitSystem.METRIC,
			  avoidHighways: false,
			  avoidTolls: false
			}, function(response, status) {
			  if (status !== 'OK') {
				alert('Error was: ' + status);
			  } else {
				var originList = response.originAddresses;
				var destinationList = response.destinationAddresses;
				var outputDiv = document.getElementById('output');
				outputDiv.innerHTML = '';
				deleteMarkers(markersArray);

				var showGeocodedAddressOnMap = function(asDestination) {
				  var icon = asDestination ? destinationIcon : originIcon;
				  return function(results, status) {
					if (status === 'OK') {
					  map.fitBounds(bounds.extend(results[0].geometry.location));
					  markersArray.push(new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						icon: icon
					  }));
					} else {
					  alert('Geocode was not successful due to: ' + status);
					}
				  };
				};

				for (var i = 0; i < originList.length; i++) {
				  var results = response.rows[i].elements;
				  geocoder.geocode({'address': originList[i]},
					  showGeocodedAddressOnMap(false));
				  for (var j = 0; j < results.length; j++) {
					geocoder.geocode({'address': destinationList[j]},
						showGeocodedAddressOnMap(true));
					outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
						': ' + results[j].distance.text + ' in ' +
						results[j].duration.text + '<br>';
				  }
				}
			  }
			});
		  }

		  function deleteMarkers(markersArray) {
			for (var i = 0; i < markersArray.length; i++) {
			  markersArray[i].setMap(null);
			}
			markersArray = [];
		  }
		</script>
		<script defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ&callback=initMap2">
		</script>
		<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		
	</div>
	
</div>
</body>
</html>