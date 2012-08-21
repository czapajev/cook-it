<?php
ob_start();
session_start();
if(isset($_SESSION['uid'])) {
	$tag_id =0;
	$przepis_id = 0;
	require_once('mysql_connect.php');
	//sendValues = 'name=' + name + '&src=' + rscr + '&cat=' + cat + '&time=' + time + '&cost=' + cost + '&comp=' + com + '&ingr=' + ingredients.toString();
	$name = $_REQUEST['name'];
	//$src = $_REQUEST['rscr'];
	$cat = $_REQUEST['cat'];
	$tags = $_REQUEST['tagi'];
	$time = substr($_REQUEST['time'],-1);
	$cost = substr($_REQUEST['cost'],-1);
	$comp = substr($_REQUEST['diff'],-1);
	$ingr = $_REQUEST['ingr'];
	$ing = $_REQUEST['ing'];
	$quan = $_REQUEST['quan'];
	$desc = $_REQUEST['desc'];
	if(isset($_REQUEST['photo'])) {$pid = $_REQUEST['photo'];}
	$uid = $_SESSION['uid'];
	$tagArray = explode(",",$tags);
	
	$query = "INSERT INTO przepisy (nazwa, opis, czas, trudnosc, koszt, kategoria, uid, data_dodania) VALUES ('$name','$desc','$time','$comp','$cost','$cat','$uid',NOW())";
	$result = mysql_query($query);
	$przepis_id = mysql_insert_id();
	
	/*if(array_search($cat, $tagArray) == null) {
		$tagArray[] = $cat;
	}*/
	if(isset($pid)) {
		for($i=0;$i<count($pid);$i++) {
			$query = "UPDATE pics SET przepis_id = '$przepis_id' WHERE pid='{$pid[$i]}'";
			$result = mysql_query($query);
		}
	}
	for ($i = 0; $i<$ingr; $i++) {
		$klucz = null;
		$query = "INSERT INTO skladniki (nazwa, ilosc, przepis_id) VALUES ('{$ing[$i]}','{$quan[$i]}', '$przepis_id')";
		$result = mysql_query($query);
		$klucz = array_search($ing[$i], $tagArray);
		/*if ($klucz == null) {
			$tagArray[] = $ing[$i];
		}*/
	}
	
	$ileTag = count($tagArray);
	
	for($i = 0; $i<$ileTag; $i++) {
		$tagArray[$i] = trim($tagArray[$i]);
		$query = "SELECT ile, tag_id FROM tagi WHERE tag='{$tagArray[$i]}'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$ile = 1 + $row['ile'];
				$tag_id = $row['tag_id'];
			}
			$query = "UPDATE tagi SET ile='$ile' WHERE tag_id = '$tag_id'";
			$result = mysql_query($query);
		} else {
			$query = "INSERT INTO tagi (tag, ile) VALUES ('{$tagArray[$i]}', '1')";
			$result = mysql_query($query);
			$tag_id = mysql_insert_id();
		}
		$query = "INSERT INTO tag_join (tag_id, przepis_id) VALUES ('$tag_id', '$przepis_id')";
		$result = mysql_query($query);
	}
	
	echo $przepis_id;
} else {
	echo 0;
}
ob_end_flush();
?>