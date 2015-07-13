<?php
Theme::asset()->add('jquery', 'library/jquery/jquery.min.js');
Theme::asset()->usePath()->add('framework', 'js/app.js', ['jquery']);
?>
{!! Form::open() !!}
<input type="hidden" name="file_id" value="{{$file->id }}"/>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="popup">&times;</button>
    <h4 class="modal-title">Attachment:: {{$file->file_name }}</h4>
</div>
<div class="modal-body">
    <p></p>

    <div class="form-group">
        <label>Title</label>
        <input
                type="text"
                name="title"
                class="form-control"
                value="{{$file->title }}"
                />
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{$file->description }}</textarea>
    </div>

</div>
<div class="modal-footer">
    <button
            type="submit"
            class="btn btn-primary"
            data-request="onSaveAttachmentConfig"
            data-stripe-load-indicator>
        Save
    </button>
    <button
            type="button"
            class="btn btn-default"
            data-dismiss="popup">
        Cancel
    </button>
</div>
{!! Form::close() !!}