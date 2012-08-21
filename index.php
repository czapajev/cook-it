<?php
$title = 'Cook it - moja książka kucharska';
include('pliki/header.php');
require_once('pliki/mysql_connect.php');
?>

<div id="recent">
<h3>Ostatnio dodane:</h3>
<?php
$query = "SELECT * FROM przepisy ORDER BY data_dodania DESC LIMIT 5";
$result = mysql_query($query);

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$pic_query = "SELECT * FROM pics WHERE przepis_id = '{$row['przepis_id']}' LIMIT 1";
		$pic_result = mysql_query($pic_query);
		$pic_row = mysql_fetch_row($pic_result);
		
		echo '<div class="search_item_small"><div class="pic"><a href="pliki/show.php?pid=' . $row['przepis_id'] . '"><img src="pliki/';
		if ($pic_row) { 
			echo 'pics/mini/mini_' . $pic_row[0] . '.jpg"';
		} else {
			echo 'postit.png"';
		}
		echo ' class="preview" /></a></div>';
		echo '<div class="desc_pic_small"><a href="pliki/show.php?pid=' . $row['przepis_id'] . '">'. $row['nazwa'] . '</a><div class="desc_preview_small">';
		echo  implode(' ',(array_slice(explode(' ',$row['opis'], 10), 0, -1))) . '...</div></div>';
		echo '<div class="add_date_small">Dodano: ' . $row['data_dodania'] . '</div></div>';
}
?>
</div>
<div id="day">
<h3>Losowy przepis:</h3>
<?php

	$query = "SELECT p.przepis_id, nazwa, uid, username, pid
				FROM przepisy AS p
				LEFT JOIN pics AS pi ON ( pi.przepis_id = p.przepis_id )
				INNER JOIN users AS u ON (p.uid = u.user_id)
				WHERE p.przepis_id  >= (SELECT FLOOR(MAX(przepisy.przepis_id) * RAND()) FROM przepisy )
				ORDER BY p.przepis_id LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$pics = $row['pid'];
			$nazwa = $row['nazwa'];
			//$tresc = $row['opis'];
			//$kategoria = $row['kategoria'];
			//$czas = $row['czas'];
			//$trudnosc = $row['trudnosc'];
			//$koszt = $row['koszt'];
			$uid = $row['uid'];
			$user = $row['username'];
			//$user_id = $row['user_id'];
			$przepis_id = $row['przepis_id'];
			if($pics == NULL) {
				echo '<a href="pliki/show.php?pid=' . $przepis_id . '" class="small_pic_visible"><img src="pliki/postit.png" class="blank" /></a>';
			} else {
				echo '<a href="pliki/show.php?pid=' . $przepis_id . '" class="small_pic_visible" id="' . $pics . '"><img src="pliki/pics/mini/mini_' . $pics . '.jpg" /></a>';
			}
			echo '<a href="pliki/show.php?pid=' . $przepis_id . '">' . $nazwa . '</a>';
?>
</div>
<div id="some_space">
<h3>Kategorie:</h3>
	<a href="pliki/search.php?key=cat&value=Przekąski" class="cat_href">Przekąski</a>
	<a href="pliki/search.php?key=cat&value=Sałatki" class="cat_href">Sałatki</a>
	<a href="pliki/search.php?key=cat&value=Zupy" class="cat_href">Zupy</a>
	<a href="pliki/search.php?key=cat&value=Wołowina" class="cat_href">Wołowina</a>
	<a href="pliki/search.php?key=cat&value=Wieprzowina" class="cat_href">Wieprzowina</a>
	<a href="pliki/search.php?key=cat&value=Drób" class="cat_href">Drób</a>
	<a href="pliki/search.php?key=cat&value=Inne mięsa" class="cat_href">Inne mięsa</a>
	<a href="pliki/search.php?key=cat&value=Wegetariańskie" class="cat_href">Wegetariańskie</a>
	<a href="pliki/search.php?key=cat&value=Ryby" class="cat_href">Ryby</a>
	<a href="pliki/search.php?key=cat&value=Desery" class="cat_href">Desery</a>
	<a href="pliki/search.php?key=cat&value=Ciasta" class="cat_href">Ciasta</a>
</div>
<div id="tag_index">
<h3>Tagi:</h3>
<?php
		$query = "SELECT COUNT(join_id) FROM tag_join";
		$result = mysql_query($query);
		$row =  mysql_fetch_array($result, MYSQL_NUM);
		$num_tag = $row[0];
$query = "SELECT * FROM tagi";
$result  = mysql_query($query);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$per = $row['ile']/$num_tag * 100;
			if($per < 2) {
				$tclass = 't1';
			} elseif($per <5) {
				$tclass = 't2';
			} elseif($per<8) {
				$tclass= 't3';
			} elseif($per<12) {
				$tclass= 't4';
			} elseif($per<14) {
				$tclass= 't5';
			} elseif($per<16) {
				$tclass= 't6';
			} elseif($per<18) {
				$tclass= 't7';
			} elseif($per<24) {
				$tclass= 't8';
			} elseif($per<30) {
				$tclass= 't9';
			} elseif($per<40) {
				$tclass= 't10';
			} else {
				$tclass= 't11';
			}
			echo '<a href="pliki/search.php?key=tag&value=' . $row['tag_id'] . '" class="' . $tclass . '">' . $row['tag'] . '</a> ';
		}
?>
</div>


<?php
include('pliki/footer.php');
?>