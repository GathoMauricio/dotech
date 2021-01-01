<p class="text-right">
    <a href="{{ route('config_index') }}"><span class="icon-home"></span> Inicio</a>
    &nbsp;&nbsp;
    <a href="#"><span class="icon-cart"></span> Proveedores de retiro</a>
    &nbsp;&nbsp;
    @if(Auth::user()->rol_user_id == 1)
    <a href="#"><span class="icon-tree"></span> Departamentos de retiro</a>
    &nbsp;&nbsp;
    <a href="#"><span class="icon-credit-card"></span> Cuentas de retiro</a>
    &nbsp;&nbsp;
    <a href="{{ route('log_index') }}"><span class="icon-database"></span> Log</a>
    &nbsp;&nbsp;
    <a href="#"><span class="icon-users"></span> Usuarios</a>
    &nbsp;&nbsp;
    @endif
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <span class="icon-exit"></span> Carrar sesión
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </a>
</p>