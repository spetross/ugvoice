@extends('client.layout')

@section('content')

@if(Auth::check())
    <div class="ui clearing very basic segment">
        <a
            href="{{ action('Clients\ArticleController@create', $client->slug) }}"
            class="right floated ui primary icon button">
            <i class="pencil icon"></i><span class="hidden-mobile"> New Post</span>
        </a>

        <div class="ui search icon input">
            <input placeholder="Search..." type="text">
            <i class="search link icon"></i>
        </div>
    </div>
@endif

<div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-2" data-uk-grid="">
    <div>
        <div class="ui fluid card">
            <div class="content">
                <div class="header">Best of Web Design</div>
                <div class="meta">30/12/2013</div>
                <div class="description">
                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, est, iste
                        similique eius perspiciatis expedita exercitationem.</p>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="ui fluid card">
            <div class="content">
                <div class="header">Best of Web Design in 2013</div>
                <div class="meta">30/12/2013</div>
                <div class="description">
                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, est, iste
                        similique eius perspiciatis expedita.</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="ui fluid card">
            <div class="content">
                <div class="header">Best of Web Design in 2013</div>
                <div class="meta">30/12/2013</div>
                <div class="description">
                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, est, iste
                        similique eius perspiciatis expedita.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection