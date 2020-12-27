<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        <script src="app/resources/js/timeago.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header"> 
            <ul>
                <li><img src="{{ url('/images/glob.png') }}"></li>
                @yield('links')
            </ul>
        </div>
         @yield('content')
    </body>
</html>