@section("header")

    <div class="header uk-block uk-block-secondary">
        <div id="header-cover"></div>
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-small" data-uk-grid-margin>
                <div class="uk-width-medium-2-3 left">
                    <h1 class="ui header title">Welcome to Voice Uganda</h1>

                    <div class="welcome-notes">
                        <h2 class="ui header">
                            <i class="white huge bordered icon ion-compose"></i>

                            <div class="content">
                                Share content
                                <div class="sub header">Share your stories, your adventures and your thoughts</div>
                            </div>
                        </h2>
                        <h2 class="ui header">
                            <i class="green huge bordered icon ion-chatboxes"></i>

                            <div class="content">
                                Discuss
                                <div class="sub header">Keep in touch with your friends, chat, mention e.t.c</div>
                            </div>
                        </h2>

                        <h2 class="ui header">
                            <i class="white huge bordered icon ion-ios-people-outline"></i>

                            <div class="content">
                                Find people
                                <div class="sub header">Discover new people, make friends and start sharing</div>
                            </div>
                        </h2>
                    </div>
                </div>
                <div class="uk-width-medium-1-3 right">
                    <div class="uk-panel">
                        <a href="{{ url('auth/register') }}" data-uk-modal="{target:'#signup-form-modal'}"
                           class="uk-button uk-button-large uk-button-primary uk-width-1-1 uk-margin-small-bottom email"><i
                                    class="icon ion-android-mail"></i> Sign up with your email <span
                                    class="uk-icon-arrow-right"></span></a>
                    </div>

                    <form id="login-form" role="form" action="" class="ui form segment" method="post">
                        <div class="message"></div>
                        <div class="uk-form-row">
                            <label for="login-username">Email Address</label>
                            <input name="username" class="uk-width-1-1" type="text" id="login-username"
                                   placeholder="Enter Email">
                        </div>
                        <div class="uk-form-row">
                            <label for="login-password">Password</label>
                            <input type="password" class="uk-width-1-1" name="password" id="login-password"
                                   placeholder="Password">
                        </div>

                        <div class="ui checkbox">
                            <input name="remember" type="checkbox" tabindex="0">
                            <label>Keep me log in</label>
                        </div>
                        <div class="uk-form-row">
                            <button type="submit" class="uk-button uk-button-primary">Log in</button>
                            <a href="">Forgot your password?</a>
                        </div>
                    </form>

                    <div class="login-social-links">
                        <div class="uk-panel uk-text-center">
                            <a href="/auth/facebook" class="uk-icon-button uk-icon-facebook facebook"></a>

                            <a href="/auth/twitter" class="uk-icon-button uk-icon-twitter  twitter"></a>

                            <a href="/auth/google" class="uk-icon-button uk-icon-google-plus google"></a>
                        </div>
                    </div>
                    @unless(Auth::check())
                        @include('partials.modals.signup')
                    @endunless
                </div>
            </div>
        </div>
    </div>

@stop


@section('page.content')

    <div class="" id="home-clients-block">
        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4" data-uk-grid="{gutter: 20}" id="clients-list">
            @include('clients.list', ['organisations' => $featured_clients])
        </div>
    </div>
@stop
