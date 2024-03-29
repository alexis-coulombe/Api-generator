<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    </head>
    <body>
        <div id="contain">
            @include('partials.header')
            @include('partials.menu')
            @yield('content')
            @include('partials.footer')
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ asset('js/ajax.js') }}"></script>
    </body>
</html>
