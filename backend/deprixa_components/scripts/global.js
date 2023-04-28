/*Browser IE Detection*/
var $buoop = {vs:{i:10, c:2},
		 reminder: 0			  
		}; 
        function $buo_f(){ 
            var e = document.createElement("script"); 
            e.src = "../../../../../browser-update.org/update.js"; 
            document.body.appendChild(e);
        };
        try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
        catch(e){window.attachEvent("onload", $buo_f)}

//dd close mobile menu
$('.close-mob-menu').click(function() {
       $('#container').toggleClass('active');
});

    //dd footer sign up form
    $('#email-signup-btn').on('click', function () {
        var theEmailAddress = $('#email-signup-address').val();

        if (theEmailAddress.indexOf('@') !== -1 && theEmailAddress.indexOf('.') !== -1) {
            $('#signup').submit();
        }
        else {
            $('#email-signup-address').val('Please enter a valid email').addClass('input-validation-error');
        }
    });

$.validator.addMethod('countrydependentpostcode', function (value, element) {	 
	 var $postcode = $(element);
	 var countrySelectId = $postcode.attr("data-country-select-id");
	 var selectedCountry = $('#' + countrySelectId).val();	
	 var regexPattern = $("#PostcodeRegexSelect option[value='" + selectedCountry + "']").text(); 
	 var $regexHidden = $postcode.siblings('input:hidden');
	  
	 $regexHidden.val(regexPattern);
	 if (value && !/^\s*$/.test(value)) {
		 if (regexPattern && !/^\s*$/.test(regexPattern)) {
			 var regex = new RegExp(regexPattern);
			 return regex.test(value);
		 }
	 }
	 return true;
 });

$.validator.unobtrusive.adapters.add('countrydependentpostcode', function (options) {
	options.rules['countrydependentpostcode'] = {};
	options.messages['countrydependentpostcode'] = options.message;
});

