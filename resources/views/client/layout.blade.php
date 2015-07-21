<div class="intro client page uk-block">
    <!-- Container -->
    <div class="ui block container">
        <!-- Section Title -->
        <div class="section-title invert-colors uk-margin-bottom-remove">
            <h2 class="ui icon header">
                <i class="briefcase icon"></i>
                <div class="content">{{ ucwords($client->name) }}</div>
            </h2>
            <p></p>
        </div>
        <!-- /Section Title -->
    </div>
    <!-- /Container -->
</div>

<div class="main content uk-block bg-white">
    <div class="">
        <div
                class="ui attached secondary fluid pointing menu"
                id="client-nav-menu" >
            <div class="ui container">
                <div class="header item">
                    {{ ucwords($client->name) }}
                </div>
                <div class="ui search item">
                    <div class="ui icon input">
                        <input class="prompt" placeholder="{{ trans('form.input_search.placeholder') }}" type="text">
                        <i class="search link icon"></i>
                    </div>
                </div>
                <div class="right menu">
                    <a
                            href="{{ route('client-home', $client->slug) }}"
                            class="{{ Request::is(sprintf('%s', $client->slug)) ? 'active' : null }} red item"
                            data-tab="home"
                            data-client="{{ $client->slug }}">
                        <i class="crosshairs icon"></i> {{ trans('site.menu.timeline') }}
                    </a>
                    <a
                            href="{{ route('client-articles', $client->slug) }}"
                            class="{{ Request::is(sprintf('%s/articles', $client->slug)) ? 'active' : null }} red item"
                            data-tab="articles"
                            data-client="{{ $client->slug }}">
                        <i class="newspaper icon"></i> {{ trans('site.menu.articles') }}
                    </a>
                    <a href="{{ route('about-client', $client->slug) }}"
                       class="{{ Request::is(sprintf('%s/about', $client->slug)) ? 'active' : null }} red item"
                       data-tab="about"
                       data-client="{{ $client->slug }}">
                        <i class="circle info icon"></i> {{ trans('site.menu.about') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="ui block container grid">
        <div class="six wide computer tablet only column" id="side-content">
            <div class="margin-top-10">
                <div class="ui fluid card">
                    <div class="content">
                        <div class="uk-text-center">
                        @if($client->logo)
                            <img class="ui small centered circular image" src="{{ $client->logo->path }}">
                        @endif
                        </div>
                        <div class="header">{{ trans('site.texts.about_us') }}</div>
                        <div class="description" style="font-style: italic">{{ str_limit($client->description, 183) }}</div>
                    </div>
                    <a href="{{ $client->website }}" class="ui teal bottom attached button">
                        <i class="globe icon"></i>
                        {{ trans('site.texts.read_more') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="ten wide computer tablet sixteen wide column" id="main-content">
            @yield('content')
        </div>
    </div>
</div>

{{--
<div class="client-container">
    @include('client.header')
    <div id="content-container" style="padding-top: 16px">
        @section('page')
            <div class="ui grid">
                <div class="computer tablet only row">
                    <div class="four wide column">
                       <div class="" data-uk-sticky="{top:80,boundary: true}">
                           @yield('sidebar.top')

                           @include('client.side-menu')

                           @yield('sidebar.bottom')
                       </div>
                    </div>
                    <div id="right-content" class="twelve wide computer eleven wide tablet sixteen wide mobile column">
                        <div class="ui tab" data-tab="home" data-client="{{ $client->slug }}"></div>
                        <div class="ui tab" data-tab="articles" data-client="{{ $client->slug }}"></div>
                        <div class="ui tab" data-tab="about" data-client="{{ $client->slug }}"></div>
                    </div>
                </div>
                <div class="mobile only column">

                </div>
            </div>
        @show
    </div>
</div>

--}}