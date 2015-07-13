jQuery(function ($) {

    var $articleForm = $('.ui.article.form');
    $('.tabular.menu .item', $articleForm).tab();

    $articleForm
        .form({
            fields: {
                name: {
                    identifier: 'title',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter article title'
                        },
                        {
                            type: 'length[20]',
                            prompt: 'Very short title'
                        },
                        {
                            type: 'maxLength[255]',
                            prompt: 'The title is too long'
                        }
                    ]
                },
                content: {
                    identifier: 'content',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please type some text'
                        },
                        {
                            type: 'length[100]',
                            prompt: 'Please provide fully qualified article content'
                        },
                    ]
                }
            }
        })
    ;

    $('#Post-content').redactor({
        minHeight: 300,
        plugins: ['fullscreen']
    });

});