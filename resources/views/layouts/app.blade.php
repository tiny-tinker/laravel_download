<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('partials._head')
    
</head>
<body>
    <div id="app">
        <div class="container">
            @include('partials._messages')

            @include('partials._nav')

            @include ('partials._sidebars')

            @include ('partials._footer')
        </div> <!-- /.container -->
    </div>

    @include('partials._javascript')

    @yield('scripts')
    
</body>
</html>
