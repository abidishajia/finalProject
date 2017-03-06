<?php

$zipcode = $_GET["$zipcode"];

include "phpsoda-1.0.0.phar";

use allejo\Socrata\SodaClient;
use allejo\Socrata\SodaDataset;
use allejo\Socrata\SoqlQuery;

$sc 		= new SodaClient("data.sfgov.org",$token="a2SZ8o7e8bGuVmJoCkl24nwyw");
$ds 		= new SodaDataset($sc, "wbb6-uh78");
$soqlQuery 	= new SoqlQuery();

$soqlQuery	->select("incident_number","incident_date","zipcode", "alarm_dttm", "arrival_dttm")
			->where ("zipcode = '". $zipcode . "'")
          	->limit(100);

$results = $ds->getDataset($soqlQuery);

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
	
	<div class="col-sm-2">
	 
	 left side
	 
	 </div><!-- col-sm-2 -->
	 
	 <div class="col-sm-8">
  
    <h1> Fire Incidents</h1> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <?php
    
    var_dump($results);


	?>
	
	</div><!-- col-sm-8 -->
	
	<div class="col-sm-2">
	 
	 right side side
	 
	 </div><!-- col-sm-2 -->
  
	</div><!--row -->
	
	</div><!--container-->
	
  </body>
</html>
