@if(Auth::check())
    <div class="ui clearing very basic segment">
        <a
                href="{{ action('Clients\ArticleController@create', $client->slug) }}"
                class="right floated ui primary icon button">
            <i class="pencil icon"></i><span class="hidden-mobile"> New Post</span>
        </a>

        <div class="ui search icon input">
            <input placeholder="Search..." type="text">
            <i class="search link icon"></i>
        </div>
    </div>
@endif

<div class="">
    {!! Theme::partial('articles.index', compact('articles')) !!}
</div>