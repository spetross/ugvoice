<div class="ui fluid relaxed selection divided vertical list">
    <div class="item">
        <div class="ui transparent icon input">
            <input placeholder="{{ trans('form.input_message.search_placeholder') }}" type="text">
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