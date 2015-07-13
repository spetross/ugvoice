@section('page.content')
    <div class="uk-grid uk-grid-small">
        <!-- column -->
        <div class="uk-width-medium-7-10 uk-width-large-7-10">
            <div class="ui top attached basic segment uk-padding-remove uk-hidden-small">
                <figure class="uk-overlay uk-overlay-hover uk-responsive-width">
                    <img class="uk-overlay-scale" src="{{ asset('assets/img/placeholder.svg') }}" width="100%" height=""
                         alt="">
                    <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-ignore">
                        <h2 class="margin-none">{{ucwords($client->name)}}</h2>
                    </figcaption>
                </figure>
            </div>

            <div class="ui bottom three item attached fluid pointing menu uk-hidden-small">
                <a href="{{route('client.home', $client->slug)}}"
                   class="{{Request::is(sprintf('%s', $client->slug)) ? 'active' : null }} item"><i
                            class="ion-calendar icon"></i> Timeline</a>
                @yield('dynamic.menu')
                <a href="{{route('client.articles', $client->slug)}}"
                   class="{{Request::is(sprintf('%s/articles', $client->slug)) ? 'active' : null }} item"><i
                            class="ion-ios-paper icon"></i>Articles</a>
                <a href="{{route('client.about', $client->slug)}}"
                   class="{{Request::is(sprintf('%s/about', $client->slug)) ? 'active' : null }} item"><i
                            class="icon ion-information"></i>About</a>
            </div>

            <div class="ui fluid vertical menu uk-visible-small">
                <a href="{{route('client.home', $client->slug)}}"
                   class="{{Request::is(sprintf('%s', $client->slug)) ? 'active' : null }} item"><i
                            class="icon fa fa-fw icon-ship-wheel"></i> Timeline</a>
                @yield('dynamic.menu')
                <a href="{{route('client.contacts', $client->slug)}}"
                   class="{{Request::is(sprintf('%s/contacts', $client->slug)) ? 'active' : null }} item"><i
                            class="group icon"></i> Contacts</a>
                <a href="{{route('client.articles', $client->slug)}}"
                   class="{{Request::is(sprintf('%s/articles', $client->slug)) ? 'active' : null }} item"><i
                            class="newspaper icon"></i>Articles</a>
                <a href="{{route('client.about', $client->slug)}}"
                   class="{{Request::is(sprintf('%s/about', $client->slug)) ? 'active' : null }} item"><i
                            class="info icon"></i>About</a>
            </div>


            @yield('content')

        </div>
        <!--/column -->

        <div class="uk-width-medium-3-10 uk-width-large-2-10 padding-right-none">
            <div class="" data-uk-sticky="{top:50}">
                @include('client.counselors')
                @include('client.twitter')
            </div>
        </div>
        <div class="uk-visible-large uk-width-large-1-10 padding-none">

        </div>
    </div>

@stop

