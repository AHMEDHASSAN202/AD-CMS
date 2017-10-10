
if (typeof jQuery == 'undefined') {
    throw new Error('jQuery is not loaded');
}

$(function () {

    //validate login form
    validate();

    //login ajax
    login();

});


/* Login ajax ====================*/
function login()
{
    var form   = $('#sign_in'),
        url    = form.attr('action'),
        method = form.attr('method'),
        submit = $('#submit'),
        result = $('#result'),
        email = $('#email'),
        password = $('#password');

    form.on('submit' , function () {

        if (email.val().length <= 0 || password.val().length <= 0) {
            return false;
        }

        data = new FormData(form[0]);

        $.ajax({

            url: url,
            data: data,
            type: method,
            dataType: 'json',
            success: function (results) {

                if (results.error) {

                    result.removeClass('alert alert-success').addClass('alert alert-danger').html(results.error);

                }else if (results.success) {

                    result.removeClass('alert alert-danger').addClass('alert alert-success').html(results.success);

                    if (results.redirectTo) {

                        setTimeout(function () {
                            window.location.href = results.redirectTo;
                        } , 100);

                    }

                }

            },
            cache: false,
            contentType: false,
            processData: false,

        });

        return false;
    });

}


function validate()
{
    var email = $('#email');
    var password = $('#password');
    var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    email.on('keyup' , function () {

        if (email.val().length <= 0) {

            $(this).parent().next('label').remove();

            $(this).parent().after('<label class="error">This field is required</label>');

            $(this).parent().addClass('error');

        }else {

            if (!(regexEmail.test($(this).val()))) {

                $(this).parent().next('label').remove();

                if (!$(this).parent().next('label').length) {

                    $(this).parent().after('<label class="error">Please enter your valid email</label>');

                }

                $(this).parent().addClass('error');

            }else {

                $(this).parent().next('label').remove();

                $(this).parent().removeClass('error');

            }
        }

    });

    password.on('keyup' , function () {

        if (password.val().length <= 0) {

            $(this).parent().next('label').remove();

            $(this).parent().after('<label class="error">This field is required</label>');

            $(this).parent().addClass('error');

        }else {

            if (password.val().length < 5) {

                $(this).parent().next('label').remove();

                if (!$(this).parent().next('label').length) {

                    $(this).parent().after('<label class="error">Please enter your valid password</label>');

                }

                $(this).parent().addClass('error');

            }else {

                $(this).parent().next('label').remove();

                $(this).parent().removeClass('error');

            }
        }

    });

}
