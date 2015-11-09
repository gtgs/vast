<?php
$success = 0;
if(isset($_GET['adid'])){
	$adid = $_GET['adid']; 
	$success = 1;
} else {
	die("Cannot server ad, no Ad Id Provided");	
}
include("db.php");
$query = "SELECT * FROM ads_vast_ads WHERE id=".$adid;
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result)){
	$row = mysqli_fetch_array($result);
	$adTitle = $row['name'];
	$adDescription = $row['description'];
	$adImpression = $row['impression'];
	
	$success = 1;
} 

if($success == 1){
	header('content-type:text/xml');
	echo('<'.'?'.'xml version="1.0" encoding="UTF-8" standalone="no"'.'?'.'>');
}
?>

<VAST version="2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="vast.xsd">
    <Ad id="<?php echo($adid)?>">
        <InLine>
			<AdSystem version="2.0">TRM AD Serving System</AdSystem>
            <AdTitle><?php echo $adTitle?></AdTitle>
            <Description><?php echo $adDescription?></Description>
            <Survey></Survey>
            <Impression id="TRM"><![CDATA[<?php echo(str_replace("[timestamp]",microtime(),$adImpression));?>]]></Impression>
            <Creatives>
	            <?php 
					$query = "SELECT * FROM ads_vast_creatives c WHERE c.ad=".$adid;
					echo $query;
                    $result = mysqli_query($connection, $query);
                	while($row = mysqli_fetch_array($result)){
                		$creative = $row['id'];
                		$creativeSequence = $row['sequence'];
                		$creativeDelivery = $row['delivery'];
						$creativeDuration = $row['duration'];
						$creativeUrl = $row['url'];
						$creativeType = $row['type'];?>
			            <Creative sequence="<?php echo $creativeSequence;?>" AdID="<?php echo $creative;?>">
			                <Linear>
			                    <Duration><?php echo $creativeDuration?></Duration>
								<?php 
									$query = "SELECT * FROM ads_vast_ads_tracking t JOIN ads_vast_events e on t.event = e.id WHERE t.ad=".$adid." AND t.creative=".$creative;
			                    	$resultCreative = mysqli_query($connection, $query);
			                    	if(mysqli_num_rows($resultCreative)){
			                    		echo "<TrackingEvents>";
			                      		while($rowCreative = mysqli_fetch_array($resultCreative)){
			                    			echo "<Tracking event='".$rowCreative['name']."'><![CDATA[".$rowCreative['trackingUrl']."?adid=".$adid."&creativeid=".$creative."&event=".$rowCreative['event']."]]>"."</Tracking>";
			                    		}
			                    		echo "</TrackingEvents>";
			                    	}	
			                    ?>
			                    <MediaFiles>
			                        <MediaFile id="<?php echo $creative?>" delivery="<?php echo $creativeDelivery?>" type="<?php echo $creativeType?>" bitrate="766" width="854" height="480">
			                            <![CDATA[<?php echo ($creativeUrl);?>]]>
			                        </MediaFile>
			                    </MediaFiles>
			                </Linear>
			            </Creative>                    		
               	<?php }
				?>	
            </Creatives>
        </InLine>
    </Ad>
</VAST>
<?php mysqli_close($connection);?>

