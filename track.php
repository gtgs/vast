<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="global.css" />
</head>
<body>
	<center>
	<?php
	include("db.php");
	if(isset($_GET['adid'])){
		$adid = $_GET['adid'];
	} else {
		die('No Ad Id provided');
	}?>
	<div id="topbar">
		TARGET RIGHT MEDIA - TRACKING STATS

	</div>
			<?php
			$query = "SELECT name FROM ads_vast_ads WHERE id=".$adid;
			$result = mysqli_query($connection, $query);
			while($row = mysqli_fetch_array($result)){
				echo "<h2>".$row['name']."</h2>";
			}
		?>
	<?php
	$query = "SELECT e.name as eventName, s.impression as impression FROM ads_vast_tracking_stats s JOIN ads_vast_events e on s.event = e.id WHERE ad=".$adid." group by event";
	$result = mysqli_query($connection, $query);
	echo ("<table width='80%'>");
	echo ("<tr><th>VAST Event</th><th>Impression Record</th></tr>");
	while($row = mysqli_fetch_array($result)){
		echo "<tr><td>".$row['eventName']."</td><td>".$row['impression']."</td></tr>";
	}
	echo ("</table>");
	mysqli_close($connection);
	?>
	</center>
</body>

</html>
