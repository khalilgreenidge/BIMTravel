<?php 
	include 'head&nav.php';
	
	$con = mysqli_connect("localhost", "root", "", "bimtravel");
	
	$rs1 = mysqli_query($con, "SELECT * FROM routes GROUP BY name ");	

	$name = "";	
						
	$routes[] = "['Option', 'Total', { role: 'style' }]";
						
	if(!$con || !$rs1){
		die('Error: '.mysqli_error($con));
	}
	else{		
		
		$i = 0;
		
		$color = array('#2E2EFE', '#a7d9e5', '#222d32');
		
		while($row = mysqli_fetch_array($rs1)){
			
			//RESET Color COUNTER IF EQUAL TO 3
			if($i > 2){
				$i = 0;
			}
			
			$name = $row["name"];
			
			$total = mysqli_num_rows(mysqli_query($con, "SELECT * FROM routes WHERE name = \"$name\" "));
			
			/* echo "Type: ".$name."<br/>";
			echo "Total: ".$total."<br/><br/>";  */
			
			/*APPEND TO STOCK ARRAY*/
			
			$routes[] = "['".$name."', ".$total.", '".$color[$i]."' ]";
			
			
			$i++;
		}
		
				
	}
	
?>
	
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
			
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	  var data;
	  var options;
	  
      function drawChart() {
	
		data = google.visualization.arrayToDataTable([
		<?php echo( implode(",", $routes) ); ?>
		]);

				
        // Set chart options
        options = {'title':'BiM Travel\'s Routes',
                       'width':700,
                       'height':400,
					   'animation': {
							'startup': true,
							'duration': 3000,
							'easing': 'out',		
					   }					   
					   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  
	  function myfunc(value){
		switch (value){
			case 'Bar':
				chart = new google.visualization.BarChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;
				
			case 'Column':
				chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;
				
			case 'Pie':
				chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				break;				
			
		}
		
	  }
	   
    drawChart();
	  
    </script>
	
	<div class="content">
		<h1>Report</h1>
		<!--Div that will hold the pie chart-->
		<div id="chart_div" style="margin: 0 auto; width: 50%">
		</div>
	</div>
	
</div>
</body>
</html>