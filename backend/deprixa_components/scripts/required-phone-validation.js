(function ($) {

    $.validator.addMethod('requiredphone', function (value, element, params) {
        var $primaryPhone = $(element);
        var altPhoneId;
        var conditionId;
        var performValidation = true;
        var conditionalValidation = params.condition && !/^\s*$/.test(params.condition);
        var id = $primaryPhone.attr('id');
        var underscorePosition = id.lastIndexOf('_');
        if (underscorePosition < 0) {
            altPhoneId = params.alt;
            if (conditionalValidation) {
                conditionId = params.condition;
            }
        }
        else {
            altPhoneId = id.substring(0, underscorePosition) + '_' + params.alt;
            if (conditionalValidation) {
                conditionId = id.substring(0, underscorePosition) + '_' + params.condition;
            }
        }
        if (conditionalValidation) {
            performValidation = false;
            var $condition = $('#' + conditionId);
            if ($condition.length == 1) {
                if (!$condition.data('phone_condition')) {
                    $condition
                        .data('phone_condition', true)
                        .change(function () {
                            var $form = $(this).closest('form');
                            $form.validate().element('#' + id);
                        });
                }
                var conditionValue = $condition.val().toLowerCase();
                performValidation = conditionValue == 'true';
            }
        }
        if (!performValidation) {
            var $carrierRequiresPhoneNumbersInput = $('#CarrierRequiresPhoneNumbers');
            if ($carrierRequiresPhoneNumbersInput.length == 1) {
                performValidation = $carrierRequiresPhoneNumbersInput.val().toLowerCase() == 'true';
            }
        }
        var $altPhone = $('#' + altPhoneId);
        if ($altPhone.length == 1) {
            if (!$altPhone.data('alt_phone')) {
                $altPhone
                    .data('alt_phone', true)
                    .blur(function () {
                        var $form = $(this).closest('form');
                        $form.validate().element('#' + id);
                    });
            }
            if (performValidation) {
                var altPhoneValue = $altPhone.val();
                if ((!value || /^\s*$/.test(value)) && (!altPhoneValue || /^\s*$/.test(altPhoneValue))) {
                    return false;
                }
            }
        }
        return true;
    });

    $.validator.unobtrusive.adapters.add('requiredphone', ['alt', 'condition'], function (options) {
        options.rules['requiredphone'] = { alt: options.params.alt, condition: options.params.condition };
        options.messages['requiredphone'] = options.message;
    });

})(jQuery);