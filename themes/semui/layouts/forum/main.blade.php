{!! Theme::partial('head') !!}

<div id="main-container" class="pusher">
    <div class="full height margin-bottom-30 padding-top-20">
        <div class="ui container">
            <div class="ui segments no-margin">
                <div class="ui segment">
                </div>
                <div class="ui segment no-padding">
                    <div class="ui bottom attached pointing stackable menu">
                        <div class="item">
                            <div class="ui transparent icon input">
                                <input placeholder="Search..." type="text">
                                <i class="search link icon"></i>
                            </div>
                        </div>
                        <a class="active item">
                            <i class="block layout icon"></i> Index
                        </a>
                        <a class="item">
                            <i class="red fire icon"></i> Hot Posts
                        </a>
                        <a class="item">
                            <i class="users icon"></i> Members
                        </a>
                    </div>
                </div>
            </div>
            <div class="ui grid">
                <div class="eleven wide computer ten wide tablet sixteen wide mobile column">
                    <div class="no-margin ui purple segment margin-top-20 padding-5">
                        {!! Theme::content() !!}
                    </div>
                </div>
                <div class="five wide computer six wide tablet only column">

                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}