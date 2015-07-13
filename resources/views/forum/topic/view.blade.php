@section('content')
    <div class="ui top attached header" style="overflow: hidden">
        Topic Name
        <div class="uk-float-right uk-button">
            Post reply
        </div>
    </div>
    <div class="ui bottom attached segment">
        @include('forum.topic.posts')
    </div>
@endsection