<?php
	if($_GET["vno"] != "" & $_GET["lat"] !="" & $_GET["lon"] !="" ){
		$vehicleno = $_GET["vno"];
		$location = $_GET["lat"].', '. $_GET["lon"];
		
		echo $location;
		
		//SEND DATA TO DATABADE
		$server = "localhost";
		$user = "id1088606_root"; 
		$pwd = "password"; 
		
		//CONNECT TO DATABASE
		$db = "id1088606_bimtravel";
		
		$con = mysqli_connect($server, $user, $pwd, $db);
		
		$sql = "UPDATE vehicles SET location='$location' WHERE vehicle_no='$vehicleno' ";
		
		$q = mysqli_query($con, $sql);
		
		if(!$con || !$db ||!$q ){
			die('Error: '.mysqli_error($con));
			echo 'something went wrong';
		}
		else{
			echo '\nUpdated coordinates!';
		}
		
		mysqli_close($con);
		
	}
?>