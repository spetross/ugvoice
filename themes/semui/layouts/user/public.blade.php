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

<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30">
        <div id="user-profile" class="ui container user-profile stackable two column grid padding-top-20">

            <div class="center aligned five wide column">
                <div>
                    <!-- #section:pages/profile.picture -->
                    <span class="profile-picture">
                        <img id="avatar" class="ui centered image" alt="{{ Auth::user()->first_name }}'s Avatar"
                             src="{{ Auth::user()->getAvatar(150) }}">
                    </span>
                    <!-- /section:pages/profile.picture -->

                    <div class="ui pointing large teal label">
                        {{ ucwords($user->name) }}
                    </div>
                </div>

                <div class="right floated ui basic segment uk-hidden-small uk-margin-top">
                    <div class="ui vertical pointing menu uk-text-left">
                        <div class="item">
                            <i class="icon fa fa-user bigger-120"></i> Profile
                            <div class="menu uk-margin-small-left">
                                <a class="{{ Request::is('user') ? 'active' : null }} item"
                                   href="{{ action('UserController@profile') }}">
                                    <i class="icon uk-icon-dashboard"></i> Dashboard
                                </a>
                                <a class="{{ Request::is('user/edit') ? 'active' : null }} item"
                                   href="{{ action('UserController@edit') }}">
                                    <i class="icon uk-icon-edit"></i> Edit profile
                                </a>
                                <a class="{{ Request::is('user/privacy') ? 'active' : null }} item"
                                   href="{{ action('UserController@privacy') }}">
                                    <i class="icon uk-icon-cog"></i> Manage privacy
                                </a>
                            </div>
                        </div>
                        <a class="{{ Request::is('user/message*') ? 'active' : null }} item"
                           href="{{ action('MessageController@index') }}"><i class="icon fa fa-envelope"></i>
                            Messages</a>
                    </div>
                </div>

                <div class="uk-visible-small uk-margin-top">
                    <div class="ui two item pointing menu">
                        <a class="{{ Request::is('user') ? 'active' : null }} item"
                           href="{{ action('UserController@profile') }}"><i class="icon fa fa-user"></i> Profile</a>
                        <a class="{{ Request::is('user/message*') ? 'active' : null }} item"
                           href="{{ action('MessageController@index') }}"><i class="icon fa fa-envelope"></i>
                            Messages</a>
                    </div>
                </div>
            </div>
            <div class="eleven wide column">
                {!! Theme::content() !!}
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}

