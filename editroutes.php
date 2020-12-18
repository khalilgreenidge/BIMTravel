<?php include 'head&nav.php';?>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<div class="content editvehicles">
		<h1>Edit Vehicles</h1>
		
		<?php include 'routes.php';?>
				
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			Vehicle No. <select name="vehicle_no" required >
						<?php
							$server = "localhost";
							$user = "root"; 
							$pwd = ""; 
							$db = "bimtravel";
							
							$con = mysqli_connect($server, $user, $pwd, $db);							
							$sql = "SELECT vehicle_no FROM routes";
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
						<option value="name">Name</option>
						<option value="vehicle_no">Vehicle no.</option>
						<option value="start">Start</option>
						<option value="stop">Stop</option>
						<option value="description">Description</option>
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
					case "name":
						$sql = "UPDATE routes SET name = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "vehicle_no":
						$sql = "UPDATE routes SET vehicle_no = '$value' WHERE vehicle_no = ".$vehicleno;
						break;
					case "start":
						$sql = "UPDATE routes SET start = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "stop":
						$sql = "UPDATE routes SET stop = '$value' WHERE vehicle_no = '$vehicleno'";
						break;
					case "description":
						$sql = "UPDATE routes SET description = '$value' WHERE vehicle_no = '$vehicleno'";
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
						   window.location.href= \'editroutes.php\'; // the redirect goes here

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