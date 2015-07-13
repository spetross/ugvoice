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
<body class="{{ Request::is('/') ? 'home' : last(Request::segments()) }}">

{!! Theme::partial('navbar') !!}

{!! Theme::content() !!}

{!! Theme::partial('footer') !!}

{!! Theme::asset()->container('footer')->scripts() !!}
</body>
</html>