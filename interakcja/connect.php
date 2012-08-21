<?php
header('Content-type: text/xml');
require_once('mysql_connect.php');
require_once('functions.php');

$name = $_GET['name'];
$query = "INSERT INTO user (name) VALUES ('$name')";
mysql_query($query);
$uid = mysql_insert_id();
$query = "SELECT * FROM sesja WHERE num<4 AND aktywna=1 LIMIT 1";
$result = mysql_query($query);
if(mysql_num_rows($result) == 0) {
	$m = 1;
	$query = "INSERT INTO sesja (nazwa, aktywna, num) VALUES ('sesja_$name', 1, $m)";
	$sname = 'sesja_' . $name;
	mysql_query($query);
	$sid = mysql_insert_id();
	$query = "INSERT INTO user_join (uid, sid, active, num) VALUES ($uid, $sid, 1, $m)";
	mysql_query($query);
	$msg = "Nowa sesja $sname rozpoczęta";
	
} else {
	$row = mysql_fetch_array($result, MYSQL_BOTH);
	$sid = $row['sid'];
	$sname = $row['nazwa'];
	$m = $row['num'];
	$m++;
	$query = "UPDATE sesja SET num=$m WHERE sid=$sid";
	mysql_query($query);
	$query = "INSERT INTO user_join (uid, sid, num) VALUES ($uid, $sid, $m)";
	
	/*if($row['user2'] == 0) {
		//echo 1;
		$query = "UPDATE sesja SET user2=$uid WHERE sid=$id";
		$m = 2;
	} elseif($row['user3'] == 0) {
		//echo 2;
		$query = "UPDATE sesja SET user3=$uid WHERE sid=$id";
		$m = 3;
	} else {
		//echo 3;
		$query = "UPDATE sesja SET user4=$uid WHERE sid=$id";
		$m = 4;
	}*/
	mysql_query($query);
	$msg = "Dołączyłeś jako $m użytkownik";
}

generateUserXML($sid, $msg, $uid);

?>