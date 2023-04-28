// Provides the logic for handling the entry of address details into a partial View rendered by the Editor
// Template associated with an AddressEntryViewModel object.
(function ($) {

    $(document).ready(function () {
        // Whenever a control other than one of the radio buttons in the address lookup selection list gets
        // focus, any currently visible address lookup selection list element should be hidden. This is
        // consistent with the behaviour of a drop-down list box (the drop-down list is closed when another
        // control gets focus).
        $('body').on('focus', 'input:not(.address-selection-input), select, textarea, button, a', function () {
            hideLookupResults();
        });
    });

    // To be called for initializing each address entry element contained in a partial View rendered by the
    // Editor Template associated with an  AddressEntryViewModel object.
    // The target element is the outermost element in that View, which has an 'address-entry-element' class.
    // If the minimalView parameter is set to true, the address entry element is set to shown only the
    // postcode and country fields.
    $.fn.setupAddressEntryElement = function (minimalView, isDeliveryAddress) {
        var $addressEntryElement = $(this);

        if (minimalView) {
            $('.address-entry--postcode-group', $addressEntryElement).hide();
            $('.address-entry-manual-entry-link', $addressEntryElement).hide();
            $('.address-entry-address-fields', $addressEntryElement).hide();
            $('.address-entry-minimal-view', $addressEntryElement).show();
        }

        // Set up both postcode input elements so that the postcode is formatted when the element loses focus
        if (!minimalView) {
            $('.address-entry-find-postcode', $addressEntryElement).blur(function () {
                $(this).val(formatPostcode($(this)));
            });
        }
        $('.address-entry-postcode', $addressEntryElement)
            .blur(function () {
                var $postcodeInput = $(this);
                $postcodeInput.val(formatPostcode($postcodeInput));
                validatePostcode($postcodeInput);
            })
            .on('replicationUpdate', function () {
                // The replicationUpdate custom event may be raised when the address element is within the
                // Collection and Delivery Details page
                validatePostcode($(this));
            });
        
        if (isDeliveryAddress) {
            $('.address-entry-postcode', $addressEntryElement)
                .change(function () {
                    var $postcodeInput = $(this);
                    $postcodeInput.val(formatPostcode($postcodeInput));
                })
                .on('replicationUpdate', function () {
                    // The replicationUpdate custom event may be raised when the address element is within the
                    // Collection and Delivery Details page                                        
                });
        }
        // Set up country select element so that, when a country is selected, a partial view is retrieved for
        // the county/state/province input (if supported) and postcode elements are enabled or disabled
        // depending on whether the selected country has postcodes
        var $countrySelect = $('.address-entry-country', $addressEntryElement);
        if (!checkIfCountryHasPostcodes($countrySelect)) {
            $addressEntryElement.showAddressEntryFields();
        }
        $countrySelect
            .change(function () {
                getCountyStateProvinceElement($(this));
                checkIfCountryHasPostcodes($(this));
            })
            .on('replicationUpdate', function () {
                // The replicationUpdate custom event may be raised when the address element is within the
                // Collection and Delivery Details page
                checkIfCountryHasPostcodes($(this));
            });

        setUpCountyStateProvinceElement($addressEntryElement);

        // Set up the Enter Address Manually link and the Find Address button
        if (!minimalView) {
            $('.address-entry-manual-entry-link a', $addressEntryElement).click(function (e) {
                $(this).closest('.address-entry-element').showAddressEntryFields();
            });
            $('.address-entry-find-postcode-btn', $addressEntryElement).click(function (e) {
                doPostcodeLookup($(this));
            });
        }

        return $(this);
    };
 
    // Hides the Enter Address Manually link and makes address fields visible.
    // Called when the user clicks on the Enter Address Manually link or performs an address lookup.
    // May also be called from another script file if and when appropriate.
    // The target element is expected to be the outermost element in an Address Entry partial View
    // (i.e. and element with an 'address-entry-element' class).
    $.fn.showAddressEntryFields = function() {
        var $addressEntryElement = $(this);
        $('.address-entry-manual-entry-link', $addressEntryElement).hide();
        $('.address-entry-address-fields', $addressEntryElement).show();
        $('.address-entry-minimal-view', $addressEntryElement).show();
        return $(this);
    };

    // Called when the user clicks on the Find address button.
    // Displays an error message if no postcode has been entered or no country selected.
    // Otherwise, makes an AJAX call to the LookupPostcodeController. The showLookupResults function
    // is called if and when the lookup results are returned.
    function doPostcodeLookup($findPostcodeButton) {
        var $findPostcodeGroup = $findPostcodeButton.closest('.address-entry-find-postcode-group');
        var $addressEntryElement = $findPostcodeGroup.closest('.address-entry-element');
        hideErrorMessage($addressEntryElement);
        var postcode = $('.address-entry-find-postcode', $findPostcodeGroup).val();
        var countryCode = $('.address-entry-country', $addressEntryElement).val();
        if (isBlank(postcode)) {
            showErrorMessage($addressEntryElement, $.globals.messagePostcodeRequired);
        }
        else if (isBlank(countryCode)) {
            showErrorMessage($addressEntryElement, $.globals.messageCountryRequired);
        }
        else {
            $.ajax({
                url: $.globals.appRoot + '/Common/LookupPostcode',
                type: 'GET',
                data: {
                    country: countryCode,
                    postcode: postcode
                },
                cache: false,
                success: function (data) {
                    var $resultsBox = $('.address-lookup-results', $addressEntryElement);
                    $resultsBox.html(data);
                    var $errorMessage = $('.address-lookup-error', $resultsBox);
                    if ($errorMessage.length == 0) {
                        showLookupResults($addressEntryElement, $resultsBox);
                    }
                    else {
                        showErrorMessage($addressEntryElement, $errorMessage.val());
                    }
                },
                error: function () {
                    showErrorMessage($addressEntryElement, $.globals.messageCannotProcessRequest);
                }
            });
        }
    };

    // Displays the lookup results retrieved by the doPostcodeLookup function in a box positioned on
    // top of the address fields (i.e. immediately below the Find address button and the associated
    // postcode text box).
    function showLookupResults($addressEntryElement, $resultsBox) {
        $addressEntryElement.showAddressEntryFields();
        var $addressFields = $('.address-entry-address-fields', $addressEntryElement);
        var position = $addressFields.position();
        var height = $addressEntryElement.height() - position.top;
        var width = $addressEntryElement.width();
        $resultsBox
            .css({
                'top': position.top + 'px',
                'left': position.left + 'px',
                'height': height + 'px',
                'width': width + 'px'
            })
            .show();

        $('.address-lookup-result-address', $resultsBox)
            .css({ 'cursor': 'pointer' })
            .click(function () {
                var $radioContainer = $(this).siblings('.address-lookup-result-radio');
                $('input[type=radio]', $radioContainer).prop('checked', true).triggerHandler('change');                
            });

        $('input[type=radio][name=address-selection]', $resultsBox).change(function () {
            if ($(this).prop('checked')) {
                getAddressDetails($addressEntryElement, $(this).attr('value'));
            }
        });
    };

    // Hides the box containing the lookup results.
    function hideLookupResults() {
        $('.address-lookup-results').hide();
    };

    // Called when the user selects an address within the lookup results displayed by the
    // showLookupResults function.
    // Makes an AJAX call to the GetAddressFromLookupReferenceController. If and when the address
    // details are returned, this function sets the values of the relevant address fields and hides
    // the box containing the lookup results.
    function getAddressDetails($addressEntryElement, reference) {
        $.ajax({
            url: $.globals.appRoot + '/Common/GetAddressFromLookupReference',
            type: 'GET',
            data: { reference: reference },
            cache: false,
            success: function (data) {
                $('.address-entry-company', $addressEntryElement).setAddressField(data.companyName);
                $('.address-entry-line1', $addressEntryElement).setAddressField(data.addressLine1);
                $('.address-entry-line2', $addressEntryElement).setAddressField(data.addressLine2);
                $('.address-entry-line3', $addressEntryElement).setAddressField(data.addressLine3);
                $('.address-entry-town', $addressEntryElement).setAddressField(data.town);
                $('.address-entry-county', $addressEntryElement).setAddressField(data.county);
                $('.address-entry-postcode', $addressEntryElement).setAddressField(data.postcode);

                $('.address-entry-county-name', $addressEntryElement).val(data.county);
                $('.address-entry-county-code', $addressEntryElement).val(data.countyOrStateCode);

                $addressEntryElement.trigger('addressLookupComplete');
                // raise event that dropdown was clicked
                $addressEntryElement.trigger('lookupAddressChosen');;
                hideLookupResults();
            },
            error: function () {
                hideLookupResults();
                showErrorMessage($addressEntryElement, $.globals.messageCannotProcessRequest);
            }
        });
    };

    // Sets the value of the target input element.
    $.fn.setAddressField = function (value) {
        var $addressField = $(this);
        var addressFieldId = $addressField.attr('id');
        $addressField.val(value);
        var $form = $addressField.closest('form');        
        setTimeout(function () {
            $form.validate().element('#' + addressFieldId);
        }, 10);
        return $(this);
    };

    // Displays the specified error message in an element defined for this purpose below the Find address
    // button and the associated postcode text box
    function showErrorMessage($addressEntryElement, message) {
        var $messageContainer = $('.address-entry-find-postcode-message', $addressEntryElement);
        $('.find-postcode-message', $messageContainer).text(message);
        $messageContainer.show();
    };

    // Hides any error message displayed by the showErrorMessage function.
    function hideErrorMessage($addressEntryElement) {
        $('.address-entry-find-postcode-message', $addressEntryElement).hide();
    };

    // Called when a text box containing a postcode loses focus to format the entered postcode.
    // The formatting consists in converting the entered value to uppercase and, if the selected country
    // ISO code is 'GB', removing all spaces and inserting one space before the last three characters
    // (e.g. 'm 501 re' becomes 'M50 1RE').
    function formatPostcode($postcodeInput) {
        var postcode = $postcodeInput.val().trim();
        if (!isBlank(postcode)) {
            postcode = postcode.toUpperCase();
            var $addressEntryElement = $postcodeInput.closest('.address-entry-element');
            var countryCode = $('.address-entry-country', $addressEntryElement).val();
            if (countryCode == 'GB') {
                var postcodeElements = postcode.split(' ');
                if (postcodeElements.length > 1) {
                    postcode = '';
                    postcodeElements.forEach(function (element) {
                        postcode += element;
                    });
                }
                if (postcode.length > 3) {
                    postcode = postcode.substr(0, postcode.length - 3) +
                        ' ' + postcode.substr(postcode.length - 3, 3);
                }
            }
        }
        return postcode;
    };

    // Called to re-validate a text box containing a postcode after formatting or selection of a
    // different country.
    function validatePostcode($postcodeInput) {
        var $form = $postcodeInput.closest('form');
        var postcodeId = $postcodeInput.attr('id');
        $form.validate().element('#' + postcodeId);
    };

    // Called when the user selects a country if the selection of a county, state, or province from a
    // list is supported (i.e. if the AddressEntryViewModel object contained a CountyStateProvinceViewModel
    // object).
    function getCountyStateProvinceElement($countryInput) {
        var $addressEntryElement = $countryInput.closest('.address-entry-element');
        $('.address-entry-county', $addressEntryElement).val('').prop('disabled', true);
        var countryCode = $countryInput.val();
        var countryInputName = $countryInput.attr('name');
        var lastDotIndex = countryInputName.lastIndexOf('.');
        var htmlFieldPrefix = countryInputName.substring(0, lastDotIndex);
        var $container = $('.address-entry-county-container', $addressEntryElement);
        $.ajax({
            url: $.globals.appRoot + '/Common/GetCountyStateProvinceView',
            type: 'GET',
            data: {
                countryCode: countryCode,
                htmlFieldPrefix: htmlFieldPrefix
            },
            cache: false,
            success: function (data) {
                $container.html(data);
                setUpCountyStateProvinceElement($addressEntryElement);
                $addressEntryElement.trigger('countyStateProvinceUpdateComplete');
            }
        });
    };

    // Sets up county / state / province validation.
    function setUpCountyStateProvinceElement($addressEntryElement) {
        var $countyCodeInput = $('.address-entry-county-code', $addressEntryElement);
        var $countyNameInput = $('.address-entry-county-name', $addressEntryElement);

        if ($countyCodeInput.length == 1) {
            $countyCodeInput
                .attr('data-val', 'true')
                .attr('data-val-required', $countyCodeInput.attr('data-required-message'))
                .removeAttr('data-required-message');

            $countyCodeInput.change(function () {
                $countyNameInput.val($('.address-entry-county-code option[value="' + $countyCodeInput.val() + '"]', $addressEntryElement).text());
            });

            var $form = $addressEntryElement.closest('form');
            $form.removeData('validator');
            $.validator.unobtrusive.parse($form);
        }
    };

    // Called when the user selects a country.
    // Determines whether the selected country has postcodes. If so, enables the Find Postcode text box,
    // the Find Address button and the Postcode text box, and returns true. If not, disables them, clears
    // the text boxes, and returns false.
    function checkIfCountryHasPostcodes($countryInput) {
        var countryWithoutPostcodes = false;
        var countryCode = $countryInput.val();
        var $addressEntryElement = $countryInput.closest('.address-entry-element');
        var $postcodeInfo = $('.post-code-info', $addressEntryElement);
        var $regexSelect = $('select', $postcodeInfo);
        $('option', $regexSelect).each(function () {
            if ($(this).attr('value') == countryCode) {
                regexPattern = $(this).text();
                countryWithoutPostcodes = isBlank(regexPattern);
                return false;
            }
            return true;
        });
        var $findPostcodeInput = $('.address-entry-find-postcode', $addressEntryElement);
        var $findPostcodeButton = $('.address-entry-find-postcode-btn', $addressEntryElement);
        var $postcodeInput = $('.address-entry-postcode', $addressEntryElement);
        if (countryWithoutPostcodes) {
            $findPostcodeInput.val('');
            $postcodeInput.val('');
        }
        if (countryWithoutPostcodes || !isBlank($postcodeInput.val())) {
            validatePostcode($postcodeInput);
        }
        $findPostcodeInput.prop('disabled', countryWithoutPostcodes);
        $findPostcodeButton.prop('disabled', countryWithoutPostcodes);
        $postcodeInput.prop('disabled', countryWithoutPostcodes);
        var $postcodeGroup = $postcodeInput.closest('.form-group');
        $postcodeGroup.toggleClass('required', !countryWithoutPostcodes);
        $('.control-label', $postcodeGroup).toggleClass('greyed-out-text', countryWithoutPostcodes);
        return !countryWithoutPostcodes;
    };

    // Determines whether the specified string is undefined, is empty, or contains only whitespace
    // characters.
    function isBlank(textString) {
        return !textString || /^\s*$/.test(textString);
    };

})(jQuery);