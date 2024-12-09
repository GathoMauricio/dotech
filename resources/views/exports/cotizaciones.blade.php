<table>
    <thead>
        <tr>
            <th>Cotización</th>
            <th>Compañía</th>
            <th>Descripción</th>
            <th>Divisa</th>
            <th>Precio + IVA</th>
            {{--  <th>Inversión</th>  --}}
            <th>Fecha cotización</th>
            <th>Proyecto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cotizaciones as $ticket)
            <tr>
                <td>{{ $ticket->folio_cotizacion }}</td>
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
                <td>{{ onlyDate($ticket->created_at) }}</td>
                <td>
                    @if ($ticket->project_at)
                        {{ $ticket->folio_proyecto }}
                    @else
                        N|A
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
