{{--
<header>
    <div class="ui text container">
    	<nav>
			<ul>
			  <li><a href="index.html" class="icon tasks">Tasks <span>3</span></a></li>
			  <li class="active"><a href="index.html" class="icon messages">Messages <span>17</span></a></li>
			  <li><a href="index.html" class="icon settings">Settings</a></li>
			</ul>
		</nav>
    </div>
</header>
--}}

<div class="ui main inverted pointing attached menu">
    <div class="ui container hidden-mobile">
        <div class="header item">
            <a href="{{ url('/') }}"><img src="/assets/img/logo.svg" style="height:30px"></a>
        </div>
        <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : null }} item">
            Home
        </a>
        <a href="{{ url('clients') }}" class="{{ Request::is('clients') ? 'active' : null }} item">
            Clients
        </a>
        <a href="{{ url('forum') }}" class="{{ Request::is('forum') ? 'active' : null }} item">
            Forum
        </a>

        <div class="right menu">
            @if(Auth::check())
                <a href="" class="item">
                    <img src="/assets/img/avatar/s/50.png" class="ui avatar image"> {{ ucwords(Auth::user()->name) }}
                </a>
            @else
                <a href="#login" class="item" id="user-login-button">
                    <i class="sign in icon"></i> Login
                </a>
                <a href="{{ action('LoginController@getSignup') }}" class="item">
                    <i class="user add icon"></i> Join us
                </a>
            @endif
        </div>
    </div>
</div>