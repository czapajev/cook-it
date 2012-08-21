<?php
ob_start();
session_start();
require_once('mysql_connect.php');
$query = explode('_',$_REQUEST['tid']);
if(isset($_SESSION['uid'])) {
	if($query[1] == $_SESSION['uid'] || $_SESSION['uid'] == 1) {
		$q = "DELETE * FROM tag_join WHERE przepis_id='{$query[2]}' AND tag_id='{$query[0]}' LIMIT 1";
		$result = mysql_query($q);

			$q2 = "SELECT ile FROM tagi WHERE tag_id='{$query[0]}'";
			$r = mysql_query($q2);
			$row2 = mysql_fetch_array($r, MYSQL_NUM);
			if($row2[0] == 1) {
				$q3 = "DELETE FROM tagi WHERE tag_id='{$query[0]}'";
				
			} else {
				$ile = $row2[0] - 1;
				$q3 = "UPDATE tagi SET ile='$ile' WHERE tag_id = '{$query[0]}'";
			}
			mysql_query($q3);

			echo 0;
	} else {
		echo 1;
	}
} else {
	echo -1;
}		
?>