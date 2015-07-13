<div class="ui middle aligned center aligned grid">
    <div class="column" style="max-width: 450px;">
        <div class="ui signup segment">
            <h2>Create an account</h2>
            @if (count($errors) > 0)
                <div class="ui error message text-left">
                    <span class="icon-x alert-close alert-close-error"></span>
                    <ul class="uk-margin-remove">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="POST" class="ui form text-left">
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

                <div class="field">
                    <button class="ui submit button" type="submit">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>




