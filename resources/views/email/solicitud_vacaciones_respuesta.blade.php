Su solicitud de {{ $vacacion->tipo }} con motivo: <i>"{{ $vacacion->motivo }}"</i> ha sido {{ $vacacion->estatus }}
@if ($vacacion->estatus == 'denegado')
    <br><br><br>
    Motivo: {{ $vacacion->motivo_denegado }}
@endif
