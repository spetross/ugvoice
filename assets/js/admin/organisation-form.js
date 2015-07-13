jQuery(function ($) {
    $('.ui.organisation.form')
        .form({
            fields: {
                name: {
                    identifier: 'name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter organisation name'
                        }
                    ]
                },
                description: {
                    identifier: 'description',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please provide a description'
                        }
                    ]
                },
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter organisation contact e-mail'
                        },
                        {
                            type: 'email',
                            prompt: 'Please enter a valid e-mail'
                        }
                    ]
                },
                phone1: {
                    identifier: 'phone1',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please provide atleast one contact number'
                        }
                    ]
                },
                address: {
                    identifier: 'address',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please provide organisation address'
                        }
                    ]
                }
            }
        })
    ;
});