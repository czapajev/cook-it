<?php
	ob_start();
	session_start();
	
	require_once('mysql_connect.php');
	$search_key = $_GET['key'];
	$value = $_GET['value'];
	//echo $search_key;
	switch ($search_key) {
		case 'tag':
				$tag_id = $value;
				$query = "SELECT tag FROM tagi WHERE tag_id = '$tag_id'";
				$result = mysql_query($query);
				$tag = mysql_fetch_row($result);
				$query = "SELECT przepisy.nazwa, przepisy.data_dodania, przepisy.przepis_id, tagi.tag_id, tagi.tag, tag_join.tag_id, tag_join.przepis_id, przepisy.opis, przepisy.uid 
						FROM przepisy 
						INNER JOIN (tag_join, tagi) 
						ON (tagi.tag_id = tag_join.tag_id AND przepisy.przepis_id = tag_join.przepis_id) 
						WHERE tagi.tag_id = '$tag_id'";
				$title = "Przepisy z tagiem \"{$tag[0]}\"";
		break;
		case 'user':
			$user_id = $value;
			$query = "SELECT username FROM users WHERE user_id='$user_id'";
			$result = mysql_query($query);
			$tag = mysql_fetch_array($result, MYSQL_NUM);
			$query = "SELECT nazwa, data_dodania, przepis_id, opis, uid FROM przepisy WHERE uid='$user_id'";
			$title = "Przepisy użytkownika {$tag[0]}";
		break;
		case 'cat':
			$cat = $value;
			$query = "SELECT * FROM przepisy WHERE kategoria='$cat'";
			$result = mysql_query($query);
			$title = "Przepisy z kategorii: $cat";
		break;
		case 'all':
			$cat = $value;
			$query = "SELECT * FROM przepisy ORDER BY LOWER(nazwa) ASC";
			$result = mysql_query($query);
			$title = "Wszystkie przepisy";
		break;
		case 'fulltext':
			$search_term = $value . "|" . ucfirst($value);
			
			$query = "(SELECT * FROM przepisy WHERE MATCH (nazwa) AGAINST ('$search_term' IN NATURAL LANGUAGE MODE)) UNION (SELECT * FROM przepisy WHERE MATCH (opis) AGAINST ('$search_term' IN NATURAL LANGUAGE MODE))";
			$result = mysql_query($query);
			$title = 'Wyniki szukania: "' . $value . '"';
		break;
		case 'fav':
			$uid = $_SESSION['uid'];
			if($uid == $value) {
				$query =  "SELECT * 
							FROM przepisy
							INNER JOIN (
							favorites
							) ON favorites.przepis_id = przepisy.przepis_id
							WHERE favorites.user_id ='$uid'";
				$result = mysql_query($query);
			}
			$title = 'Twoje ulubione przepisy';
		break;
	}
	
	//echo $query;
	
	$result = mysql_query($query);
	include('header.php');
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$pic_query = "SELECT * FROM pics WHERE przepis_id = '{$row['przepis_id']}' LIMIT 1";
		$pic_result = mysql_query($pic_query);
		$pic_row = mysql_fetch_row($pic_result);
		
		echo '<div class="search_item"><div class="pic"><a href="show.php?pid=' . $row['przepis_id'] . '"><img src="';
		if ($pic_row) { 
			echo 'pics/mini/mini_' . $pic_row[0] . '.jpg"';
		} else {
			echo 'postit.png"';
		}
		echo ' class="preview" /></a></div>';
		echo '<div class="desc_pic"><a href="show.php?pid=' . $row['przepis_id'] . '">'. $row['nazwa'] . '</a><div class="desc_preview">';
		echo  implode(' ',(array_slice(explode(' ',$row['opis'], 25), 0, -1))) . '...</div></div>';
		echo '<div class="add_date">Dodano: ' . $row['data_dodania'];
		if($_SESSION['uid'] == $row['uid'] || $_SESSION['uid'] == 1) {
			echo ' <span class="delete" alt="' . $row['przepis_id'] . '_' . $row['uid'] . '">Usuń</span>';
		}
		echo '</div></div>';
	}
	include('footer.php');
	ob_end_flush();
?>