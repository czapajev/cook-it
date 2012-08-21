<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>My dev blog</title>
	<link rel="stylesheet" href="layout.css">
	<script type="text/javascript" src="html5.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="skrypty.js"></script>
</head>
<body>
<header>
	<div id="pasek">
				<div id="dummy_h"></div>
				<div id="dummy_h2"></div>
				<div id="box">Dev Blog</div>
				Jakis tekst
				<div id="dummy_div_h"></div>
			</div>
</header>

<nav>
	<ul>
		<li><a href="#">Link</a>
			<ol>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
			</ol>
		</li>
		<li><a href="#">Link</a>
			<ol>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				
			</ol>
		</li>
		<li><a href="#">Link</a>
			<ol>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				
			</ol>
		</li>
		<li><a href="#">Link</a>
			
		</li>
		
		<li><a href="#">Link</a>
			
		</li>
		
	</ul>
</nav>

<div id="content">
	<div id="c2">
	<div id="main">
<?php

require_once 'mysql_connect.php';

$query = "SELECT * FROM posty ORDER BY pid DESC LIMIT 5";
$result = mysql_query($query);
echo  mysql_error();
while($row = mysql_fetch_array($result, MYSQL_BOTH)) {
	$title = $row['title'];
	$body = $row['body'];
	$author = $row['author'];
	$date = $row['date'];
	$pid = $row['pid'];
	
	
	$q = "SELECT * FROM aside WHERE pid=$pid ORDER BY aid ASC";
	$r = mysql_query($q);
	
	?>
	
	<div>
			<div class="left_margin">
					<?php
						while($r2 = mysql_fetch_array($r, MYSQL_BOTH)) {
							echo '<aside>' . $r2['body'] . '</aside>';
						}
					
					
					?>
			</div>
			<article>
				<header>
					<h2><?php echo $title; ?></h2>
					<div class="art_data">
						Dodano: <time datetime="<?php echo $date ?>" pubdate="pubdate"><?php echo $date ?></time> <br />
						Autor: <?php echo $author; ?>
					</div>
					<div class="author_pic"><img src="photo.jpg" alt="Autor" /></div>
				</header>
						<?php echo $body;  ?>
				<div class="comments">
					<h3>Komentarze:</h3>
				<div>
						<label for="name1">Imię:</label><br /><input type="text" id="name1" name="name1" /><br />
						<label for="comment1">Komentarz:</label><br>
						<textarea id="comment1" name="comment1"></textarea>
						<div><button id="add_comment1">Dodaj komentarz</button></div>
					</div>
				</div>
			</article>
		</div>
	
	
	
	<?php
	
	
}

?>

</div>		
	<section>sekcja</section>
	<section>sekcja</section>
	<section><span id="zegar"></span></section>
</div>
</div>
<div id="dummy_div"></div>
<footer>&copy; Krzysztof Czapiewski</footer>
</body>