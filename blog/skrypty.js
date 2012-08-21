$(document).ready(function() {
	$("#dummy_div").css("height",$("#content").css("height"));
	$(".left_margin").each(function() {
		$(this).css("height",$(this).next().css("height"));
	});
	$("aside").each(function(index) {
		i = index+1;
		$(this).attr("id","aside"+i)
	});
	$("sup").each(function(index) {
		var prevTop = new String();
		$(this).text(index+1);
		topV = $(this).position().top;
		id = "aside" + $(this).text();
		t = $("#" + id);
		if(index>0) {
			if(t.prev().css("top") != undefined){
				prevTop = t.prev().css("top");
				prevTop = prevTop.slice(0,prevTop.indexOf("px"))*1;
				prevHeight = t.prev().css("height");
				prevHeight = prevHeight.slice(0,prevHeight.indexOf("px"))*1;
				if(prevTop + prevHeight > topV) {
					topV = prevTop + prevHeight+30;
				}
			}
		}
		t.css("top", topV);
	});
	txt = $("cite").text();
	$("cite").html('<span class="lcite">&rdquo;</span>' + txt);

});
$(window).resize(function() {
	$("#dummy_div").css("height",$("#content").css("height"));
	$(".left_margin").each(function() {
		$(this).css("height",$(this).next().css("height"));
	});
	$("sup").each(function(index) {
		var prevTop = new String();
		$(this).text(index+1);
		topV = $(this).position().top;
		id = "aside" + $(this).text();
		t = $("#" + id);
		if(index>0) {
			if(t.prev().css("top") != undefined){
				prevTop = t.prev().css("top");
				prevTop = prevTop.slice(0,prevTop.indexOf("px"))*1;
				prevHeight = t.prev().css("height");
				prevHeight = prevHeight.slice(0,prevHeight.indexOf("px"))*1;
				if(prevTop + prevHeight > topV) {
					topV = prevTop + prevHeight+30;
				}
			}
		}
		t.css("top", topV);
	});
});
