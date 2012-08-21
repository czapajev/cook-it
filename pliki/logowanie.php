<?php
ob_start();
session_start();
require_once('mysql_connect.php');

$username = $_POST['name'];
$pass = $_POST['pass'];

$query = "SELECT * FROM users WHERE username='$username' AND haslo='$pass'";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num == 1) {
	$row = mysql_fetch_row($result);
	$uid = $row[0];
	$_SESSION['username'] = $username;
	$_SESSION['uid'] = $uid;
	echo '1';
} else {
	echo '0';
}
ob_end_flush()


?>