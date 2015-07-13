app.login = {};

// ready event
app.login.ready = function () {

    var $loginModal = $('#login-modal');
    var $loginForm = $('.ui.login.form', $loginModal);

    $loginModal.on({

        'show.uk.modal': function () {
            var $loginForm = $('.ui.login.form');
            $('#sign-in-username', $loginForm).focus();
            $loginForm
                .api({
                    action: 'login user',
                    serializeForm: true,
                    method: 'post',
                    dataType: 'json'
                })
            ;
        }
    });

}

$(document)
    .ready(app.login.ready)
;