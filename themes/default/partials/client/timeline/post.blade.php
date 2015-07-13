<li class="" data-client="{{ $client->slug }}" data-post="{{ $post->id }}" id="post-{{ $post->id }}">
    <div class="timeline-datetime">
        <span class="timeline-time">8:19</span>
        <span class="timeline-date">Today</span>
    </div>
    <div class="timeline-badge blue">
        <img src="{{ $post->user->getAvatar(100) }}" class="badge-picture">
    </div>
    <div class="timeline-panel bordered-2 bordered-azure">
        <div class="timeline-header bordered-bottom bordered-blue">
            <span class="timeline-title">
                <a href="{{ action('UserController@profile') }}">
                    {{ ucwords($post->user->name) }}
                </a>
                Posted
            </span>

            <p class="timeline-datetime">
                <small class="text-muted">
                    <i class="glyphicon glyphicon-time">
                    </i>
                    <abbr class="timeago" title="{{ $post->created_at }}"></abbr>
                </small>
            </p>
        </div>
        <div class="timeline-body">
            <div class="post content">
                @if(!$post->pictures->isEmpty())
                    @if($post->pictures->count() > 1)
                        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4" data-uk-grid>
                            @foreach($post->pictures as $picture)
                                <a href="{{ $picture->path }}" class="">
                                    <img data-src="{{ $picture->path }}" src="" class="ui post image">
                                </a>
                            @endforeach
                        </div>
                        <p>{{ $post->content }}</p>
                    @else
                        <?php $picture = $post->pictures()->first(); ?>
                        <a href="{{ $picture->path }}"><img data-src="{{ $picture->path }}" src=""
                                                            class="ui centered medium post image"></a>
                        <i class="text muted text-sm">
                            {{ $post->content }}
                        </i>
                    @endif
                @else
                    <p>{{ $post->content }}</p>
                @endif
            </div>
            <div class="ui text post menu no-margin">
                <div class="header item">
                    <time class="timestamp" title="{{ $post->created_at }}" datetime="{{ $post->created_at }}"
                          data-timestamp="{{ $post->created_at }}">{{ $post->created_at->toFormattedDateString() }}</time>
                </div>
                <div class="item">
                    <div class="comments_count">
                        <i class="comments icon"></i>
                        comments
                        <span class="detail">{{ $post->comments->count() }}</span>
                    </div>
                </div>
                @if(Auth::id() !== $post->user->id)
                    <a data-post="{{$post->id}}" class="item">
                        <i class="thumbs up icon"></i> Like
                    </a>
                @endif
                <div class="ui pointing dropdown item">
                    Share <i class="dropdown icon"></i>

                    <div class="menu">
                        <a class="item" href="#"><i class="facebook icon"></i> Facebook</a>
                        <a class="item" href="#"><i class="twitter icon"></i> Twitter</a>
                    </div>
                </div>
                @if(Auth::check() && Auth::id() === $post->user->id)
                    <a class="post delete item" href="#" data-client="{{ $client->slug }}" data-id="{{ $post->id }}"><i
                                class="remove icon"></i> Delete</a>
                @endif
            </div>
            <?php   $limit = 3;
            $comments = $post->comments()
                    ->newQuery()->paginate($limit);
            ?>
            <div
                    class="post comments"
                    id="post-{{$post->id}}-comments"
                    data-offset=""
                    data-limit="{{ $limit }}"
                    data-post="{{ $post->id }}">
                {!! Theme::partial('client.timeline.post-comments', compact('post', 'comments')) !!}
            </div>
            @if(Auth::check())
                <form class="ui comment reply form margin-top-5" data-client="{{ $client->slug }}"
                      data-post="{{ $post->id }}">
                    <div class="field">
                        <textarea placeholder="Add your comment ..." rows="1" class="auto text"
                                  name="Post[comment]"></textarea>
                    </div>
                    <div class="field form-actions margin-bottom-10 uk-hidden">
                        <button class="ui submit blue button" type="submit">
                            <i class="icon edit"></i> Submit
                        </button>
                        <button class="ui reset button" type="reset">
                            Cancel
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</li>