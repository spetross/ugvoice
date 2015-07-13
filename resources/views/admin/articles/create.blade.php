<?php
$uploadConfig = array(
        'displayMode' => 'image-multi',
        'imageHeight' => 200,
        'imageWidth' => 200,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'Article-Featured-Images'
);
?>

@section('content')
    @include('layout.flash')
    {!! app('form')->open(['action' => array('Admin\ArticlesController@store'), 'class' => 'ui article form']) !!}
    @include('articles.form')
    {!! app('form')->close() !!}
@stop