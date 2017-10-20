<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            {{ Setting::get('core::site-name') }}
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/css/vendor/ionicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/css/vendor/alertify/alertify.core.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/vendor/admin-lte/dist/css/AdminLTE.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/adminlte/vendor/admin-lte/plugins/iCheck/square/blue.css') }}"/>

    <script src="{{ asset('themes/adminlte/vendor/jquery/jquery.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108380705-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-108380705-1');
    </script>

</head>
<body class="hold-transition login-page">

<div class="login-box">
    @yield('content')
</div>

<!-- Bootstrap -->
<script src="{{ asset('themes/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/js/vendor/alertify/alertify.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
