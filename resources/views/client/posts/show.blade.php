@extends("site::client.layout")


@section('org.menu')

    <div class="ui bottom four item attached fluid pointing menu">
        <a href="{{route('org.home', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s', $organisation->slug)) ? 'active' : null }} item"><i
                    class="fa fa-fw icon-ship-wheel"></i> Timeline</a>
        <a class="active item"><i class="fa fa-fw icon-compose"></i> Post</a>
        <a href="{{route('org.articles', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s/articles', $organisation->slug)) ? 'active' : null }} item"><i
                    class="newspaper icon"></i>Articles</a>
        <a href="{{route('org.about', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s/about', $organisation->slug)) ? 'active' : null }} item"><i
                    class="info icon"></i>About</a>
    </div>

@overwrite

@section('content')
    <div class="innerTB">
        <div class="widget activity-line">
            <div class="widget-body padding-none">
                <div class="widget-body padding-none">
                    <div class="activity-status border-bottom">
                        <div class="activity-author"><a href="#"><img src="{{ $post->user->photo }}" alt="" width="50"/></a>
                        </div>
                        <div class="text">
                            <div class="pull-right label label-default padding-right-10">
                                <em>{{ $post->timestamp() }}</em></div>
                            <h5 class="strong muted text-uppercase"><i class="icon-user-1"></i> {{$post->user->name}}
                            </h5>

                            <p class="margin-none">{{$post->content}}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="ui attached small secondary pointing menu">
                        <div class="header item">{{$post->created_at->toFormattedDateString()}}</div>
                        <a class="active popup item" href="{{$post->link}}" title="View all comments">
                            <i class="comments icon"></i> {{$post->comments()->count()}} Comments
                        </a>

                        <div class="ui dropdown item">
                            <i class="alternate share icon"></i> Share
                            <i class="dropdown icon"></i>

                            <div class="menu">
                                <a class="item" title="Share on facebook"><i class="facebook icon"></i>Facebook</a>
                                <a class="item" title="Share on twitter"><i class="twitter icon"></i>Twitter</a>
                                <a class="item" title="Share on google+"><i class="google plus icon"></i>Google+</a>
                            </div>
                        </div>
                    </div>
                    <div class="innerAll">
                        <div class="ui minimal comments" id="comments-container">
                            @include('site::client.posts.comments', ['comments' => $post->comments])
                        </div>
                        @if(Sentry::check())
                            <form class="ui reply comment form">
                                <div class="field">
                                    <textarea name="comment" class="share text"></textarea>
                                </div>
                                <div class="ui primary submit labeled icon button" data-client="{{$organisation->slug}}"
                                     data-post="{{$post->id}}">
                                    <i class="icon edit"></i>Add Comment
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@stop