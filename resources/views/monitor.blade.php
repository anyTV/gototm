<!DOCTYPE html>
<html>
    <head>
        <title>gotoTM</title>
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <span class="title">Success</span>
            <br>
            <div class="content">
                <h1>
                    You can now use
                    <a target="_blank" href="{{ config('app.url') }}/{{ $data['short_url'] }}"/>
                        {{ config('app.url') }}/{{ $data['short_url'] }}
                    </a>
                </h1>
                <a href="/">create more</a>
            </div>
        </div>
    </body>
</html>
