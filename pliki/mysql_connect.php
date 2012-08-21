<?php

define ('DB_USER' , 'cookit');
define ('DB_PASSWORD','spec65');
define ('DB_HOST','sql7.lh.pl');
define ('DB_NAME','cookit_jedzenie');

$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die ('Nie było mozliwe połączenie z serwerem MySQL: ' . mysql_error());
mysql_select_db (DB_NAME) or die ('Nie było można wybrać bazy danych: ' . mysql_error());

function escape_data ($data) {
	global $dbc;
	if (ini_get('magic_quotes_gpc')) {
		$data = stripslashes($data);
	}
	return mysql_real_escape_string(trim($data),$dbc);
}
$query = "SET CHARACTER SET utf8";
$result = mysql_query($query);
$query = "SET collation_connection = utf8_bin";
$result = mysql_query($query);
?>
