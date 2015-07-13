@extends("layout.uikit.client")

@section('content')

    <div class="innerB uk-margin">
        <form class="ui search" method="get" role="search">
            <div class="ui fluid icon input">
                <input placeholder="Search people" class="prompt" type="text">
                <i class="search icon"></i>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="" id="contacts">
            {!! Theme::partial("client.contacts") !!}
        </div>
    </div>

@stop


@section('org.menu')

    <div class="ui bottom four item attached fluid pointing menu">
        <a href="{{route('org.home', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s', $organisation->slug)) ? 'active' : null }} item"><i
                    class="fa fa-fw icon-ship-wheel"></i> Timeline</a>
        <a href="{{route('org.contacts', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s/contacts', $organisation->slug)) ? 'active' : null }} item"><i
                    class="group icon"></i> Contacts</a>
        <a href="{{route('org.articles', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s/articles', $organisation->slug)) ? 'active' : null }} item"><i
                    class="newspaper icon"></i>Articles</a>
        <a href="{{route('org.about', $organisation->slug)}}"
           class="{{Request::is(sprintf('client/%s/about', $organisation->slug)) ? 'active' : null }} item"><i
                    class="info icon"></i>About</a>
    </div>

@overwrite

