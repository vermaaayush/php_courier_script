/*Browser IE Detection*/
var $buoop = {vs:{i:8, c:2},
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
    /*$('#email-signup-btn').on('click', function () {
        var theEmailAddress = $('#email-signup-address').val();

        if (theEmailAddress.indexOf('@') !== -1 && theEmailAddress.indexOf('.') !== -1) {
            $('#signup').submit();
        }
        else {
            $('#email-signup-address').val('Please enter a valid email').addClass('input-validation-error');
        }
    });*/


     //dd footer sign up form
    $('#email-signup-btn').on('click', function () {

        var theEmailAddress = $('#email-signup-address').val();

        if (theEmailAddress.indexOf('@') !== -1 && theEmailAddress.indexOf('.') !== -1) {

            $.ajax({
                type: "POST",
                url: "https://mandrillapp.com/api/1.0/messages/send.json",
                data: {
                    'key': 'htcBHZsxZCbL3qVWUte-vg',
                    'message': {
                        'from_email': 'noreply@myparceldelivery.com',
                        'to': [{
                            'email': 'nazma.noor@mpd-group.com',
                            'type': 'to'
                        }],
                        'autotext': 'true',
                        'subject': 'New Signup for Email Newsletter',
                        'html': 'A user has just requested that the following email address be added to the mailing list:<br><br>' + theEmailAddress
                    }
                }
            }).done(function (response) {
                $('form.email-signup input, form.email-signup .error-msg').hide();
                $('.mobEmail').append('<p class="thankyou-msg">Thank you, your email address has been received and will be added to our mailing list</p>');
            });

        } else {
            if ($('form.email-signup .error-msg').length === 0) {
                $('form.email-signup').append('<p class="error-msg">Please enter a valid email address</p>');
            }
        }

    });