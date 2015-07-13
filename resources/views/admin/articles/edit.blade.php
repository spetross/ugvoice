<?php
$uploadConfig = array(
        'displayMode' => 'image-multi',
        'imageHeight' => 200,
        'imageWidth' => 200,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'Article-Featured-Images'
);
if ($photos = $article->photos) {
    foreach ($photos as $photo) {
        $photo->thumb = $photo->getThumb($uploadConfig['imageWidth'], $uploadConfig['imageHeight']);
    }
    $uploadConfig['fileList'] = $photos;
}
?>

@section('form.buttons')
        <!-- Save -->
<button
        class="ui basic primary submit icon button" type="submit"><i class="check icon"></i> Save
</button>
<button
        class="ui negative tiny icon article delete button" type="button"><i class="trash icon"></i> Delete
</button>
@stop

@section('content')
    @include('layout.flash')
    {!! app('form')->model($article, ['action' => array('Admin\ArticlesController@update', $article->id), 'method' => 'put', 'class' => 'ui article form']) !!}
    @include('articles.form')
    {!! app('form')->close() !!}
    <div class="ui tiny article modal" id="delete-article">
        <div class="header">
            Delete article
        </div>
        <div class="content">
            <p>Are you sure you want to delete this article</p>
            <h5>{{ $article->title }}</h5>
        </div>
        <div class="actions">
            <div class="ui negative cancel button">
                No
            </div>
            <div class="ui positive right icon approve button">
                Yes
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.ui.article.modal')
                .modal({
                    onApprove: function () {
                        $(this).api({
                            url: '{{ action('ArticlesController@destroy', $article->id) }}',
                            method: 'DELETE',
                            on: 'now',
                            onSuccess: function (response) {
                                window.location.href = '{{ action('ArticlesController@index') }}'
                            }
                        })
                    }
                })
                .modal('attach events', '.ui.article.delete.button', 'show')
        ;
    </script>
@append



