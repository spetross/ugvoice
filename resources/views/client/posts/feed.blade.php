<div class="ui posts feed" id="posts-container">
    @forelse($posts as $post)
        @include('client.posts.post', compact('post'))
    @empty
        <div class="ui center aligned purple segment no-margin" style="padding: 40px 20px">
            <h2 class="ui center aligned icon header">
                <i class="bullseye large icon" style="font-size: 100px"></i>

                <div class="content">
                    {{ ucwords($client->name) }}
                    <div class="sub header"></div>
                </div>
            </h2>
        </div>
    @endforelse
</div>

@if($posts->hasMorePages())

    <button class="ui posts paginate bottom attached purple basic fluid icon primary button"
            data-page="{{ $posts->currentPage()+1 }}"><i class="uk-icon-arrow-up"></i>Load more posts
    </button>

@endif
