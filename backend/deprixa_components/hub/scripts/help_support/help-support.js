$(document).ready(function(){

    if($('.trust-pilot')[0]) {
       $('.grey-gradient-bg').show();
    }
    else $('.grey-gradient-bg').hide();

    // pop dropdown menu
    $('select[name="SelectURL"]').change(function() {
        window.location.replace($(this).val());
    });

    // Unique menu naming
    $('.menu-section ul').each(function(i,j) {
       $(this).addClass('help-menu'+(i+1));
    });


    //Back Button
	$('a.help-back').text("back to help");



    // trustpilot
    $.ajax({
        type: "GET",
        url: "https://s.trustpilot.com/tpelements/975029/f.jsonp",
        dataType: "jsonp",
        jsonpCallback: "trustpilot_jsonp_callback",
        success: function (data) {
            var tpScore = data.TrustScore.Score + '/100';
            $('.tp-score').text(tpScore);
            $('.promo-trust-pilot span').text(tpScore);
        }
    });

});
