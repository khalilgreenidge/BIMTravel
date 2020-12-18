<?php
	// Start XML file, create parent node
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node);

	//CONNECT TO DATABASE
	$server = "localhost";
	$user = "root"; 
	$pwd = ""; 
	
	//SELECT DATABASE
	$db = "bimtravel";	
	$con = mysqli_connect($server, $user, $pwd, $db);
	
	//CREATE QUERY
	$sql = "SELECT * FROM vehicles WHERE 1";	
	$q = mysqli_query($con, $sql);
	
	if(!$con || !$db ||!$q ){
		die('Error: '.mysqli_error($con));
		echo 'something went wrong';
	}
	else{
		header("Content-type: text/xml");
		
		while($row = mysqli_fetch_assoc($q)){
			// Add to XML document node
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);
			$newnode->setAttribute("vno", $row['vehicle_no']);
			$newnode->setAttribute("driver", $row['driver']);
			$newnode->setAttribute("route", $row['route']);
			$newnode->setAttribute("type", $row['type']);
			$newnode->setAttribute("operational", $row['operational']);
			$newnode->setAttribute("location", $row['location']);
		}
		
		echo $dom->saveXML();
	}
	
	
?>