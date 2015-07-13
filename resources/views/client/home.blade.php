@if(Auth::check())
    {!! Theme::watchPartial('client.post-form') !!}
@endif

@include('client.posts.feed')
