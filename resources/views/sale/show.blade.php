@extends('layouts.app')
@section('content')
<h4 class="title_page text-center">
    @if($sale->status == 'Pendiente')
    Cotización:
    @else
    {{ $sale->status }}:
    @endif
    <br>
    {{ $sale->description }} 
</h4>
<span class="float-right title_page">
    Autor: 
    {{ $sale->author['name'] }} 
    {{ $sale->author['middle_name'] }} 
    {{ $sale->author['last_name'] }}
</span>
<table class="table table-dark" id="companyTableShow" style="display:none;">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
                <span onclick="showCompany();" class="icon icon-enlarge2 float-right"></span>
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
    <div>
    <tbody>
        <tr>
            <td>{{ $sale->department['name'] }}</td>
            <td>{{ $sale->department['manager'] }}</td>
            <td>{{ $sale->department['phone'] }}</td>
            <td>{{ $sale->department['email'] }}</td>
        </tr>
    </tbody>
    </div>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Detalles</h5>
            </th>
        </tr>
        <tr>
            <th colspan="2">
                <span class="font-weight-bold">Observaciones: </span>
                @if(empty($sale->observation))
                N/A
                @else
                {{ $sale->observation }}
                @endif
            </th>
            <th colspan="2">
                <span class="font-weight-bold">Material: </span>
                @if(empty($sale->material))
                N/A
                @else
                {{ $sale->material }}
                @endif
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
            <th>
                Divisa
                <span onclick="msg('Info',this.title);" title="Divisa seleccionada." class="icon icon-info info-click"></span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>${{ $sale->investment }}</td>
            <td>${{ $sale->estimated }}</td>
            <td>${{ $sale->utility }}</td>
            <td>{{ $sale->currency }}</td>
        </tr>
    </tbody>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="8" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Productos</h5>
            </th>
        </tr>
        <tr>
            <th>Cant</th>
            <th>Descripción</th>
            <th>P/U Compra</th>
            <th>P/U Venta</th>
            <th>Desc</th>
            <th>Total Compra</th>
            <th>Total Venta</th>
            <th>Utilidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->description }}</td>
            <td>${{ $product->unity_price_buy }}</td>
            <td>${{ $product->unity_price_sell }}</td>
            <td>{{ $product->discount }}</td>
            <td>${{ $product->total_buy }}</td>
            <td>${{ $product->total_sell }}</td>
            <td>${{ $product->utility }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="9" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Retiros</h5>
            </th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Descripción</th>
            <th>Cuenta</th>
            <th>Departamento</th>
            <th>Tipo de retiro</th>
            <th>Cantidad</th>
            <th>Estatus</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($whitdrawals as $whitdrawal)
        <tr>
            <td>{{ formatDate($whitdrawal->created_at) }}</td>
            <td>{{ $whitdrawal->provider['name'] }}</td>
            <td>{{ $whitdrawal->description }}</td>

            @if(empty($whitdrawal->account['name']))
            <td>No definida</td>
            @else
            <td>{{ $whitdrawal->account['name'] }}</td>
            @endif

            <td>{{ $whitdrawal->department['name'] }}</td>
            <td>{{ $whitdrawal->type }}</td>
            <td>${{ $whitdrawal->quantity }}</td>
            <td>{{ $whitdrawal->status }}</td>
            @if($whitdrawal->invoive == 'SI')
                @if(empty($whitdrawal->document))
                <td>No subido aún</td>
                @else
                <td><a href="#">{{ $whitdrawal->document }}</a></td>
                @endif
            @else
                N/A
            @endif
        </tr>
        @endforeach
        @if(count($whitdrawals) <= 0)
        <tr><td colspan="9">No hay retiros aún</td></tr>
        @endif
    </tbody>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Pagos</h5>
            </th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Comprobante</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ formatDate($payment->created_at) }}</td>
            <td>{{ $payment->description }}</td>
            <td>${{ $payment->amount }}</td>
            <td>{{ $payment->document }}</td>
        </tr>
        @endforeach
        @if(count($payments) <= 0)
        <tr><td colspan="4">No hay pagos aún</td></tr>
        @endif
    </tbody>
</table>
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="3" class="title_page" style="background-color:white;">
                <h5 class="font-weight-bold">Documnetos</h5>
            </th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Enlace</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documents as $documnet)
        <tr>
            <td>{{ formatDate($documnet->created_at) }}</td>
            <td>{{ $documnet->description }}</td>
            <td>{{ $documnet->document }}</td>
        </tr>
        @endforeach
        @if(count($documents) <= 0)
        <tr><td colspan="3">No hay documnetos aún</td></tr>
        @endif
    </tbody>
</table>
@endsection