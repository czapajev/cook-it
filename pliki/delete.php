<?php
ob_start();
session_start();
require_once('mysql_connect.php');
$query = explode('_',$_REQUEST['pid']);
if(isset($_SESSION['uid'])) {
	if($query[1] == $_SESSION['uid'] || $_SESSION['uid'] == 1) {
		$q = "DELETE FROM przepisy WHERE przepis_id='{$query[0]}'";
		mysql_query($q);
		echo mysql_error();
		$q = "DELETE FROM skladniki WHERE przepis_id='{$query[0]}'";
		mysql_query($q);
		echo mysql_error();
		$q = "SELECT * FROM przepisy WHERE przepis_id='{$query[0]}'";
		$result = mysql_query($q);
		echo mysql_error();
		$a = mysql_num_rows($result);
		
		$q = "SELECT * FROM tag_join WHERE przepis_id='{$query[0]}'";
		$result = mysql_query($q);
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			$tag = $row[1];
			$q2 = "SELECT ile FROM tagi WHERE tag_id='$tag'";
			$r = mysql_query($q2);
			$row2 = mysql_fetch_array($r, MYSQL_NUM);
			if($row2[0] == 1) {
				$q3 = "DELETE FROM tagi WHERE tag_id='$tag'";
				
			} else {
				$ile = $row2[0] - 1;
				$q3 = "UPDATE tagi SET ile='$ile' WHERE tag_id = '$tag'";
			}
			mysql_query($q3);
		}
		$q2 = "DELETE FROM tag_join WHERE przepis_id='{$query[0]}'";
		mysql_query($q2);
		echo mysql_error();
		echo $a;
	} else {
		echo 1;
	}
} else {
	echo -1;
}
ob_end_flush();
?>