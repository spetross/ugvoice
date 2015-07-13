<div class="ui clearing very basic segment">
    <a
            href="{{ action('Clients\PersonController@add', $client->slug) }}"
            class="right floated ui primary icon button">
        <i class="user add icon"></i><span class="hidden-mobile"> Add</span>
    </a>

    <div class="ui search icon input">
        <input placeholder="Search people..." type="text">
        <i class="search link icon"></i>
    </div>
</div>
<div id="List">
    {!! Theme::partial('client.counselors') !!}
</div>
