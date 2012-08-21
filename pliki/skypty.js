var cost_id = new Array;
var photo = new Array;
var time;
var name;
var desc;
var tagi;
var quan = new Array;
var ing = new Array;
var pcount = 0;

var qcount = 1
$(document).ready(
	function() {
		$('#next').click(
			function() {
				vid = $('.small_pic_visible').attr('id');
				nvid=vid*1;
				nvid++;
				jid = '#' + nvid;
				if($(jid).length) {
					$('.small_pic_visible').fadeOut('slow', function () {
						$('.small_pic_visible').removeClass('small_pic_visible').addClass('small_pic_invisible');
						$(jid).fadeIn('slow', function() {
							$(jid).removeClass('small_pic_invisible').addClass('small_pic_visible');
							}
						);
						}
					
					
					);
				}
			}
		);
		$('#prev').click(
			function() {
				vid = $('.small_pic_visible').attr('id');
				nvid=vid*1;
				nvid--;
				jid = '#' + nvid;
				if($(jid).length) {
					$('.small_pic_visible').fadeOut('slow', function () {
						$('.small_pic_visible').removeClass('small_pic_visible').addClass('small_pic_invisible');
						$(jid).fadeIn('slow', function() {
							$(jid).removeClass('small_pic_invisible').addClass('small_pic_visible');
							}
						);
						}
					
					
					);
				} 
			}
		);	
		$('.cost').hover(
			function() {
				$(this).prevAll().andSelf().addClass('cost_hover').removeClass('cost');
				$(this).nextAll().addClass('cost').removeClass('cost_hover');
				$('label').removeClass('cost').removeClass('cost_hover');
				$(this).parent().next().children().text($(this).attr('alt'));
			},
			function() {
				$(this).siblings().andSelf().addClass('cost').removeClass('cost_hover');
				$('label').removeClass('cost').removeClass('cost_hover');
				$(this).parent().next().children().text('');
			}
		);
		$('.cost').click(
			function() {
				cost_id[$(this).parent().attr('id')] = $(this).attr('id');
				
				$(this).prevAll().andSelf().addClass('clicked').removeClass('cost_hover');
				$(this).nextAll().removeClass('clicked');
				$('label').removeClass('clicked');
			}
		);
		$('.time').each(function() {
			$(this).addClass($(this).attr('id')+'b');
		});
		$('.time').mouseover(function() {
			$(this).addClass($(this).attr('id')).removeClass($(this).attr('id')+'b');
			$(this).parent().next().children().text($(this).attr('alt'));
		});
		mout = function() {
			$(this).removeClass($(this).attr('id')).addClass($(this).attr('id')+'b');
			$(this).parent().next().children().text('');
		}
		$('.time').mouseout(mout);
		
		$('.time').click(function() {
			$time_owner = $(this);
			$time_owner.addClass($time_owner.attr('id')+'-clicked').removeClass($time_owner.attr('id')+'b').unbind('mouseout');
			$time_owner.siblings().each(function() {
				$(this).removeClass($(this).attr('id')+'-clicked').addClass($(this).attr('id')+'b').bind('mouseout',mout);
			});
			time = $(this).attr('id');
			$(this).parent().next().children().text('');
		});

		$('input[name=add]').click(
			function() {
				qcount++;
				text = '<li id="' + qcount + '"><ul class="add_item"><li><input type="text" name="ing' + qcount + '" class="ing" /></li><li><input type="text" name="quan' + qcount + '" class="quan" /></li><li><input type="button" value="Usuń" name="remove" /></li><li><span class="comment"></span></li></ul></li>';
				$(text).hide().insertBefore('#add').slideDown();
				$('input[name=remove]').click(
					function() {
						line = $(this).parent().parent().parent();
						line.slideUp(
							function() {
								line.remove();
							}
						);
					}
				);
				$('.quan').parent().css('text-align','center');
				$('.quan').parent().next().css('width','100px');
				$('#second_page input[type=text]').blur(
					function() {
						
						if($(this).val() == '') {
							$(this).parent().nextAll().last().children().text('Musisz wypełnić te pola');
							$(this).css("background-color","red");
						} else {
							$(this).parent().nextAll().last().children().text('');
							$(this).css("background-color","white");
						}
					}
				);
			}
		);
		$('input[name=remove]').click(
			function() {
				line = $(this).parent().parent().parent();
				line.slideUp(
					function() {
						line.remove();
					}
				);
			}
		);
		$('#recepie input[type=text], #recepie input[type=password]').blur(
			function() {
				
				if($(this).val() == '') {
					$(this).parent().nextAll().last().children().text('Musisz wypełnić te pola');
					$(this).addClass('error');
					$(this).css('color','white');
				} else {
					$(this).parent().nextAll().last().children().text('');
					$(this).removeClass("error");
					$(this).css('color','#0080C0');
				}
			}
		);
		$('#recepie textarea').blur(
			function() {
				
				if($(this).val() == '') {
					$(this).parent().nextAll().last().children().text('Musisz wypełnić te pola');
					$(this).addClass('error');
				} else {
					$(this).parent().nextAll().last().children().text('');
					$(this).removeClass("error");
				}
			}
		);
		$('select').blur(
			function() {
				if($(this).val() == 0) {
					$(this).parent().next().children().text('Musisz wypełnić te pola');
					$(this).addClass('error');
				} else {
					$(this).parent().nextAll().last().children().text('');
					$(this).removeClass("error");
				}
			}
		);
		$('.quan').parent().css('text-align','center');
		$('.quan').parent().next().css('width','100px');
		$('[type=file]').hover(
			function() {
				$(this).parent().next().children().text('Zdjęcie nie jest obowiązkowe');
			},
			function() {
				$(this).parent().next().children().text('');
			}
		);
		$('#third_page .add_item').children(':eq(1)').css('width','500px');
		$('#third_page .add_item').children(':eq(0)').css('display','block');
		$('[name=przeslij]').click(
			function() {
				name = $('input[name=nazwa]').val();
				tagi = $('textarea.tag_area').val();
				cat = $(':selected').val();
				if(cat=='0') {
					cat=false;
				}
				desc = $('textarea.desc_area').val();
				cost = cost_id['cost-choser'];
				diff = cost_id['diff-choser'];
				$('.ing').each(
					function(index) {
						ing[index] = $(this).val();
					}
				);
				$('.quan').each(
					function(index) {
						quan[index]=$(this).val();
					}
				);
				query = 'cat=' + cat +'&name=' + name + '&tagi=' + tagi + '&desc=' + desc + '&cost=' + cost + '&diff=' + diff + '&time=' + time + '&ingr=' + quan.length;
				
				for(i=0;i<ing.length;i++) {
					query += '&ing[' + i + ']=' + ing[i];
				}
				for(i=0;i<quan.length;i++) {
					query += '&quan[' + i + ']=' + quan[i];
				}
				for(i=0;i<photo.length;i++) {
					query += '&photo[' + i + ']=' + photo[i];
				}
				
				if(name && tagi && cat && desc && cost && diff && ing[0] && quan[0]) {
					$.ajax({
						type: "POST",
						url: "save.php",
						data: query,
						success: function(result) {
							//alert(result);
							target = "show.php?pid=" + result;
							
							$(window.location).attr('href',target);
						}
					});
					
					return false;
				} else {
					alert('Musisz podać wszystkie wymagane informacje');
				//alert(name+tagi+cat+desc+cost+time+diff+ing[0]+quan[0]+ing[1]+quan[2]);
					return false;
				}
			}
			
		);
		$('input[name=logowanie]').click(
			function() {
				name = $(this).prevAll('[for=login]').children().val();
				
				pass = $(this).prevAll('[for=haslo]').children().val();
				query = 'name=' + name + '&pass=' + pass;
				file = $(this).attr('alt') + "logowanie.php";
				file2 =$(this).attr('alt') + "witaj.php";
				$.post(file, query, function(result) {
						if(result == 1) {
							$('#loginForm').fadeOut('slow',
								function() {
									$('#loginForm').remove();
									$('#log_field').load(file2);
								}
							);
						} else {
							alert('Logowanie nie powieodło się');
						}
					}
				);
			}
		);
		$('#fav span').click(
			function() {
				favpid = $(this).attr('alt');
				favpid = "fav=" + favpid;
				//alert(favpid);
				$.post("favorites.php", favpid, function(result) {
						if(result == 0) {
							$('#fav').html('Zaloguj się');
						} else {
							if(result == -1) {
								$('#fav').html('To już jest Twój ulubiony przepis');
							} else {
								$('#fav').html('Dodano do ulubionych');
							}
						}
					}
				);
			}
		);
		$('#edit span').click(function() {
			$('.tagi').after($('<span>').addClass('tag_delete').text('X').click(function() {
				tid = $(this).prev().attr('alt');
				tag = $(this).prev();
				del = $(this);
				$.ajax({
					type: "POST",
					url: "delete_tag.php",
					data: "tid=" + tid,
					success: function(result) {
						if(result == 0) {
							tag.fadeOut();
							del.fadeOut();
						}
					}
				})
			}));
			
		});
		$('[name=rejestruj]').click(
			function() {
				login = $('[name=reg_login]').val();
				haslo1 = $('[name=haslo1]').val();
				haslo2 = $('[name=haslo2]').val();
				email = $('[name=email]').val();
				if(haslo1 == haslo2) {
					if(login && haslo1 && email) {
						query = 'login=' + login + '&haslo=' + haslo1 + '&email=' + email;
						$.ajax({
							type: "POST",
							url: "reg.php",
							data: query,
							success: function(result) {
								//alert(result);
								if(result == 0) {
									alert('Rejestracja nieudana');
								} else {
									alert('Możesz się już zalogować');
									target = "../index.php";
									
									$(window.location).attr('href',target);
								}
							}
						});
					} else {
						alert('Wszystkie pola muszą być wypełnione');
					}
				} else {
					alert('Hasła muszą być identyczne');
				}
			}
		);
		$('span.delete').click(function() {
			id = $(this).attr("alt");
			t = $(this);
			$.ajax ({
				type: "POST",
				url: "delete.php",
				data: "pid=" + id,
				success: function(result) {
					if(result == 0) {
						t.parent().parent().slideUp();
					} else {
						if(result == 1) {
							$(this).text("To nie jest Twój przepis");
						} else {
							$(this).text("Musisz sie zalogować");
						}
					}
				}
			});
		});
		$('[name=update]').click(
			function() {
				haslo1 = $('[name=haslo1]').val();
				haslo2 = $('[name=haslo2]').val();
				email = $('[name=email]').val();
				query = '';
				if(haslo1 != '') {
					if(haslo1 == haslo2) {
						flag = true;
						query += 'haslo=' + haslo1;
						//alert(query);
					} else {
						flag = false;
					}
				} else {
					flag=false;
				}
				if(email != '') {
					if(flag) {
						query += '&';
					}
					flag = true;
					query += 'email=' + email;
					//alert(query);
				} else {
					flag = false;
				}
				if(flag) {
					$.ajax({
						type: "POST",
						url: "update.php",
						data: query,
						success: function(result) {
							//alert(result);
							//alert(query);
							if(result == 0) {
								alert('Aktualizacja nieudana');
							} else {
								alert('Twoje dane zostały zmienione');
								target = "../index.php";
								
								$(window.location).attr('href',target);
							}
						}
					});
				}
			}
		);

	}
);



function init() {
	document.getElementById('picDiv').innerHTML = 'Wysyłanie...';

	return true;

}

function postPic() {
  	document.page1.submit();
  	//document.getElementById('picDiv').innerHTML = 'Ładowanie...';
}

function stopUpload(success){

	var result = '';

	if (success == 0){
		document.getElementById('info_pic').innerHTML = 'Wystąpił błąd.';
	} else {
		document.getElementById('picDiv').innerHTML = '<img src="pics/mini/mini_' + success + '.jpg" />';
		document.getElementById('info_pic').innerHTML = '<input type="button" value="Dodaj kolejne zdjęcie" id="next_pic" style="margin-left:200px;" />';
		$('#next_pic').click(
			function() {
				$('#picDiv').html('<input type="file" name="pic" onchange="postPic()"/>');
				$('#info_pic').html('');
				$('[type=file]').hover(
					function() {
						$(this).parent().next().children().text('Zdjęcie nie jest obowiązkowe');
					},
					function() {
						$(this).parent().next().children().text('');
					}
				);
			}
		);	
	
		
		photo[pcount] = success;
		pcount++;
	}
	return true;
}
