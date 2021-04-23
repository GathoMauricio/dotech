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

<table style="width:100%;">
    <tr>
        <td onclick="showCotizadoTab('cotizado');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Cotizado
        </td>
        <td onclick="showCotizadoTab('productos');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Productos
        </td>
        <td onclick="showCotizadoTab('pagos');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Pagos
        </td>
        <td onclick="showCotizadoTab('archivos');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Archivos
        </td>
        <td onclick="showCotizadoTab('retiros');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Retiros
        </td>
        <td onclick="showCotizadoTab('bitacoras');" class="text-center font-weight-bold" style="background-color:#d30035;color:white;cursor:pointer;">
            Bitacoras
        </td>
    </tr>
</table>
<br/>
<div id="cotizado_container_tab">
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
                <b>Retiros</b>
                <span title="Inversión hasta el momento..." class="icon-info"></span>
            </td>
            <td>
                <b>Costo del proyecto</b>
                <span title="Costo total del proyecto..." class="icon-info"></span>
            </td>
            <td>
                <b>Utilidad</b>
                <span title="Utilidad generada hasta el momento..." class="icon-info"></span>
            </td>
            <td>
                <b>Comisión</b>
                <span title="Comisión para el vendedor hasta el momento..." class="icon-info"></span>
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
            </td>
        </tr>
        <tr>
            <td>${{ $totalRetiros }}</td>
            <td>${{ $costoProyecto }}</td>
            <td>${{ $utilidad }}</td>
            <td>${{ $comision }}</td>
        </tr>
        <!--
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
        -->
        <tr>
            <td colspan="4" style="word-wrap:break-word;"><b>Observaciones:</b> {{ $sale->observation }}</td>
        </tr>
    </table>
</div>
<div id="productos_container_tab" style="display:none;">
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
</div>
<div id="pagos_container_tab" style="display:none;">
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
</div>
<div id="archivos_container_tab" style="display:none;">
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
</div>
<div id="retiros_container_tab" style="display:none;">
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
    </table>
    <table class="table" border="5" id="index_table_retiros">
        <thead>
            <tr>
                <th><b>Fecha</b></th>
                <th><b>Proveedor</b></th>
                <th><b>Descripción</b></th>
                <th><b>Cuenta</b></th>
                <th><b>Departamento</b></th>
                <th><b>Tipo de retiro</b></th>
                <th><b>Cantidad</b></th>
                <th><b>Estatus</b></th>
                <th><b>Documento</b></th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
        @if(count($whitdrawals)<=0)
        <tr><td colspan="9" class="text-center">Sin registros</td></tr>
        @endif
    </table>
</div>
<div id="bitacoras_container_tab" style="display:none;">
    <table class="table" border="5">
        <tr>
            <td colspan="6" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Bitácoras</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addBinnacle({{ $sale->id }});" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar bitácora..."></span></label>
                    <!--
                    <br/>
                    <a href="#" onclick="sendBinnacleAll({{ $sale->id }})" style="color:white;"><span class="icon-envelop"></span> Enviar todas las bitácoras</a>
                    -->
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Autor</b></td>
            <td><b>Descripción</b></td>
            <td><b>Firma</b></td>
            <td><b>Observaciones</b></td>
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
            <td>{{ $binnacle->feedback }}</td>
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
        <tr><td colspan="6" class="text-center">Sin registros</td></tr>
        @endif
    </table>
</div>
    @if($sale->status == 'Finalizado')
    <h3 class="font-weight-bold" style="color:green">[Proyecto finalizado]</h3>
    @else
    <a href="#" onclick="setProjectAsFinish({{ $sale->id }})" class="font-weight-bold link-sys">[Marcar proyecto como finalizado]</a>
    @endif
    <br/>
    <input type="hidden" id="txt_get_binnacle" value="{{ route('binnacle_show_json') }}">
    <input type="hidden" id="txt_get_project_data" value="{{ route('show_quote_ajax') }}">
    <input type="hidden" id="txt_show_binnacle_image_route" value="{{ route('show_binnacle_image') }}">
    <input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}">
    <input type="hidden" id="txt_set_project_as_finish" value="{{ route('set_project_as_finish')}}">
</center>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        $("#index_table_retiros").dataTable({
                deferRender: true,
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [],
                pageLength: 10,
                bDestroy: true,
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [0,8]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            setTableStyle()
    });
    function setTableStyle() {
        setTimeout(function() {
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "custom-select"
            );
            $(".dataTables_length").prepend("<b>Mostrar</b> ");
            $("select[name='table_asistencias_length']").prop(
                "class",
                "custom-select"
            );
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "form-control"
            );
            $(".dataTables_length").append(" <b>elementos por página</b>");
    
            $("input[type='search']").prop("class", "form-control");
            $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
        }, 300);
    }
</script>
@include('sale.send_binnacle_pdf_modal')
@include('sale.send_all_binnacle_pdf_modal')
@include('withdrawal.add_provider_modal')
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_binnacle_modal')
@include('sale.add_binnacle_image_modal')
@include('sale.add_whitdrawal_document_modal')
@include('sale.add_sale_payment_modal')
@include('sale.add_sale_document_modal')
@include('sale.add_sale_whitdrawal_modal')

@endsection