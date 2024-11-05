<table>
    <thead>
        <tr>
            <th>Estatus</th>
            <th>Nombre</th>
            <th>Vendedor asignado</th>
            <th>Fecha</th>
            <th>Autor</th>
            <th>Último seguimiento</th>
            <th>Hace</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            @php
                $item = App\CompanyFollow::where('company_id', $cliente->id)
                    ->orderBy('created_at', 'DESC')
                    ->first();
            @endphp
            @if ($item)
                @php
                    $toDate = Carbon\Carbon::parse($item->created_at);
                    $fromDate = Carbon\Carbon::parse(date('Y-m-d'));
                    $dias = $toDate->diffInDays($fromDate);
                @endphp
                {{--  @if ($dias >= 30)  --}}
                @if (1)
                    <tr>
                        <td>{{ $item->company->status }}</td>
                        <td>{{ $item->company->name }}</td>
                        <td>{{ $item->company->vendedor->name }} {{ $item->company->vendedor->middle_name }}
                            {{ $item->company->vendedor->last_name }}</td>
                        <td>{{ explode(' ', $item->created_at)[0] }}</td>
                        <td>
                            {{ $item->author->name . ' ' . $item->author->middle_name . ' ' . $item->author->last_name }}
                        </td>
                        <td>{{ $item->body }}</td>
                        <td>{{ $dias }} Días</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td>{{ $cliente->status }}</td>
                    <td>{{ $cliente->name }}</td>
                    <td>0</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>SIN SEGUIMIENTOS</td>
                    <td>N/A</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
