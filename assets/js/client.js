app.posts = {};

// ready event
app.posts.ready = function () {

    var
        $postForm = $('.ui.post.form'),
        $postsContainer = $('#social-feed-wrapper'),
        $commentForm = $(".ui.comment.form"),
        refreshInterval = 30,
        $submitButton,
        handler;


    handler = {

        initPostForm: function () {
            var $textArea = $postForm.find('textarea.auto.text');
            $textArea.on('focus', function () {
                autosize($textArea);
                $postForm.find('.field.form-actions').show();
            });

            var $resetButton    = $('.ui.reset.button', $postForm);
            $resetButton.on('click', function() {
                $postForm.form('clear');
                autosize.destroy($textArea);
                $postForm.find('.field.form-actions').hide();
            });

            $submitButton   = $('.ui.submit.button', $postForm);
            $submitButton.api({
                method: 'POST',
                dataType: 'json',
                serializeForm: true,
                beforeSend: function (settings) {
                    if (handler.isPosting()) return false;
                    settings.url = $(this).data('url');
                    handler.postingStatus();
                    return settings;
                },
                onSuccess: function (response) {
                    if (response['Post']) {
                        $postsContainer.prepend(response['Post']);
                        $postForm.form('clear');
                        setTimeout(function () {
                            handler.init();
                        }, 0)
                    }
                    handler.removePostingStatus();
                },
                onError : function() {
                    handler.removePostingStatus();
                }
            })
        },

        initCommentForm: function () {

            $commentForm = $(".ui.comment.form");

            $('.comment.input', $commentForm).on('focus', function () {
                $commentForm = $(this).closest('.ui.form');
                $(this).hide();
                var $textArea = $commentForm.find('.comment.text').removeClass('uk-hidden').focus();
                autosize($textArea);
                $commentForm.find('.form-actions').removeClass('uk-hidden');
            });

            $('.reset.button', $commentForm).on('click', function () {
                $commentForm = $(this).closest('.ui.form');
                var $textArea =  $commentForm.find('textarea').addClass('uk-hidden');
                autosize.destroy($textArea);
                $commentForm.form('reset');
                $commentForm.find('.form-actions').addClass('uk-hidden');
                $commentForm.find('.comment.input').show();
            });

            $submitButton = $('.comment.submit.button');


            $submitButton.api({
                method          : 'put',
                dataType        : 'json',
                serializeForm   : true,
                beforeSend      : function (settings) {
                    settings.url = $(this).data('action');
                    return settings;
                },
                onSuccess: function (response, element) {
                    var post = $(this).data('post'),
                        $commentForm = $(this).closest('form'),
                        $postWrapper = $('.widget#post-'+post),
                        $commentsWrapper = $postWrapper.find('div.comments');
                    if (response['comment_count']) {
                        $postWrapper.find('.comments_count').html(response['comment_count'])
                    }
                    if (response['Comment']) {
                        $commentForm.form('clear');
                        $commentsWrapper.append(response['Comment']);
                        $postWrapper.data('offset', response['offset'])
                        setTimeout(function () {
                            handler.init();
                            handler.destroyTextarea($commentForm)
                        }, 0)
                    }
                }
            })
        },
        'refreshWidgets' : function () {  
            $.each($('.widget.social-feed-box'), function (index, element) {
                var el = $(element);
                handler.getComments(el, refreshInterval*1000);
                refreshInterval = refreshInterval + 10;
            })
        },
        getPosts: function (intervel) {
            if(!$postsContainer.length) return;
            setInterval(function () {
                $.ajax({
                    url : $postsContainer.data('url'),
                    type: 'post',
                    dataType: 'json',
                    on: 'now',
                    data : {
                        offset : $postsContainer.data('offset')
                    },
                    onSuccess: function (data) {
                        if (data['Posts']) {
                            $.each(data['Posts'], function (index, post) {
                                $postsContainer.prepend(post);
                            });
                            setTimeout(function () {
                                handler.init();
                                handler.refreshWidgets();
                            }, 0)
                        }
                    }
                });

            }, intervel);
        },
        getComments: function (widget, interval) {
            setInterval(function () {
                $.ajax({
                    url: widget.data('url'),
                    type: 'GET',
                    dataType: 'json',
                    data: {
                      offset: widget.data('offset')
                    },
                    success: function (data) {
                        widget.find('.post_likes').html(data['post_likes']);
                        widget.find('.comments_count').html(data['comments_count']);
                        if (data['comments']) {
                            $.each(data['comments'], function appendComments(index, comment) {
                                widget.find('.social-footer .comments').append(comment);
                            });
                            widget.data('offset', data['offset']);
                            setTimeout(function () {
                                handler.init()
                            }, 0)
                        }
                    }
                });
            }, interval);
        },
        deleteComment : function (comment, url) {
            var $comment = $('#comment-'+comment);
            var deleteBtn = $comment.find(".comment.delete.button");
            deleteBtn.api({
                method: 'delete',
                dataType: 'json',
                url: url,
                on: 'now',
                onSuccess: function (response) {
                    var post = deleteBtn.data('post'),
                        $postWrapper = deleteBtn.closest("#post-" + post);
                    if (response['comment_count']) {
                        $postWrapper.find('.comments_count').html(response['comment_count'])
                    }
                    $comment.remove();
                }
            })
        },

        deletePost : function (post, url) {
            var $postWidget = $('.widget#post-'+post);
            var $deleteButton =  $(".post.delete.button", $postWidget);
            $deleteButton
                .api({
                    method: 'delete',
                    dataType: 'json',
                    url : url,
                    on: 'now',
                    onSuccess: function () {
                        $postWidget.remove();
                    }
                })
            ;
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
            txt.addClass('uk-hidden');
            form.find('.comment.input').show();
            form.find('.comment.text').addClass('uk-hidden');
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
        init: function () {
            handler.paginatePosts();
            handler.initCommentForm();
            handler.refreshTimestamps();

            $('.tabular.menu > .item').tab();
            $('.ui.dropdown').dropdown();

            $('.reset.button').on('click', function () {
                //handler.destroyTextarea($(this).closest('form'));
            });





            $('.post.image', $postsContainer)
                .visibility({
                    type: 'image',
                    transition: 'fade in',
                    duration: 1000
                })
            ;
        }
    };

    app.posts = handler;

    handler.init();
    handler.initPostForm();
    handler.refreshWidgets();
    handler.getPosts(1000*(refreshInterval+20));

/**
    $('#client-nav-menu .right.menu > .item')
     .tab({
         context : '#main-content',
         auto    : true,
         history : true,
         path    : pageUrl,
         cache   : false,
         alwaysRefresh : true,
         onLoad  : function (tabPath) {
             handler.initPostForm();
             handler.init();
             if(isLoggedIn) $('[data-control="fileupload"]').fileUploader();
             UIkit.grid('[data-uk-grid]', {gutter: 5});
             UIkit.tab("[data-uk-tab]");
         }
     })
     ; **/

    $(document).on('click', '.button.load-more-comments', function () {
        handler.loadMoreComments($($(this).data('target')), $(this));
        return false;
    })
};

$(document)
    .ready(app.posts.ready)
;