<div class="ui fluid vertical pointing tabbed menu">
    <a
        href="{{ route('client.home', $client->slug) }}"
        class="{{ Request::is(sprintf('%s', $client->slug)) ? 'active' : null }} red item"
        data-tab="home"
        data-client="{{ $client->slug }}">
        <i class="crosshairs icon"></i> Timeline
    </a>
    <a
        href="{{ route('client.articles', $client->slug) }}"
        class="{{ Request::is(sprintf('%s/articles', $client->slug)) ? 'active' : null }} red item"
        data-tab="articles"
        data-client="{{ $client->slug }}">
        <i class="newspaper icon"></i> Articles
    </a>
    <a href="{{ route('client.about', $client->slug) }}"
       class="{{ Request::is(sprintf('%s/about', $client->slug)) ? 'active' : null }} red item"
       data-tab="about"
       data-client="{{ $client->slug }}">
        <i class="circle info icon"></i> About
    </a>
</div>





