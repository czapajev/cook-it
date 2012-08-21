
<?php
	require_once('mysql_connect.php');
	$destination_path = 'pics/';
	$result = 0;
	
	$query = "INSERT INTO pics () VALUES ()";
	$qresult = mysql_query($query);
	$pid = mysql_insert_id();
	
	$file = $destination_path . $pid . '.jpg';
	if(move_uploaded_file($_FILES['pic']['tmp_name'], $file)) {
		if (file_exists($file)) {
				if(chmod($file, 0755)) {
					echo 'fuck';
				} else {
					echo 'tu cie mam';
				}
		}
		echo substr(sprintf('%o', fileperms($file)), -4);
		$file2 = 'pics/' . $pid . '.jpg';
		/*echo $file2;
		if (file_exists($file2)) {
				chmod($file2, 755);
		}*/
		
		list($width, $height) = getimagesize($file);
		$new_width = 350;
		$zmiana = ($new_width/$width) * 100;
		$new_height = ($height/100) * $zmiana;
		if($new_height > $new_width) {
			$new_height = 270;
			$zmiana = ($new_height/$height) *100;
			$new_width = ($width/100) * $zmiana;
		}
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromjpeg($file);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		$flink = 'pics/mini/mini_' . $pid . '.jpg';
		if(imagejpeg($image_p, $flink)) {
	
			$result = $flink;
			$query = "UPDATE pics SET name='$pid', data_dodania=NOW() WHERE pid='$pid'";
			$qresult = mysql_query($query);
		} else {
			echo 'Pffff';
		}
	} else {
	
	echo 'Dupa';
	}

	sleep(1);

?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $pid ?>);
</script> 
