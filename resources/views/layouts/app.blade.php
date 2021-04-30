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
    <script src="{{ asset('datepicker/jquery.datetimepicker.full.min.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('datepicker/jquery.datetimepicker.min.css') }}"/>
    <script src="//unpkg.com/vanilla-masker@1.1.1/lib/vanilla-masker.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>

<body>
    <audio id="message" preload="auto">
        <source src="{{ asset('sound/pristine.mp3') }}" type="audio/mp3">
    </audio>
    <div id="app">
        <div class="contenedor_vp" style="width:100%;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 principal-container-vp">
                        @include('layouts.notification')
                        @if(Session::has('message')) @include('layouts.message') @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="menu_vp">
            <center>
            <a href="{{ route('/') }}" style="padding:5px;">
                <img src="{{ asset('img/dotech_fondo.png') }}" width="100" height="60">
            </a>
            </center>
            <hr>
            <div class="content_menu_vp overflow_menu">
                <a href="{{ route('config_index') }}">
                    <p style="cursor:pointer;" class="text-center">
                        @if(Auth::user()->image == 'perfil.png')
                        <img src="{{asset('img')}}/{{ Auth::user()->image }}" width="50" height="50" style="border-radius:150px;" />
                        @else
                        <img src="{{asset('storage')}}/{{ Auth::user()->image }}" width="50" height="50" style="border-radius:150px;" />
                        @endif
                        <span style="display:none;" class="label-item-menu">
                            <br>
                            {{ Auth::user()->name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }} 
                            <br>
                            {{ Auth::user()->rol['name'] }}
                            <input type="hidden" id="txt_user_id" value="{{ Auth::user()->id }}" />
                            <input type="hidden" id="txt_rol_user_id" value="{{ Auth::user()->rol_user_id }}" />
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('/') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-home">
                            <span style="display:none;" class="label-item-menu">
                                Inicio
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('whitdrawal_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-checkmark">
                            <span style="display:none;" class="label-item-menu">
                                Retiros
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('task_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-clipboard">
                            <span style="display:none;" class="label-item-menu">
                                Tareas
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                @if(Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2)
                <a href="{{ route('index_quotes') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-coin-dollar">
                            <span style="display:none;" class="label-item-menu">
                                Cotizaciones
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                @endif
                <a href="{{ route('index_proyects') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-price-tag">
                            <span style="display:none;" class="label-item-menu">
                                Proyectos
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <!--
                <a href="{{ route('index_service') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-aid-kit">
                            <span style="display:none;" class="label-item-menu">
                                Expedientes
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                -->
                <a href="{{ route('index_binnacle') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-book">
                            <span style="display:none;" class="label-item-menu">
                                Bitácoras
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('company_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-office">
                            <span style="display:none;" class="label-item-menu">
                                Compañias
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('vehicle_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-truck">
                            <span style="display:none;" class="label-item-menu">
                                Vehiculos
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('stock_product_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-barcode">
                            <span style="display:none;" class="label-item-menu">
                                Almacén
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ asset('mobile/dotech_mobile_1-1-0.apk') }}" target="_blank">
                    <p style="cursor:pointer;">
                        <span class="icon-android" style="color:green;">
                            <span style="display:none;" class="label-item-menu">
                                App
                            </span>
                        </span>
                    </p>
                </a>
                <hr>
                <a href="{{ route('config_index') }}">
                    <p style="cursor:pointer;">
                        <span class="icon-cog">
                            <span style="display:none;" class="label-item-menu">
                                Configuración
                            </span>
                        </span>
                    </p>
                </a>
            </div>
        </div>
    </div>
    <style>
        body {
            background:url({{ asset('img/background_black_red.jpg')}});
        }
        .comment-box-modal{
            background:url({{ asset('img/background_black_red.jpg')}});
            width: 100%;
            height: 400px;
            overflow: hidden;
            overflow-y:scroll;
        }
        
        .menu_vp {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: #d5d8dc;
            
        }

        .content_menu_vp {
            padding: 10px;
            padding-top: 50px;
            text-align: center;
        }

        

        .label-item-menu {
            font-weight: bold;
            padding: 10px;
            font-size: 18;
            color: white;
        }

        .contenedor_vp {
            padding-left: 120px;
        }

        .principal-container-vp {
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
    <script type="text/javascript"
	src="https://slideshow.triptracker.net/slide.js"></script>
    <script>
        $(document).ready(function(){
        $(".menu_vp").mouseenter(function(e){
            $(".label-item-menu").css('display', 'inline');
            $(".content_menu_vp p").css('text-align','left');
            $(".content_menu_vp p span").css('font-size','18px');
        }).mouseleave(function(){
            $(".content_menu_vp p").css('text-align','center');
            $(".label-item-menu").css('display', 'none');
            $(".content_menu_vp p span").css('font-size','22px');
        });       
    });
    </script>
    @include('companies.show_modal')

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = '{{ env('PUSHER_LOG',false) }}';
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        var channel = pusher.subscribe('user-{{ Auth::user()->id }}-channel');
            channel.bind('notification', function(data) {
            $("#text_route_notificacion").attr('href',data.message.route);
            $("#text_route_notificacion").text(data.message.msg);
            $("#notification_container").css('display','block');
            document.getElementById('message').play();

            switch(data.message.event) { 
                case 'task_comment':
                    console.log("Comentario de tarea");
                    if($("#index_task_comment_modal").length > 0) {
                        $("#index_task_comment_modal").modal('hide');
                        showTaskCommentsModal(data.message.task_id);
                    }
                break;
            }
        });
    </script>
</body>

</html>