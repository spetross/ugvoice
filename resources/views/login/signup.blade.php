<div class="intro page uk-block">
      
    <!-- Container -->
    <div class="ui block container">
      <!-- Section Title -->
      <div class="section-title invert-colors uk-margin-bottom-remove">
        <h2 class="ui icon header">
            <i class="user add icon"></i>
            <div class="content">Register</div>
        </h2>
        <p>Create your account</p>
      </div>
      <!-- /Section Title -->
    </div>
    <!-- /Container -->
  
</div>

<div class="main content uk-block">
    <div class="ui middle aligned center aligned grid">
        <div class="column" style="max-width: 450px;">
            <div class="ui left aligned signup segment">
                <h3 class="ui center aligned header">Create an account</h3>
                @include('layout.flash')
                <form role="form" method="POST" class="ui {{ $errors->has() ? 'error' :  null }} form text-left">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                    <div class="required field">
                        <label>Email</label>
                        <input type="text" id="register-form-email" name="email" value="{{ old('email') }}"
                               placeholder="Email">
                    </div>
                    <div class="required field">
                        <label>Password</label>
                        <input type="password" id="register-form-password" name="password" placeholder="Password">
                    </div>
                    <div class="required field">
                        <label>Confirm password</label>
                        <input type="password" id="register-form-confirm-password" name="password_confirmation"
                               placeholder="Confirm Password">
                    </div>
                    <div class="two fields">
                        <div class="required field">
                            <label for="register-form-firstname">First name</label>
                            <input type="text" id="register-form-firstname" name="first_name"
                                   value="{{ old('first_name') }}" placeholder="First Name">
                        </div>
                        <div class="required field">
                            <label>Last name</label>
                            <input type="text" id="register-form-lastname" name="last_name" placeholder="Last Name"
                                   value="{{ old('last_name') }}">
                        </div>
                    </div>

                    <div class="field">
                        <label for="register-form-gender"></label>
                        <select id="register-form-gender" class="ui selection dropdown">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="field uk-text-center">
                        <button class="uk-button uk-button-danger" type="submit">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




