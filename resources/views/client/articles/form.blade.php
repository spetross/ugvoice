<?php
/**
 * $article \app\Article
 */
$uploadConfig = array(
        'displayMode' => 'image-multi',
        'imageHeight' => 150,
        'imageWidth' => 150,
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
<div class="top attached ui header">
    {{ Theme::get('title') }}
</div>
<div class="bottom attached ui segment">
    {!! Theme::partial('flash') !!}
    {!! Theme::partial('articles.form', compact('article', 'uploadConfig')) !!}
</div>
