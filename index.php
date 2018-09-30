<?php
	include "db.php";

	$tempDat = $db->prepare("select name, count(name) as freq FROM items group by name order by count(name) desc limit 5");
	$tempDat->execute();
	$data = $tempDat->fetchAll();
	$str = "";
 	foreach ($data as $row) {
 		$str .= "['".$row['name']."', ".$row['freq']."],";
 	}
 	$str = substr($str, 0, -1);
?>


<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto:100" rel="stylesheet">
	<link rel="stylesheet" href="static/style.css" type="text/css" />
	<script src="static/script.js" ></script>
	  <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();


        data.addColumn('string', 'Item Names');
        data.addColumn('number', 'Popularity');
        data.addRows([
         <?php
         	echo $str;
         ?>
        ]);

        // Set chart options
        var options = {'title':'Best Items',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
	
<div class="back">
	<div class="content3">
		<h1> FortNotification </h1>
		<?php


			use google\appengine\api\users\User;
			use google\appengine\api\users\Userservice;
			$user = UserService::getCurrentUser();
			if( isset($user)){
				echo sprintf('Welcome, %s! (<a href="index2">Go to my subscribed items! </a>)',$user->getNickname());
			}else{
				echo sprintf('<a href="%s" class="googleLogin">Sign in or register<img border="0" src="static/goog.png"></img></a>', UserService::createLoginUrl('/'));
			}

		?>
			<p> Made with <a href="https://fortniteapi.com"> Fortnite API </a></p>
	</div>
	<div id="charts">
		Best items (as per our userbase)
		<div id="chart_div"></div>	

	</div>
</div>

</body>

