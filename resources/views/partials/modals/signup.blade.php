<div class="uk-modal" id="signup-form-modal" tabindex="-1" role="dialog">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <h2>Sign up for an account</h2>
        </div>
        <form id="signup-form" action="{{ action('LoginController@postSignup') }}" class="uk-form" role="form">

            <div class="modal-body">
                <div class="message"></div>
                <div class="uk-form-row">
                    <label for="inputName">Your full name</label>

                    <div class="uk-form-controls">
                        <input type="text" name="name" id="inputName" class="form-control"
                               placeholder="Provide your full name">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="inputUsername">Choose username</label>

                    <div class="uk-form-controls">
                        <input type="text" name="username" id="inputUsername" class="" placeholder="Choose username">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="inputEmail">Email Address</label>

                    <div class="uk-form-controls">
                        <input type="text" name="email" class="" id="inputEmail" placeholder="Enter Email">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="inputPassword">Password</label>

                    <div class="uk-form-controls">
                        <input type="password" name="password" class="" id="inputPassword" placeholder="Password">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="selectBirthDate">Birth Date</label>
                </div>
                <div class="uk-form-row">
                    <label for="inputGender">Gender:</label>
                    <select style="width: 33%" name="gender" id="inputGender">
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="uk-form-row">
                    <input placeholder="Enter the text in below image" class="form-control" id="captcha-form"
                           type="text" name="captcha" autocomplete="off">

                </div>
                <div class="checkbox">
                    <label>
                        <input name="toc" type="checkbox"> By clicking signup button you agree with our <a
                                href="/site/toc">terms and conditions</a>
                    </label>
                </div>
            </div>
            <div class="uk-modal-footer">
                <button type="submit" class="uk-button uk-button-success">Sign up now</button>
                <br>
            </div>
        </form>
    </div>
    <!-- /.uk-modal-dialog -->
</div><!-- /.uk-modal -->