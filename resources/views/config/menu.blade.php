<!--
<p class="text-right">
    <a href="{{ route('config_index') }}"><span class="icon-home"></span> Inicio</a>
    &nbsp;&nbsp;
    <a href="{{ route('provider_index') }}"><span class="icon-cart"></span> Proveedores de retiro</a>
    &nbsp;&nbsp;
    @if (Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2)
<a href="{{ route('index_department') }}"><span class="icon-tree"></span> Departamentos de retiro</a>
    &nbsp;&nbsp;
    <a href="{{ route('index_account') }}"><span class="icon-credit-card"></span> Cuentas de retiro</a>
    &nbsp;&nbsp;
    <a href="{{ route('log_index') }}"><span class="icon-database"></span> Log</a>
    &nbsp;&nbsp;
    <a href="{{ route('index_user') }}"><span class="icon-users"></span> Usuarios</a>
    &nbsp;&nbsp;
@endif
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <span class="icon-exit"></span> Cerrar sesión
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </a>
</p>
-->
