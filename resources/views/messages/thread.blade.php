<div class="chat-messages uk-text-left" id="thread-container">
    <div class="ui top attached purple segment messages-contact">
        <div class="contact-avatar">
            <img src="{{ $user->getAvatar(100) }}">
        </div>
        <div class="contact-info">
            <div class="contact-name">{{ ucwords($user->name) }}</div>
            <div class="contact-status">
                @if($user->active)
                    <div class="online"></div>
                    <div class="status">{{ trans('site.texts.status_online') }}</div>
                @else
                    <div class="offline"></div>
                    <div class="status">{{ trans('site.texts.status_offline') }}</div>
                @endif
            </div>
            <div class="last-chat-time">
                a moment ago
            </div>
            <div class="back">
                <a href="{{ route('messages') }}">
                    <i class="icon arrow left icon"></i>
                </a>
            </div>
        </div>
    </div>
    <form method="post" class="ui clearing attached segment padding-5 send-message form" data-user="{{ $user->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <textarea name="message" rows="1" class="auto text" placeholder="{{ trans('form.input_message.placeholder') }}"></textarea>
        <div class="field padding-5">
            <button type="submit" class="ui positive send button" data-user="{{ $user->id }}">
                <i class="mail send icon"></i>
                {{ trans('form.button_send') }}
            </button>
        </div>
    </form>
    <div class="ui attached piled segment">
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
    </div>
    @if($messages->hasMorePages())
        <div class="ui bottom attached fluid paging button" data-offset>{{ trans('site.texts.more_messages') }}</div>
    @endif
</div>
