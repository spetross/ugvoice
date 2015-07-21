<?php
Theme::asset()->add('timeline', 'assets/css/components/timeline.css');
Theme::asset()->add('profile', 'assets/css/components/profile.css');
Theme::set('bodyClass', 'client profile');
?>

{!! Theme::partial('head') !!}
<style>
    .ui.post.feed > .event > .label + .content {
        margin: .2em 0 2em .75em;
    }

    .ui.feed .ui.pointing.dropdown > .menu:after {
        left: 25%;
    }
</style>
<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30 padding-top-20">
        <div class="ui container  profile-container">
            <div class="ui top attached teal segment profile-header">
                <div class="ui grid">
                    <div class="three wide computer four wide tablet sixteen wide mobile column text-center">
                        <img src="/assets/img/avatar/d/150.png" alt="" class="rounded centered ui imageheader-avatar">
                    </div>
                    <div class="eight wide computer twelve wide tablet sixteen wide mobile column profile-info">
                        <div class="ui header ">{{ ucwords($client->name) }}</div>
                        <a href="#" class="right floated ui basic button">
                            <i class="edit icon"></i>
                            Edit
                        </a>

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
            <div class="bottom attached ui fluid four stackable item pointing menu">
                <a href="{{ action('Clients\AdminController@dashboard', $client->slug) }}"
                   class="{{ Request::is('*/dashboard') ? 'active' : null }} item">
                    <i class="dashboard icon"></i> Dashboard
                </a>

                <a href="{{ action('Clients\PostsController@index', $client->slug) }}"
                   class="{{ Request::is('*/timeline') ? 'active' : null }} item">
                    <i class="crosshairs icon"></i> Timeline
                </a>

                <a href="{{ action('Clients\ArticleController@index', $client->slug) }}"
                   class="{{ Request::is('*/article*') ? 'active' : null }} item">
                    <i class="copy icon"></i> Articles
                </a>

                <a href="{{ action('Clients\PersonController@index', $client->slug) }}"
                   class="{{ Request::is('*/counselor*') ? 'active' : null }} item">
                    <i class="users icon"></i> Counselors
                </a>
            </div>
        </div>
        <div class="ui container margin-top-10">
            {!! Theme::content() !!}
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
