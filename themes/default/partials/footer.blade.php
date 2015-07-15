<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui inverted section divider"></div>
        <img src="/assets/img/logo.svg" class="ui centered mini image">

        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="{{ url('/') }}">Home</a>
            <a class="item" href="{{ url('clients') }}">Clients</a>
            <a class="item" href="{{ url('forum') }}">Forum</a>
            <a class="item" href="{{ url('privacy/policy') }}">Privacy</a>
        </div>
    </div>
</div>

@unless(Auth::check())
    {!! Theme::partial('login-modal') !!}
@endunless

@section('scripts')
    <script type="text/javascript">
        var baseUrl = '<?= Request::getBaseUrl() ?>';
        var pageUrl = '<?= Request::url() ?>'
        var siteName = 'UgVoice';
        var maxPostImage = 8;
        var updateSpeed = 30;
        var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    </script>
@show