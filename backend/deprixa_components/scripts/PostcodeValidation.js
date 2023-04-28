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