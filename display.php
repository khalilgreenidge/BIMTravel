<?php
	//SEND DATA TO DATABASE

	$server = "localhost";
	$user = "root"; 
	$pwd = ""; 
	
	/* $server = "localhost";
	$user = "id1088606_root"; 
	$pwd = "password";  */
	
	//CONNECT TO DATABASE
	//$db = "id1088606_bimtravel";
	$db = "bimtravel";
	
	$con = mysqli_connect($server, $user, $pwd, $db);
	
	//TYPE OF VEHICLE 1
	
	$sql = "SELECT * FROM vehicles WHERE Type='blue bus'";
	
	$q = mysqli_query($con, $sql);
	
	$type1 = mysqli_num_rows($q);
	
	//TYPE OF VEHICLE 2
	
	$sql2 = "SELECT * FROM vehicles WHERE Type='mini bus'";
	
	$q2 = mysqli_query($con, $sql2);
	
	$type2 = mysqli_num_rows($q2)
?>
	<div id="display">
	
		<div id="imgs">
			<img src="imgs/bus.png" style="width: 500px;"/>			
			<img src="imgs/minivan.png" style="float: right;" /> 
		</div>
		
		<br/><br/>
		
		<div id="counter-container">
			<div class="counter" style="float: left">
				<span class="inner-counter"><?php echo $type1;?></span>
				<span class="smalltext">Blue Bus</span>
			</div>
			
			<div class="counter" style="float: right;">	
				<span class="inner-counter"><?php echo $type2;?></span>
				<span class="smalltext">Mini Bus</span>
			</div>
		</div>

	</div>
	
	<table>
			<tr>
				<th>Vehicle No.</th>
				<th>Driver</th>
				<th>Route</th>
				<th>Type</th>
				<th>Operation</th>
				<th>Location</th>
			</tr>
			
			<?php
				$sql = "SELECT * FROM vehicles";
				$q = mysqli_query($con, $sql);
				
				if(!$con || !$db ||!$q ){
					die('Error: '.mysqli_error($con));
					echo 'something went wrong';
				}
				else{
					while($row = mysqli_fetch_assoc($q)){
						echo '
						<tr>
							<td> '.$row["vehicle_no"].'</td>
							<td> '.$row["driver"].'</td>
							<td> '.$row["route"].'</td>
							<td> '.$row["type"].'</td>
							<td> '.$row["operational"].'</td>
							<td> '.$row["location"].'</td>
						</tr>						
						';
					}
				}
				
				mysqli_close($con);
					
			?>
					
		</table>
