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

@extends('user.layout')

@if(!$conversations->isEmpty())

    @section('aside')
        <div class="uk-text-left">
            @include('messages.conversations')
        </div>
    @overwrite

@endif

@section('content')

    @if($conversations->isEmpty() or !isset($user))

        <div class="ui info message">
            <p>{{ trans('site.texts.no_messages') }}</p>
        </div>
    @else
        <div class="" style="max-width: 500px">
            @include('messages.thread')
        </div>
    @endif
@stop

