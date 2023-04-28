$(document).ready(function(){

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
				if (data.Reviews[i].Content.length > 50 && revCount < 5) {
					var theMarkup = '<div class="swiper-slide tp">';
					theMarkup += '<img src="' + data.Reviews[i].TrustScore.StarsImageUrls.medium + '" />';
					theMarkup += '<h4>' + data.Reviews[i].Title + '</h4>';
					theMarkup += '<p class="tp-review">' + truncate(data.Reviews[i].Content, 255, data.Reviews[i].Url) + '</p>';
					theMarkup += '<p class="fl">' + data.Reviews[i].User.Name + ', ' + data.Reviews[i].Created.HumanDate + '</p>';
					theMarkup += '</div>';
					$('.reviews-wrapper').append(theMarkup);
					revCount++;
				}
			}
			// dd loop around and create unique swipers.
			$('.swiper-container').each(function (index, element) {
				var sCount = 's' + index;
				$(this).addClass(sCount);
				var swiper = new Swiper('.s' + index, { pagination: '.s' + index + '> .pagination', paginationClickable: true, loop: true, autoplay: 10000, autoplayDisableOnInteraction: false, calculateHeight: true });
			});
			
		}
	});
	
	//Get Quote Class change
	$('.btn-get-quote').click(function(){
    	$('#booking-pod-container').addClass( 'invalid');
		setTimeout(function() {
      		$('#booking-pod-container').removeClass('invalid');
		}, 900);
	
	});
	
	//Init PopOvers
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
		
	// UPS Store Locator
	$(function(){
		
		setTimeout(function(){
			$('#upsLogo').fadeIn('500');
		},1000);
	
	});
		
	//Arrow Button Rollover
	$('.primaryButtonLarge').hover(function(){
		$('.primaryButtonLarge span').addClass('arrow-hover');
	}, function() {
		$('.primaryButtonLarge span').removeClass('arrow-hover');
	});


	// Countries Toggle	
	$(".countries-more").hide();
    $('.show-countries').click(function(e){
		e.preventDefault();
        var link = $(this);
		$(this).toggleClass("collapsed");
        $('.countries-more').slideToggle(200, function() {
            if ($(this).is(":visible")) {
                 link.text('show less');                
            } else {
                 link.text('show more');                
            }
        });
            
    }); 	

	//Back To Top
	$('a#back-top ').click(function () {
        $('body,html').animate({
                scrollTop: 0
        }, 800);
        	return false;
    });
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});


	//Add Inactive Class To All Accordion Headers
	$('.accordion-header').toggleClass('inactive-header');
	
	//Open The First Accordion Section When Page Loads
	$('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
	$('.accordion-content').first().slideDown().toggleClass('open-content');
	
	$("#example-links").keyup(function(event){
		if(event.keyCode == 13){
			$("#example-links").click();
		}
	});	
	
	// The Accordion Effect
	$('.accordion-header').click(function () {
		if($(this).is('.inactive-header')) {
			$('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
			$(this).toggleClass('active-header').toggleClass('inactive-header');
			$(this).next().slideToggle().toggleClass('open-content');
		}
		
		else {
			$(this).toggleClass('active-header').toggleClass('inactive-header');
			$(this).next().slideToggle().toggleClass('open-content');
		}
	});
	
	return false;


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