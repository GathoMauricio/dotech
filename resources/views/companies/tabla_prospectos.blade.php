<br>
{{ $prospectos->links('pagination::bootstrap-4') }}
<table class="table table-stripped">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Cliente</th>
            <th>Enacargado</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prospectos as $prospecto)
            <tr>
                <td>{{ $prospecto->origin }}</td>
                <td>{{ $prospecto->name }}</td>
                <td>{{ $prospecto->responsable }}</td>
                <td>{{ $prospecto->email }}</td>
                <td>{{ $prospecto->phone }}</td>
                <td>{{ $prospecto->address }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
