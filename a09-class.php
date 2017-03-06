<?php

$zipcode = $_GET["zipcode"];

include "phpsoda-1.0.0.phar";

use allejo\Socrata\SodaClient;
use allejo\Socrata\SodaDataset;
use allejo\Socrata\SoqlQuery;

$sc 		= new SodaClient("data.sfgov.org",$token="a2SZ8o7e8bGuVmJoCkl24nwyw");
$ds 		= new SodaDataset($sc, "wbb6-uh78");
$soqlQuery 	= new SoqlQuery();

$soqlQuery	->select("incident_number","incident_date","zipcode", "location", "address")
			->where ("zipcode = '". $zipcode . "'")
          	->limit(100);

$cases = $ds->getDataset($soqlQuery);

?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Fire Incidents </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />	
	<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"> </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
	<div class="container">
	
	<div class="row">  

	<div class="col-sm-12">
	
	<?php
    
   // var_dump($cases);

	?>
	
	
	 <h1> Fire Incidents</h1> 
	 
	 <div id="mapid" style = "height:1000px;width:100%;"> </div>
		  
		  <script>
		  
		  var mymap = L.map('mapid').setView([37.7749, -122.4194], 13);
		  
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWJpZGlzaGFqaWEiLCJhIjoiY2l3aDFiMG96MDB4eDJva2l6czN3MDN0ZSJ9.p9SUzPUBrCbH7RQLZ4W4lQ', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYWJpZGlzaGFqaWEiLCJhIjoiY2l3aDFiMG96MDB4eDJva2l6czN3MDN0ZSJ9.p9SUzPUBrCbH7RQLZ4W4lQ'
}).addTo(mymap);
		  

		  <?php
			
			$i = 0;

			foreach ($cases as $case)

			{
					echo ("var marker" . $i . "= L.marker([" .  $case["location"]["coordinates"][1] . "," . $case["location"]["coordinates"][0] .  "]).addTo(mymap);\n\rmarker" . $i . ".bindPopup(\"'" . $case["address<br>"]. $case["incident_date"]. "'\");\n\r");
					
					$i++;
			}

			?>
			
</script>

			
</div>
	 <div class="col-sm-2">
	 left side
	 
	 </div><!-- col-sm-2 -->
	 
	 <div class="col-sm-8">
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    
	</div><!-- col-sm-8 -->
	
	<div class="col-sm-2">
	 
	 right side side
	 
	 </div><!-- col-sm-2 -->
  
	</div><!--row -->
	
	</div><!--container-->
	
  </body>
</html>
