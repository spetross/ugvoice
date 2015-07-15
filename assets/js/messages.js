app.messaging = {};

// ready event
app.messaging.ready = function () {

    var
        $threadsWrapper = $('#thread-container'),
        handler;

    handler = {
        refresh : function (interval) {
            setInterval(function () {
                $.api({
                    url: window.location.href,
                    method: 'GET',
                    dataType: 'json',
                    on: 'now',
                    beforeSend: function(settings) {
                        return settings;
                    },
                    onSuccess: function (data) {
                        var $messagesList = $threadsWrapper.find('.messages-list');
                        if (data['Messages']) {
                            $.each(data['Messages'], function (index, message) {
                                $messagesList.prepend(message);
                            });
                        }
                    }
                });
            }, interval);
        }
    };

    handler.refresh(24000);


    $('.ui.send.button', $threadsWrapper)
        .api({
            action          : 'send message',
            serializeForm   : true,
            method          : 'post',
            dataType        : 'json',
            onSuccess       : function (data) {
                var form = $(this).closest('form'),
                    $messagesList = $threadsWrapper.find('.messages-list');
                if(data['Message']) {
                    $messagesList.prepend(data['Message']);
                    $(this).state('flash text', 'Sent!');
                    form.find('textarea').val('');
                    UIkit.notify(data['alert'], {pos:'top-right'});
                } else {
                    $(this).state('flash text', 'Failed!');
                    UIkit.notify(data['alert'], {pos:'top-right'});
                }
            }
        })
    ;




};

$(document)
    .ready(app.messaging.ready)
;


