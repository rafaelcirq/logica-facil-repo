<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('auth.head-content')
</head>

<body>
    @yield('body-content')
</body>

</html>