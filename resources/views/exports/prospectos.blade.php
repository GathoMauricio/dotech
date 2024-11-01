<table>
    <thead>
        <tr>
            <th>Folio</th>
            <th>Name</th>
            <th>como se entero</th>
            <th>requerimiento</th>
            <th>cliente</th>
            <th>cotizado</th>
            <th>status cotizacion</th>
            <th>status cliente</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cotizaciones as $key => $cotizacion)
            <tr>
                <td>{{ $cotizacion->folio_cotizacion }}</td>
                <td>{{ $cotizacion->company->origin }}</td>
                <td>{{ $cotizacion->description }}</td>
                <td>{{ $cotizacion->company->name }}</td>
                <td>${{ $cotizacion->estimated }}</td>
                <td>{{ $cotizacion->status }}</td>
                <td>{{ $cotizacion->company->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
