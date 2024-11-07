import $ from 'jquery';
import 'jquery-validation';

$(document).ready(function() {
    $('body').toggleClass('loading');

    $('#loginForm').validate({
        rules: {
            emailInput: {
                required: true,
                email: true
            },
            passwordInput: {
                required: true,
            }
        },
        errorClass: 'is-invalid',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            alert('Login successful');
            console.log($(form).serialize());
            $(form).reset();
        }
    });
});

