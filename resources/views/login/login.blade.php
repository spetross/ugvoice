<div class="intro page uk-block">
      
    <!-- Container -->
    <div class="ui block container">
      <!-- Section Title -->
      <div class="section-title invert-colors uk-margin-bottom-remove">
        <h2 class="ui icon header">
            <i class="sign in icon"></i>
            <div class="content">Log-in to your account</div>
        </h2>
        <p></p>
      </div>
      <!-- /Section Title -->
    </div>
    <!-- /Container -->
  
</div>

<div class="main content uk-block bg-white">
    <div class="ui middle aligned center aligned grid">
        <div class="left aligned column" style="max-width: 450px">
            <h2 class="ui red center aligned header">
                <i class="sign in icon"></i>
                Login
            </h2>
            @include('layout.flash')
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
                    <button type="submit" class="ui fluid primary button">Login</button>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui padding-10 uk-text-center message">
                New to us? <a href="{{ action('LoginController@getSignup') }}">Sign Up</a>
            </div>
        </div>
    </div>
</div>
