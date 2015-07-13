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
<body>
{!! Theme::partial('header') !!}

<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30">
        <div class="ui container padding-top-20">
            {!! Theme::content() !!}
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
@include('layout.api')
{!! Theme::asset()->container('footer')->scripts() !!}
</body>
</html>