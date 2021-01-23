<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('pickadate.js-3.6.2/lib/themes/classic.css') }}" rel="stylesheet">
    <link href="{{ asset('pickadate.js-3.6.2/lib/themes/classic.date.css') }}" rel="stylesheet">
    @if (config('app.locale') == 'ar')
    <link href="{{ asset('pickadate.js-3.6.2/lib/themes/ar.css') }}" rel="stylesheet">
    @endif
    <style>
        form.form label.error,label.error{
            color:red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="@yield('type')">
            @include('layouts.partials._navbar')
        </div>
        <main class="py-4">
            <div class="container">
                @include('layouts.partials._session')
                @yield('content')
            </div>
        </main>
    </div>
    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('script')
    <script>
        $(function(){
            $('#alert').fadeTo(2000,500).slideUp(500,function(){
                $('#alert').slideUp(500);
            });
        });
    </script>
</body>
</html>
