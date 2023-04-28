if (window.jQuery) {
    $(function() {
        $('input').on('focusout', function() {
            var value = $(this).val().trim();
            $(this).attr('value', value);
            $(this).val(value);
        });
    });
} else {
    console.error('jQuery is not loaded so fields will not be automatically trimmed');
}