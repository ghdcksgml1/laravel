<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Laravel')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <ul>
            <li><a href="/">Welcome</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/hello">Hello</a></li>
        </ul>
    @yield('content')
    </body>
</html>
