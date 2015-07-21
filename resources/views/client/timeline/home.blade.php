@extends('client.layout')

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

@section('sidebar.top')

@stop

@section('content')
    <div class="uk-margin-top">
        @if(Auth::check())
            @include('client.post.form')
        @else
        <div class="ui info message">
            <p>Please login to share content with  {{ $client->name }}</p>
        </div>
        @endif
    </div>
    @include('client.timeline.feed')
@stop