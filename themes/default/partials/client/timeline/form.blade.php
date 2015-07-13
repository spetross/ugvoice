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
{!! app('form')->open(['class' => 'ui post tabbed form', 'data-client' => $client->slug]) !!}
<div class="ui top attached tabular menu">
    <a href="#" class="active item" data-tab="post-compose"><i class="pencil square icon"></i> Post</a>
    <a href="#" class="item" data-tab="post-media"><i class="picture icon"></i> Add Photo</a>
    <a href="#" class="item" data-tab="post-link"><i class="linkify icon"></i> Add Link</a>
</div>
<div class="ui bottom attached attached active tab segment padding-5" data-tab="post-compose">
    <textarea rows="2" name="Post[content]" class="auto text status" placeholder="Have something to share"></textarea>

    <div class="field form-actions padding-5 uk-hidden">
        <div class="ui checkbox margin-top-10 margin-left-10">
            <input type="checkbox" id="private_post" name="post_private" tabindex="0">
            <label for="private_post">Hide identity</label>
        </div>
        <button type="submit" class="ui small right floated submit primary icon button">Post <i class="check icon"></i>
        </button>
        <button type="reset" class="ui small right floated reset button">Cancel <i class=""></i></button>
    </div>
</div>
<div class="ui bottom attached tab segment padding-5" data-tab="post-media">
    @include('partials.fileupload.image_multi', $uploadConfig)
</div>
<div class="ui bottom attached tab segment padding-5" data-tab="post-link">
    <textarea rows="1" class="text link" name="Post[link]" placeholder="Share a link ..."></textarea>

    <div class="field form-actions padding-5">
        <button type="submit" class="ui small icon primary button">Share <i class="arrow right icon"></i></button>
    </div>
</div>

{!! app('form')->close() !!}