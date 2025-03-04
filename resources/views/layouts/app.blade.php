<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <title>Dotech | System</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">

    {{--  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-fixed sidebar-collapse ">
    <audio id="message" preload="auto">
        <source src="{{ asset('sound/pristine.mp3') }}" type="audio/mp3">
    </audio>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fa fa-user"></i><i class="fa fa-caret-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('/') }}" class="brand-link">

                <img src="{{ asset('img/brand.png') }}" alt="DotechLogo" class="img-circle p-1"
                    style="background-color:white;" width="40">

                <span class="brand-text font-weight-light">Dotech System</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ Avatar::create(Auth::user()->email)->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 100]) }}"
                            class="img-circle elevation-3" alt="User Image" width="80" height="80" />
                    </div>
                    <div class="info">
                        <a href="{{ route('config_index') }}"
                            class="d-block">{{ Auth::user()->name . ' ' . Auth::user()->middle_name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('/') }}"
                                class="nav-link @if (Route::currentRouteName() == '/') active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Reportes</p>
                            </a>
                        </li>
                        @if (@Auth::user()->hasPermissionTo('modulo_retiros'))
                            <li class="nav-item">
                                <a href="{{ route('wire_whitdrawals') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_whitdrawals') active @endif">
                                    <i class="nav-icon icon-checkmark"></i>
                                    <p>Retiros </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_transacciones'))
                            <li class="nav-item">
                                <a href="{{ route('wire_transactions') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_transactions') active @endif">
                                    <i class="nav-icon icon-credit-card"></i>
                                    <p>Transacciones </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_tareas'))
                            <li class="nav-item">
                                <a href="{{ route('wire_tasks') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_tasks') active @endif">
                                    <i class="nav-icon icon-clipboard"></i>
                                    <p>Tareas </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_cotizaciones'))
                            <li class="nav-item">
                                <a href="{{ route('wire_quotes') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_quotes') active @endif">
                                    <i class="nav-icon icon-coin-dollar"></i>
                                    <p>Cotizaciones </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_proyectos'))
                            <li class="nav-item">
                                <a href="{{ route('wire_projects') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_projects') active @endif">
                                    <i class="nav-icon icon-price-tag"></i>
                                    <p>Proyectos </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_bitacoras'))
                            <li class="nav-item">
                                <a href="{{ route('wire_binnacles') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_binnacles') active @endif">
                                    <i class="nav-icon icon-book"></i>
                                    <p>Bitácoras </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_prospectos'))
                            <li class="nav-item">
                                <a href="{{ route('prospecto_index') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'prospecto_index') active @endif">
                                    <i class="nav-icon icon-office"></i>
                                    <p>Prospectos</p>
                                </a>
                            </li>
                        @endif
                        @if (
                            @Auth::user()->hasPermissionTo('modulo_clientes') ||
                                @Auth::user()->email == 'soporte2@dotredes.com' ||
                                @Auth::user()->email == 'soporte3@dotredes.com')
                            <li class="nav-item">
                                <a href="{{ route('clientes') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'clientes') active @endif">
                                    <i class="nav-icon icon-office"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_vehiculos'))
                            <li class="nav-item">
                                <a href="{{ route('wire_vehicles') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_vehicles') active @endif">
                                    <i class="nav-icon icon-truck"></i>
                                    <p>Vehículos </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_almacen'))
                            <li class="nav-item">
                                <a href="{{ route('wire_stocks') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_stocks') active @endif">
                                    <i class="nav-icon icon-barcode"></i>
                                    <p>Almacén </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_aspirantes'))
                            <li class="nav-item">
                                <a href="{{ route('wire_candidates') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_candidates') active @endif">
                                    <i class="nav-icon icon-users"></i>
                                    <p>Aspirantes </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_vacaciones'))
                            <li class="nav-item">
                                <a href="{{ route('index_user') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'index_user') active @endif">
                                    <i class="nav-icon icon-dice"></i>
                                    <p>Vacaciones</p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_documentos'))
                            <li class="nav-item">
                                <a href="{{ route('wire_documents') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_documents') active @endif">
                                    <i class="nav-icon icon-file-pdf"></i>
                                    <p>Documentos </p>
                                </a>
                            </li>
                        @endif
                        @if (@Auth::user()->hasPermissionTo('modulo_machotes'))
                            <li class="nav-item">
                                <a href="{{ route('wire_forms') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'wire_forms') active @endif">
                                    <i class="nav-icon icon-file-word"></i>
                                    <p>Machotes </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ asset('mobile/dotech_mobile_1-1-3.apk') }}" target="_blank"
                                class="nav-link">
                                <i class="nav-icon icon-android" style="color:green;"></i>
                                <p>App</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                @yield('page_title')
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            </ol>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                @include('layouts.notification')
                @include('layouts.browser_notification')
                @if (Session::has('message'))
                    @include('layouts.message')
                @endif
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                @if (@Auth::user()->hasPermissionTo('modulo_roles_permisos'))
                    <a href="{{ route('roles_permisos') }}">
                        <i class="icon-key"></i> Roles y permisos
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('catalogo_proveedores_de_retiro'))
                    <a href="{{ route('provider_index') }}">
                        <i class="icon-cart"></i> Proveedores de retiro
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('catalogo_departamentos_de_retiro'))
                    <a href="{{ route('index_department') }}">
                        <i class="icon-tree"></i> Departamentos de retiro
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('catalogo_cuentas_de_retiro'))
                    <a href="{{ route('index_account') }}">
                        <i class="icon-credit-card"></i> Cuentas de retiro
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('modulo_de_log'))
                    <a href="{{ route('log_index') }}">
                        <i class="icon-database"></i> Log
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('catalogo_de_usuarios'))
                    <a href="{{ route('index_user') }}">
                        <i class="icon-users"></i> Usuarios
                    </a><br /><br />
                @endif
                @if (@Auth::user()->hasPermissionTo('enviar_notificacion_web'))
                    <a onclick="$('#browser_notification_modal').modal();" href="javascript:void(0)">

                        <i class="icon-bell"></i> Notificación página web
                    </a><br /><br />
                @endif
                <a href="#"
                    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                    <i class="icon-exit"></i> Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Dotech System
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} <a href="#"> DOTECH</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @livewireScripts
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script src="{{ asset('js/alertify.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('datepicker/jquery.datetimepicker.full.min.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('datepicker/jquery.datetimepicker.min.css') }}" />
    <script src="//unpkg.com/vanilla-masker@1.1.1/lib/vanilla-masker.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Livewire.on('dissmisUploadFileModal', () => $('#upload_file_modal').modal('hide'));
        Livewire.on('dissmissCreateTransactionModal', () => $('#create_transaction_modal').modal('hide'));
        Livewire.on('showEditTransactionModal', () => $('#edit_transaction_modal').modal());
        Livewire.on('dissmissEditTransactionModal', () => $('#edit_transaction_modal').modal('hide'));
        window.deleteTransaction = transaction_id => {
            alertify.confirm("",
                    function() {
                        Livewire.emit('destroy', transaction_id);
                    },
                    function() {
                        //alertify.error('Cancel');
                    })
                .set('labels', {
                    ok: 'Si, eliminar!',
                    cancel: 'Cancelar'
                })
                .set({
                    transition: 'flipx',
                    title: 'Alerta',
                    message: '¿Eliminar registro?'
                });
        };
        Pusher.logToConsole = false;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        var channel = pusher.subscribe('user-{{ Auth::user()->id }}-channel');
        channel.bind('notification', function(data) {
            $("#text_route_notificacion").attr('href', data.message.route);
            $("#text_route_notificacion").text(data.message.msg);
            $("#notification_container").css('display', 'block');
            document.getElementById('message').play();

            switch (data.message.event) {
                case 'task_comment':
                    console.log("Comentario de tarea");
                    if ($("#index_task_comment_modal").length > 0) {
                        $("#index_task_comment_modal").modal('hide');
                        showTaskCommentsModal(data.message.task_id);
                    }
                    break;
            }
        });
        $("#form_browser_notification").submit(function(e) {
            e.preventDefault();
            const form = $("#form_browser_notification");
            $.ajax({
                type: "GET",
                url: form.attr("action"),
                data: form.serialize(),
                success: function(data) {
                    form[0].reset();
                    $("#browser_notification_modal").modal('hide');
                },
                error: err => console.log(err)
            });

        });
    </script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            $('.select2').select2();
        });
    </script>

    @include('companies.show_modal')
    <input type="hidden" id="txt_user_id" value="{{ Auth::user()->id }}" />
    <input type="hidden" id="txt_rol_user_id" value="{{ Auth::user()->rol_user_id }}" />
    <style>
        .comment-box-modal {
            background: url({{ asset('img/background_black_red.jpg') }});
            width: 100%;
            height: 400px;
            overflow: hidden;
            overflow-y: scroll;
        }
    </style>
    @include('layouts.pendientes_modal')
    @include('layouts.pendientes_modal_admin')
    @if (session()->has('recent_login'))
        <script>
            var user_id = {{ session('recent_login') }};
            cargarPendientesInicio(user_id);

            function cargarPendientesInicio(user_id) {
                @if (Auth::user()->rol_user_id == 1)
                    $.ajax({
                        type: "GET",
                        url: "{{ url('obtener_pendientes_admin') }}",
                        data: {
                            user_id: user_id
                        },
                        success: function(response) {
                            console.log(response);
                            //Tareas
                            var html_lista_tareas_pendientes = ``;
                            var html_lista_retiros_pendientes = ``;
                            var html_lista_vacaciones_pendientes = ``;

                            $.each(response.tareas, function(index, item) {
                                html_lista_tareas_pendientes += `<li>${item.title}</li>`;
                            });
                            if (response.tareas.length <= 0) {
                                html_lista_tareas_pendientes = `<li>No tienes tareas pendientes</li>`;
                            }

                            $.each(response.retiros, function(index, item) {
                                html_lista_retiros_pendientes +=
                                    `<li>${item.description} por \$${item.quantity}</li>`;
                            });
                            if (response.retiros.length <= 0) {
                                html_lista_retiros_pendientes = `<li>No tienes retiros pendientes</li>`;
                            }

                            $.each(response.vacaciones, function(index, item) {
                                html_lista_vacaciones_pendientes +=
                                    `<li>${item.empleado.name} ${item.empleado.middle_name} ha solicitado ${item.tipo}</li>`;
                            });
                            if (response.vacaciones.length <= 0) {
                                html_lista_vacaciones_pendientes = `<li>No hay vacaciones pendientes</li>`;
                            }

                            $("#lista_tareas_pendientes_admin").html(html_lista_tareas_pendientes);
                            $("#lista_retiros_pendientes_admin").html(html_lista_retiros_pendientes);
                            $("#lista_vacaciones_pendientes_admin").html(html_lista_vacaciones_pendientes);

                            $("#pendientes_modal_admin").modal();
                        },
                        error: err => console.log(err)
                    });
                @else
                    $.ajax({
                        type: "GET",
                        url: "{{ url('obtener_pendientes') }}",
                        data: {
                            user_id: user_id
                        },
                        success: function(response) {
                            console.log(response);
                            //Tareas
                            var html_lista_tareas_pendientes = ``;
                            $.each(response.tareas, function(index, item) {
                                html_lista_tareas_pendientes += `<li>${item.title}</li>`;
                            });
                            if (response.tareas.length <= 0) {
                                html_lista_tareas_pendientes = `<li>No tienes tareas pendientes</li>`;
                            }
                            $("#lista_tareas_pendientes").html(html_lista_tareas_pendientes);

                            $("#pendientes_modal").modal();
                        },
                        error: err => console.log(err)
                    });
                @endif
            }
        </script>
        @php
            session()->forget('recent_login');
        @endphp
    @endif
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />

    <script>
        const driver = window.driver.js.driver;

        const driverObj = driver({
            showProgress: true,
            nextBtnText: "Siguiente",
            prevBtnText: "Atras",
            doneBtnText: "Terminar",
            onDestroyed: function() {
                alert("Se termino el tour");
            },
            steps: [{
                    element: '.page-header',
                    popover: {
                        title: 'Title',
                        description: 'Description'
                    }
                },
                {
                    element: '.top-nav',
                    popover: {
                        title: 'Title',
                        description: 'Description'
                    }
                },
                {
                    element: '.sidebar',
                    popover: {
                        title: 'Title',
                        description: 'Description'
                    }
                },
                {
                    element: '.footer',
                    popover: {
                        title: 'Title',
                        description: 'Description'
                    }
                },
            ]
        });

        //driverObj.drive();
    </script>
    @yield('custom_scripts')
</body>

</html>
