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
    <style>
        .ui.post.feed > .event > .label + .content {
            margin: .2em 0 2em .75em;
        }

        .ui.feed .ui.pointing.dropdown > .menu:after {
            left: 25%;
        }
    </style>
</head>
<body class="client">
{!! Theme::partial('header') !!}
<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30 padding-top-20">
        <div class="ui vertical segment">
            <div class="ui text container">
                <div class="ui header">
                    <img src="/assets/img/savethechildren.jpg">

                    <div class="content">{{ $client->name }}</div>
                </div>
            </div>
        </div>
        <div class="ui stackable column text container grid margin-top-10">
            <div class="five wide side column">
                {!! Theme::partial('client.sidebar') !!}
            </div>
            <div class="eleven wide main column">
                {!! Theme::content() !!}
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
{!! Theme::asset()->container('footer')->scripts() !!}
</body>
</html>