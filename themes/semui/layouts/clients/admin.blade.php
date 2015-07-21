
<?php
Theme::asset()->add('timeline', 'assets/css/components/timeline.css');
Theme::asset()->add('profile', 'assets/css/components/profile.css');
Theme::set('bodyClass', 'client');
?>

{!! Theme::partial('head') !!}
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
