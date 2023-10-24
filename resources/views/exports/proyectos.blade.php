<table>
    <thead>
        <tr>
            <th>Proyecto</th>
            <th>Compañía</th>
            <th>Descripción</th>
            <th>Divisa</th>
            <th>Precio</th>
            <th>Inversión</th>
            <th>Fecha de cotización</th>
            <th>Fecha proyecto</th>
            <th>Cotización</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyectos as $ticket)
            <tr>
                <td>{{ $ticket->folio_proyecto }}</td>
                <td>{{ $ticket->company->name }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->currency }}</td>
                <td>${{ number_format($ticket->estimated, 2) }}</td>
                <td>${{ number_format($ticket->investment, 2) }}</td>
                <td>{{ onlyDate($ticket->created_at) }}</td>
                <td>{{ onlyDate($ticket->project_at) }}</td>
                <td>{{ $ticket->folio_cotizacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
