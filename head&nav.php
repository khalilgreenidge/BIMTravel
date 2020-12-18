<!DOCTYPE html>
<head>
	<title>BiM Travel</title>
	<link rel="stylesheet" type="text/css" href="style.css" >
	<link rel="shortcut icon" href="imgs/logo.png" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

</head>
<body>
<div id="wrap">
	<div id="head">
		<ul>
			<li style="width: 9%"><img src="imgs/logo.png" width="60px" height="60px" /></li>
			<li style="width: 75%">BiM Travel</li>
			<li style="width: 14.3%;">Khalil Greenidge</li>
		</ul>
	</div>
	
	<div id="nav">

		<button class="accordion"><a href="index.php">Overview</a></button>
		
		<button class="accordion"><a>Schedule <span></span></a></button>
		<div class="panel">
			<ul class="panel">
				<li><a href="viewroutes.php">Routes</a></li>
				<li><a href="addroutes.php">Add Routes</a></li>
				<li><a href="editroutes.php">Edit Routes</a></li>
				<li><a href="timetable.php">Timetable</a></li>
			</ul>
		</div>
		
		<!--button class="accordion"><a>Management<span></span></a></button>
		<div class="panel">
			<ul class="panel">
				<li><a href="maintenance.php">Maintenance</a></li>
				<li><a href="fuel.php">Fuel</a></li>
			</ul>
		</div-->
		
		<button class="accordion"><a>Vehicles <span></span></a></button>
		<div class="panel">
			<ul class="panel">
				<li><a href="vehicles.php">View vehicles</a></li>
				<li><a href="addvehicles.php">Add a vehicle</a></li>
				<li><a href="editvehicles.php">Edit a Vehicle</a></li>
				<li><a href="deletevehicles.php">Delete a vehicle</a></li>				
				<li><a href="distance.php">How far is my bus</a></li>				
			</ul>
		</div>
		
		<button class="accordion"><a>Statistics <span></span></a></button>
		<div class="panel">
			<ul class="panel">
				<li><a href="reports.php">Reports</a></li>
			</ul>
		</div>
	</div>
	
	<script>
		function myMap() {
		  var mapCanvas = document.getElementById("map");
		  var mapOptions = {
			center: new google.maps.LatLng(13.174928, -59.562083), 
			zoom: 11
		  }
		  var map = new google.maps.Map(mapCanvas, mapOptions);
		}
		
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
			acc[i].onclick = function(){
				this.classList.toggle("active");

				/* Toggle between hiding and showing the active panel */
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight){
				  panel.style.maxHeight = null;
				} else {
				  panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			}
		}
	</script>
		