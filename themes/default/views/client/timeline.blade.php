<ul class="posts timeline">
    @if(Auth::check())
        <li class="post form">
            <div class="timeline-badge blue color">
                <i class="write icon"></i>
            </div>
            <div class="timeline-panel">
                <div class="timeline-body">
                    {!! Theme::partial('client.timeline.form') !!}
                </div>
            </div>
        </li>
    @endif
    @forelse($posts as $post)
        {!! Theme::partial('client.timeline.post', compact('post')) !!}
    @empty
        <li>
            <div class="timeline-badge blue color">
                <i class="info icon"></i>
            </div>
            <div class="timeline-panel">
                <div class=" no-margin" style="padding: 40px 20px">
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
            </div>
        </li>

    @endforelse
    @if($posts->hasMorePages())
        <li class="timeline-node">
            <a
                    class="ui basic yellow button"
                    id="timeline-paginator-button"
                    data-client="{{ $client->slug }}"
                    data-page="{{ $posts->currentPage()+1 }}">
                LOAD MORE
            </a>
        </li>
    @endif
</ul>