<?php include 'head&nav.php';?>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<div class="content editvehicles">
		<h1>Edit Vehicles</h1>
		
		<?php include 'display.php';?>
				
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			Vehicle No. <select name="vehicle_no" required >
						<?php
							$server = "localhost";
							$user = "root"; 
							$pwd = ""; 
							$db = "bimtravel";
							
							$con = mysqli_connect($server, $user, $pwd, $db);							
							$sql = "SELECT vehicle_no FROM vehicles";
							$q = mysqli_query($con, $sql);
							
							if(!$con ||!$q ){
								die('Error: '.mysqli_error($con));
							}
							else{
								while($row = mysqli_fetch_assoc($q)){
									echo '
									<option value="'.$row["vehicle_no"].'">'.$row["vehicle_no"].'</option>
									';
								}
							}		

							mysqli_close($con);		
						?>
						</select> <br/><br/>	
						
			Field: <select name="field" required >
						<option value="driver">Driver</option>
						<option value="route">Route</option>
						<option value="type">Type</option>
						<option value="operational">Operational</option>
						<option value="location">Location</option>
					</select> <br/><br/>
					
			Value:		<input type="text" name="value" required />
			
			<br/><br/>
			
			<input style="float: left;" type="submit" />		<input type="reset" />
			
		</form>
		
		<?php
			// define variables and set to empty values
			$vehicleno = $field = $value = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
				
				$vehicleno = test_input($_POST["vehicle_no"]);
				$field = test_input($_POST["field"]);
				$value = test_input($_POST["value"]);
				
				$server = "localhost";
				$user = "root"; 
				$pwd = ""; 
				$db = "bimtravel";
				
				$con = mysqli_connect($server, $user, $pwd, $db);	
				
				switch($field){
					case "vehicle_no":
						$sql = "UPDATE vehicles SET vehicle_no = '$value' WHERE vehicle_no = ".$vehicleno;
						break;
					case "driver":
						$sql = "UPDATE vehicles SET driver = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "route":
						$sql = "UPDATE vehicles SET route = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "type":
						$sql = "UPDATE vehicles SET type = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "operational":
						$sql = "UPDATE vehicles SET operational = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "location":
						$sql = "UPDATE vehicles SET location = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
				}
				
				$q = mysqli_query($con, $sql);
				
				if(!$con ||!$q ){
					die('Error: '.mysqli_error($con));
				}
				else{
					echo '	
					<div class="alert success">
					  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
					  You have successfully added a new route!
					</div>
					
					<script>
						setTimeout(function () {
						   window.location.href= \'editvehicles.php\'; // the redirect goes here

						},10000);
					</script>
					';						
				}		

				mysqli_close($con);	
			}		
		?>
		
		<br/><br/>
	</div>
	
</div>
</body>
</html>