<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head-content')
    </head>

    <body>
        @yield('body-content')
    </body>

</html>
