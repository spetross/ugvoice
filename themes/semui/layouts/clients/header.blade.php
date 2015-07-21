<h2 class="ui top attached header visible-small">
    {{ ucwords($client->name) }}
</h2>
<div class="ui teal raised segment profile-header uk-margin-remove">
    <div class="ui grid">
        <div class="three wide computer four wide tablet sixteen wide mobile column text-center">
            <img src="{{ $client->logo ? $client->logo->path : asset('assets/img/square-image.png') }}" alt=""
                 class="rounded centered ui imageheader-avatar">
        </div>
        <div class="eight wide computer twelve wide tablet sixteen wide mobile column profile-info">
            <div class="ui header ">{{ ucwords($client->name) }}</div>
            @if(Auth::check())
                <a href="#" class="right floated ui basic button">
                    <i class="edit icon"></i>
                    Edit
                </a>
            @endif
            <div class="header-information">
                {{ str_limit($client->description, 227) }}
            </div>
        </div>
        <div class="five wide computer sixteen wide tablet sixteen wide mobile center aligned column profile-stats"
             style="">
            <div class="ui mini three statistics">
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
                {{--
                <div class="views statistic stats-col">
                    <div class="value">
                        1
                    </div>
                    <div class="label">
                        Views
                    </div>
                </div>
                --}}
            </div>
        </div>
    </div>
</div>