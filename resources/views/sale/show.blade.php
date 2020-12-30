@extends('layouts.app')
@section('content')
<h4 class="title_page text-center">
    @if($sale->status == 'Pendiente')
    Cotización:
    @else
    {{ $sale->status }}:
    @endif
    {{ $sale->id }}
    {{ $sale->description }}
</h4>
<h5 class="text-center">{{ $sale->company['name'] }}</h5>
<!--
<span class="float-right title_page">
    Autor: 
    {{ $sale->author['name'] }} 
    {{ $sale->author['middle_name'] }} 
    {{ $sale->author['last_name'] }}
</span>
-->
<center>
    <table class="table" border="1">
        <tr>
            <td style="padding:5px;">
                <b>Encargado</b>
            </td>
            <td style="padding:5px;">{{ $sale->department['manager'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px;">
                <b>Departamento</b>
            </td>
            <td style="padding:5px;">{{ $sale->department['name'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px;">
                <b>Télefono</b>
            </td>
            <td style="padding:5px;">{{ $sale->department['phone'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px;">
                <b>Email</b>
            </td>
            <td style="padding:5px;">{{ $sale->department['email'] }}</td>
        </tr>
    </table>
</center>
<center>
    <table class="table" border="1">
        <tr>
            <td colspan="3" style="padding:5px;">
                <center>
                    <label>
                        {{ $sale->author['name'] }}
                        {{ $sale->author['middle_name'] }}
                        {{ $sale->author['last_name'] }}
                    </label>
                </center>
            </td>
        </tr>
        <tr>
            <td style="padding:5px;">
                <center>
                    <span onclick="mostrarCotizacion(0);" class="icon-file-pdf" style="cursor:pointer;"> Ver
                        cotización</span>
                </center>
            </td>
            <td style="padding:5px;">
                <center>
                    <span onclick="solicitarRetiro(0);" class="icon-credit-card" style="cursor:pointer;"> Solicitar
                        retito</span>
                </center>
            </td>
            <td style="padding:5px;">
                <center>
                    <span onclick="comentariosVenta(0);" class="icon-bubble2" style="cursor:pointer;">
                        Seguimientos</span>
                </center>
            </td>
        </tr>
    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="4" style="background-color:#d30035;color:white;font-weight:bold;">
                <label style="float:right;padding:5px;">
                    <span onclick="editarProyecto(0);" class="icon-pencil"
                        style="cursor:pointer;color:white;" title="Editar proyecto...">
                    </span>
                </label>
                <center><label>Cotizado</label></center>
            </td>
        </tr>
        <tr>
            <td>
                <b>Compra</b>
                <span title="Cantidad que se pretende invertir en este proyecto..." class="icon-info"></span>
            </td>
            <td>
                <b>Venta</b>
                <span title="Cantidad en la que se le ofreció al cliente..." class="icon-info"></span>
            </td>
            <td colspan="2">
                <b>Utilidad proyectada</b>
                <span title="Utilidad esperada en este proyecto..." class="icon-info"></span>
            </td>
        </tr>
        <tr>
            <td>${{ $sale->investment }}</td>
            <td>${{ $sale->estimated}}</td>
            <td colspan="2">${{ $sale->utility }}</td>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="background-color:#d30035;color:white;font-weight:bold;">
                <center><label>Real</label></center>
            </td>
        </tr>
        <tr>
            <td>
                <b>Total compras</b>
                <span title="Cantidad que se ha invertido hasta el momento..." class="icon-info"></span>
            </td>
            <td>
                <b>Utilidad bruta</b>
                <span title="Utilidad bruta generada según el total de compras hasta el momento..."
                    class="icon-info"></span>
            </td>
            <td>
                <b>Comisión
                    <input type="hidden" id="txt_change_commision_route" value="{{ route('change_commision') }}">
                    <select onchange="changeCommision(this.value,{{ $sale->id }});" style="width:50%;">
                        @if($sale->commision_percent == '0')
                        <option value="0" selected>0%</option>
                        <option value="8">8%</option>
                        <option value="13">13%</option>
                        @endif
                        @if($sale->commision_percent == '8')
                        <option value="0">0%</option>
                        <option value="8" selected>8%</option>
                        <option value="13">13%</option>
                        @endif
                        @if($sale->commision_percent == '13')
                        <option value="0">0%</option>
                        <option value="8">8%</option>
                        <option value="13" selected>13%</option>
                        @endif
                    </select>
                </b>
            </td>
            <td><b>Utilidad <label>-</label> Comisión</b></td>
        </tr>
        <tr>
            <td>${{ $totalSell }}</td>
            <td>${{ $grossProfit }} - IVA = {{ $grossNoIvaProfit }}</td>
            <td>${{ $commision }}</td>
            <td>${{ $grossNoIvaProfitNoCommision }}</td>
        </tr>
        <tr>
            <td colspan="4" style="word-wrap:break-word;"><b>Observaciones/Material:</b>{{ $sale->material }}</td>
        </tr>
    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="4" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Pagos</label>
                    <label style="float:right;padding:5px;"><span onclick="agregarPago(0);" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar pago..."></span></label>
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Descripción</b></td>
            <td><b>Monto</b></td>
            <td><b>Comprobante</b></td>
        </tr>

    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="2" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Archivos</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="agregarArchivoProyecto(0);" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar archivo..."></span></label>
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Descripción</b></td>
            <td><b>Archivo</b></td>
        </tr>

    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="9" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Retiros</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="agregarArchivoProyecto(0);" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Solicitar retiro..."></span></label>
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Proveedor</b></td>
            <td><b>Descripción</b></td>
            <td><b>Cuenta</b></td>
            <td><b>Departamento</b></td>
            <td><b>Tipo de retiro</b></td>
            <td><b>Cantidad</b></td>
            <td><b>Estatus</b></td>
            <td><b>Documento</b></td>
        </tr>
        @foreach($whitdrawals as $whitdrawal)
        <tr>
            <td>{{ onlyDate($whitdrawal->created_at) }}</td>
            <td>{{ $whitdrawal->provider['name'] }}</td>
            <td>{{ $whitdrawal->description }}</td>
            <td>{{ $whitdrawal->account['name'] }}</td>
            <td>{{ $whitdrawal->department['name'] }}</td>
            <td>{{ $whitdrawal->type }}</td>
            <td>{{ $whitdrawal->quantity }}</td>
            <td>{{ $whitdrawal->status }}</td>
            <td>{{ $whitdrawal->document }}</td>
        </tr>
        @endforeach
    </table>
</center>

<!--
<table class="table table-dark">
    <thead>
        <tr>
            <th colspan="4" class="title_page" style="background-color:white;">
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
            <th colspan="5" class="title_page" style="background-color:white;">
                <div class="float-right">
                    <a href="{{ route('edit_sale',$sale->id) }}" style="padding:5px;"><span class="icon icon-pencil"></span></a>
                    @if(Auth::user()->rol_user_id == 1)
                    <a href="#" style="padding:5px;"><span class="icon icon-bin"></span></a>
                    @endif
                </div>
                <h5 class="font-weight-bold">Detalles</h5>
            </th>
        </tr>
        <tr>
            <th colspan="3">
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
                IVA
                <span onclick="msg('Info',this.title);" title="IVA que se cobrará con base a la venta." class="icon icon-info info-click"></span>
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
            <td>${{ $sale->iva }}</td>
            <td>{{ $sale->currency }}</td>
        </tr>
        <tr>
            <th>
                Deadline
                <span onclick="msg('Info',this.title);" title="Fecha límite para entregar el proyecto." class="icon icon-info info-click"></span>
            </th>
            <th>
                Comisión %
                <span onclick="msg('Info',this.title);" title="Porcentaje de comisión para el autor." class="icon icon-info info-click"></span>
            </th>
            <th>
                Comisión $
                <span onclick="msg('Info',this.title);" title="Comisión estimada con base a la cotización." class="icon icon-info info-click"></span>
            </th>
            <th>
                Envio
                <span onclick="msg('Info',this.title);" title="Indica si el proyecto contará con envio." class="icon icon-info info-click"></span>
            </th>
            <th>
                Crédito
                <span onclick="msg('Info',this.title);" title="Indica si el proyecto contará con un crédito." class="icon icon-info info-click"></span>
            </th>
        </tr>
        <tr>
            <td>{{  formatDate($sale->deadline) }}</td>
            <td>{{ $sale->commision_percent }}%</td>
            <td>${{ $sale->commision_pay }}</td>
            <td>{{ $sale->shipping }}</td>
            <td>{{ $sale->credit }}</td>
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
        @if(count($products) <= 0)
        <tr><td colspan="9">No hay productos aún</td></tr>
        @endif
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
        <tr><td colspan="3">No hay documentos aún</td></tr>
        @endif
    </tbody>
</table>
-->
@endsection