<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <title>@yield('title', 'YOURS')</title>

        {{-- included Styles --}}
        @include('public._partials._styles')
    </head>
    <body id="page-top">
            @include('public._partials._navigation')

            @include('public._partials._flash-notification')
            {{-- @include('public.pages.profile._partials._navigation') --}}
        <div id="wrapper">

            <div id="page-content-wrapper">
                {{-- <div class="container"> --}}
                    @yield('content')
                {{-- </div> --}}
            </div>


            {{-- @include('public._partials._footer') --}}
            @include('public._partials._scripts')
            {{-- @include('public._partials._vue-components._all') --}}
        </div>
    </body>
</html>
