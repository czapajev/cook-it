<?php
session_start();
if(isset($_SESSION['uid'])) {
	$uid = $_SESSION['uid'];
	require_once('mysql_connect.php');
	$pid = $_POST['fav'];
	$query = "SELECT * FROM favorites WHERE user_id='$uid' AND przepis_id='$pid'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO favorites (user_id, przepis_id) VALUES ('$uid', '$pid')";
		$result = mysql_query($query);
		
		echo mysql_insert_id();
	} else {
		echo -1;
	}
	
} else {
echo 0;
}


?>