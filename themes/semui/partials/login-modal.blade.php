<div id="login-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <form class="ui fluid login form" method="POST"
              action="{{ action('LoginController@postLogin') }}?redirect={{Request::getUri()}}"
              data-redirect="{{Request::getUri()}}">
            <div class="field">
                <div class="ui very basic center aligned segment uk-padding-remove">
                    <h5>Login with</h5>
                    <div data-uk-margin>
                        <a href="/auth/twitter" class="ui twitter icon button" id="twitter_button"><i
                                    class="twitter icon"></i> <span>Twitter</span></a>
                        <a href="/auth/facebook" class="ui facebook icon button" id="facebook_button"><i
                                    class="facebook icon"></i> <span>Facebook</span></a>
                        <a href="/auth/google" class="ui google plus icon button" id="google_button"><i
                                    class="google icon"></i> <span>Google</span></a>
                    </div>
                    <div class="ui horizontal divider">
                        Or
                    </div>
                </div>
            </div>
            <div class="" id="messages"></div>
            <div class="ui two fields">
                <div class="required field">
                    <label for="sign-in-username">Email Address</label>
                    <input type="email" placeholder="Email" id="sign-in-username" name="email">
                </div>
                <div class="required field">
                    <label for="sign-in-password">Password</label>
                    <input type="password" placeholder="Password" id="sign-in-password" name="password">
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input name="remember" type="checkbox" tabindex="0">
                    <label>Keep me log in</label>
                </div>
            </div>
            <div class="center aligned ui basic segment no-padding">
                <button class="login ui primary button" type="submit">Submit</button>
                <a href="{{ action('LoginController@getSignup') }}?redirect={{Request::getPathInfo()}}">Create an
                    account</a>
            </div>
        </form>
    </div>
</div>