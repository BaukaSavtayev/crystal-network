<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
{{--        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600&family=Comfortaa:wght@300;400;500;600;700&family=Jost:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;1,200;1,300;1,400;1,600&display=swap" rel="stylesheet">--}}
{{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
{{--        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}
{{--        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body id="app">
       <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
