<!DOCTYPE html>
<html lang="en">
    <head>

<!--  meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title> Erp Task</title>
<!--  styles -->

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @yield('styles')

<!-- head scripts -->

        @yield('head-scripts')

    </head>
    <body >

        <div id="app">

        </div>

        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

<!--  body scripts -->
        @yield('scripts')
    </body>
</html>

