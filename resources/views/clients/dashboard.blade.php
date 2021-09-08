login del cliente {{ auth('clients')->user()->name }} 
<hr/>
<a href = "{{ route('clients/logout') }}">Cerrar sesión</a