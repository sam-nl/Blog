<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
        crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body> 
        <!-- Header -->
        <div class ="container">
            <nav class="navbar navbar-default" style="background-color: purple;">
                <ul class = "link-list">
                    <li class = "links"><img src="{{ url('/images/glob.png') }}" class = "glob"></li>
                    <li class = "links"><a href="/home">Home</a></li>
                    @yield('links')
                </ul>
            </nav>
        
        <!-- Main Body -->
         @yield('content')
        </div>
    </body>
    @yield('script')
</html>