<?php include 'head&nav.php';?>
	
	<div class="content">
		<div id="map" style="width:60%;height:500px"></div>
		<br/><br/>
		

				<script>	
				function initMap() {
					
					var infoWindow = new google.maps.InfoWindow;

									
					var map = new google.maps.Map(document.getElementById('map'), {
					  center: new google.maps.LatLng(13.174928, -59.562083),
					  zoom: 12
					});
					
					
					
					// Change this depending on the name of your PHP or XML file
					downloadUrl('mapconnect.php', function(data) {
								var xml = data.responseXML;
								var markers = xml.documentElement.getElementsByTagName('marker');
								Array.prototype.forEach.call(markers, function(markerElem) {
								var vno = markerElem.getAttribute('vno');
								var driver = markerElem.getAttribute('driver');
								var route = markerElem.getAttribute('route');
								var type = markerElem.getAttribute('type');
								var operational = markerElem.getAttribute('operational');
								var str = markerElem.getAttribute('location'); 
								var res = str.split(","); 
								var lat = res[0];	
								var lon = res[1];	
		
								var point = new google.maps.LatLng(lat,	lon);

							  var infowincontent = document.createElement('div');
							  var strong = document.createElement('strong');
							  strong.textContent = vno
							  infowincontent.appendChild(strong);
							  
							  infowincontent.appendChild(document.createElement('br'));
							  var text = document.createElement('text');
							  text.textContent = route
							  infowincontent.appendChild(text);
							  
							  infowincontent.appendChild(document.createElement('br'));
							  var text = document.createElement('text');
							  text.textContent = driver
							  infowincontent.appendChild(text);
							  
							  //var icon = customLabel[type] || {};
							  var marker = new google.maps.Marker({
								map: map,
								position: point,
								//label: icon.label 
							  });
							  marker.addListener('click', function() {
								infoWindow.setContent(infowincontent);
								infoWindow.open(map, marker);
							  });
							});
						  });
						}



					  function downloadUrl(url, callback) {
						var request = window.ActiveXObject ?
							new ActiveXObject('Microsoft.XMLHTTP') :
							new XMLHttpRequest;

						request.onreadystatechange = function() {
						  if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						  }
						};

						request.open('GET', url, true);
						request.send(null);
					  }

					  function doNothing() {}
				</script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO2jhqxUIikSLLvgVa27g14yFi_iF_6lQ&callback=initMap">
				</script>
			
	</div>
</div>

</body>
</html>