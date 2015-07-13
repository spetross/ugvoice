<?php
Asset::add('jquery', 'js/jquery.min.js');
Asset::add('semantic-css', 'vendor/sui/semantic.min.css');
Asset::add('admin-css', 'css/admin.css');
Asset::container('footer')->add('tablesort', 'vendor/sui/tablesort.min.js', ['jquery']);
Asset::container('footer')->add('semantic', 'vendor/sui/semantic.min.js', ['jquery', 'tablesort']);
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title or null }}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png">
    {!! Asset::styles() !!}
    @yield('styles')
    {!! Asset::scripts() !!}
</head>
<body>
@yield('content')
{!! Asset::container('footer')->scripts() !!}
@yield('scripts')
</body>
</html>