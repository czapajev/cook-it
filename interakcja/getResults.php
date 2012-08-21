<?php
header('Content-type: text/xml');
require_once('mysql_connect.php');
require_once('functions.php');

$sid = $_GET['sid'];
if(isset($_GET['posts'])) {
	$posts = $_GET['posts'];
	$s = $posts-1;
	$e = $posts;
} else {
	$s = 0;
	$e = 1000000;
}
$query = "SELECT * 
FROM wyniki
INNER JOIN user ON user.id = wyniki.uid WHERE sid=$sid ORDER BY time ASC LIMIT $s, $e";
$result = mysql_query($query);
echo '<wyniki>';
while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
	echo '<linia>';
	echo '<uid>' . $row['uid'] . '</uid>';
	echo '<uname>' . $row['name'] . '</uname>';
	echo '<body>' . $row['tresc'] . '</body>';
	echo '<time>' . $row['time'] . '</time>';
	echo '</linia>';
}
echo '</wyniki>';
//echo mysql_error();
?>