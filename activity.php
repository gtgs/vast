<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
</head>
<body>
	<?php
	include("db.php");
	if(isset($_GET['adid'])){
		$adid = $_GET['adid'];
	} else {
		die('No Ad Id provided');
	}
	if(isset($_GET['creativeid'])){
		$creativeid= $_GET['creativeid'];
	} else {
		die('No Creative Id provided');
	}
	if(isset($_GET['event'])){
		$event= $_GET['event'];
	} else {
		die('No event provided');
	}
	$query = "SELECT impression FROM ads_vast_tracking_stats WHERE ad=".$adid." AND creative=".$creativeid." AND event=".$event."";
	echo $query;
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result) > 0){
		$query = "UPDATE ads_vast_tracking_stats  set impression = impression + 1 WHERE ad=".$adid." AND creative=".$creativeid." AND event=".$event."";	
	} else {
		$query = "INSERT INTO ads_vast_tracking_stats (ad, creative, event, impression ) VALUES (".$adid.", ".$creativeid.", ".$event.", 1)";
	}
	echo $query;
	$result = mysqli_query($connection, $query);
	?>
</body>

</html>
