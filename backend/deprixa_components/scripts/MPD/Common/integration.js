
$(document).ready(function() {
	GetBasketCount();
	//GetIsLoggedIn();
	GetAnalytics();
});

function GetBasketCount() {
	var basketCount = $(".basket-count");
	$.ajax({
		url: webRootPath + "/booking/basketsummary",
		type: "GET",
		success: function (data) {
			basketCount.html(data.basketItemCount);
		},
		error: function (xhr, status, error) {
			basketCount.html("0");
		},
		data: null,
		cache: false,
		processData: false,
		contentType: "application/json",
		dataType: "jsonp"
	});
}

function GetIsLoggedIn() {
	var $loginStatus = $(".login-status");
	$.ajax({
		url: webRootPath + "/myaccount/myaccountinfo",
		type: "GET",
		success: function (data) {
			SetLoggedInPanel($loginStatus, data.IsLoggedIn);			
		},
		error: function (xhr, status, error) {
			SetLoggedInPanel($loginStatus, false);
		},
		data: null,
		cache: false,
		processData: false,
		contentType: "application/json",
		dataType: "jsonp"
	});
}

function GetAnalytics() {
	var $head = $("head");
	try {
		$.ajax({
			url: webRootPath + "/analytics/mpdanalytics",
			type: "GET",
			success: function(data) {
				$head.append(data.ga);
				$head.append(data.sc);
				//$head.append(data.script);
			},
			error: function(xhr, status, error) {
			},
			data: null,
			cache: false,
			processData: false,
			contentType: "application/json",
			dataType: "jsonp",
		});
	} catch(err) {}
}

function SetLoggedInPanel(element, result) {
	if (result == true) {
		element.html("<a href='" + webRootPath + "/MyBookings/' title='My Account'>My Account</a> - <a href='" + webRootPath + "/login/flushlogin' title='Log out'>Log out</a>");
	} else {
		element.html("<a href='" + webRootPath + "/login' title='Log In'>Log in to My Account</a>");
	}
}