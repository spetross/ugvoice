app.profile = {};

// ready event
app.profile.ready = function () {

    var
        form_initialized = false,
        $profileForm = $('#edit-profile-form'),
        handler;

    handler = {
        initializeForm: function () {
            if (form_initialized) return;
            form_initialized = true;
            $profileForm
                .find('input[type=file]')
                .ace_file_input({
                    style: 'well',
                    btn_choose: 'Change avatar',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-picture-o',
                    thumbnail: 'large',
                    droppable: true,
                    allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                    allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
                })
                .end().find('button[type=reset]').on(ace.click_event, function () {
                    $('input[type=file]', $profileForm).ace_file_input('reset_input');
                })
                .end().find('input[type=file]')
                .ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);
            $('.wysiwyg-editor', $profileForm)
                .ace_wysiwyg({
                    toolbar: [
                        'bold',
                        'italic',
                        'strikethrough',
                        'underline',
                        null,
                        'justifyleft',
                        'justifycenter',
                        'justifyright',
                        null,
                        'createLink',
                        'unlink',
                        null,
                        'undo',
                        'redo'
                    ]
                }).prev().addClass('wysiwyg-style1')
            ;
        }
    };

    handler.initializeForm();

};

$(document)
    .ready(app.profile.ready)
;

