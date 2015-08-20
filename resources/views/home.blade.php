<!DOCTYPE html>
<html>
    <head>
        <title>gotoTM</title>
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        @include('partials.header')
        <div class="main">
            <div class="container">
                <span class="title">goto.tm</span>
                <br><br>
                <div class="content">
                    <form action="redirect" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label>URL</label>
                        <input type="text" name="long_url"/>
                        <label>New URL</label>
                        <input type="text" name="short_url" placeholder="http://goto.tm/"/>
                        <input type="submit"/>
                        <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                    </form>
                    <br>
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
    <footer>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </footer>
    </body>
</html>
