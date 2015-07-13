<?php Theme::asset()->container('footer')->add('jquery', 'assets/js/jquery.min.js') ?>
<?php Theme::asset()->container('footer')->add('uikit', 'assets/js/uikit.js', ['jquery']) ?>
<?php Theme::asset()->container('footer')->add('uk-sticky', 'assets/library/uikit/js/components/sticky.js', ['jquery']) ?>
<?php
Theme::asset()->container('footer')->add('semantic', 'assets/library/sui/semantic.min.js', ['jquery']);
Theme::asset()->container('footer')->add('application', 'assets/js/application.js', ['semantic', 'pace']);
?>
@if(Auth::check())
<?php Theme::asset()->add('chatbar', 'assets/css/components/chatbar.css'); ?>
@else
<?php Theme::asset()->container('footer')->add('login', 'assets/js/login.js', ['semantic', 'application']); ?>
@endif


        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title or null }}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!--[if !IE]> -->
    <script data-pace-options='{ "ajax": true, "document": true, "eventLag": false, "elements": false }'
            src="{{ asset('library/pace.js') }}"></script>
    <!-- <![endif]-->

</head>
<body class="{{ $bodyClass or last(Request::segments()) }}">
<div class="ui vertical inverted left sidebar menu">

</div>
<div class="uk-offcanvas" id="chatbar">
    @include('layout.chatbar')
</div>
@include('layout.navbar')
<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30">
        <div class="segment header">@yield("header")</div>
        <div
                class="uk-container uk-container-center">
            @yield("page.content")
        </div>
    </div>
    <div class="ui black inverted vertical footer segment">
        @include('layout.footer')
    </div>
</div>
@unless(Auth::check())
@include('partials.modals.login')
@endunless
{!! Theme::asset()->container('footer')->scripts() !!}
@include('layout.api')
        <!-- inline page scripts -->
@yield('scripts')
</body>
</html>