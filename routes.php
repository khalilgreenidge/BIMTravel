
<table>
	<tr>
		<th>Name</th>
		<th>Vehicle No.</th>
		<th>Start</th>
		<th>Stop</th>
		<th>Description</th>		
	</tr>
	
	<?php
		$con = mysqli_connect("localhost", "root", "", "bimtravel");
		$sql = "SELECT * FROM routes";
		$q = mysqli_query($con, $sql);
		
		if(!$con ||!$q ){
			die('Error: '.mysqli_error($con));
			echo 'something went wrong';
		}
		else{
			while($row = mysqli_fetch_assoc($q)){
				echo '
				<tr>
					<td> '.$row["name"].'</td>
					<td> '.$row["vehicle_no"].'</td>
					<td> '.$row["start"].'</td>
					<td> '.$row["stop"].'</td>
					<td> '.$row["description"].'</td>
				</tr>						
				';
			}
		}
		
		mysqli_close($con);
			
	?>
			
</table>
