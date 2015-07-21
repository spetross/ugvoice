<div
    class="widget no-header social-feed-box"
    data-client="{{ $client->slug }}"
    data-post="{{ $post->id }}"
    id="post-{{ $post->id }}">
    <div class="widget-body">
        <div class="uk-float-right social-action dropdown">
            <div class="ui top right mini pointing dropdown icon basic button">
                <i class="large angle down icon"></i>
                <div class="menu">
                    <a class="item" href="#">{{ trans('post.show_post') }}</a>
                    @if(Auth::check())
                    <a class="item" href="#">{{ trans('post.edit_post') }}</a>
                    <a class="item" href="#">{{ trans('post.delete_post') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="social-avatar">
            <a href="{{ route('profile', $post->user->present()->getId()) }}" class="uk-float-left">
                <img alt="image" src="{{ $post->user->getAvatar(100) }}" class="ui image">
            </a>
            <div class="header">
                <a href="{{ route('profile', $post->user->present()->getId()) }}">
                    {{ $post->user->present()->fullName() }}
                </a>
                <small class="uk-text-muted">
                    <i class="clock icon"></i>
                    <abbr class="timeago" title="{{ $post->created_at }}"></abbr>
                </small>
            </div>
        </div>
        <div class="social-body">
            @if($post->content)
                <p>{{ $post->content }}</p>
            @endif
            @if(!$post->pictures->isEmpty())
                @if($post->pictures->count() > 1)
                    <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4" data-uk-grid>
                        @foreach($post->pictures as $picture)
                            <a href="{{ $picture->path }}" data-uk-lightbox="{group:'post-images-{{$post->id}}'}">
                                <img data-src="{{ $picture->path }}" src="" class="ui post image">
                            </a>
                        @endforeach
                    </div>
                @else
                    <?php $picture = $post->pictures()->first(); ?>
                    <a href="{{ $picture->path }}"
                       data-uk-lightbox="{group:'post-images-{{$post->id}}'}">
                        <img data-src="{{ $picture->path }}" src=""
                             class="ui centered medium post image">
                    </a>
                @endif
            @endif
            <div class="" data-uk-margin="">
                <button class="ui tiny basic button"><i class="thumbs up icon"></i><span class="text">{{ ucfirst(trans('post.like_button')) }}</span></button>
                <button class="ui tiny basic button"><i class="comments icon"></i><span class="text">{{ ucfirst(trans('post.comments')) }}</span></button>
                <div class="ui tiny basic top right pointing dropdown  button">
                    <i class="share icon"></i>
                    <span class="text">{{ ucfirst(trans('post.share')) }}</span>
                    <div class="menu">
                        <a class="item" href="#"><i class="facebook icon"></i> Facebook</a>
                        <a class="item" href="#"><i class="twitter icon"></i> Twitter</a>
                    </div>
                </div>
            </div>
        </div>
        <?php   $limit = 3; $post_comments = $post->comments()->newQuery()->paginate($limit); ?>
        <div
                class="social-footer {{ ($post_comments->isEmpty() && !Auth::check()) ? 'no-comments' : null }}"
                id="post-{{$post->id}}-comments"
                data-limit="{{ $limit }}"
                data-post="{{ $post->id }}">
            @if(!$post_comments->isEmpty())
                @if($comments->hasMorePages())
                @endif
                @foreach($post_comments as $comment)
                    <div class="social-comment">
                        <a href="{{ route('profile', $comment->user->present()->getId()) }}" class="uk-float-left">
                            <img alt="image" src="{{ $comment->user->present()->getAvatar(50) }}">
                        </a>
                        <div class="content">
                            <a href="{{ route('profile', $comment->user->present()->getId()) }}">
                                {{ $comment->user->present()->fullName }}
                            </a>
                            <p>{{ $comment->content }}</p>
                            <br>
                            <small class="uk-text-muted">
                                <abbr class="timeago" title="{{ $post->created_at }}"></abbr>
                            </small>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(Auth::check())
            <div class="social-comment comment-form-wrapper">
                <a href="{{ route('profile', $post->user->present()->getId()) }}" class="uk-float-left">
                    <img alt="image" src="{{ $post->user->present()->getAvatar(50) }}">
                </a>
                <div class="content">
                    <form class="ui comment form" data-post="{{ $post->id }}">
                        <textarea class="auto text" name="Post[comment]" rows="1" placeholder="{{ trans('post.comment.form_placeholder') }}"></textarea>
                        <div class="field form-actions padding-5 uk-hidden">
                            <button type="submit" class="uk-button uk-button-primary">
                                {{ trans('form.button_submit') }}
                            </button>
                            <button type="reset" class="uk-button reset button">
                                {{ trans('form.button_reset') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>