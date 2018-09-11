<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('partials._head')
    
</head>
<body>
    <div id="app">
        <div id="fader">
            <div class="mk-spinner-wrap">
                <div class="mk-spinner-weight"></div>
            </div>
            <h1 class="text-center text-white">Please wait...</h1>
            <p>We are preparing the file to download.</p>
        </div>
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
