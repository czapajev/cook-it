<?php

require_once('mysql_connect.php');

	$type = $_GET['type'];
	$value = $_GET['value'];
	
	$query = "SELECT * FROM users WHERE $type='$value'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) ==0) {
		$response = 'wolne';
	} else {
		$response = 'zajete';
	}
	echo $response . mysql_error() . $value;
?>