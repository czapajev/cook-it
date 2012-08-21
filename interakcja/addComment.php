<?php
//header('Content-type: text/xml');
require_once('mysql_connect.php');
require_once('functions.php');
$com = $_GET['com'];
$uid = $_GET['uid'];
$sid = $_GET['sid'];

$query = "INSERT INTO wyniki (uid, sid, tresc, time) VALUES ($uid, $sid, '$com', NOW())";
mysql_query($query);
$query = "SELECT user_join.num AS unum, sesja.num AS snum FROM user_join INNER JOIN sesja ON user_join.sid=sesja.sid WHERE user_join.sid=$sid AND user_join.uid=$uid";
$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_BOTH);

$active = $row['unum'];
//echo $row['snum'];
if($active<$row['snum']) {
	$active++;
} else {
	$active=1;
}
//echo $active;
$query = "UPDATE user_join SET active=0 WHERE uid=$uid AND sid=$sid";
mysql_query($query);

$query = "UPDATE user_join SET active=1 WHERE sid=$sid AND num=$active";
mysql_query($query);
//echo mysql_error();
$query = "SELECT * FROM wyniki WHERE sid=$sid ORDER BY time ASC";
$result = mysql_query($query);
echo mysql_num_rows($result);
?>