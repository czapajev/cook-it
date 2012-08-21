<?php
ob_start();
if(!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl-PL">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
if(substr($_SERVER['PHP_SELF'],-9) == 'index.php') {
	$fd = 'pliki/';
	$hd = '';
	
} else {
	$fd = '';
	$hd = '../';
}
$_SESSION['fd'] = $fd;
?>
<script type="text/javascript" src="<?php echo $fd; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo $fd; ?>skypty.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $fd; ?>style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $fd; ?>forms.css" />
<title><?php if(isset($title)) { echo $title; } else { echo 'To jest tytuł artykułu'; } ?></title>
</head>
<body>
<?php
?>
	<div id="top_bar">
		<ul id="top_menu">

			<li><a href="<?php echo $fd; ?>reg_form.php">Rejestracja</a>
			</li>
			<li><a href="<?php echo $fd; ?>new_recepie.php">Dodaj przepis</a>
			</li>
			<li><a href="<?php echo $fd; ?>search.php?key=all&value=all">Wszystkie przepisy</a>
			</li>
		</ul>
	</div>
	<div id="middle_bar">
		<div id="bar_content">
			<div id="left_middle_bar">
			
				<a href="<?php echo $hd; ?>index.php" id="title">Cook-it</a>
			</div>
			<div id="right_middle_bar">
				<div id="log_field">
					<?php
						if(isset($_SESSION['uid'])) {
							include('witaj.php');
						} else {
					?>
					<form id="loginForm" action="">
						<fieldset>
							<legend>Logowanie</legend>
							<label class="" for="login">
							Login:
							<input type="text" name="login" />
							</label>
							<label for="haslo">
							Hasło:
							<input type="password" name="haslo" />
							</label>
							<input type="button" value="Zaloguj" class="submit" name="logowanie" alt="<?php echo $fd; ?>" />
						</fieldset>
					</form>
					<?php
						}
					?>
				</div>
				<div id="search_field">
					<form action="<?php echo $fd; ?>search.php" method="get" name="szukaj">
						<input type="hidden" name="key" value="fulltext" />
						<input type="text" name="value" />
						<input type="submit" value="Szukaj" name="start_search" />
					</form>
				</div>
				</div>
		</div>
	</div>
	<div id="header_bar">
			<h1><?php if(isset($title)) { echo $title; } else { echo 'To jest tytuł artykułu'; } ?></h1>
	</div>
	<div id="main_body">
		<div id="content">