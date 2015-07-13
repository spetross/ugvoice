app.forum = {};

// ready event
app.forum.ready = function () {

    var
        $postForm = $('.post.form'),
        $activityContainer = $('.activity-container'),
        $commentsForm = $('.comment.form'),
        handler;


    handler = {

        initPostForm: function () {
            $postForm.api({
                method: 'POST',
                dataType: 'json',
                action: 'add post',
                serializeForm: true,
                beforeSend: function (settings) {
                    if (!isLoggedIn) {
                        $(this).state('flash text', 'Requires Login!');
                        return false;
                    }
                    if (handler.isPosting()) return false;
                    handler.postingStatus();
                    return settings;
                },
                onSuccess: function (response, element) {
                    handler.removePostingStatus();
                    $postsContainer.prepend(response['Post']);
                    element.form('clear');
                    setTimeout(function () {
                        handler.init();
                    }, 0)
                }
            })
        },

        initCommentForm: function () {
            $commentsForm.api({
                method: 'POST',
                dataType: 'json',
                action: 'add comment',
                serializeForm: true,
                onSuccess: function (response, element) {
                    var post = $(this).data('post');
                    var $postCommentWrapper = $("#post-" + post + "-comments").find('.ui.comments');
                    if (response['Comment']) {
                        $postCommentWrapper.append(response['Comment']);
                        $(this).form('clear')
                        setTimeout(function () {
                            handler.init();
                        }, 0)
                    }
                }
            })
        },

        initTextArea: function () {

            var txt = $('form').find('textarea.auto.text');
            autosize.destroy(txt)
            $('.form-actions').addClass('uk-hidden');

            $('.share.link', $postForm).on('focus', function () {
                $('.form-actions', $postForm).removeClass('uk-hidden')
            });

            $('.auto.text', $postForm).on('focus', function () {
                autosize($(this));
                $(this).closest('form').find('.form-actions').removeClass('uk-hidden');
            });

            $('.auto.text', $activityContainer).on('focus', function () {
                autosize($(this));
                handler.postingStatus();
                $(this).closest('form').find('.form-actions').removeClass('uk-hidden');
            });

            $('.reset.uk-button').on('click', function () {
                var txt = $(this).closest('form').find('textarea.auto.text');
                autosize.destroy(txt)
                handler.removePostingStatus();
                $(this).closest('.form-actions').addClass('uk-hidden');
            })
        },

        postingStatus: function () {
            window.postingStatus = true;
        },

        isPosting: function () {
            return window.postingStatus;
        },

        removePostingStatus: function () {
            window.postingStatus = false;
        },

        disablePosting: function () {
            $("#post-submit-button").attr('disabled', 'disabled');
        },

        enablePosting: function () {
            $("#post-submit-button").removeAttr('disabled');
        },

        refreshTimestamps: function () {
            $("abbr.timeago").timeago();
            $("time.timeago").timeago();
            $("span.timeago").timeago();
        },
        init: function () {
            handler.initPostForm();
            handler.initCommentForm();
            handler.initTextArea();

            $(".comments .actions .delete")
                .api({
                    method: 'delete',
                    dataType: 'json',
                    action: 'delete comment',
                    beforeSend: function (settings) {
                        if (confirm("Sure to delete this comment")) {
                            return settings
                        }
                        return false;
                    },
                    onSuccess: function () {
                        var comment = $(this).data('id');
                        $("#comment-" + comment).remove();
                    }
                })
            ;

            $('.ui.feed img')
                .visibility({
                    type: 'image',
                    transition: 'fade in',
                    duration: 1000
                })
            ;


            $(".ui.feed .post.delete")
                .api({
                    method: 'delete',
                    dataType: 'json',
                    action: 'delete post',
                    beforeSend: function (settings) {
                        if (confirm("Sure to delete your post")) {
                            return settings
                        }
                        return false;
                    },
                    onSuccess: function () {
                        var post = $(this).data('id');
                        $("#post-" + post).remove();
                    }
                })
            ;
        }
    };

    handler.init();

    $('.client .ui.right.sticky')
        .sticky({
            offset: 50,
            context: '#main-container'
        })
    ;
    $('.tabular.menu .item').tab();
};

$(document)
    .ready(app.forum.ready)
;