<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">


        <style>
        @font-face {
            font-family: 'Siegra';
            src: url('{{ asset('Siegra.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        </style>
        
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @cookieconsentscripts
        @vite('resources/ts/app.ts')
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        @cookieconsentview
    </body>
</html>
