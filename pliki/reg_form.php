<?php
session_start();
require_once('mysql_connect.php');
if(isset($_GET['change'])) {
	$title = 'Zmiana danych';
	$query = "SELECT * FROM users WHERE user_id='{$_SESSION['uid']}'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
} else {
	$title = 'Rejestracja';
}
include('header.php');
?>
<ul id="recepie">
	<li>
		<ul class="add_item">
			<li><label for="reg_login">Login:</label></li>
			<li><?php if(isset($_GET['change'])) { echo '<h3>' . $row['username'] . '</h3>';} else {?><input type="text" name="reg_login" /><?php } ?></li>
			<li><span class="comment"></span></li>
		</ul>
	</li>
	<li>
		<ul class="add_item">
			<li><label for="haslo1">Hasło:</label></li>
			<li><input type="password" name="haslo1" /></li>
			<li><span class="comment"></span></li>
		</ul>
	</li>
	<li>
		<ul class="add_item">
			<li><label for="haslo2">Powtórz hasło:</label></li>
			<li><input type="password" name="haslo2" /></li>
			<li><span class="comment"></span></li>
		</ul>
	</li>
	<li>
		<ul class="add_item">
			<li><label for="email">E-mail:</label></li>
			<li><input type="text" name="email"<?php if(isset($_GET['change'])) { echo " value=\"{$row['email']}\"";}?> /></li>
			<li><span class="comment"></span></li>
		</ul>
	</li>
	<li>
		<ul class="add_item">
			<li></li>
			<li>Adres e-mail jest wymagany tylko i wyłącznie na potrzeby przypominania hasła.</li>
			<li><span class="comment"></span></li>
		</ul>
	</li>
	<li>
		<ul class="add_item">
			<li></li>
			<li><input type="button" <?php if(isset($_GET['change'])) { echo 'name="update" value="Aktualizuj" ';} else {echo 'name="rejestruj" value="Zarejestruj się"  ';} ?>/></li>
			<li></li>
	</li>
</ul>
<?php
include('footer.php');
?>