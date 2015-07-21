<?php
Theme::asset()->container()->add('timeline', 'assets/css/components/timeline.css');
Theme::asset()->container()->add('profile', 'assets/css/components/profile.css');
Theme::set('bodyClass', 'client');
?>
{!! Theme::partial('head') !!}

<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30 padding-top-20">
        <div class="ui two stackable column container grid">

        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}