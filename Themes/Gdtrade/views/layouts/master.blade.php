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
        appUrl: '{{ config('app.url') }}'
    };
</script>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="{{ mix('js/front.js') }}"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-108380705-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
