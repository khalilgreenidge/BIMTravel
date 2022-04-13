<?php include 'head&nav.php';?>
	<div class="content" id="vehicle">
		<h1>Add Vehicles</h1>
		
		<form class="below" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Vehicle No. <input type="text" name="vehicleno" /> 
			<br/><br/>
			Driver <input type="text" name="driver" />
			<br/><br/>
			Route <input type="text" name="route" />
			<br/><br/>
			Type <select name="type">
					<option value="Blue Bus">Blue Bus</option>
					<option value="Mini Bus">Mini Bus</option>
				 </select>	
			<br/><br/>
			Operational: <br/>
			<label for="yes">Yes</label> <input id="yes" type="radio" name="operational" value="yes" /> <label for="no">No</label>  <input id="no" type="radio" name="operational" value="no" />
			
			<br/><br/>
			
			<input style="float: left;" type="submit" />		<input type="reset" />
			
		</form>
		<br/><br/>
		<?php
			// define variables and set to empty values
			$vehicleno = $driver = $route = $type = $operational = $location = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
				
				$vehicleno = test_input($_POST["vehicleno"]);
				$driver = test_input($_POST["driver"]);
				$route = test_input($_POST["route"]);
				$type = test_input($_POST["type"]);
				$operational = $_POST["operational"];
				$location = "13.0963789, -59.5478358";
					
				
				//SEND DATA TO DATABADE
				$server = "localhost";
				$user = "root"; 
				$pwd = ""; 
				
				//CONNECT TO DATABASE
				$db = "bimtravel";
				
				$con = mysqli_connect($server, $user, $pwd, $db);
				
				$sql = "INSERT INTO vehicles (vehicle_no, driver, route, type, operational, location) 
					VALUES('$vehicleno', '$driver', '$route', '$type', '$operational', '$location') ";
				
				$q = mysqli_query($con, $sql);
				
				if(!$con || !$db ||!$q ){
					die('Error: '.mysqli_error($con));
					echo 'something went wrong';
				}
				else{
					echo '	
					<div class="alert success">
					  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
					  You have successfully added a new vehicle!
					</div>
					
					<script>
						setTimeout(function () {
						   window.location.href= \'addvehicles.php\'; // the redirect goes here

						},10000);
					</script>
					';
				}
				
				mysqli_close($con);			
			}
		?>
		<br/>
		<br/>
	</div>
	
</div>
</body>
</html>