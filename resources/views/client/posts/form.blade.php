<?php
$uploadConfig = [
        'displayMode' => 'image-multi',
        'imageHeight' => 100,
        'imageWidth' => 100,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'Post-Images'
];
?>
<div class="tabbable">
    <ul class="uk-tab" data-uk-tab="{connect:'#PostFormTabs'}">
        <li><a href="#"><i class="uk-icon-pencil-square-o"></i> Post</a></li>
        <li><a href="#"><i class="uk-icon-picture-o"></i> Add Photo</a></li>
        <li><a href="#"><i class="uk-icon-link"></i> Add Link</a></li>
    </ul>
    {!! app('form')->open(['class' => 'ui post form']) !!}
    <div class="uk-switcher" id="PostFormTabs">
        <div class="ui attached segment padding-5" style="margin-top: -2px">
            <textarea rows="2" name="Post[content]" class="auto text status"
                      placeholder="Have something to share"></textarea>
        </div>
        <div class="ui attached segment padding-5">
            @include('partials.fileupload.image_multi', $uploadConfig)
        </div>
        <div class="ui attached segment padding-5">
            <textarea rows="1" class="share link" name="Post[link]" placeholder="Share a link ..."></textarea>
        </div>
    </div>
    <div class="ui attached form-actions clearing segment uk-hidden" style="overflow: hidden">
        <div class="ui checkbox">
            <input type="checkbox" name="user_hide" tabindex="0">
            <label>Hide identity</label>
        </div>
        <div class="uk-float-right">
            <button type="submit" class="submit uk-button uk-button-primary">Post <i class="uk-icon-check-circle"></i>
            </button>
            <button type="reset" class="reset uk-button">Cancel <i class=""></i></button>
        </div>
    </div>
    {!! app('form')->close() !!}
</div>