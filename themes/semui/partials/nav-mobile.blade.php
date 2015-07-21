<div class="ui vertical mobile inverted sidebar icon labeled menu">
    
    <a class="item" href="{{ route('home') }}">
        <i class="home icon"></i>
        Home
    </a>
    <a class="item" href="{{ route('clients') }}">
        <i class="briefcase icon"></i>
        Clients
    </a>
    <a class="item" href="{{ route('forum') }}">
        <i class="block layout icon"></i>
        Forum
    </a>
    @if(Auth::check())
    <a class="item" href="{{ route('user') }}">
        <i class="user icon"></i>
        Profile
    </a>
    <a class="item" href="{{ route('logout') }}">
        <i class="sign out icon"></i>
        Logout
    </a>
    @else
    <a class="item" href="{{ route('login') }}">
        <i class="sign in icon"></i>
        Login
    </a>
    <a class="item" href="{{ route('signup') }}">
        <i class="user add icon"></i>
        Sign Up
    </a>
    @endif
</div>