<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CSFE') }}</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
{{--        <link href="https://cdn.bootcss.com/font-awesome/5.5.0-2/css/all.min.css" rel="stylesheet">--}}
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="">
        @inertia
    </body>
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/concept.min.js') }}"></script>
</html>
