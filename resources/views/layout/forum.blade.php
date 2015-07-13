@extends('layout.default')

@section('header')
    <div class="ui masthead uk-block">
        <div class="uk-container uk-container-center">
            <h1 class="ui header">
                {{ $title or null }}
                <div class="sub header">

                </div>
            </h1>
            <div class="advertisement">

            </div>
            <div class="ui three small pointing item menu">
                <a class="item active"><i class="red large icon ion-ios-flame"></i> Hot posts</a>
                <a class="item"><i class="large icon ion-ios-list-outline"></i> Top posts</a>
                <a class="item"><i class="icon large ion-ios-people-outline"></i> Members</a>
            </div>
        </div>
    </div>
@endsection


@section('page.content')
    <div class="uk-grid uk-grid-small" data-uk-grid-match>
        <div class="uk-width-large-8-10 uk-width-medium-6-10">
            @yield('content')
        </div>
        <div class="uk-width-large-2-10 uk-width-medium-4-10">
            <div class="ui top attached header">
                <i class="uk-icon-user"></i> Recent members
            </div>
            <div class="ui bottom attached segment no-padding">
                <div class="ui celled selection topic list">
                    <div class="item">
                        <img class="ui avatar image" src="/img/avatar/s/100.png">

                        <div class="content">
                            <a href="" class="header">Daniel Louise</a>
                            2 days ago
                        </div>
                    </div>
                    <div class="item">
                        <img class="ui avatar image" src="/img/avatar/p/100.png">

                        <div class="content">
                            <a href="" class="header">Poodle</a>
                            yesterday
                        </div>
                    </div>
                    <div class="item">
                        <img class="ui avatar image" src="/img/avatar/m/100.png">

                        <div class="content">
                            <a href="" class="header">Paulo</a>
                            3 hours ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
