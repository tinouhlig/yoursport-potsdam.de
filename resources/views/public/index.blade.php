<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <title>@yield('title', 'YOURS')</title>

        {{-- included Styles --}}
        @include('public._partials._styles')

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    </head>
    <body id="page-top">
        @include('public._partials._navigation')

        @include('public._partials._flash-notification')

        @yield('content')

        @include('public._partials._footer')

        @include('public._partials._scripts')

        @include('public._partials._vue-components._loginModal')

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-87139758-1', 'auto');
          ga('send', 'pageview');

        </script>
    </body>
</html>
