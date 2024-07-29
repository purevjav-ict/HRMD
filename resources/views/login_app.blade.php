<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SMART HRM | Administrator Control Panel</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <?php
        $url=Config::get('app.url');
        ?>
        <link href="{{ asset('/admin/css/vendor.css') }}?ver=11" rel="stylesheet">
        
        <!-- Theme initialization -->
        <link href="{{ asset('/admin/css/app-orange.css?version=3') }}" rel="stylesheet">
       
    </head>

    <body>
        @yield('content')
        
        <script src="{{ asset('/admin/js/vendor.js') }}?ver=11"></script>
        <script src="{{ asset('/admin/js/app.js') }}?ver=11"></script>
    </body>

</html>