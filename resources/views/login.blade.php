<!DOCTYPE html>
<html>
    <head>
        <title>gotoTM: Login</title>
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="main">
            <div class="container">
                <br>
                <div class="content">
                    <h1>
                        Please login to proceed
                    </h1>
                    <a href="/au">Login with Freedom!</a>
                    @if ($errors->any())
                        <ul class="error-list">
                            @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
