<div class="intro slider uk-block">
    <div class="ui block container grid">
        <div class="fourteen wide mobile thirteen wide tablet twelve wide computer column">
            <div id="home-slides" class="uk-switcher">
                <div class="uk-active slide" data-tab="hf">
                    <div class="ui center aligned basic segment">
                        <h1 class="uk-h1 uk-text-contrast uk-animation-slide-bottom"> Find An Organisation </h1>
                        <div class="ui large action input">
                            <input placeholder="Search..." type="text">
                            <button class="ui primary button">Search</button>
                        </div>
                    </div>
                </div>
                <div class="slide" data-tab="hi">
                    
                </div>
                <div class="slide" data-tab="hj">
                    <h1 class="ui header title uk-text-contrast">Join Voice Uganda</h1>
                    <div class="welcome-notes uk-text-left">
                        <h2 class="ui header uk-text-contrast">
                            <i class="white huge bordered compose icon"></i>
                            <div class="content">
                                Share content
                                <div class="sub header uk-text-contrast">Share your stories, your adventures and your thoughts</div>
                            </div>
                        </h2>
                        <h2 class="ui header uk-text-contrast">
                            <i class="green huge bordered chat icon"></i>
                            <div class="content">
                                Discuss
                                <div class="sub header uk-text-contrast">Keep in touch with your friends, chat, mention e.t.c</div>
                            </div>
                        </h2>
                    </div>
                    <div class="ui buttons">
                        <button class="ui button" data-uk-modal="{target:'#login-modal'}">Login</button>
                        <div class="or"></div>
                        <button data-uk-modal="{target:'#signup-modal'}" class="ui positive button">Register</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="two wide mobile three wide tablet four wide computer left aligned column">
            <div class="pager block vcenter">
                <div class="vcenter-this">
                    <ul class="tab-pager" data-uk-switcher="{connect:'#home-slides', animation: 'uk-animation-slide-left'}">
                        <li class="uk-active"><a href="#"><i class="search icon"></i><span>Find Organisation</span></a></li>
                        <li class=""><a href="#"><i class="info icon"></i><span>About Voice</span></a></li>
                        <li class=""><a href="#"><i class="user add icon"></i><span>Join Voice</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="main content uk-block bg-white">
    <div class="ui main container grid">
        <div class="column">
            <div class="section-title">
                <h2>Featured Organisations</h2>
                <p></p>
            </div>
            <div class="">
                <div class="uk-slidenav-position" data-uk-slider="{infinite: false, center: true}">
                    <div class="uk-slider-container">
                        <ul class="uk-slider uk-grid uk-grid-width-medium-1-4">
                            @foreach($featured_clients as $client)
                                <li class="">
                                    <div class="ui fluid card">
                                        <a class="image" href="{{ route('client.home', $client->slug) }}">
                                            <img src="{{ $client->logo ? $client->logo->path : asset('assets/img/placeholder.svg') }}"
                                                 alt="{{ $client->name }}">
                                        </a>
                                        <div class="content" style="text-align:center">
                                            <a class="header"
                                               href="{{ route('client.home', $client->slug) }}">{{ $client->name }}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

