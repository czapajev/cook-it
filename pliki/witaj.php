<?php
ob_start();
if(isset($_SESSION['uid'])) {
	
} else {
	session_start();
}
$username = $_SESSION['username'];
echo '<h3>Witaj, ' . $username . '!</h3>';
?>
<ol class="user_menu">
	<li><a href="<?php echo $_SESSION['fd']; ?>reg_form.php?change=y">Edytuj moje dane</a></li>
	<li><a href="<?php echo $_SESSION['fd']; ?>search.php?key=fav&value=<?php echo $_SESSION['uid']; ?>">Ulubione przepisy</a></li>
	<li><a href="<?php echo $_SESSION['fd']; ?>wyloguj.php">Wyloguj</a></li>
</ol>

<?php

ob_end_flush();
?>