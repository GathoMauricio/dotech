<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <title>{{ env('APP_NAME') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container text-center" id="error">
        <br><br><br>
        <center><img src="{{ asset('img/dotech_fondo.png') }}" width="280"
                height="140">
        </center>
        <br>
        <svg height="100" width="100">
            <polygon points="50,25 17,80 82,80" stroke-linejoin="round" style="fill:none;stroke:#ff8a00;stroke-width:8" />
            <text x="42" y="74" fill="#ff8a00" font-family="sans-serif" font-weight="900" font-size="42px">!</text>
        </svg>
        <div class="row">
            <div class="col-md-12">
                <div class="main-icon text-warning"><span class="uxicon uxicon-alert"></span></div>
                <h3 class="color-primary-sys">La página que ha solicitado no existe</h3>
                <h1 class="color-primary-sys">404</h1>
            </div>
        </div>
    </div>
    <style>
        body {
            background:url({{ asset('img/background_black_red.jpg')}});
        }
        .container{
            background-color: white;
            height: 100vh;
            padding: 25px;
            overflow: hidden;
            overflow-y: auto;
            border-radius: 5px;
            border: solid 1px rgba(131,47,47,1);
            box-shadow: 0px -1px 37px -9px rgba(131,47,47,1);
            -webkit-box-shadow: 0px -1px 37px -9px rgba(131,47,47,1);
            -moz-box-shadow: 0px -1px 37px -9px rgba(131,47,47,1);

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>