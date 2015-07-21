<!DOCTYPE html>
<html>
<head>
    <title>{!! Theme::get('title') !!}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!! Theme::asset()->styles() !!}
    {!! Theme::asset()->scripts() !!}
</head>
<body class="{{ Theme::get('bodyClass', last(Request::segments())) }}">

{!! Theme::partial('navbar') !!}

<div class="pusher">
    <div class="full height">
        {!! Theme::content() !!}
        {!! Theme::partial('footer') !!}
    </div>
</div>
@unless(Auth::check())
    {!! Theme::partial('login-modal') !!}
@endunless
{!! Theme::partial('api') !!}
{!! Theme::asset()->container('footer')->scripts() !!}
@include('partials.page-scripts')
</body>
</html>