<?php
$title = 'Dodaj nowy przepis';
include('header.php');
if(isset($_SESSION['uid'])) {

?>
<div id="container">
<!--<form action="javascript: alert('Dupa');" method="post" name="przepis">-->
<ol id="recepie">
	<li id="first_page">
		<ul class="add_ing">
			<li>
				<ul class="add_item">
					<li><label for="nazwa">Nazwa:</label></li>
					<li><input type="text" name="nazwa" /></li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
			<li>
				<ul class="add_item">
					<li><label for="cat">Kategoria:</label></li>
					<li><select name="cat">
						<option value="0">-----</option>
						<option value="Przekąski">Przekąski</option>
						<option value="Sałatki">Sałatki</option>
						<option value="Zupy">Zupy</option>
						<option value="Wołowina">Wołowina</option>
						<option value="Wieprzowina">Wieprzowina</option>
						<option value="Drób">Drób</option>
						<option value="Inne mięsa">Inne mięsa</option>
						<option value="Wegetariańskie">Wegetariańskie</option>
						<option value="Ryby">Ryby</option>
						<option value="Desery">Desery</option>
						<option value="Ciasta">Ciasta</option>
					</select></li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
			<li>
				<ul class="add_item">
					<li><label for="tags">Tagi (rozdzielaj przecinkami):</label></li>
					<li><textarea name="tags" class="tag_area"></textarea></li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
			<li><form name="page1" id="pic" action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="init()">
				<ul class="add_item">
					<li><label for="pic">Zdjęcie:</label></li>
					<li id="picDiv"><input type="file" name="pic" onchange="postPic()"/></li>
					<li><span class="comment" id="info_pic"></span><iframe id="upload_target" name="upload_target" src="" style="display: none;"></iframe></li>
				</ul></form>
			</li>
			<li>
				<ul class="add_item">
					<li><label>Czas przygotowania:</label></li>
					<li id="time-choser">
						<span id="time1" class="time1 time" alt="Krótki (do 30 min)"></span>
						<span id="time2" class="time2 time" alt="Średni (do 1,5 godziny)"></span>
						<span id="time3" class="time3 time" alt="Długi (ponad 1,5 godziny)"></span>
					</li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
			<li>
				<ul class="add_item">
					<li><label>Koszt:</label></li>
					<li id="cost-choser">
						<span id="cost1" class="cost" alt="Bardzo niski"></span>
						<span id="cost2" class="cost" alt="Niski"></span>
						<span id="cost3" class="cost" alt="Średni"></span>
						<span id="cost4" class="cost" alt="Wysoki"></span>
						<span id="cost5" class="cost" alt="Bardzo wysoki"></span>
					</li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
			<li>
				<ul class="add_item">
					<li><label>Trudność:</label></li>
					<li id="diff-choser">
						<span id="diff1" class="cost" alt="Bardzo łatwe"></span>
						<span id="diff2" class="cost" alt="Łatwe"></span>
						<span id="diff3" class="cost" alt="Średnie"></span>
						<span id="diff4" class="cost" alt="Trudne"></span>
						<span id="diff5" class="cost" alt="Bardzo trudne"></span>			
					</li>
					<li><span class="comment"></span></li>
				</ul>
			</li>
		</ul>
	</li>
	<li id="second_page">
		<ol class="add_ing">
			<li>
				<ul class="add_item">
					<li><h4>Składnik:</h4></li>
					<li><h4>Ilość:</h4></li>
				</ul>
			</li>

			<li id="1"><ul class="add_item"><li><input type="text" name="ing1" class="ing" /></li><li><input type="text" class="quan" name="quan1" /></li><li><input type="button" value="Usuń" name="remove" /></li><li><span class="comment"></span></li></ul></li>
			<li id="add">
				<input type="button" value="Dodaj składnik" name="add" />
			</li>
		</ol>
	</li>
	<li id="third_page">
		<ul class="add_item">
			<li><label for="opis">Opis przyrządzenia:</label></li>
			<li><textarea name="opis" class="desc_area"></textarea></li>
			<li><span class="comment"></span>
		</ul>
	</li>
	<li>
		<input type="button" value="Dodaj przepis" name="przeslij" />
	</li>
</ol>
<!--</form>-->
</div>
<?php
} else {
	echo 'Musisz się zalogować, aby dodać przepis';
}
include('footer.php');
?>
