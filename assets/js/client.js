app.posts = {};

// ready event
app.posts.ready = function () {

    var
        $postForm = $('.ui.post.form'),
        $postsContainer = $('.posts.timeline'),
        $commentForm = $(".ui.comment.reply.form"),
        handler;


    handler = {

        initPostForm: function () {
            var $postsContainer = $('.posts.timeline');
            var $formWrapper = $('li.post.form').removeClass('hidden');
            $formWrapper.prependTo($postsContainer);
            var $postForm = $('.ui.post.form');
            $postForm.api({
                method: 'POST',
                dataType: 'json',
                action: 'add post',
                serializeForm: true,
                beforeSend: function (settings) {
                    if (handler.isPosting()) return false;
                    handler.postingStatus();
                    return settings;
                },
                onSuccess: function (response, element) {
                    handler.removePostingStatus();
                    if (response.Post) {
                        console.log(response.Post);
                        $postsContainer.prepend(response.Post);
                        $(this).form('clear');
                        setTimeout(function () {
                            handler.initPostForm();
                            handler.init();
                            handler.destroyTextarea($postForm)
                        }, 0)
                    }
                }
            })
        },

        initCommentForm: function () {
            var $commentForm = $(".ui.comment.reply.form");
            $commentForm.form({
                fields: {
                    post_comment: {
                        identifier: 'Post[comment]',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Please enter your comment'
                            }
                        ]
                    }
                }
            });
            $commentForm.api({
                method: 'POST',
                dataType: 'json',
                action: 'add comment',
                serializeForm: true,
                onSuccess: function (response, element) {
                    var
                        post = $(this).data('post'),
                        $postWrapper = $(this).closest("#post-" + post),
                        $commentsWrapper = $postWrapper.find('.ui.comments');
                    if (response.commentsCount) {
                        $postWrapper.find('.comments_count .detail').html(response.commentsCount)
                    }
                    if (response.Comment) {
                        $commentsWrapper.append(response.Comment);
                        $(this).form('clear');
                        setTimeout(function () {
                            handler.init();
                            handler.destroyTextarea($commentForm)
                        }, 0)
                    }
                }
            })
        },

        loadMoreComments: function (target, caller) {
            var limit = target.data('limit'),
                offset = target.data('offset'),
                page = caller.data('page'),
                post = caller.data('post');
            $.api({
                method: 'POST',
                dataType: 'json',
                action: 'more comments',
                on: 'now',
                data: {
                    limit: limit,
                    offset: offset
                },
                urlData: {
                    page: page,
                    post: post
                },
                onSuccess: function (data) {
                    if (data['Comments']) {
                        $.each(data['Comments'], function (index, comment) {
                            target.find('.ui.comments').prepend(comment);
                        });
                        if (data['nextPage']) {
                            caller.data('page', data['nextPage']);
                            target.data('limit', data['limit']);
                            target.data('offset', data['offset'])
                        } else {
                            caller.remove()
                        }
                        setTimeout(function () {
                            handler.init()
                        }, 0)
                    }
                }
            });
        },

        paginatePosts: function () {

            $("#timeline-paginator-button")
                .api({
                    method: 'POST',
                    dataType: 'json',
                    action: 'more posts',
                    onSuccess: function (data) {
                        var postContainer = $(".ui.posts.feed");
                        if (data['Posts']) {
                            $.each(data['Posts'], function (index, post) {
                                postContainer.append(post);
                            });
                            if (data['nextPage']) {
                                $(this).data('page', data['nextPage'])
                            } else {
                                $(this).remove()
                            }
                            setTimeout(function () {
                                handler.init();

                            }, 0)
                        }
                    }
                })
            ;
        },

        destroyTextarea: function (form) {
            var txt = form.find('.auto.text');
            autosize.destroy(txt);
            form.find('.form-actions').addClass('uk-hidden').fadeOut();
            form.form('reset')
        },

        createTextarea: function (txtarea) {
            autosize(txtarea);
            txtarea.closest('form').find('.form-actions').removeClass('uk-hidden').fadeIn();
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
        refreshPosts: function (intervel) {
            setInterval(function () {
                $.api({
                    action: 'refresh posts',
                    method: 'POST',
                    dataType: 'json',
                    on: 'now',
                    beforeSend: function (settings) {
                        if (handler.isPosting()) {
                            return false
                        }
                        return settings;
                    },
                    onSuccess: function (data) {
                        var $postsContainer = $('.posts.timeline');
                        if (data['Posts']) {
                            $.each(data['Posts'], function (index, post) {
                                $postsContainer.prepend(post);
                            });
                            setTimeout(function () {
                                handler.init();
                            }, 0)
                        }
                    }
                });

            }, intervel);
        },
        refreshComments: function (intervel) {
            setInterval(function () {
                $(".post.comments").api({
                    action: 'refresh comments',
                    method: 'GET',
                    dataType: 'html',
                    on: 'now',
                    beforeSend: function (settings) {
                        return settings;
                    },
                    onSuccess: function (data) {
                        $(this).html(data);
                        setTimeout(function () {
                            handler.init();
                        }, 0)
                    }
                });

            }, intervel);

        },
        init: function () {
            handler.paginatePosts();
            handler.initCommentForm();
            handler.refreshTimestamps();

            $('.tabular.menu > .item').tab();
            $('.ui.dropdown').dropdown();

            $('.reset.button').on('click', function () {
                handler.destroyTextarea($(this).closest('form'));
            });

            $('.auto.text').on('focus', function () {
                handler.createTextarea($(this));
            });

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
                        var post = $(this).data('post'),
                            $postWrapper = $(this).closest("#post-" + post),
                            comment = $(this).data('id');
                        if (response.commentsCount) {
                            $postWrapper.find('.comments_count .detail').html(response.commentsCount)
                        }
                        $("#comment-" + comment).remove();
                    }
                })
            ;

            $('.post.image', $postsContainer)
                .visibility({
                    type: 'image',
                    transition: 'fade in',
                    duration: 1000
                })
            ;

            $(".post.delete", $postsContainer)
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
    handler.initPostForm();
    handler.refreshPosts(45000);

    /*
     $('.client #tabbed-nav-menu > .item')
     .tab({
     context : '#right-content',
     auto    : true,
     history : true,
     path    : pageUrl,
     cache   : false,
     alwaysRefresh : true,
     onLoad  : function (tabPath) {
     handler.init()
     }
     })
     ;
     */
    $('.client .ui.right.sticky')
        .sticky({
            offset: 50,
            context: '#main-container'
        })
    ;

    $(document).on('click', '.button.load-more-comments', function () {
        handler.loadMoreComments($($(this).data('target')), $(this));
        return false;
    })
}

$(document)
    .ready(app.posts.ready)
;