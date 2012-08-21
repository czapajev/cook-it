<?php
include('header.php');
?>
<div id="add_body">
	<h3>Dodaj swój własny przepis</h3>
	<form name="page1" id="pic" action="pliki/upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="init()">
	<div id="page1">
		<h4>Strona 1/3</h4>
		<div class="line">
			<div class="label">
				Nazwa:
			</div>
			<div class="input">
				<input type="text" class="text" name="name" />
			</div>
		</div>
		<div class="line">
			<div class="label">
				Kategoria:
			</div>
			<div class="input">
				<select class="text" name="category">
					<option value="0">-----</option>
					<option value="snacks">Przekąski</option>
					<option value="salads">Sałatki</option>
					<option value="soups">Zupy</option>
					<option value="beef">Wołowina</option>
					<option value="pork">Wieprzowina</option>
					<option value="poultry">Drób</option>
					<option value="other">Inne mięsa</option>
					<option value="weg">Wegetariańskie</option>
					<option value="fish">Ryby</option>
					<option value="deserts">Desery</option>
					<option value="cakes">Ciasta</option>
				</select>
			</div>
		</div>
		<div class="line">
			<div class="label">
				Tagi (oddzielaj przecinkami):
			</div>
			<div class="input">
				<textarea name="tags" id="tags"></textarea>
			</div>
		</div>
		<div class="line">		
			<div class="label">
				Zdjęcie:
			</div>
			<div class="input" id="picDiv">
				<input type="file" class="file" name="picture" onmouseover="document.getElementById('info_pic').style.visibility = 'visible'" onmouseout="document.getElementById('info_pic').style.visibility = 'hidden'" onchange="postPic()" />
				<br /><span id="info_pic" style="visibility: hidden">Zdjęcie nie jest obowiązkowe</span>
			</div>
		<iframe id="upload_target" name="upload_target" src="" style="display: none;"></iframe>

		</div>
		<div class="line">
			<div class="label">
				Czas przygotowania:
			</div>
			<div class="input">
				<img src="pliki/time1b.png" id="time1" onmouseover="checkOn(this, 'Krótki')" onmouseout="checkOut(this)" onclick="picSelect(this)" />
				<img src="pliki/time2b.png" id="time2" onmouseover="checkOn(this, 'Średni')" onmouseout="checkOut(this)" onclick="picSelect(this)" />
				<img src="pliki/time3b.png" id="time3" onmouseover="checkOn(this, 'Długi')" onmouseout="checkOut(this)" onclick="picSelect(this)" />
				<span id="info_time"></span>
			</div>
		</div>
		<div class="line">
			<div class="label">
				Koszt:
			</div>
			<div class="input">
				<img src="pliki/cost1.png" id="cost1" onmouseover="countOn(this, 'Bardzo niski')" onmouseout="countOut(this)" onclick="picCost(this)" />
				<img src="pliki/cost1.png" id="cost2" onmouseover="countOn(this, 'Niski')" onmouseout="countOut(this)" onclick="picCost(this)" />
				<img src="pliki/cost1.png" id="cost3" onmouseover="countOn(this, 'Średni')" onmouseout="countOut(this)" onclick="picCost(this)" />
				<img src="pliki/cost1.png" id="cost4" onmouseover="countOn(this, 'Wysoki')" onmouseout="countOut(this)" onclick="picCost(this)" />
				<img src="pliki/cost1.png" id="cost5" onmouseover="countOn(this, 'Bardzo wysoki')" onmouseout="countOut(this)" onclick="picCost(this)" />
				<span id="info_cost"></span>
			</div>
		</div>
		<div class="line">
			<div class="label">
				Trudność:
			</div>
			<div class="input">
				<img src="pliki/garnek1.png" id="garnek1" onmouseover="countOnCom(this, 'Bardzo łatwe')" onmouseout="countOutCom(this)" onclick="picCom(this)" />
				<img src="pliki/garnek1.png" id="garnek2" onmouseover="countOnCom(this, 'Łatwe')" onmouseout="countOutCom(this)" onclick="picCom(this)" />
				<img src="pliki/garnek1.png" id="garnek3" onmouseover="countOnCom(this, 'Średnie')" onmouseout="countOutCom(this)" onclick="picCom(this)" />
				<img src="pliki/garnek1.png" id="garnek4" onmouseover="countOnCom(this, 'Trudne')" onmouseout="countOutCom(this)" onclick="picCom(this)" />
				<img src="pliki/garnek1.png" id="garnek5" onmouseover="countOnCom(this, 'Bardzo trudne')" onmouseout="countOutCom(this)" onclick="picCom(this)" />
				<span id="info_garnek"></span>
			</div>
		</div>
		<div class="next">
			<input type="button" class="button" onclick="nextpage()" value="Dalej" />
		</div>
	</div>
	<div id="page2" style="display: none;">
	<h4>Strona 2/3</h4>
		<div class="line">
			<div class="ing">Składnik</div>
			<div class="quan">Ilość</div>
		</div>
		<div class="line" id="l1">
			<div class="ing">
				<input type="text" name="ing1" id="ing1" class="textIng" />
			</div>
			<div class="quan">
				<input type="text" name="quan1" id="quan1" class="textQuan" /><input type="button" id="line1" value="Usuń" onclick="delIng(this)" class="button" />
			</div>
		</div>
		<div class="line" id="but">
			<input type="button" name="add" onclick="addIng()" value="Dodaj składnik" class="button" />
		</div>
		<div class="line">
			<input type="button" class="button2" value="Wstecz" onclick="document.getElementById('page1').style.display = 'block'; document.getElementById('page2').style.display = 'none'" />
			<input type="button" class="button2" value="Dalej" onclick="nextpage2()">
		</div>
	</div>
	<div id="page3" style="display: none;">
	<h4>Strona  3/3</h4> 
		<div  class="line">
			<div  class="label">Przepis:</div> 
			<div  class="input">
				<textarea cols="20" rows="40" name="desc" class="desc" id="desc"></textarea>
			</div> 
		</div>
		<div  class="line">
			<input type="button"  class="button2" value="Wstecz" onclick="document.getElementById('page2').style.display = 'block'; document.getElementById('page3').style.display = 'none'" />
			<input type="button" id="finish" value="Zapisz" onclick="saveRecepie()" class="button2" />
		</div>
	</div>
	<div id="notice" onclick="this.style.display = 'none'">

	</div>
</div>
<?php
include('footer.php');
?>