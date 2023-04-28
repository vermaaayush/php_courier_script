$(document).ready(function()
{


	$.ajax({
        type: "GET",
        url: "https://s.trustpilot.com/tpelements/975029/f.jsonp",
        dataType: "jsonp",
        jsonpCallback: "trustpilot_jsonp_callback",
        success: function (data) {
            var tpScore = data.TrustScore.Score + '/100';
            $('.tp-score').text(tpScore);
            $('.promo-trust-pilot span').text(tpScore);

            var revCount = 0;
            for (i = 0; i < data.Reviews.length; i++) {
                if (data.Reviews[i].Content.length > 50 && revCount < 10) {
                    var theMarkup = '<div class="swiper-slide tp">';
                    theMarkup += '<img src="' + data.Reviews[i].TrustScore.StarsImageUrls.medium + '" />';
                    theMarkup += '<h4>' + data.Reviews[i].Title + '</h4>';
                    theMarkup += '<p class="tp-review">' + truncate(data.Reviews[i].Content, 500, data.Reviews[i].Url) + '</p>';
                    theMarkup += '<p class="fl">' + data.Reviews[i].User.Name + ', ' + data.Reviews[i].Created.HumanDate + '</p>';
                    theMarkup += '</div>';
                    $('.reviews-wrapper').append(theMarkup);
                    revCount++;
                }
            }

        }
    });

	//Arrow Button Rollover
	$('.primaryButtonLarge').hover(function(){
		$('.primaryButtonLarge span').addClass('arrow-hover');
	}, function() {
		$('.primaryButtonLarge span').removeClass('arrow-hover');
	});


});




function truncate(str, limit, reviewUrl) {
    var bits, i;
    if ("string" !== typeof str) { return ''; }
    bits = str.split('');
    if (bits.length > limit) {
        for (i = bits.length - 1; i > -1; --i) {
            if (i > limit) {
                bits.length = i;
            } else if (' ' === bits[i]) {
                bits.length = i; break;
            }
        }
        bits.push('... <a href="' + reviewUrl + '"> Read More</a>');
    } return bits.join('');
}



