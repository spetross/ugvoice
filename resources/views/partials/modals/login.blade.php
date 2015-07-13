<div id="login-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>

        <h1>Login</h1>

        <form class="ui fluid login form" method="POST"
              action="{{ action('LoginController@postLogin') }}?redirect={{Request::getUri()}}"
              data-redirect="{{Request::getUri()}}">
            <div class="field">
                <div class="ui very basic center aligned segment">
                    <h5>Login with</h5>
                    <a href="/auth/twitter" class="ui twitter icon button" id="twitter_button"><i
                                class="uk-icon-twitter"></i> <span>Twitter</span></a>
                    <a href="/auth/facebook" class="ui facebook icon button" id="facebook_button"><i
                                class="uk-icon-facebook"></i> <span>Facebook</span></a>
                    <a href="/auth/google" class="ui google plus icon button" id="google_button"><i
                                class="uk-icon-google"></i> <span>Google</span></a>

                    <div class="ui horizontal divider">
                        Or
                    </div>
                </div>
            </div>
            <div class="field" id="flashMessages"></div>
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
            <div class="uk-modal-footer">
                <div class="field">
                    <button class="login uk-button uk-button-large uk-button-primary uk-margin-left" type="submit">
                        Submit
                    </button>
                    <div class="uk-float-right">
                        <a href="{{ action('LoginController@getSignup') }}?redirect={{Request::getPathInfo()}}">Create
                            an account</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>