$(document).ready(function () {

    $(".email-in-use").hide();
    $("#business-contact-details").hide();
    $("#business-details").hide();
   
    $('.address-entry-element', $('#personal-contact-details')).each(function () {
        $(this).setupAddressEntryElement();
    });

    $(".business-type").click(function (e) {       
        var txt = $(e.target).val();
        if (txt == "Business") {
            $("#business-details").show();
            $("#business-contact-details").show();
        }
        else {
            $("#business-details").hide();
            $("#business-contact-details").hide();
        }
    });


    $("#PersonalContactDetails_IsRegisteredBusinessAddress").click(function (e) {
        var txt = $(e.target).is(":checked");
        if (!txt)
            $("#business-contact-details").show();
        else
            $("#business-contact-details").hide();

    });

    $('#PersonalDetails_Email').change(function () {
        var txt = $('#PersonalDetails_Email').val();
        $.getJSON("/SignUp/DoesEmailAlreadyExist", { email: txt }, function (data) {
            if (data) {
                $("#Email", ".email-in-use").val(txt).focus();
                $(".email-in-use").show();
                $(".email-not-in-use").hide();
            }
            else
            {
                $(".email-in-use").hide();
                $(".email-not-in-use").show();
            }
        });
    });
});