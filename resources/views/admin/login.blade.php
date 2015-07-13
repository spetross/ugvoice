@section('content')
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui purple image header">
                <img src="{{asset('img/logo_black.svg')}}" class="image">

                <div class="content">
                    Log-in to your account
                </div>
            </h2>
            @include('layout.flash')
            <form class="ui large form" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" value="{{ old('email', Auth::check() ? Auth::user()->email : null) }}"
                                   name="email" placeholder="E-mail address">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <button class="ui fluid large purple submit button">Login</button>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                New to us? <a href="#">Sign Up</a>
            </div>
        </div>
    </div>

@endsection
@section('styles')

    <style type="text/css">
        body {
            background-color: #DADADA;
        }

        body > .grid {
            height: 100%;
        }

        .image {
            margin-top: -100px;
        }

        .column {
            max-width: 450px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.ui.form')
                    .form({
                        fields: {
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your e-mail'
                                    },
                                    {
                                        type: 'email',
                                        prompt: 'Please enter a valid e-mail'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter your password'
                                    },
                                    {
                                        type: 'length[6]',
                                        prompt: 'Your password must be at least 6 characters'
                                    }
                                ]
                            }
                        }
                    })
            ;
        })
        ;
    </script>
@endsection

  

