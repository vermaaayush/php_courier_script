function scrollToElement(selector, time, verticalOffset) {
			time = typeof(time) != 'undefined' ? time : 500;
			verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
			element = $(selector);
			offset = element.offset();
			offsetTop = offset.top + verticalOffset;
			$('html, body').animate({
				scrollTop: offsetTop
			}, time);			
		}

(function () { var a = "https:" == document.location.protocol ? "https://s.trustpilot.com" : "http://s.trustpilot.com", b = document.createElement("script"); b.type = "text/javascript"; b.async = true; b.src = a + "/tpelements/tp_elements_all.js"; var c = document.getElementsByTagName("script")[0]; c.parentNode.insertBefore(b, c) })();

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

$(document).ready(function(){

	$('#awardWinningLink').click(function (e) {
		e.preventDefault();
		scrollToElement('#awardsAnchor', 700);
	});

	$('#joinUsLink').click(function (e) {
		e.preventDefault();
		scrollToElement('#joinUsAnchor', 700);
	});

	$('#meetTeamLink').click(function (e) {
	e.preventDefault();
	scrollToElement('#meetTeamAnchor', 700);
	});

	$('#whereWeAreLink').click(function (e) {
	e.preventDefault();
	scrollToElement('#awardsAnchor', 700);
	});

	$('#awardsLink').click(function (e) {
	e.preventDefault();
	scrollToElement('#awardsAnchor', 700);
	});


	$('#backToTopLink').click(function (e) {
		e.preventDefault();
		scrollToElement('.careers-hub-container', 700);
	});




});		