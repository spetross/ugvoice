<ul class="messages-list">
    {{-- dd($messages) --}}
    @forelse($messages as $message)
        @include('messages.message', compact('message'))
    @empty
        <li class="no-message">
            <div class="ui info message">
                <p>No messages</p>
            </div>
        </li>
    @endforelse
</ul>

