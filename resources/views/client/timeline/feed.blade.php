<div 
    class="uk-margin-top"
    data-url="{{ route('get-client-posts', $client->slug) }}"
    data-offset="{{ $posts->first()->id }}"
    id="social-feed-wrapper"
    >
    <?php $interval = 20; ?>
    @forelse($posts as $post)
        <?php $comments = $post->comments()->getQuery()->paginate(5) ?>
        @include('client.post.post', compact('post', 'comments'))
        <?php $interval = $interval+10; ?>
    @empty
        <div class="no-margin" style="padding: 40px 20px">
            <h2 class="ui center aligned icon header">
                <i class="bullseye large icon" style="font-size: 100px"></i>
                <div class="content">
                    {{ ucwords($client->name) }}
                    <div class="sub header">
                        <i>Be the first to post here</i>
                    </div>
                </div>
            </h2>
        </div>
    @endforelse
</div>