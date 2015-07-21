{!! Theme::partial('nav-mobile') !!}
<div class="ui fixed navbar block segment">
    <div class="ui grid container">
        <div class="tablet computer only row">
            <div class="column">
                <div class="ui secondary menu">
                    <div class="header item">
                        <a class="uk-hidden-small" href="{{ route('home') }}">
                            <img class="uk-margin uk-margin-remove" src="{{ asset('assets/img/logo.svg') }}" width="90" height="30" title="Home" alt="Voice">
                        </a>
                    </div>
                    <a href="{{ route('home') }}" class="{{ (Request::is('/') or Request::is('home')) ? 'active' : null }} icon item">
                        <i class="home icon"></i>
                    </a>
                    <a href="{{ route('forum') }}" class="{{ Request::is('*forum*') ? 'active' : null }} item">
                        <i class="group icon"></i> Forum
                    </a>
                    <div class="right menu">
                        <div class="item uk-visible-large">
                            
                        </div>
                        @if(Auth::check())
                            <a href="{{ route('logout') }}" class="item">
                                <i class="sign out icon"></i>
                                Log out
                            </a>
                            <a href="{{ route('messages') }}" class="messages icon item">
                                <i class="inbox icon"></i>
                                <span class="ui mini floating circular green empty label" style="top:0;"></span>
                            </a>
                            <div class="ui pointing dropdown item">
                                <img src="{{ Auth::user()->present()->getAvatar(50) }}" class="ui avatar image">
                                {{ ucwords(Auth::user()->name) }}
                                <div class="menu">
                                    <div class="header">
                                        Signed as {{ Auth::user()->present()->fullName }}
                                    </div>
                                    <a href="{{ action('UserController@profile') }}" class="item"><i class="user icon"></i>Your profile</a>
                                    <a href="{{ url('auth/logout') }}" class="item"><i class="sign out icon"></i>Log out</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" data-uk-modal="{target:'#login-modal'}" class="item"><i class="sign in icon"></i> Login</a>
                            <div class="item">
                                <a href="{{ route('signup') }}" class="ui large primary icon labeled button"><i class="user add icon"></i>Register</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile only row">
            <div class="column uk-padding-remove">
                <nav class="uk-navbar uk-navbar-attached">
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
                    @if(Auth::check())
                        <div class="uk-navbar-content uk-navbar-flip">
                            <a href="{{ route('messages') }}" class="ui small basic green icon button"><i class="inbox icon"></i></a>
                        </div>
                    @endif
                    <a href="#" class="uk-navbar-toggle uk-vertical-align-middle"></a>

                    <div class="uk-navbar-brand uk-navbar-center">
                        <a href="{{ route('home')  }}">
                            <img src="{{ asset('assets/img/logo_black.svg') }}" width="90" height="30" alt="Voice">
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>