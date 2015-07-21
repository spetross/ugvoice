<nav class="main uk-navbar uk-navbar-attached">
    <div class="uk-container uk-container-center">

        <a class="uk-navbar-brand uk-hidden-small" href="{{ url('/') }}" style="margin-right: 40px">
            <img class="uk-margin uk-margin-remove" src="{{ asset('img/logo_black.svg') }}" width="90" height="30"
                 alt="Voice">
        </a>

        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav uk-hidden-small">
                <li class="{{ Request::is('/') ? 'uk-active' : null }}"><a href="{{ url('/') }}"><i
                                class="ion-android-home empty uk-icon-home"></i></a></li>
                <li class="{{ Request::is('clients') ? 'uk-active' : null }}"><a
                            href="{{ action('ClientController@index') }}"> Browse</a></li>
                <li class="{{ Request::is('forum') ? 'uk-active' : null }}"><a
                            href="{{ url(config('forum.uri', 'forum')) }}"> Forum</a></li>
            </ul>
        </div>

        @if(Auth::check())
            <div class="uk-navbar-content uk-hidden-small" id="user-menu">

            </div>
        @endif

        <div class="uk-navbar-content uk-hidden-small">
            {{--
            <form class="uk-search uk-margin-remove uk-display-inline-block">
                <input class="uk-search-field" style="width: 150px" type="text" placeholder="Search">
                <button class="uk-button uk-button-primary uk-hidden">Submit</button>
            </form>--}}
        </div>

        @unless(Request::is('/') || Auth::check())
            <div class="uk-navbar-content uk-hidden-small" id="user-menu">
                <a class="uk-button uk-button-transparent"
                   href="{{ action('LoginController@getLogin') }}?redirect={{Request::getUri()}}"
                   data-uk-modal="{target:'#login-modal'}"><i class="uk-icon-sign-in"></i> Sign in</a>
                <a class="uk-button uk-button-transparent"
                   href="{{ action('LoginController@getSignup') }}?redirect={{Request::getUri()}}"><i
                            class="uk-icon-user-plus"></i> Create account</a>
            </div>
        @endunless

        <a href="#" class="uk-navbar-toggle uk-visible-small uk-vertical-align-middle"></a>

        <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
            <a class="tm-logo-small" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_black.svg') }}" width="90" height="30" alt="Voice">
            </a>
        </div>
    </div>
</nav>