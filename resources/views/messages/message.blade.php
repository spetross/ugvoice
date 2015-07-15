@if($message->sender == $user->id)
    <li class="message">
        <div class="message-info">
            <div class="bullet"></div>
            <div class="contact-name">Me</div>
            <div class="message-time">{{ $message->created_at->diffForHumans() }}</div>
        </div>
        <div class="message-body">
            {{ $message->text }}
        </div>
    </li>
@else
    <li class="message reply">
        <div class="message-info">
            <div class="bullet"></div>
            <div class="contact-name">{{ $message->senderUser->present()->fullName }}</div>
            <div class="message-time">{{ $message->created_at->diffForHumans() }}</div>
        </div>
        <div class="message-body">
            {{ $message->text }}
        </div>
    </li>
@endif