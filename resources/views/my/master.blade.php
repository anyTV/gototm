<!DOCTYPE html>
<html ng-app="userApp">
    <head>
        <title></title>
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        @yield('body')
    </body>
    <script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>
    @yield('scripts')
</html>
