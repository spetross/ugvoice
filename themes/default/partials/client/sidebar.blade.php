@if(Request::is(sprintf('%s', $client->slug)))
    <div class="margin-bottom-10">
        <div class="ui fluid large icon input">
            <input placeholder="Search..." type="text">
            <i class="search link icon"></i>
        </div>
    </div>
@endif

<div class="ui fluid vertical pointing menu" id="tab-nav-menu">
    <a
            href="{{ route('client.home', $client->slug) }}"
            class="{{ Request::is(sprintf('%s', $client->slug)) ? 'active' : null }} red item" data-tab="timeline">
        <i class="crosshairs icon"></i> Timeline
    </a>
    <a
            href="{{ route('client.articles', $client->slug) }}"
            class="{{ Request::is(sprintf('%s/articles', $client->slug)) ? 'active' : null }} red item"
            data-tab="articles">
        <i class="newspaper icon"></i> Articles
    </a>
    <a href="{{ route('client.about', $client->slug) }}"
       class="{{ Request::is(sprintf('%s/about', $client->slug)) ? 'active' : null }} red item"
       data-tab="about">
        <i class="circle info icon"></i> About
    </a>
</div>