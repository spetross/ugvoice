<div class="ui middle aligned center aligned grid">
    <div class="column" style="max-width: 450px">
        <h2 class="ui red image header">
            <i class="sign in icon"></i>
            Log-in to your account
        </h2>
        <div class="uk-text-left">@include('layout.flash')</div>
        <form class="ui large form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Login</button>
            </div>

            <div class="ui error message"></div>

        </form>

        <div class="ui message">
            New to us? <a href="{{ action('LoginController@getSignup') }}">Sign Up</a>
        </div>
    </div>
</div>
