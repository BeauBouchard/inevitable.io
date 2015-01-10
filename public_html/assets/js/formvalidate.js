$(document).ready(function () {

    $('#reg-form').validate({
        rules: {
            login: {
                minlength: 8,
                maxlength: 30,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password1: {
                minlength: 8,
            },
            password2: {
                minlength: 8,
                equalTo : "#password1"
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }
    });

});