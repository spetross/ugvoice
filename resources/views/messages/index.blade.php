<style>
    .messages-list > a:hover {
        text-decoration: none;
    }
    .chat-messages .messages-contact {
        height: 85px;
        padding: 10px;
        position: relative;
        background-color: #F3F3F3;
        border-bottom: 1px solid #E5E5E5;
    }
    .chat-messages .messages-contact .contact-avatar {
        display: inline-block;
        width: 65px;
        height: 65px;
    }
    .chat-messages .messages-contact .contact-avatar img {
        width: 65px;
        height: 65px;
    }
    .chat-messages .messages-contact .contact-info {
        display: inline-block;
        vertical-align: bottom;
        padding-left: 5px;
    }
    .chat-messages .messages-contact .contact-info .contact-name {
        font-size: 1em;
        padding-bottom: 2px;
    }
    .chat-messages .messages-contact .contact-info .contact-status {
        font-size: 0.8em;
        margin-bottom: 2px;
    }
    .chat-messages .messages-contact .contact-info .contact-status .online,
    .chat-messages .messages-contact .contact-info .contact-status .offline {
        display: inline-block;
        border-radius: 50%;
        width: 8px;
        height: 8px;
    }
    .chat-messages .messages-contact .contact-info .contact-status .online {
        background-color: #00B5AD;
    }
    .chat-messages .messages-contact .contact-info .contact-status .status {
        display: inline-block;
        margin-left: 4px;
    }
    .chat-messages .messages-contact .last-chat-time {
        position: absolute;
        right: 20px;
        bottom: 12px;
        font-size: 0.8em;
    }
    .chat-messages .messages-contact .back {
        position: absolute;
        top: 14px;
        right: 14px;
    }
    .chat-messages .messages-contact .back a:hover{
        text-decoration: none;
    }
    .chat-messages .messages-contact .back i {
        font-size: 22px;
        color: #2DC3E8;
    }
    .chat-messages .messages-list {
        list-style: outside none none;
        padding: 10px 0;
        overflow: auto;
    }
    .chat-messages .messages-list .message {
        padding: 10px 15px;
    }
    .chat-messages .messages-list .message .message-info {
        height: 18px;
    }
    .chat-messages .messages-list .message .message-info .bullet {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #00B5AD;
        margin-right: 5px;
    }
    .chat-messages .messages-list .message .message-info .bullet,
    .chat-messages .messages-list .message .message-info .contact-name,
    .chat-messages .messages-list .message .message-info .message-time {
        display: inline-block;
    }

    .chat-messages .messages-list .message .message-info .contact-name {
        font-weight: bold;
        margin-right: 5px;
    }
    .chat-messages .messages-list .message .message-info .message-time {
        font-size: 0.8em;
        color: #666;
    }
    .chat-messages .messages-list .message .message-body {
        margin-top: 10px;
        border-radius: 3px;
        background-color: #00B5AD;
        color: #FFF;
        padding: 10px;
        position: relative;
        margin-right: 10%;
    }
    .chat-messages .messages-list .message .message-body:before {
        position: absolute;
        display: block;
        width: 0;
        height: 0;
        content: '';
        top: -14px;
        left: 10px;
        border: 7px solid;
        border-bottom-color: #00B5AD;
    }
    .chat-messages .messages-list .message.reply .message-info .bullet,
    .chat-messages .messages-list .message.reply .message-info .contact-name,
    .chat-messages .messages-list .message.reply .message-info .message-time {
        float: right;
        margin-right: 0;
        margin-left: 10px;
    }
    .chat-messages .messages-list .message.reply .message-info .bullet {
        background-color: #A333C8;
        margin-top: 8px;
    }
    .chat-messages .messages-list .message.reply .message-info .message-time {
        margin-top: 2px;
    }
    .chat-messages .messages-list .message.reply .message-body {
        background-color: #A333C8;
        margin-left: 10%;
        margin-right: 0;
    }
    .chat-messages .messages-list .message.reply .message-body:before {
        border-bottom-color: #A333C8;
        right: 10px;
        left: auto
    }
</style>
<h5 class="row-title before-sky">Messages inbox</h5>
<div id="message-notify"></div>

@if(!$conversations->isEmpty())

    <div class="ui stackable grid">
        <div class="five wide left column">
            <div class="sticky" data-uk-sticky="{top:100}">
                <div class="ui fluid vertical pointing menu">
                    <div class="item">
                        <div class="ui transparent icon input">
                            <input placeholder="Search messages..." type="text">
                            <i class="search icon"></i>
                        </div>
                    </div>
                    @foreach($conversations as $conversation)
                        <a
                                href="{{ route('messages', ['user' => $conversation->present()->theUser()->present()->getId()]) }}"
                                class="{{ (isset($contact) and $contact->id == $conversation->present()->theUser()->id) ? 'active' : null}} item">
                            <h6 class="ui small header">
                                <img class="ui avatar image" src="{{ $conversation->present()->theUser()->present()->getAvatar(50) }}">
                                <div class="content" style="width: calc(100% - 50px)">
                                    {{ $conversation->present()->theUser()->present()->fullName() }}
                                    <?php $count = app('app\\Repositories\\MessageRepository')->countUnreadFrom($conversation->present()->theUser()->id)?>
                                    @if($count)
                                        <div class="ui teal pointing left small label uk-float-right">{{ $count }}</div>
                                    @endif
                                </div>
                            </h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="eleven wide right column">
            @if(Request::has('user'))
                <div class="chat-messages" id="thread-container">
                    <div class="ui top attached purple segment messages-contact">
                        <div class="contact-avatar">
                            <img src="{{ $contact->getAvatar(100) }}">
                        </div>
                        <div class="contact-info">
                            <div class="contact-name">{{ ucwords($contact->name) }}</div>
                            <div class="contact-status">
                                @if($contact->active)
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                @else
                                    <div class="offline"></div>
                                    <div class="status">offline</div>
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
                    <form method="post" class="ui clearing attached segment padding-5 send-message form">
                        <input type="hidden" name="user_id" value="{{ $contact->id }}">
                        <div class="field">
                            <textarea name="message" rows="2" class="auto text" placeholder="Type your message here"></textarea>
                        </div>
                        <div class="field">
                            <button type="submit" class="ui right floated positive send button">
                                <i class="mail send icon"></i> Send
                            </button>
                        </div>
                    </form>
                    <div class="ui attached piled segment">
                        @include('messages.thread',compact('contact', 'messages'))
                    </div>
                    @if($messages->hasMorePages())
                        <div class="ui bottom attached fluid paging button" data-offset>Load old messages</div>
                    @endif
                </div>

            @else

            @endif
        </div>
    </div>

@else

    <div class="ui info message">
        <p> You do not have any messages</p>
    </div>

@endif

