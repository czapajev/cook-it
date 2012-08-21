	var name = "";
	var aname = 0;
	var auid = 0;
	var uid = 0;
$(document).ready(function() {

	if(!name) {
		$('#polecenie').text("Podaj imię");
	} 
	$('#send').click(function() {
		if($('#polecenie').text="Podaj imię") {
			//alert('dupa');
			if($('#tresc').val()) {
				name = $('#tresc').val();
				$('#polecenie').text("Witaj "+name);
				$('#tresc').val('').slideUp();
				link = "connect.php?name="+name;
				$.ajax({
					url: link,
					success: function(data) {
						/*var text = "<ul><li>Użytkownicy:</li>";
						$(data).find('user').each(function() {
							var $user = $(this);
							text += "<li>" + $user.children('uname').text() + "</li>";
						});
						text += "</ul>";
						$('#lista').append(text);*/
						auid = printUsers(data);
						$('#send').fadeOut();
						num = $(data).find('numOfUsers').text();
						var html = $(data).find('msg').text();
						sid = $(data).find('sid').text();
						if(num == 1) {
							html += "<br />Musisz poczekać na kolejnch użytkowników";
							
							reCheck(sid);
						} else {
							html += '<br /><input type="button" value="Zamknij" id="close" />';
						}
						$('#message').html(html).fadeIn();
						$('#close').click(function() {
							$('#message').fadeOut();
						});
						$('h2').text($(data).find('name').text()).fadeIn();
						uid = $(data).find('last_insert').text();
						checkPosts(sid);
						//if(uid == auid) {
							$('#commentSet').fadeIn(function() {
								$('#sendComment').click(function() {
									com = $('#comment').val();
									$('#comment').val('').focus();
									$.ajax({
										url: "addComment.php?uid="+uid+"&sid="+sid+"&com=" + com,
										success: function(data) {
											if(data != 0) {
												//$("#commentSet").fadeOut();
												/*$.ajax({
													url: "getResults.php?sid="+sid+"&posts="+data,
													success: function(data) {
														user = $(data).find('uname').text();
														tresc = $(data).find('body').text();
														time = $(data).find('time').text();
														var html = '<div>' + time + ' <strong>user:</strong> '+tresc+'</div>';
														reCheck(sid);
														$('#result').append(html); 
													}
												});*/
											}
										}
									});
								});
							});
						//}
					}
				});
			}
		} 
		

	});
	
	
	
});
function reCheck(sid) {
	$.ajax({
		url: "checkStatus.php?sid="+sid,
		success: function(data) {
			num = $(data).find('numOfUsers').text()*1;
			if(num>1) {
				$('#message').fadeOut();
				printUsers(data);
			} else {
				rc = setTimeout(reCheck(sid), 1000);
			}
		}
	});
	//rc = setTimeout(reCheck(sid), 500);
}
function printUsers(data) {
	$('#lista').empty();
	active=0;
	var text = '<ul class="userlist"><li>Użytkownicy:</li>';
	$(data).find('user').each(function() {
		var user = $(this);
		
		//text += "<li>" + $user.children('uname').text() + "</li>";
		if($(this).children('uactive').text() == 1) {
			active = $(this).children('unum').text();
			auid = $(this).children('uid').text();
			aname = $(this).children('uname').text();
			//text += '<li style="font-weight: bold">' + $user.children('uname').text() + "</li>";
		} 
		text += "<li>" + user.children('uname').text() + "</li>";
		
	});
	text += "</ul>";
	$('#lista').append(text);
	a = (active*1)+1;
	$('.userlist li:nth-child(' + a + ')').css('font-weight','bold');
	return auid;
	
}
function checkPosts(sid) {
	$.ajax({
		url: 'getResults.php?sid='+sid,
		success: function(data) {
			
			$('#result').empty();
			$(data).find('linia').each(function() {
				user = $(this).children('uname').text();
				tresc = $(this).children('body').text();
				time = $(this).children('time').text();
				var html = '<div>' + time + ' <strong>'+user+':</strong> '+tresc+'</div>';
				reCheck(sid);
				$('#result').append(html); 
			});
			//if(auid != uid) {
				setTimeout(checkPosts(sid), 1000);
			//}
		}
	});
	
}

