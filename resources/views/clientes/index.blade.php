@extends('layouts.app')

@section('content')
    <a href="{{ route('exportar_ultimos_seguimientos') }}" target="_BLANK" class="float-right">
        <i class="icon icon-download"></i>
        Exportar últimos
        seguimientos
    </a>
    <div class="container">
        <div class="row justify-content-center">
            <h3>Catálogo de clientes</h3>
            <div class="col-md-12">
                {{--  <a href="{{ url('create_cliente') }}" class="btn btn-primary float-right">Nuevo</a>  --}}
                {{ $clientes->links('pagination::bootstrap-4') }}
                <div class="table-responsive">
                    <br>
                    <select class="select2 form-control" onchange="verCliente(this.value)">
                        <option value>--Buscar cliente--</option>
                        @foreach ($clientes_all as $key => $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Origen</th>
                                <th>Porcentaje</th>
                                <th>Nombre</th>
                                <th>Responsable</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Fecha de cliente</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $key => $cliente)
                                <tr>
                                    <td>{{ $cliente->origin }}</td>
                                    <td>
                                        {{ $cliente->porcentaje }}%
                                        <br>
                                        Vendedor: <br>
                                        {{ $cliente->vendedor->name }}
                                        {{ $cliente->vendedor->middle_name }}
                                        {{ $cliente->vendedor->last_name }}
                                    </td>
                                    <td>{{ $cliente->name }}</td>
                                    <td>{{ $cliente->responsable }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->phone }}</td>
                                    <td>{{ $cliente->fecha_cliente }}</td>
                                    <td>
                                        <a href="{{ route('clientes.show', $cliente->id) }}">Abrir</a><br>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function verCliente(cliente_id) {
            if (cliente_id.length > 0)
                window.location = "{{ url('clientes.show') }}/" + cliente_id;
        }
    </script>
@endsection
