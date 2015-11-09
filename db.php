<?php
#$db_host='localhost';
#$db_catalog='ads';
#$db_user='root';
#$db_pass='abcd!234';

#$db_phpmyadmin='https://p3nlmysqladm002.secureserver.net/grid55/179';
$db_host='trmdemo.db.4081757.hostedresource.com';
$db_catalog='trmdemo';
$db_user='trmdemo';
$db_pass='Abcd!234';



$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_catalog);
if (mysqli_connect_errno()) {
	die("Cannot Open Connection");
}
?>