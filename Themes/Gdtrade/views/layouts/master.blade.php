<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grim Dawn Trade</title>
    <link media="all" type="text/css" rel="stylesheet" href="{{ mix('css/front.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="current-locale" content="{{ locale() }}">
    @if ($currentUser)
        <meta name="user-api-token" content="{{ $currentUser->getFirstApiKey() }}">
    @endif
    @routes
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108380705-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-108380705-1');
    </script>

</head>
<body>
<div class="wrapper" id="app">
    <navbar></navbar>
    <div class="container">
        @yield('content')
        <router-view></router-view>
    </div>
</div>


<script>
    window.AsgardCMS = {
        currentLocale: '{{ locale() }}',
        adminPrefix: '{{ config('asgard.core.core.admin-prefix') }}',
    };
</script>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="{{ mix('js/front.js') }}"></script>
</body>
</html>
