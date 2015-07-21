<div class="comment" id="comment-{{$comment->id}}">
    <a class="avatar">
        <img src="{{ $comment->user->photo }}">
    </a>

    <div class="content">
        <a class="author">{{ ucwords($comment->user->name) }}</a>

        <div class="metadata">
            <span class="date timeago" title="{{ $comment->created_at }}">{{ $comment->created_at }}</span>
        </div>
        <div class="text">
            <p>{{ $comment->content }}</p>
        </div>
        <div class="actions">
            @if(Auth::id() === $comment->user->id)
                <a class="cm delete red color" data-client="{{ $client->slug }}" data-post="{{ $comment->post_id }}"
                   data-id="{{ $comment->id }}">Delete</a>
            @else
                <a class="cm reply" data-client="{{ $client->slug }}" data-id="{{ $comment->id }}">Reply</a>
            @endif
        </div>
    </div>
</div>