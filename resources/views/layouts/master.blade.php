<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        {{--Style--}}
        <link rel="stylesheet" href="{{ URL::to('libs/bootstrap-3.3.7/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('libs/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('css/style.css') }}">

        {{--Head Scripts--}}
        <script src="{{ URL::to('libs/jquery.min.js') }}"></script>
    </head>
    <body>
        {{--Header--}}
        @include('partials.header')

        {{--Main--}}
        @yield('main')

        {{--Footer--}}
        @include('partials.footer')

        {{--Scripts--}}
        <script src="{{ URL::to('libs/bootstrap-3.3.7/bootstrap.min.js') }}"></script>
        <script src="{{ URL::to('js/scripts.js') }}"></script>
        @yield('extra_js')
    </body>
</html>