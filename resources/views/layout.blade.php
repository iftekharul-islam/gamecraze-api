<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <!-- google icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Owl Stylesheets -->
{{--        <link rel="stylesheet" href="{{asset('scss/owl/owl.carousel.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('scss/owl/owl.theme.default.min.css')}}">--}}
{{--        <!-- bx slider -->--}}
{{--        <link rel="stylesheet" href="{{asset('scss/bxslider/jquery.bxslider.css')}}">--}}
        <!-- title icon -->
        <link rel="icon" href="{{ asset('img/title/title.png') }}" type="image/x-icon">
        <!-- custom style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Title -->
        <title>Welcome to Gameplay Station</title>
    </head>
    <body>
    <div id="app">
        <navbar></navbar>
    </div>

    <!-- jquery -->
    <script src=" {{ asset('js/app.js') }} "></script>
    </body>
</html>
