// namespace
window.app = {
    handler: {}
};

// Allow for console.log to not break IE
if (typeof window.console == "undefined" || typeof window.console.log == "undefined") {
    window.console = {
        log: function () {
        },
        info: function () {
        },
        warn: function () {
        }
    };
}
if (typeof window.console.group == 'undefined' || typeof window.console.groupEnd == 'undefined' || typeof window.console.groupCollapsed == 'undefined') {
    window.console.group = function () {
    };
    window.console.groupEnd = function () {
    };
    window.console.groupCollapsed = function () {
    };
}
if (typeof window.console.markTimeline == 'undefined') {
    window.console.markTimeline = function () {
    };
}
window.console.clear = function () {
};

// ready event
app.ready = function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-REMOTE': 'true'
        }
    });

    $.fn.api.settings.api = {
        'refresh posts': pageUrl,
        'login user': '/auth/login?redirect={redirect}',
        'more posts': baseUrl + '/{client}/posts/?page={page}',
        'add post': baseUrl + '/{client}/post/add',
        'add comment': baseUrl + '/{client}/post/{post}',
        'refresh comments': baseUrl + '/{client}/post/{post}/comments',
        'more comments': baseUrl + '/{client}/post/{post}/comments/?page={page}',
        'delete comment': baseUrl + '/{client}/comment/{id}',
        'delete post': baseUrl + '/{client}/post/{id}'
    };


    $.fn.api.settings.successTest = function (response) {
        return response.success || false;
    };

    $.fn.api.settings.onError = function (message) {
        alert(message)
    };

    $.fn.api.settings.onComplete = function (response, $element) {
        var form = $element.closest('form');
        if (response['FLASH']) {
            $.each(response['FLASH'], function processMessage(type, message) {
                var errorContainer = "<div class='uk-alert uk-alert-" + type + "'><a href='#' class='uk-alert-close uk-close'></a>" + message + "</div>";
                form.addClass('error').find('#flashMessages').html(errorContainer);
                handler.alert();
            })
        }
        if (response['REDIRECT']) {
            window.location.href = response['REDIRECT']
        }

        if (response['ERROR_FIELDS']) {
            var isFirstInvalidField = true;
            $.each(response['ERROR_FIELDS'], function focusErrorField(fieldName, fieldMessages) {
                var fieldElement = form.find('[name="' + fieldName + '"], [name="' + fieldName + '[]"], [name$="[' + fieldName + ']"], [name$="[' + fieldName + '][]"]').filter(':enabled').first();
                if (fieldElement.length > 0) {

                    var _event = jQuery.Event('ajaxInvalidField');
                    $(window).trigger(_event, [fieldElement, fieldName, fieldMessages, isFirstInvalidField]);

                    if (isFirstInvalidField) {
                        if (!_event.isDefaultPrevented()) fieldElement.focus();
                        isFirstInvalidField = false
                    }
                }
            })
        }
        form.trigger('ajaxComplete', [$element, response]);
    };


    var $sticky = $('.ui.sticky'), $dropdown = $('.ui.dropdown'), $checkbox = $('.ui.checkbox'), $loginModal = $('#login-modal'), handler;

    handler = {
        alert: function () {
            setTimeout(function () {
                var alerts = $('.uk-alert');
                alerts.addClass('bounceOut');
                alerts.addClass('animated');
                setTimeout(function () {
                    alerts.slideUp(500, function () {
                        alerts.remove();
                    });
                }, 500);
            }, 2500);
        },
        refresh: function (intervel) {
            setInterval(function () {
                $.api({
                    url: baseUrl + '/refresh',
                    method: 'POST',
                    dataType: 'json',
                    on: 'now',
                    beforeSend: function (settings) {
                        if (!isLoggedIn) {
                            return false;
                        }
                        return settings;
                    },
                    onSuccess: function (data) {

                    }
                });

            }, intervel);

        }
    };

    app.handler = handler;

    // fix main menu to page on passing
    if ($(window).width() > 600) {
        $('.main.menu').visibility({
            type: 'fixed'
        });

        $('.overlay').visibility({
            type: 'fixed',
            offset: 80
        });
    }
    // lazy load images
    $('.image').visibility({
        type: 'image',
        transition: 'vertical flip in',
        duration: 500
    });

    // show dropdown on hover
    $('.main.menu  .ui.dropdown').dropdown({
        on: 'hover'
    });

    $loginModal
        .modal({
            onShow: function () {
                var $loginForm = $('.ui.login.form', $loginModal);
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
        })
        .modal('attach events', '#user-login-button', 'show')
    ;


    $('.right.sidebar')
        .sidebar({
            scrollLock: true,
            dimPage: false
        })
        .sidebar('attach events', '.uk-button.chat-toggle', 'show')
    ;

    $('.left.sidebar')
        .sidebar()
        .sidebar('attach events', '.uk-navbar-toggle', 'show')
    ;

    $dropdown.dropdown();
    $checkbox.checkbox();
    $sticky.sticky();

    $('.ui.tabular.menu .item').tab();


    $('.message .close').on('click', function () {
        $(this).closest('.message').fadeOut();
    });
};

// attach ready event
$(document)
    .ready(app.ready)
;