<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Takeaway Town') }}</title>

        <script>
            window.Laravel = {!! json_encode([
                'authUser' => Auth::user(),
                'csrfToken' => csrf_token(),
                'siteName'  => config('app.name'),
                'apiDomain' => config('app.url').'/api',
                'frontpage' => true
            ]) !!}
        </script>
        <!-- Styles -->
        <!-- Styles -->
        <link href="{{ mix('css/all.css') }}" rel="stylesheet">
        <style>
            .flex-center.position-ref.full-height {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                position: relative;
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .front.navbar{
                display: none;
            }
            .flex-center.position-ref.full-height .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .flex-center.position-ref.full-height .content {
                text-align: center;
            }

            .flex-center.position-ref.full-height .title {
                font-size: 84px;
            }

            .flex-center.position-ref.full-height .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            #app.front .m-b-md {
                margin-bottom: 30px;
            }

        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="app" class="front">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                @endif

                <div class="content">
                    <div class="title m-b-md">
                        Laravel
                    </div>

                    <div class="links">
                        <a href="https://laravel.com/docs">Documentation</a>
                        <a href="https://laracasts.com">Laracasts</a>
                        <a href="https://laravel-news.com">News</a>
                        <a href="https://forge.laravel.com">Forge</a>
                        <a href="https://github.com/laravel/laravel">GitHub</a>
                    </div>
                </div>
            </div>

        </div>
        <script>
            if (window.Laravel) {
                console.log(window.Laravel)
            }
            if (window.Laravel.frontpage === true) {
                console.log('Frontpage');
            }

        </script>

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
