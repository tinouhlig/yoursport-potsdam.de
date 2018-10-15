<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <title>Admin - @yield('title', 'YOURS')</title>

        {{-- included Styles --}}
        @include('admin._partials._styles')
    </head>
    <body class="skin-green sidebar-mini">
        <div class="wrapper">
            {{-- included header --}}
            @include('admin._partials._header')
            {{-- included sidebar - navigation --}}
            @include('admin._partials._sidebar')
            {{-- main Content --}}
            <div class="content-wrapper">
                @yield('content')
            </div>
            {{-- included scripts --}}
            @include('admin._partials._scripts')
        </div>
    </body>
</html>
