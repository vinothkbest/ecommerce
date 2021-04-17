<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>YellowRider | CRM Login</title>

    <meta name="description" content="YellowRider">
    <meta name="author" content="NinosITSolution">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('images/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/custom.css') }}">
    @yield('css_after')
</head>

<body>
    <div id="page-container">
        <main id="main-container">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    @yield('js_after')
</body>

</html>
