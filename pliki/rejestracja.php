<form name="rejestracja" method="post" action="?p=rejestruj">
	<div id="rej_body">
	<div class="line">
		<div class="label">
			Login:
		</div>
		<div class="input">
			<input type="text" name="username" id="username" class="rejestracja" onblur="check(this)" onfocus="highlight(this)" onmouseover="hint(this, 'Login musi zawierać od 3 do 12 znaków bez polskich znaków i znaków specjalnych')" onmouseout="hide_hint()" />
		</div>
	</div>
	<div class="line">
		<div class="label">
			Hasło:
		</div>
		<div class="input">
			<input type="password" name="haslo1" id="haslo1" class="rejestracja" onblur="check(this)" onfocus="highlight(this)" onmouseover="hint(this, 'Hasło musi miec od 4 do 12 znaków bez polskich znaków i znaków specjalnych')" onmouseout="hide_hint()" />
		</div>
	</div>
	<div class="line">
		<div class="label">
			Powtórz hasło:
		</div>
		<div class="input">
			<input type="password" name="haslo2" id="haslo1" class="rejestracja" onblur="check(this)"onfocus="highlight(this)" onmouseover="hint(this, 'Powtórz hasło, musi byc identyczne jak hasło powyżej')" onmouseout="hide_hint()" />
		</div>
	</div>
	<div class="line">
		<div class="label">
			E-mail:
		</div>
		<div class="input">
			<input type="text" name="email" id="email" class="rejestracja" onblur="check(this)" onfocus="highlight(this)" />
		</div>
	</div>
	<div id="info">E-mail jest potrzebny tylko do potwierdzenia rejestracji oraz do przypominania hasła. Nie będzie wykorzystany w żaden inny sposób</div>
	<div class="line">		
		<input type="submit" class="submit" id="rejestracja" name="rejestracja" />
	</div>
	</div>
</form>
<div id="form_info"></div>