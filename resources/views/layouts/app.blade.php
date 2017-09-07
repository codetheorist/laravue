<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Takeaway Town') }}</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1HRHyMjIogjxDuJ_OG9eMctiyURL3IU&libraries=places"></script>
    <!-- Styles -->
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'authUser' => Auth::user(),
            'csrfToken' => csrf_token(),
            'siteName'  => config('app.name'),
            'apiDomain' => config('app.url').'/api'
        ]) !!}
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
