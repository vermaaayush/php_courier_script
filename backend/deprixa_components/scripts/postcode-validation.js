(function ($) {

    $.validator.addMethod('countrydependentpostcode', function (value, element) {
        var $postcode = $(element);
        var countrySelectId = $postcode.data('countrySelectId');
        var selectedCountry = $('#' + countrySelectId).val();
        var $regexSelect = $postcode.siblings('select');
        var $regexHidden = $postcode.siblings('input:hidden');
        var regexPattern = '';
        $('option', $regexSelect).each(function () {
            if ($(this).attr('value') == selectedCountry) {
                regexPattern = $(this).text();
                return false;
            }
            return true;
        });
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

    $.validator.addMethod('requiredifcountryhaspostcodes', function (value, element) {
        if (!value || /^\s*$/.test(value)) {
            var $postcode = $(element);
            var countrySelectId = $postcode.data('countrySelectId');
            var selectedCountry = $('#' + countrySelectId).val();
            var $regexSelect = $postcode.siblings('select');
            var regexPattern = '';
            $('option', $regexSelect).each(function () {
                if ($(this).attr('value') == selectedCountry) {
                    regexPattern = $(this).text();
                    return false;
                }
                return true;
            });
            if (regexPattern && !/^\s*$/.test(regexPattern)) {
                return false;
            }
        }
        return true;
    });

    $.validator.unobtrusive.adapters.add('requiredifcountryhaspostcodes', function (options) {
        options.rules['requiredifcountryhaspostcodes'] = {};
        options.messages['requiredifcountryhaspostcodes'] = options.message;
    });

})(jQuery);