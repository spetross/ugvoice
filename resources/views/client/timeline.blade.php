@extends("site::client.layout")


@section('content')

        <!-- // Tabs Heading END -->
<div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-match>
    @if(Sentry::check() && !is_null($popularPost))
        <div class="uk-width-medium-1-2">
            @include('site::client.posts.form')
        </div>
        <!--
        <script>
            autosize($('textarea.small.text'));
        </script>-->
        <div class="uk-width-medium-1-2 uk-hidden-small">
            <div class="ui fluid card">
                <div class="content">
                    <span class="right floated time">2 days ago</span>

                    <div class="header">Popular post</div>
                    <div class="description">
                        <p></p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="right floated author">
                        <img class="ui avatar image" src="/assets/img/avatar/small/matt.jpg"> Matt
                    </div>
                </div>
            </div>
        </div>
    @endif

    @unless(Sentry::check())
        <div class="uk-width-medium-1-2">
            <div class="ui half banner test ad" data-text="Banner"></div>
        </div>
    @endunless
</div>

<!-- Widget Scroll -->
<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-2 tm-grid-heights uk-margin-top"
     data-uk-grid="{gutter: 10}" id="articles-list">
    @if(Sentry::check() && is_null($popularPost))
        <div class="">
            @include('site::client.posts.form')
        </div>
    @endif
    @forelse($posts as $post)
        <div class="">
            @include('site::client.posts.post', compact('post'))
        </div>
    @empty
        <div class="ui info message">
            <p>No posts</p>
        </div>
    @endforelse
</div>
@if(!$posts->isEmpty())
    <div class="fluid ui bottom basic paginate button margin-top-10" data-client="{{$organisation->slug}}"
         data-page="{{$posts->currentPage()+1}}">
        Load more content...
    </div>
    @endif
            <!-- // Widget Scroll END -->

    @stop

