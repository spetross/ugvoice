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
    <div class="full height boxed-wrapper ">
     <div class="content block">
        <div id="user-profile" class="ui content container user-profile two column grid padding-top-20">
            <div class="center aligned four wide column">
                <div>
      {{-- /////////////////////////////////////////////////////////////////////////////////////////////////////??????????????????????????????//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////O MMMMM                      #section:pages/profile.picture --}}
                    <span class="profile-picture">
                        <img id="avatar" class="ui centered image" alt="{{ Auth::user()->first_name }}'s Avatar"
                             src="{{ Auth::user()->getAvatar(150) }}">
                    </span>
                    <!-- /section:pages/profile.picture -->
                </div>
                <div class="ui header">
                    {{ $user->present()->fullName }}
                    <div class="sub header">
                        {{ ucfirst($user->username) }}
                    </div>
                </div>
                <div class="ui simple divider"></div>
                <div>
                    <i class="clock icon"></i> Joined on {{ $user->created_at->toFormattedDateString() }}
                </div>
                <div class="ui simple divider"></div>
                <a href="{{ action('UserController@edit') }}" class="uk-button uk-button-primary">
                    <i class="edit icon"></i> Edit
                </a>
            </div>
            <div class="twelve wide column">
                @if(!Request::is('user/edit'))
                    <div class="ui top attached tabular menu">
                        <a class="{{ Request::is('user') ? 'active' : null }} item"
                           href="{{ action('UserController@profile') }}">
                            <i class="icon star"></i> Activity
                        </a>
                        @if($user->present()->isAuthor)
                            <a href="" class="item"><i class="icon paper"></i> Articles</a>
                        @endif
                        <a class="{{ Request::is('user/message*') ? 'active' : null }} item"
                           href="{{ action('MessageController@index') }}">
                            <i class="envelope icon"></i> Messages
                        </a>
                    </div>
                <div class="ui bottom attached active tab segment">{!! Theme::content() !!}</div>
                @else
                    {!! Theme::content() !!}
                @endif
            </div>
        </div>
    </div>
</div>
</div>

{!! Theme::partial('footer') !!}

