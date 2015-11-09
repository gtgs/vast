<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="global.css" />

<title>TRM VAST Sample</title>
<style>
	body { margin: 0px; overflow:hidden }
</style>

</head>
<?php
if (isset($_GET["contentUrl"]))
	$contentUrl = $_GET["contentUrl"];
else 
	$contentUrl = "";#urlencode("rtmp://cp67126.edgefcs.net/ondemand/mediapm/strobe/content/test/SpaceAloneHD_sounas_640_500_short");	
if (isset($_GET["vastTagUrl"]))
	$vastTagUrl = $_GET["vastTagUrl"];
else
	$vastTagUrl = "";#urlencode("http://demo.tremorvideo.com/proddev/vast/vast2RegularLinear.xml");
?>
<body scroll="no">

	<center>
	<div>
		<span style="font-size:0.7em;">
		<?php
	include("db.php");
	$query = "SELECT * FROM ads_vast_ads";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($result)) {
#		echo("<div>");
#		echo("<a href='default.php?vastTagUrl=vast-gen.php%3Fadid=".$row['id']."&contentUrl=rtmp%3A%2F%2Fcp67126.edgefcs.net%2Fondemand%2Fmediapm%2Fstrobe%2Fcontent%2Ftest%2FSpaceAloneHD_sounas_640_500_short'>".$row['name']."</a>&nbsp;<a href='track.php?adid=".$row['id']."'>Track Views</a>	");
#		echo("</div>");
	}
	mysqli_close($connection);
	?>
	</span>
	</div>
	<div id="trm-vast-player">
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			id="TRM VAST Player" width="100%" height="100%"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
			<param name="movie" value="VASTSample.swf" />
			<param name="quality" value="high" />
			<param name="allowScriptAccess" value="sameDomain" />
			<PARAM NAME="SCALE" VALUE="exactfit">
			<param name=FlashVars value="vastTagUrl=<?php echo $vastTagUrl;?>&contentUrl=<?php echo $contentUrl;?>">
			<embed src="VASTSample.swf" quality="high" bgcolor="#333333"
				width="100%" height="100%" name="TRM VAST Player" align="middle"
				SCALE="exactfit"
				play="true"
				loop="false"
				quality="high"
				allowScriptAccess="sameDomain"
				FlashVars="vastTagUrl=<?php echo $vastTagUrl;?>&contentUrl=<?php echo $contentUrl;?>"
				type="application/x-shockwave-flash"
				pluginspage="http://www.adobe.com/go/getflashplayer"
				vasttag="www.google.com">
			</embed>
	</object>
	</div>
	</center>

	
</body>
</html>
