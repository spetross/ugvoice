@if($menu)
    <div class="ui grid">
        <div class="two column row">
            <div class="four wide computer five wide tablet only column">
                <div class="ui fluid vertical pointing menu">
                    @foreach($menu as $item)
                        <a href="{{ Backend::url($item->url) }}"
                           class="{{ BackendMenu::isMainMenuItemActive($item) ? 'active' : null }} item">
                            <i class="{{ $item->icon }} icon"></i> {{trans($item->label)}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="sixteen wide mobile eleven wide tablet twelve wide computer column">
                @if($sideMenuItems = BackendMenu::listSubMenuItems())
                    <?php
                    $itemsCount = null;
                    switch (count($sideMenuItems)):
                        case 2:
                            $itemsCount = 'two';
                            break;
                        case 3:
                            $itemsCount = 'three';
                            break;
                        case 4:
                            $itemsCount = 'four';
                            break;
                    endswitch;
                    ?>
                    <div class="ui top attached {{ $itemsCount }} item tabular menu">
                        @foreach($sideMenuItems as $item)
                            <a href="{{ Backend::url($item->url) }}"
                               class="{{ BackendMenu::isSubMenuItemActive($item) ? 'active' : null }} purple item">
                                <i class="{{ $item->icon }} icon"></i> {{ trans($item->label) }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="ui attached segment border-top-none">
                    @yield('header', $title)
                </div>
                <div class="ui bottom attached purple stacked segment">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@else
    <div class="ui segments">
        <div class="ui segment">
            @yield('header', $title)
        </div>
        <div class="ui purple stacked segment">
            @yield('content')
        </div>
    </div>
@endif

    
