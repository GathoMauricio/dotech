@extends('layouts.app')
@section('content')
<h4 class="title_page text-center">
    @if($sale->status == 'Pendiente')
    Cotización:
    @else
    {{ $sale->status }}:
    @endif
    {{ $sale->description }} 
</h4>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
                <span class="float-right">
                    Autor: 
                    {{ $sale->author['name'] }} 
                    {{ $sale->author['middle_name'] }} 
                    {{ $sale->author['last_name'] }}
                </span>
                <h5 class="font-weight-bold">Compañía: {{ $sale->company['name'] }}</h5>
            </th>
        </tr>
        <tr>
            <th>Departamento</th>
            <th>Encargado</th>
            <th>Télefono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $sale->department['name'] }}</td>
            <td>{{ $sale->department['manager'] }}</td>
            <td>{{ $sale->department['phone'] }}</td>
            <td>{{ $sale->department['email'] }}</td>
        </tr>
    </tbody>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Detalles</h5>
            </th>
        </tr>
        <tr>
            <th>
                Inversión estimada 
                <span onclick="msg('Info',this.title);" title="Cantidad estimada que se pretende invertir." class="icon icon-info info-click"></span>
            </th>
            <th>
                Venta estimada
                <span onclick="msg('Info',this.title);" title="Precio que se le ofreció al cliente a la hora de enviarle la cotización." class="icon icon-info info-click"></span>
            </th>
            <th>
                Utilidad estimada
                <span onclick="msg('Info',this.title);" title="Utilidad que se pretende generar a partir de la inversión contra la ventana." class="icon icon-info info-click"></span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>${{ $sale->investment }}</td>
            <td>${{ $sale->estimated }}</td>
            <td>${{ $sale->utility }}</td>
        </tr>
    </tbody>
</table>
@endsection