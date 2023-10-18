<table>
    <thead>
        <tr>
            <th>Proyecto</th>
            <th>Compañía</th>
            <th>Descripción</th>
            <th>Divisa</th>
            <th>Precio</th>
            <th>Inversión</th>
            <th>Fecha finalizado</th>
            <th>Cotización</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($finalizados as $ticket)
            <tr>
                <td>{{ $ticket->folio_proyecto }}</td>
                <td>{{ $ticket->company->name }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->currency }}</td>
                <td>${{ number_format($ticket->estimated, 2) }}</td>
                <td>${{ number_format($ticket->investment, 2) }}</td>
                <td>{{ onlyDate($ticket->finished_at) }}</td>
                <td>{{ $ticket->folio_cotizacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
