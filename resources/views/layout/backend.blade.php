<?php
Asset::add('jquery', 'js/jquery.min.js');
Asset::add('semantic-css', 'library/sui/semantic.min.css');
Asset::add('admin-css', 'css/admin.css');
Asset::container('footer')->add('tablesort', 'library/sui/tablesort.min.js', ['jquery']);
Asset::container('footer')->add('semantic', 'library/sui/semantic.min.js', ['jquery', 'tablesort']);
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$title or null}}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" type="image/ico" href="/favicon.ico">
    {!! Asset::styles() !!}
    @yield('styles')
    {!! Asset::scripts() !!}
</head>
<body>
<div id="header">
    <h1>
        <a href="{{ url(config('backend.uri')) }}">
            <img src="{{asset('img/logo.svg')}}" alt="Voice">
        </a>
    </h1>
</div>

<div id="options-bar" class="menu">
    <div class="container">
        <div class="ui main compact secondary borderless menu">
            <div class="header item" id="user">
                {{ Auth::user()->full_name}}
            </div>
            <a class="user popup icon item">
                <i class="user icon"></i>
            </a>
            <a class="mail popup icon item" data-content="View Messages">
                <i class="mail icon"></i>
            </a>

            <div class="ui right aligned category search item focus hidden-xs">
                <div class="ui transparent icon input">
                    <input autocomplete="off" class="prompt" placeholder="Search content ..." type="text">
                    <i class="search link icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
        <div class="ui main right floated secondary menu visible-xs-block margin-right-10">
            <a class="launch icon item">
                <i class="content icon"></i>
            </a>
        </div>
        <ul class="hidden-xs margin-right-10">
            <li class="home">
                <a href="{{ Backend::url() }}">Home</a>
            </li>
            @if(Auth::user()->hasAnyAccess(['backend.users.*']))
                <li class="groups">
                    <a href="{{ Backend::url('users') }}">Users</a>
                </li>
            @endif
            <li class="logout">
                <a href="{{ action('Admin\DashController@logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</div>
<div class="container padding-left-10 padding-right-10">
    <div class="crumbs padding-5">
        {!! Breadcrumb::render() !!}
    </div>
    @section('main.content')
        @include('layout.sidebar')
    @show
</div>
{!! Asset::container('footer')->scripts() !!}
@yield('scripts')
</body>
</html>