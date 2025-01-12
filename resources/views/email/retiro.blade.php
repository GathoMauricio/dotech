Solicitud de retiro para el proyecto <strong>{{ $retiro->sale->description }}</strong>
<br>
Descripción: {{ $retiro->description }}
<br>
Cantidad: ${{ $retiro->quantity }}
<br>
Empleado: {{ $retiro->author->name }} {{ $retiro->author->middle_name }} {{ $retiro->author->last_name }}
