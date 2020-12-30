<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body>
        <div class="header"> 
            <ul>
                <li class ="links"><img src="{{ url('/images/glob.png') }}"></li>
                @yield('links')
            </ul>
        </div>
         @yield('content')
         
    </body>
    @yield('script')
    
</html>