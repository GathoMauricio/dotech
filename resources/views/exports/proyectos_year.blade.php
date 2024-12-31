<table>
    <thead>
        <tr>
            <th>Proyecto</th>
            <th>Compañía</th>
            <th>Descripción</th>
            <th>Divisa</th>
            <th>Precio + IVA</th>
            {{--  <th>Inversión</th>  --}}
            <th>Retiros aprobados</th>
            <th>Utilidad</th>
            <th>Fecha de cotización</th>
            <th>Fecha proyecto</th>
            <th>Cotización</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyectos as $ticket)
            @php
                $total_retiros = 0;
                foreach ($ticket->retiros as $retiro) {
                    if ($retiro->status == 'Aprobado') {
                        $total_retiros += $retiro->quantity;
                    }
                }
            @endphp
            <tr>
                <td>{{ $ticket->folio_proyecto }}</td>
                <td>{{ $ticket->company->name }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->currency }}</td>
                @if ($ticket->status == 'Pendiente')
                    <td>${{ number_format($ticket->estimated, 2) }}</td>
                @else
                    @php
                        $iva = ($ticket->estimated * 16) / 100;
                        $total = $ticket->estimated + $iva;
                    @endphp
                    <td>${{ number_format($total, 2) }}</td>
                @endif
                {{--  <td>${{ number_format($ticket->investment, 2) }}</td>  --}}
                <td>${{ number_format($total_retiros, 2) }}</td>

                @if ($ticket->status == 'Pendiente')
                    <td>${{ number_format($ticket->estimated - $total_retiros, 2) }}</td>
                @else
                    @php
                        $iva = ($ticket->estimated * 16) / 100;
                        $total = $ticket->estimated + $iva;
                    @endphp
                    <td>${{ number_format($total - $total_retiros, 2) }}</td>
                @endif

                {{--  <td>${{ number_format($ticket->estimated - $total_retiros, 2) }}</td>  --}}
                <td>{{ onlyDate($ticket->created_at) }}</td>
                <td>{{ onlyDate($ticket->project_at) }}</td>
                <td>{{ $ticket->folio_cotizacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
