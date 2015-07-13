@forelse($organisations as $client)
    {{--
    <div class="client-box">
        <a class="uk-panel uk-panel-box-primary uk-panel-box-primary-hover" href="{{ action('Clients\ClientController@home', $client->slug) }}">
            <div class="uk-panel-teaser">
                <img src="{{ $client->logo ? $client->logo->path : asset('assets/img/placeholder.svg') }}" class="img-responsive" alt="{{$client->name}}">
            </div>
            <h3 class="uk-panel-title uk-text-center">{{$client->name}}</h3>
        </a>
    </div>--}}
    <div class="card">
        <a class="image" href="{{ action('Clients\ClientController@home', $client->slug) }}">
            <img src="{{ $client->logo ? $client->logo->path : asset('assets/img/placeholder.svg') }}"
                 alt="{{ $client->name }}">
        </a>

        <div class="content" style="text-align:center">
            <a class="header"
               href="{{ action('Clients\ClientController@home', $client->slug) }}">{{ $client->name }}</a>
        </div>
    </div>
@empty
@endforelse
