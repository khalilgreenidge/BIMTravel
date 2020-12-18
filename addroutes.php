<?php include 'head&nav.php';?>
	<div class="content" id="vehicle">
		<h1>Add Route</h1>
		<br/>
		<form class="below" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Name <input type="text" name="name" /> 
			<br/><br/>
			
			Bus no. <input type="text" name="vehicle_no" />
			<br/><br/>
			
			Start <input type="text" name="start" />
			<br/><br/>
			
			End <input type="text" name="stop" />
			<br/><br/>
			
			Description <textarea name="description" rows="4" >
					
				</textarea>
				
			<br/><br/>
			
			
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
				  $data = htmlentities($data);
				  return $data;
				  
				}
				
				$name = test_input($_POST["name"]);
				$vehicle_no = test_input($_POST["vehicle_no"]);
				$start = test_input($_POST["start"]);
				$stop = test_input($_POST["stop"]);
				$description = test_input($_POST["description"]);					
				
				echo "Description".$description;
				echo "Description".test_input($description);
				
				//SEND DATA TO DATABADE
				$server = "localhost";
				$user = "root"; 
				$pwd = ""; 
				
				//CONNECT TO DATABASE
				$db = "bimtravel";
				
				$con = mysqli_connect($server, $user, $pwd, $db);
				
				$sql = "INSERT INTO routes (name, vehicle_no, start, stop, description) 
					VALUES('$name', '$vehicle_no', '$start', '$stop', '$description') ";
				
				$q = mysqli_query($con, $sql);
				
				if(!$con || !$db ||!$q ){
					die('Error: '.mysqli_error($con));
					echo 'something went wrong';
				}
				else{
					echo '	
					<div class="alert success">
					  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
					  You have successfully added a new route!
					</div>
					
					<script>
						setTimeout(function () {
						   window.location.href= \'addroutes.php\'; // the redirect goes here

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