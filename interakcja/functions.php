<?php
function generateUserXML($sid, $msg="",$last=0) {
	$query = "SELECT * FROM sesja WHERE sid=$sid";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_BOTH);
	$m = $row['num'];
	$query = "SELECT sesja.sid, user.id, sesja.nazwa, sesja.num AS snum, user_join.num AS ujnum, active, user.name
FROM user
INNER JOIN user_join ON user.id = user_join.uid
INNER JOIN sesja ON sesja.sid = user_join.sid WHERE sesja.sid=$sid ORDER BY user.id ASC";
	$result = mysql_query($query);
	
	echo '<?xml version="1.0"?>';
	echo '<sesja>';
	echo '<name>' . $row['nazwa'] . '</name>';
	echo '<sid>' . $sid . '</sid>';
	echo '<msg>' . $msg . '</msg>';
	echo '<numOfUsers>' . $m . '</numOfUsers>';
	echo '<users>';
	while($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		echo '<user>';
		echo '<uid>' . $row['id'] . '</uid>';
		echo '<uname>' . $row['name'] . '</uname>';
		echo '<unum>' . $row['ujnum'] . '</unum>';
		echo '<uactive>' . $row['active'] . '</uactive>';
		echo '</user>';
	}
	/*echo '<user>';
	echo '<uid>' . '</uid>';
	echo '<uname>' . '</uname>';
	echo '</user>';*/
	echo '</users>';
	echo '<last_insert>' . $last . '</last_insert>';
	echo '<active>' . $row['aktywny_user'] . '</active>';
	echo '</sesja>';
}
?>