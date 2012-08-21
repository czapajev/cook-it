<?php


	
if(isset($_POST['rejestracja'])) {
	require_once('pliki/mysql_connect.php');
	if(eregi("^[[a-z0-9._-]{4,20}$", stripslashes(trim($_POST['username'])))) {
		$l = escape_data($_POST['username']);
	} else {
		$l = false;
		echo '<p class="error>Login może się składać tylko z liter, cyfr i znaków ".", "-", "_".</p>';
	}

	if (eregi("^[[:alnum:]]{4,20}$", stripslashes(trim($_POST['haslo1'])))) {
		if ($_POST['haslo1'] == $_POST['haslo2']) {
			$h = escape_data($_POST['haslo1']);
		} else {
			$h = false;
			echo '<p class="error">Hasła musz± być identyczne!</p>';
		}
	} else {
		$h = false;
		echo '<p class="error">Hasło musi zawierać 4-20 znaków, bez polskich i specjalnych!</p>';
	}
	if (!empty($_POST['email'])) {
		if (eregi("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", stripslashes(trim($_POST['email'])))) {
			$e = escape_data($_POST['email']);
		} else {
			$e = false;
			echo '<p class="error">Podaj poprawny e-mail!</p>';
		}
	} else {
		$e = 'brak';
	}

	

	
	if ($l && $h && $e) {
		
		$query = "SELECT user_id FROM users WHERE username='$l'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) == 0) {
		
			$query = "INSERT INTO users (username, email, haslo, data_rejestracji) VALUES ('$l', '$e',  '$h', NOW() )";
			$result = @mysql_query($query);
			if($result) {
				echo '<p>Rejestracja pomy¶lna!</p>';
				
				mysql_close();
				exit();
			} else {
				echo '<p class="error">Przepraszamy, ale wyst±piły błędy.</p>' . mysql_error();
			}
		} else {
			echo '<p class="error">Użytkownik o podanej nazwie już istnieje!</p>';
		}
	} else {
		echo '<p class="error">Spróbuj jeszcze raz!</p>';
	}
}

?>