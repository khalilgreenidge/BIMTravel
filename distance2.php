<?php include 'head&nav.php';?>
	
	<div class="content distance">
		<h1>How far is my Bus?</h1>
		<br/><br/>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Choose bus: <select name="buslocation" required id="buslocation" >
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
						
			<input class="form-button" style="float: left;" type="submit" value="Find Distance"/> 
			
		</form>
		
		<br/>
		<script>
			
		</script>
		<br/><br/>
		
		<div id="map" style="width:60%;height:500px"></div>
    
		<script>
			var startPos;
			window.onload = function() {
			 		  
			  var geoSuccess = function(position) {
				startPos = position;
				lat2 = startPos.coords.latitude;
				document.getElementById('userlocation').value = startPos.coords.latitude;
				lon2 = startPos.coords.longitude;
				document.getElementById('userlocation').value += "," + startPos.coords.longitude;
			  };
			  navigator.geolocation.getCurrentPosition(geoSuccess);
			};
		  // This example creates a 2-pixel-wide red polyline showing the path of William
		  // Kingsford Smith's first trans-Pacific flight between Oakland, CA, and
		  // Brisbane, Australia.

		  function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 3,
			  center: new google.maps.LatLng(13.174928, -59.562083),
			  mapTypeId: 'terrain'
			});
			
			var str = document.getElementById('buslocation').value; 
			var res = str.split(","); 
			var lat1 = res[0];	
			var lon1 = res[1];
			
			var str = document.getElementById('userlocation').value; 
			var res = str.split(","); 
			var lat2 = res[0];	
			var lon2 = res[1];
			
			
			
			var flightPlanCoordinates = [
			  {lat: Number(lat1), lng: Number(lon1)},
			  {lat: Number(lat2), lng: Number(lon2) }
			];
			
			var flightPath = new google.maps.Polyline({
			  path: flightPlanCoordinates,
			  geodesic: true,
			  strokeColor: '#FF0000',
			  strokeOpacity: 1.0,
			  strokeWeight: 2
			});

			flightPath.setMap(map);
		  }
		</script>
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ&callback=initMap">
		</script>
		
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$start = $_POST["buslocation"];
				$end = $_POST["userlocation"];
				
				$key = "AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ";

				$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$start."&destinations=".$end."&key=AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ";
				
			    $url2 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=13.25,-59.65&destinations=13.0963789,-59.6478358&mode=driving&language=English-%20en&key=AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ";
				
				$json = file_get_contents($url); // get the data from Google Maps API
				
				$result = json_decode($json, true); // convert it from JSON to php array
				
				//print_r($result);
				echo '<br/><br/><p>Distance  :'.$result["rows"][0]["elements"][0]["distance"]["text"].'</p>';
				//print_r($result["rows"][0]["elements"][0]["distance"]);
				
			}
		?>
		
	</div>
	
</div>
</body>
</html>