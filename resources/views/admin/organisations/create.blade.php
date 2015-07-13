<?php
$uploadConfig = array(
        'displayMode' => 'image-single',
        'imageHeight' => 200,
        'imageWidth' => 250,
        'singleFile' => false,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'Organisation-Logo'
);
?>

@section('content')
    {!! app('form')->open(['action' => array('Admin\OrganisationsController@store'), 'class' => 'ui organisation form']) !!}
    @include('organisations.form')
    {!! app('form')->close() !!}
@stop