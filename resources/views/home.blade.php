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
                <br>
                <span><small>Freedom! URL Shortener</small></span>
                <br><br><br>
                <div class="content">
                    <form action="redirect" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label>Long URL</label>
                        <input type="text" name="long_url" placeholder="Paste a long URL here"/>
                        <label>Short URL <small>{{ config('app.url') }}/</small></label>
                        <input type="text" name="short_url"/>
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
