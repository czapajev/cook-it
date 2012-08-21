<?php
session_start();
require_once('mysql_connect.php');
$query = "UPDATE users SET";
if(isset($_POST['haslo'])) {
	$haslo = $_POST['haslo'];
	$query .= " haslo='$haslo'";
}
if(isset($_POST['email'])) {
	if(isset($_POST['haslo'])) {
		$query .= ',';
	}
	$email = $_POST['email'];
	$query .= " email='$email'";
}

$uid = $_SESSION['uid'];
$query .= " WHERE user_id='$uid'";


$result = mysql_query($query);

echo mysql_affected_rows();







?>