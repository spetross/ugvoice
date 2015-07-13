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
        <a class="icon item" data-tab="options">
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
</div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/redactor/redactor.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor') }}" type="text/css">
    <style>
        .redactor-box {
            margin-bottom: 0;
        }
    </style>
@append

@section('scripts')
    <script src="{{ asset('library/redactor/redactor.min.js') }}"></script>
    <script src="{{ asset('library/redactor/plugins/table.js') }}"></script>
    <script src="{{ asset('library/redactor/plugins/fontsize.js') }}"></script>
    <script src="{{ asset('library/redactor/plugins/pagebreak.js') }}"></script>
    <script src="{{ asset('library/redactor/plugins/fullscreen.js') }}"></script>
    <script src="{{ asset('library/redactor/plugins/imagemanager.js') }}"></script>
    <script src="{{ asset('js/admin/article.form.js') }}"></script>
@append