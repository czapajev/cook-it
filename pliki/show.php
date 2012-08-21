<?php
	ob_start();
	session_start();
	require_once('mysql_connect.php');
	$przepis_id = $_REQUEST['pid'];
	$query = "SELECT *
				FROM przepisy
				LEFT JOIN pics ON ( pics.przepis_id = przepisy.przepis_id )
				INNER JOIN users ON (przepisy.uid = users.user_id)
				WHERE przepisy.przepis_id = '$przepis_id'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$pics[] = $row['pid'];
			$nazwa = $row['nazwa'];
			$tresc = $row['opis'];
			$kategoria = $row['kategoria'];
			$czas = $row['czas'];
			$trudnosc = $row['trudnosc'];
			$koszt = $row['koszt'];
			$uid = $row['uid'];
			$user = $row['username'];
			$user_id = $row['user_id'];
		}
		$query = "SELECT COUNT(join_id) FROM tag_join";
		$result = mysql_query($query);
		$row =  mysql_fetch_array($result, MYSQL_NUM);
		$num_tag = $row[0];

		//$query = "SELECT * FROM users WHERE user_id = '$uid'";
		//$result = mysql_query($query);
		//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		//$user = $row['username'];
		
		$title = $nazwa;
		include('header.php');
?>
		<div id="pic_container" class="wraptocenter"><div id="prev"></div>
		<?php
			for($i = 0; $i<count($pics); $i++) {
				if($i==0) {
					if($pics[0] == NULL) {
						echo '<a href="#" class="small_pic_visible" id="' . $i . '"><img src="postit.png" class="blank" /></a>';
					} else {
						echo '<a href="pics/' . $pics[$i] . '.jpg" class="small_pic_visible" id="' . $i . '"><img src="pics/mini/mini_' . $pics[$i] . '.jpg" /></a>';
					}
				} else {
					echo '<a href="pics/' . $pics[$i] . '.jpg" class="small_pic_invisible" id="' . $i . '"><img src="pics/mini/mini_' . $pics[$i] . '.jpg" /></a>';
				}
			}
		?>
		<div id="next"></div>
</div>
<div id="ing_container">

<ul class="ingr">
	<li>Dodane przez: <?php echo '<a href="search.php?key=user&value=' . $user_id . '">' . $user . '</a>';?></li>
	<li><h3>Składniki:</h3></li>
	<?php
	
	$query = "SELECT * FROM skladniki WHERE przepis_id='$przepis_id'";
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo '
	
	<li>
		<ul class="item">
			<li class="ing_s">'. $row['nazwa'] . ':</li>
			<li class="quan_s">'. $row['ilosc'] . '</li>
		</ul>
	</li>';
	}
	?>
	<li>
		<ul class="item">
			<li>Czas:</li>
			<li>
	<?php
	
		
			for($i=1;$i<=3;$i++) {
				if($i == $czas) {
					echo '<img src="time' . $i . '.png" />';
				} else {
					echo '<img src="time' . $i . 'b.png" />';
				}
		}
	?>
			</li>
		</ul>
	</li>
	<li>
		<ul class="item">
			<li>Koszt:</li>
			<li>
	<?php
			for($i=1;$i<=5;$i++) {
				if($i <= $koszt) {
					echo '<img src="cost2.png" />';
				} else {
					echo '<img src="cost1.png" />';
				}
		}
	?>	
			</li>
		</ul>
	</li>
	<li>
		<ul class="item">
			<li>Trudność:</li>
			<li>
	<?php
			for($i=1;$i<=5;$i++) {
				if($i <= $trudnosc) {
					echo '<img src="garnek2.png" />';
				} else {
					echo '<img src="garnek1.png" />';
				}
		}
		?>
			</li>
		</ul>
	</li>
	<li id="fav"><span<?php echo ' alt="' . $przepis_id . '"';?>>Dodaj do ulubionych</span>
	</li>
	<?php
		if($_SESSION['uid'] == 1 || $_SESSION['uid'] == $user_id) {
	?>
	<li id="edit"><span<?php echo ' alt="' . $przepis_id . '"';?>>Edytuj</span>
	</li>
	<?php
		}
	?>
</ul>
</div>
<div id="tag_container">
<?php
		$query = "SELECT * FROM tagi INNER JOIN tag_join ON (tagi.tag_id = tag_join.tag_id) WHERE tag_join.przepis_id='$przepis_id'";
		$result = mysql_query($query);
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
			echo '<a href="search.php?key=tag&value=' . $row['tag_id'] . '" class="' . $tclass . ' tagi" alt="' . $row['tag_id'] . '_' . $user_id . '_' . $przepis_id . '">' . $row['tag'] . '</a> ';
		}
		?>
</div>
<div id="desc_container">
<?php

echo $tresc;

?>
</div>
<div id="com_container"></div>

<?php		

		
		

	}


include('footer.php');
ob_end_flush();
?>