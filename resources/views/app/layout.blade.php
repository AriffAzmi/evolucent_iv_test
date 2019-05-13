<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BizNest | Administration Portal</title>
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset("modules/bootstrap/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ asset("modules/fontawesome/css/all.min.css") }}">
        <!-- CSS Libraries -->
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
        <link rel="stylesheet" href="{{ asset("css/components.css") }}">
        <style>
            .field-err {
                color: #d00;
            }
        </style>
        @yield('custom-css')
    </head>
    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>

                @include('components.topbar-menu')

                @include('components.sidebar-menu')

                @yield('content')
            </div>
        </div>
        <!-- General JS Scripts -->
        <script src="{{ asset("modules/jquery.min.js") }}"></script>
        <script src="{{ asset("modules/popper.js") }}"></script>
        <script src="{{ asset("modules/tooltip.js") }}"></script>
        <script src="{{ asset("modules/bootstrap/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("modules/nicescroll/jquery.nicescroll.min.js") }}"></script>
        <script src="{{ asset("modules/moment.min.js") }}"></script>
        <script src="{{ asset("js/stisla.js") }}"></script>
        <!-- JS Libraies -->
        <!-- Page Specific JS File -->
        <!-- Template JS File -->
        <script src="{{ asset("js/scripts.js") }}"></script>
        <script src="{{ asset("js/ajax.js") }}"></script>
        <script>
            var token = "{{ csrf_token() }}";
            moment.locale('en');
            function l(data,type="normal") {
                
                if (type=="normal") {

                    console.log(data);
                }
                else if (type=="error") {

                    console.error(data);
                }
                else if (type=="info") {

                    console.info(data);
                }
            }
            var Http = new Ajax();
        </script>
        <script src="{{ asset("js/custom.js") }}"></script>
        @yield('custom-js')
    </body>
</html>