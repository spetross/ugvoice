@if($comments->hasMorePages())
    <a class="blue basic ui fluid paginate button load-more-comments" data-post="{{ $post->id }}"
       data-target="#post-{{$post->id}}-comments"><i class="uk-icon-arrow-up"></i> Load more comments</a>
@endif
<div class="ui comments" data-post="{{ $post->id }}">
    @if(!$comments->isEmpty())
        @foreach($comments as $comment)
            {!! Theme::partial('client.timeline.comment', compact('comment')) !!}
        @endforeach
    @endif
</div>