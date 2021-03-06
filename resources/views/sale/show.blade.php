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
                    <a href="{{ route('load_sale_pdf',$sale->id) }}" target="_BLANK">
                        <span class="icon-file-pdf" style="cursor:pointer;">
                            Ver cotización
                        </span>
                    </a>
                </center>
            </td>
            <td style="padding:5px;">
                <center>
                    <a href="#">
                        <span onclick="addSaleWhitdrawal({{ $sale->id }});" class="icon-credit-card" style="cursor:pointer;">
                            Solicitar retito
                        </span>
                    </a>
                </center>
            </td>
            <td style="padding:5px;">
                <center>
                    <a href="{{ route('sale_follows',$sale->id) }}" target="_BLANK">
                        <span class="icon-bubble2" style="cursor:pointer;">
                            Seguimientos
                        </span>
                    </a>
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
            
            <td>
                <b>Comisión
                    <input type="hidden" id="txt_change_commision_route" value="{{ route('change_commision') }}">
                    @if(Auth::user()->rol_user_id == 1)
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
                    @endif
                </b>
            </td>
            <td>
                <b>Venta + IVA</b>
                <span title="Utilidad bruta generada según el total de compras hasta el momento..."
                    class="icon-info"></span>
            </td>
            <td><b>Utilidad <label>-</label> Comisión</b></td>
        </tr>
        <tr>
            <td>${{ $commision }}</td>
            <td>${{ $sale->estimated}} + ${{ $sale->iva}} = ${{ $sale->estimated + $sale->iva }}</td>
            <td>${{$sale->utility}} - ${{ $commision }} = ${{ $sale->utility - $commision }}</td>
        </tr>
        <tr>
            <td colspan="4" style="word-wrap:break-word;"><b>Observaciones/Material:</b> {{ $sale->observation }}</td>
        </tr>
    </table>

    <table class="table" border="5">
        <thead>
            <tr>
                <td colspan="6" style="background-color:#d30035;color:white;font-weight:bold;">
                <!--
                    <label style="float:right;padding:5px;">
                        <span class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar producto...">
                        </span>
                    </label>
                -->
                    <center><label>Productos</label></center>
                </td>
            </tr>
            <tr>
                <th>Cant</th>
                <th>U. Medida</th>
                <th>Producto</th>
                <th>P/U</th>
                <th>Descuento</th>
                <th>Venta</th>
                <!--<th></th>-->
            </tr>
        </thead>
        <tbody>
            @php
            $totalProduct = 0;
            $totalProductIva = 0;
            @endphp
            @foreach($products as $product)
            @php
            $totalProduct += $product->total_sell;
            $totalProductIva = ($totalProduct * 16) / 100;
            @endphp
            <tr>
                <td>{{ $product->quantity }}</td>
                <td>
                    @if(!empty($product->measure))
                    {{ $product->measure }}
                    @else
                    N/A
                    @endif
                </td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->unity_price_sell }}</td>
                <td>{{ $product->discount }}%</td>
                <td>${{ $product->total_sell }}</td>
                <!--
                <td>
                    <span onclick="editProductModal({{ $product->id }})" class="icon-pencil" style="cursor:pointer;color:#F39C12;"></span>
                    <br>
                    <span onclick="deleteProductModal({{ $product->id }})" class="icon-bin" style="cursor:pointer;color:#E74C3C ;"></span>
                </td>
                -->
            </tr>
            @endforeach
            @if(count($products)<=0)
            <tr><td colspan="6" class="text-center">Sin registros</td></tr>
            @endif
            <tr>
                <td colspan="6" class="text-right">Subtotal: ${{ $totalProduct }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">IVA: ${{ $totalProductIva }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">Total: ${{ $totalProduct+$totalProductIva }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="4" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Pagos</label>
                    <label style="float:right;padding:5px;"><span onclick="addSalePaymentModal({{ $sale->id }});" class="icon-plus"
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
        @foreach($payments as $payment)
        <tr>
            <td>{{ formatDate($payment->created_at) }}</td>
            <td>{{ $payment->description }}</td>
            <td>{{ $payment->amount }}</td>
            @if(!empty($payment->document))
            <td class="text-center"><a href="{{ env('APP_URL').'/storage/'.$payment->document }}" target="_BLANK"><span class="icon-eye"></span></a></td>
            @else 
            <td class="text-center"><a href="#"><span class="icon-upload"></span></a></td>
            @endif
        </tr>
        @endforeach
        @if(count($payments)<=0)
        <tr><td colspan="4" class="text-center">Sin registros</td></tr>
        @endif
    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="3" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Archivos</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addSaleDocumentModal({{ $sale->id }});" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar archivo..."></span></label>
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Descripción</b></td>
            <td><b>Archivo</b></td>
        </tr>
        @foreach($documents as $document)
        <tr>
            <td>{{ formatDate($document->created_at) }}</td>
            <td>{{ $document->description }}</td>
            <td class="text-center"><a href="{{ env('APP_URL').'/storage/'.$document->document }}" target="_BLANK"><span class="icon-eye"></span></a></td>
        </tr>
        @endforeach
        @if(count($documents)<=0)
        <tr><td colspan="3" class="text-center">Sin registros</td></tr>
        @endif
    </table>

    <table class="table" border="5">
        <tr>
            <td colspan="9" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Retiros</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addSaleWhitdrawal({{ $sale->id }});" class="icon-plus"
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
            @if(!empty( $whitdrawal->account['name']))
            <td>{{ $whitdrawal->account['name'] }}</td>
            @else
            <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60"></td>
            @endif
            @if(!empty( $whitdrawal->department['name']))
            <td>{{ $whitdrawal->department['name'] }}</td>
            @else
            <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60"></td>
            @endif
            @if(!empty( $whitdrawal->type))
            <td>{{ $whitdrawal->type }}</td>
            @else
            <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60"></td>
            @endif
            <td>${{ $whitdrawal->quantity }}</td>
            <td>
                {{ $whitdrawal->status }}
                @if(Auth::user()->rol_user_id == 1 && $whitdrawal->status == 'Pendiente')
                <br/>
                <a href="#" onclick="aproveWithdrawalModal({{ $whitdrawal->id }});"><span class="icon-checkmark"></span> Aprobar</a>
                @endif
            </td>
            @if($whitdrawal->invoive == 'SI')
            @if(!empty($whitdrawal->document))
                <td class="text-center"><a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span></a></td>
                @else 
                <td class="text-center"><a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span></a></td>
                @endif
            @else
            <td class="text-center">N/A</td>
            @endif
        </tr>
        @endforeach
        @if(count($whitdrawals)<=0)
        <tr><td colspan="9" class="text-center">Sin registros</td></tr>
        @endif
    </table>
    <table class="table" border="5">
        <tr>
            <td colspan="5" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Bitácoras</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addBinnacle({{ $sale->id }});" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar bitácora..."></span></label>
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Autor</b></td>
            <td><b>Descripción</b></td>
            <td><b>Firma</b></td>
            <td><b>Imágenes</b></td>
        </tr>
        @foreach($binnacles as $binnacle)
        <tr>
            <td>{{ formatDate($binnacle->created_at) }}</td>
            <td>{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
            <td>{{ $binnacle->description }}</td>
            <td>
                @if(!empty($binnacle->firm))
                <img src="{{ asset('storage') }}/{{ $binnacle->firm }}" width="80" height="80">
                
                @else
                <center>No disponible</center>
                @endif
            </td>
            <td>
                <a href="#" onclick="addBinnacleImage({{ $binnacle->id }})">
                    <span class="icon-plus" title="Agregar imagen..." style="cursor:pointer;color:#c52cec">
                        Nuevo
                    </span>
                </a>
                <br>
                <a href="#" onclick="viewBinnacleImages({{ $binnacle->id }},{{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }})">
                    <span class="icon-image" title="ver imágenes..." style="cursor:pointer;color:#2c49ec">
                        {{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }}
                        Imágenes
                    </span>
                </a>
                <br>
                <a href="{{ route('binnacle_pdf',$binnacle->id) }}" target="_blank">
                    <span class="icon-file-pdf" title="Ver pdf..." style="cursor:pointer;color:#ec422c">
                        PDF
                    </span>
                </a>
                <br>
                <a href="#" onclick="sendBinnacle({{ $binnacle->id }});">
                    <span class="icon-envelop" title="Enviar pdf..." style="cursor:pointer;color:#b3d420">
                        Enviar
                    </span>
                </a>
                <br>
            </td>
        </tr>
        @endforeach
        @if(count($binnacles)<=0)
        <tr><td colspan="5" class="text-center">Sin registros</td></tr>
        @endif
    </table>
    <input type="hidden" id="txt_get_binnacle" value="{{ route('binnacle_show_json') }}">
    <input type="hidden" id="txt_show_binnacle_image_route" value="{{ route('show_binnacle_image') }}">
    <input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}">
</center>
@include('sale.send_binnacle_pdf_modal')
@include('withdrawal.add_provider_modal')
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_binnacle_modal')
@include('sale.add_binnacle_image_modal')
@include('sale.add_whitdrawal_document_modal')
@include('sale.add_sale_payment_modal')
@include('sale.add_sale_document_modal')
@include('sale.add_sale_whitdrawal_modal')

@endsection