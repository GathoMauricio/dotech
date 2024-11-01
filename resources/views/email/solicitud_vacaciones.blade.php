{{ $vacacion->empleado->name . ' ' . $vacacion->empleado->middle_name . ' ' . $vacacion->empleado->last_name }}
a solicitado {{ $vacacion->dias }} dia(s) de {{ $vacacion->tipo }} con motivo: {{ $vacacion->motivo }} a partir del
{{ $vacacion->fecha_inicio }}
