<?php
Theme::asset()->container()->add('timeline', 'assets/css/components/timeline.css');
Theme::asset()->container()->add('profile', 'assets/css/components/profile.css');
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{!! Theme::get('title') !!}</title>
    {!! Theme::asset()->styles() !!}
    {!! Theme::asset()->scripts() !!}
    <style>
        .posts.timeline .ui.pointing.dropdown > .menu:after {
            left: 25%;
        }
    </style>
</head>
<body class="client">
{!! Theme::partial('header') !!}
<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30 padding-top-20">
        <div class="ui two stackable column container grid">
            <div class="ui container  profile-container">
                <div class="ui teal raised segment profile-header uk-margin-remove">
                    <div class="ui grid">
                        <div class="three wide computer four wide tablet sixteen wide mobile column text-center">
                            <img src="/assets/img/avatar/d/150.png" alt=""
                                 class="rounded centered ui imageheader-avatar">
                        </div>
                        <div class="eight wide computer twelve wide tablet sixteen wide mobile column profile-info">
                            <div class="ui header ">{{ ucwords($client->name) }}</div>
                            @if(Auth::check())
                                <a href="#" class="right floated ui basic button">
                                    <i class="edit icon"></i>
                                    Edit
                                </a>
                            @endif
                            <div class="header-information">
                                {{ str_limit($client->description, 227) }}
                            </div>
                        </div>
                        <div class="five wide computer sixteen wide tablet sixteen wide mobile center aligned column profile-stats"
                             style="">
                            <div class="ui mini three statistics">
                                <div class="posts statistic stats-col">
                                    <div class="value">
                                        {{ $client->posts->count() }}
                                    </div>
                                    <div class="label">
                                        Posts
                                    </div>
                                </div>
                                <div class="articles statistic stats-col">
                                    <div class="value">
                                        {{ $client->articles->count() }}
                                    </div>
                                    <div class="label">
                                        Articles
                                    </div>
                                </div>
                                <div class="views statistic stats-col">
                                    <div class="value">
                                        1
                                    </div>
                                    <div class="label">
                                        Views
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content-container" style="padding-top: 16px">
                    <div class="ui grid">
                        <div class="four wide computer five wide tablet ony column">
                            {!! Theme::partial('client.sidebar') !!}
                        </div>
                        <div class="twelve wide computer eleven wide tablet sixteen wide mobile column">
                            {!! Theme::content() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
{!! Theme::asset()->container('footer')->scripts() !!}
</body>
</html>