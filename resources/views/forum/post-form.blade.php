<div class="uk-margin">
    <form class="ui post form">
        <div class="ui small top attached tabular menu">
            <a class="active icon item" data-tab="compose">
                <i class="large icon ion-compose"></i>
            </a>
            <a class="icon item" data-tab="media">
                <i class="large icon ion-images"></i>
            </a>
        </div>
        <div class="ui bottom attached active tab segment border-vertical-remove padding-5" data-tab="compose">
            <div class="field">
                <textarea
                        placeholder="{{ trans('forms.forum.post.placeholder') }}"
                        class="auto text" rows="1"
                        id="post-body"></textarea>
            </div>
        </div>
        <div class="ui bottom attached tab segment border-vertical-remove" data-tab="media">
            <!-- Tab Content !-->
        </div>
        <div class="ui attached segment uk-margin-remove padding-5" style="width: 100%">
            <div class="form-actions uk-hidden" id="activity-post-submit">
                <button class="submit uk-button" type="submit">{{ trans('forms.buttons.submit') }}</button>
                <button class="reset uk-button" type="reset">{{ trans('forms.buttons.cancel') }}</button>
            </div>
        </div>
    </form>
</div>