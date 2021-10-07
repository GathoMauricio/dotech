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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    @livewireStyles
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
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      -->
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      -->
      <!-- Messages Dropdown Menu
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="{{ asset('adminlte/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="{{ asset('adminlte/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="{{ asset('adminlte/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      <!--
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      -->
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
      
      <img src="{{ asset('img/brand.png') }}" alt="DotechLogo" class="img-circle p-1" style="background-color:white;" width="40">
      
      <span class="brand-text font-weight-light">Dotech System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--
          @if(Auth::user()->image == 'perfil.png')
            <img src="{{ asset('img/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image"  width="60" height="60" />
          @else
            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image"  width="60" height="60" />
          @endif
          -->
         <img src="{{ Avatar::create(Auth::user()->email)->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 100]) }}" class="img-circle elevation-3" alt="User Image"  width="80" height="80" />
        </div>
        <div class="info">
          <a href="{{ route('config_index') }}" class="d-block">{{ Auth::user()->name.' '.Auth::user()->middle_name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!--
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('/') }}" class="nav-link @if (Route::currentRouteName() == '/') active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('whitdrawal_index') }}" class="nav-link @if (Route::currentRouteName() == 'whitdrawal_index') active @endif">
                  <i class="nav-icon icon-checkmark"></i><p>Retiros</p>
                </a>
            </li>
            -->
             <li class="nav-item">
                <a href="{{ route('wire_whitdrawals') }}" class="nav-link @if (Route::currentRouteName() == 'wire_whitdrawals') active @endif">
                  <i class="nav-icon icon-checkmark"></i><p>Retiros <img src="{{ asset('img/wire.png') }}" width="60"></p>
                  
                </a>
                
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('task_index') }}" class="nav-link @if (Route::currentRouteName() == 'task_index') active @endif">
                  <i class="nav-icon icon-clipboard"></i><p>Tareas <img src="{{ asset('img/react.png') }}" width="60"></p>
                </a>
            </li>
            -->
            <li class="nav-item">
              <a href="{{ route('wire_tasks') }}" class="nav-link @if (Route::currentRouteName() == 'wire_tasks') active @endif">
                <i class="nav-icon icon-clipboard"></i><p>Tareas <img src="{{ asset('img/wire.png') }}" width="60"></p>
              </a>
          </li>
            @if(Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2)
            <!--
            <li class="nav-item">
                <a href="{{ route('index_quotes') }}" class="nav-link @if (Route::currentRouteName() == 'index_quotes') active @endif">
                  <i class="nav-icon icon-coin-dollar"></i><p>Cotizaciones</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_quotes') }}" class="nav-link @if (Route::currentRouteName() == 'wire_quotes') active @endif">
                  <i class="nav-icon icon-coin-dollar"></i><p>Cotizaciones <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            @endif
            <!--
            <li class="nav-item">
                <a href="{{ route('index_proyects') }}" class="nav-link @if (Route::currentRouteName() == 'index_proyects') active @endif">
                  <i class="nav-icon icon-price-tag"></i><p>Proyectos</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_projects') }}" class="nav-link @if (Route::currentRouteName() == 'wire_projects') active @endif">
                  <i class="nav-icon icon-price-tag"></i><p>Proyectos <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('index_binnacle') }}" class="nav-link @if (Route::currentRouteName() == 'index_binnacle') active @endif">
                  <i class="nav-icon icon-book"></i><p>Bitácoras</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_binnacles') }}" class="nav-link @if (Route::currentRouteName() == 'wire_binnacles') active @endif">
                  <i class="nav-icon icon-book"></i><p>Bitácoras <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('company_index') }}" class="nav-link @if (Route::currentRouteName() == 'company_index') active @endif">
                  <i class="nav-icon icon-office"></i><p>Compañias <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('vehicle_index') }}" class="nav-link @if (Route::currentRouteName() == 'vehicle_index') active @endif">
                  <i class="nav-icon icon-truck"></i><p>Vehículos</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_vehicles') }}" class="nav-link @if (Route::currentRouteName() == 'wire_vehicles') active @endif">
                  <i class="nav-icon icon-truck"></i><p>Vehículos <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a href="{{ route('stock_product_index') }}" class="nav-link @if (Route::currentRouteName() == 'stock_product_index') active @endif">
                  <i class="nav-icon icon-barcode"></i><p>Almacén</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_stocks') }}" class="nav-link @if (Route::currentRouteName() == 'wire_stocks') active @endif">
                  <i class="nav-icon icon-barcode"></i><p>Almacén <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            @if(Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2)
            <!--
            <li class="nav-item">
                <a href="{{ route('candidates') }}" class="nav-link @if (Route::currentRouteName() == 'candidates') active @endif">
                  <i class="nav-icon icon-users"></i><p>Aspirantes</p>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="{{ route('wire_candidates') }}" class="nav-link @if (Route::currentRouteName() == 'wire_candidates') active @endif">
                  <i class="nav-icon icon-users"></i><p>Aspirantes <img src="{{ asset('img/wire.png') }}" width="60"></p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('wire_documents') }}" class="nav-link @if (Route::currentRouteName() == 'wire_documents') active @endif">
                <i class="nav-icon icon-file-pdf"></i><p>Documentos <img src="{{ asset('img/wire.png') }}" width="60"></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('wire_forms') }}" class="nav-link @if (Route::currentRouteName() == 'wire_forms') active @endif">
                <i class="nav-icon icon-file-word"></i><p>Machotes <img src="{{ asset('img/wire.png') }}" width="60"></p>
              </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ asset('mobile/dotech_mobile_1-1-3.apk') }}" target="_blank" class="nav-link">
                  <i class="nav-icon icon-android" style="color:green;"></i><p>App</p>
                </a>
            </li>

        <!--
            <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Arbol
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rama</p>
                </a>
              </li>

            </ul>
          </li>
          -->
        
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
            <!--
            {{ \Breadcrumbs::render(Route::currentRouteName()) }}
            -->
            <!--
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
              -->
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
    @if(Session::has('message')) @include('layouts.message') @endif
    @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      @if(Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2)
      <a href="{{ route('provider_index') }}">
        <i class="icon-cart"></i> Proveedores de retiro 
      </a><br/><br/>
      <a href="{{ route('index_department') }}">
        <i class="icon-tree"></i> Departamentos de retiro
      </a><br/><br/>
      <a href="{{ route('index_account') }}">
        <i class="icon-credit-card"></i> Cuentas de retiro 
      </a><br/><br/>
      <a href="{{ route('log_index') }}">
        <i class="icon-database"></i> Log 
      </a><br/><br/>
      <a href="{{ route('index_user') }}">
        <i class="icon-users"></i> Usuarios
      </a><br/><br/>
      <a onclick="$('#browser_notification_modal').modal();" href="javascript:void(0)">

        <i class="icon-bell"></i> Notificación página web
      </a><br/><br/>
      @endif
      <a href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <i class="icon-exit"></i>  Cerrar sesión
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
    <strong>Copyright &copy; {{ date('Y') }}  <a href="#"> DOTECH</a>.</strong> All rights reserved.
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

<script src="{{ asset('js/alertify.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('datepicker/jquery.datetimepicker.full.min.js') }}" defer></script>
<link rel="stylesheet" type="text/css" href="{{ asset('datepicker/jquery.datetimepicker.min.css') }}"/>
<script type="text/javascript"src="https://slideshow.triptracker.net/slide.js"></script>
<script src="//unpkg.com/vanilla-masker@1.1.1/lib/vanilla-masker.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
        Pusher.logToConsole = false;
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
        $("#form_browser_notification").submit(function (e) {
          e.preventDefault();
          const form = $("#form_browser_notification");
          $.ajax({
            type: "GET",
            url: form.attr("action"),
            data: form.serialize(),
            success: function (data) { 
              console.log(data);
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
      document.addEventListener('livewire:load',function(){
        $('.select2').select2();
      });
    </script>

    @include('companies.show_modal')
    <input type="hidden" id="txt_user_id" value="{{ Auth::user()->id }}" />
    <input type="hidden" id="txt_rol_user_id" value="{{ Auth::user()->rol_user_id }}" />
    <style>
    .comment-box-modal{
            background:url({{ asset('img/background_black_red.jpg')}});
            width: 100%;
            height: 400px;
            overflow: hidden;
            overflow-y:scroll;
        }
    </style>
</body>
</html>
