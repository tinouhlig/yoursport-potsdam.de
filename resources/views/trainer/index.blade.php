<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <title>@yield('title', 'YOURS')</title>

        @include('public._partials._styles')
    </head>
    <body id="page-top">
            @include('public._partials._navigation')

            @include('public._partials._flash-notification')

        <div id="wrapper">

            <div id="page-content-wrapper">
                {{-- <div class="container"> --}}
                    @yield('content')
                {{-- </div> --}}
            </div>


            @include('public._partials._scripts')
        </div>
    </body>
</html>
