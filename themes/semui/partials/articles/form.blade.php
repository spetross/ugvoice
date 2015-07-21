{!! app('form')->model($article, ['class' => 'ui article form']) !!}
<style>
    .redactor-box {
        margin-bottom: 0;
    }
</style>
<?php if (!isset($statusList)) {
    $statusList = [
            ' ' => 'Select status',
            'published' => 'Published',
            'draft' => 'Draft',
            'archived' => 'Archived'
    ];
}
?>
<div class="required field{{ $errors->has('title') ? ' error' : '' }}">
    <label>Title</label>
    {!!
    Form::text('title', old('title'), ['class' => 'form-control'])
    !!}
    {!! $errors->first('title', '<div class="ui red pointing prompt label">:message</div>') !!}
</div>

<div class="field" data-field-name="toolbar">
    <!-- Partial -->
    <div class="form-buttons loading-indicator-container">
        @yield('form.buttons')
    </div>
</div>
<div class="ui error message"></div>
<div class="tabbable">
    <div class="ui top attached tabular menu">
        <a class="icon active item" data-tab="editor">
            <i class="large edit icon"></i>
        </a>
        <a class="item" data-tab="options">
            <i class="settings icon"></i> Options
        </a>
    </div>

    <div class="bottom attached ui active tab segment no-padding padding-top-5" data-tab="editor">
        <div class="field {{ $errors->has('publish') ? 'error' : '' }}">
            {!!
            Form::textarea('content', old('content', isset($article) ? $article->content_html : null), ['id' => 'Post-content'])
            !!}
        </div>
    </div>

    <div class="bottom attached ui tab segment" data-tab="options">
        <div class="inline field {{ $errors->has('status') ? ' error' : '' }}">
            <label class="control-label" for="publish-date">Publish date</label>
            {!! Form::select('status', $statusList, old('status'), ['class' => 'ui selection dropdown']) !!}
        </div>
        <div class="field {{ $errors->has('excerpt') ? ' error' : '' }}">
            <label for="Post-excerpt">Excerpt</label>
            {!!
            Form::textarea('excerpt', old('excerpt'), ['id' => 'Post-excerpt','rows' => '3', 'class' => 'form-control field-textarea size-small'])
            !!}
        </div>
        <div class="field {{ $errors->has('tags') ? ' error' : '' }}">
            <label for="Post-tags">Tags</label>

            <div class="ui left icon input">
                {!!
                Form::text('tags', old('tags'), ['id' => 'Post-tags','class' => 'form-control taginput'])
                !!}
                <i class="tags icon"></i>
            </div>
        </div>
        <div class="field">
            <label>Featured Images</label>
            @include('partials.fileupload.image_multi', $uploadConfig)
        </div>
    </div>

    <div class="ui center aligned segment form-actions">
        <button type="submit" class="ui primary submit icon labeled button"><i class="save icon"></i> Save</button>
        <button type="reset" class="ui reset icon labeled button"><i class="undo icon"></i> Reset</button>
    </div>
</div>

<?php
Theme::asset()->container()->add('redactor', 'assets/vendor/redactor/redactor.css');
Theme::asset()->container('footer')->add('redactor', 'assets/vendor/redactor/redactor.min.js', ['jquery']);
Theme::asset()->container('footer')->add('table-plugin', 'assets/vendor/redactor/plugins/table.js', ['redactor']);
Theme::asset()->container('footer')->add('fontsize-plugin', 'assets/vendor/redactor/plugins/fontsize.js', ['redactor']);
Theme::asset()->container('footer')->add('pagebreak-plugin', 'assets/vendor/redactor/plugins/pagebreak.js', ['redactor']);
Theme::asset()->container('footer')->add('fullscreen-plugin', 'assets/vendor/redactor/plugins/fullscreen.js', ['redactor']);
Theme::asset()->container('footer')->add('imagemanager-plugin', 'assets/vendor/redactor/plugins/imagemanager.js', ['redactor']);
Theme::asset()->container('footer')->add('article-form-init', 'assets/js/admin/article-form.js', ['redactor']);