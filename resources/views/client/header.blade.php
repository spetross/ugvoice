<h2 class="ui top attached header uk-hidden">
    {{ ucwords($client->name) }}
</h2>
<div class="ui teal client-header segment uk-margin-remove uk-padding-remove">
    <div class="uk-grid uk-grid-small">
        <div class="uk-width-medium-2-3 uk-width-small-1-1">
            <ul class="uk-slideshow" data-uk-slideshow="{autoplay:true}">
                <li>
                    <figure class="uk-overlay uk-overlay-hover">
                        <figcaption class="uk-overlay-panel uk-flex uk-flex-top">
                            <a class="ui basic red icon button"><i class="edit icon"></i></a>
                        </figcaption>
                        <img src="{{ $client->banner ? $client->banner->path : asset('assets/img/placeholder.svg') }}">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-ignore">
                            <h2>{{ ucwords($client->name) }}</h2>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </div>
        <div class="uk-width-medium-1-3 uk-hidden-small uk-position-relative">
            @if($client->logo)
                <img src="{{ $client->logo ? $client->logo->path : asset('assets/img/square-image.png') }}" height="300" alt=""
                     class="rounded centered ui imageheader-avatar">
            @else
                <div class="ui mini three statistics client-stats">
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
            @endif
        </div>
    </div>
</div>