<?php
header('Content-type: text/xml');
require_once('mysql_connect.php');
require_once('functions.php');
$sid = $_GET['sid'];

/*$query = "SELECT * FROM sesja WHERE sid=$sid";
$result = mysql_query($query);

$row = mysql_fetch_array($result, MYSQL_BOTH);
if($row['user2'] || $row['user3'] || $row['user4']) {
	
}*/
generateUserXML($sid);
?>