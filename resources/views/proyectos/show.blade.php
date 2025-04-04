@extends('layouts.app')

@section('content')
    @php
        $cliente = App\Company::findOrFail($proyecto->company_id);
        foreach ($cliente->cotizaciones_proyectos as $key => $historial) {
            $historial->commision_percent = $cliente->porcentaje;
            //$historial->commision_pay = 0; //Calcular porcentaje ganado
            $historial->save();
        }
    @endphp
    <div class="container">
        <h3 class="text-center">
            Folio:
            @if ($proyecto->status == 'Proyecto' || $proyecto->status == 'Finalizado')
                {{ $proyecto->folio_proyecto }}
            @else
                {{ $proyecto->folio_cotizacion }}
            @endif
        </h3>
        <div class="row">
            <div class="col-md-8 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                <h5>Detalles</h5>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Cliente</span>
                    </div>
                    <div class="col-md-6 p-2"><a
                            href="{{ route('clientes.show', $proyecto->cliente->id) }}">{{ $proyecto->cliente->name }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Encargado</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->departamento->manager }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Departamento</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->departamento->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Teléfono</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->departamento->phone }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Email</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->departamento->email }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Descripción</span>
                    </div>
                    <div class="col-md-6 p-2">
                        <a href="javascript:void(0)" onclick="actualizarDescripcion('{{ $proyecto->description }}');"
                            class="float-right"><span class="icon icon-pencil"></span></a>
                        {{ $proyecto->description }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Observaciones</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->observation }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 p-2">
                        <a href="{{ route('load_sale_pdf', $proyecto->id) }}" class="btn btn-primary" target="_BLANK">Ver
                            cotización</a>
                    </div>
                    <div class="col-md-4 p-2">
                        <a href="javascript:void(0)" onclick="solicitarRetiro();" class="btn btn-primary">Solicitar
                            retiro</a>
                    </div>
                    <div class="col-md-4 p-2">
                        <a href="javascript:void(0)" onclick="abrirSeguimientos({{ $proyecto->id }});"
                            class="btn btn-primary">({{ $proyecto->seguimientos->count() }})
                            Seguimientos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                <h5>Información</h5>
                {{--  <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Identificador interno</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->id }}</div>
                </div>  --}}
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Estatus</span>
                    </div>
                    <div class="col-md-6 p-2">
                        @if (Auth::user()->rol_user_id == 1)
                            <a href="javascript:void(0)" onclick="actualizarEstatus();_" class="float-right"><span
                                    class="icon icon-pencil"></span></a>
                        @endif
                        {{ $proyecto->status }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Fecha cotización</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->created_at }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Fecha proyecto</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->project_at }}</div>
                </div>
                @if ($proyecto->status == 'Finalizado')
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <span class="font-weight-bold">Fecha finalizado</span>
                        </div>
                        <div class="col-md-6 p-2">{{ $proyecto->finished_at }}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Precio de venta</span>
                    </div>
                    <div class="col-md-6 p-2">${{ $costoProyecto }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Utilidad</span>
                    </div>
                    <div class="col-md-6 p-2">${{ $utilidad }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Total en retiros</span>
                    </div>
                    <div class="col-md-6 p-2">${{ number_format($totalRetiros, 2) }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Comisión ({{ $proyecto->commision_percent }}%)</span>
                    </div>
                    <div class="col-md-6 p-2">${{ $comision }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_productos">N° de Productos</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->productos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_pagos">N° de Pagos</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->pagos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_archivos">N° de facturas</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->archivos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_retiros">N° de Retiros</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->retiros->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_bitacoras">N° de Bitácoras</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->bitacoras->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold"><a href="#row_transacciones">N° de Transacciones</a></span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->transacciones->count() }}</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                <div id="grafica_costos"></div>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_productos">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Productos</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <a href="{{ route('quote_products', $proyecto->id) }}"
                                    class="float-right btn btn-success"><span class="icon icon-pencil"></span> Editar</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Cant</th>
                            <th>U. Medida</th>
                            <th>Producto</th>
                            <th>P/U</th>
                            {{--  <th>Descuento</th>  --}}
                            <th>Total + IVA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if (!empty($product->measure))
                                        {{ $product->measure }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $product->description }}</td>
                                <td>${{ number_format($product->unity_price_sell, 2) }}</td>
                                {{--  <td>{{ $product->discount }}%</td>  --}}
                                <td>${{ number_format($product->total_sell, 2) }}</td>
                                <td>
                                    {{--  <span onclick="editProductModal({{ $product->id }})" class="icon-pencil"
                                        style="cursor:pointer;color:#F39C12;"></span>
                                    <br>
                                    <span onclick="deleteProductModal({{ $product->id }})" class="icon-bin"
                                        style="cursor:pointer;color:#E74C3C ;"></span>  --}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class="text-right">Total: ${{ number_format($totalMasIva, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_pagos">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Pagos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <a href="javascript:void(0)" onclick="agregarPago();"
                                    class="float-right btn btn-success"><span class="icon icon-plus"></span> Agregar</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->pagos as $pago)
                            <tr>
                                <td>{{ formatDate($pago->created_at) }}</td>
                                <td>{{ $pago->description }}</td>
                                <td>${{ number_format($pago->amount, 2) }}</td>
                                @if (!empty($pago->document))
                                    <td class="text-center"><a
                                            href="{{ 'http://dotech.dyndns.biz:16666/dotech/public/storage/' . $pago->document }}"
                                            target="_BLANK"><span class="icon-eye"></span></a></td>
                                @else
                                    <td class="text-center"><a href="#"><span class="icon-upload"></span></a></td>
                                @endif
                            </tr>
                        @endforeach
                        @if (count($proyecto->pagos) <= 0)
                            <tr>
                                <td colspan="4" class="text-center">Sin registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_archivos">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Facturas</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <a href="javascript:void(0)" onclick="agregarArchivo();"
                                    class="float-right btn btn-success"><span class="icon icon-plus"></span> Agregar</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Archivo</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->archivos as $archivo)
                            <tr>
                                <td>{{ formatDate($archivo->created_at) }}</td>
                                <td>{{ $archivo->description }}</td>
                                <td class="text-center"><a
                                        href="{{ 'http://dotech.dyndns.biz:16666/dotech/public//storage/' . $archivo->document }}"
                                        target="_BLANK"><span class="icon-eye"></span></a></td>
                            </tr>
                        @endforeach
                        @if (count($proyecto->archivos) <= 0)
                            <tr>
                                <td colspan="3" class="text-center">Sin registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_retiros">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Retiros</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Descripción</th>
                            <th>Cuenta</th>
                            <th>Departamento</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Estatus</th>
                            <th>Folio</th>
                            <th>Pagado</th>
                            <th>Transacciones</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->retiros as $retiro)
                            <tr>
                                <td>{{ onlyDate($retiro->created_at) }}</td>
                                <td>{{ $retiro->provider['name'] }}</td>
                                <td>{{ $retiro->description }}</td>
                                @if (!empty($retiro->account['name']))
                                    <td>{{ $retiro->account['name'] }}</td>
                                @else
                                    <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60">
                                    </td>
                                @endif
                                @if (!empty($retiro->department['name']))
                                    <td>{{ $retiro->department['name'] }}</td>
                                @else
                                    <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60">
                                    </td>
                                @endif
                                @if (!empty($retiro->type))
                                    <td>{{ $retiro->type }}</td>
                                @else
                                    <td class="text-center"><img src="{{ asset('img/loading.gif') }}" width="60">
                                    </td>
                                @endif
                                <td>${{ number_format($retiro->quantity, 2) }}</td>
                                <td>
                                    {{ $retiro->status }}
                                    {{--  @if (Auth::user()->rol_user_id == 1 && $retiro->status == 'Pendiente')
                                        <br />
                                        <a href="#" onclick="aproveWithdrawalModal({{ $retiro->id }});"><span
                                                class="icon-checkmark"></span> Aprobar</a>
                                    @endif  --}}
                                    @if ($retiro->status != 'Aprobado')
                                        <a href="javascript:void(0)"
                                            onclick="eliminarRetiroNoAprobado({{ $retiro->id }});"
                                            class="text-danger">Eliminar</a>
                                        <form id="form_eliminar_retiro_{{ $retiro->id }}"
                                            action="{{ route('eliminar_retiro', $retiro->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    @endif
                                </td>

                                <td width="40%;">
                                    <input type="text"
                                        onkeyUp="updateWhitdrawalFolio({{ $retiro->id }},this.value);"
                                        value="{{ $retiro->folio }}" class="form-control" />
                                    <input type="hidden" id="txt_update_whidrawal_folio"
                                        value="{{ route('update_whitdrawal_folio') }}">
                                </td>

                                <td width="40%;">
                                    <select onchange="updateWhitdrawalPaid({{ $retiro->id }},this.value);"
                                        class="form-control">
                                        @if ($retiro->paid == 'SI')
                                            <option value="SI" selected>SI</option>
                                            <option value="NO">NO</option>
                                        @else
                                            <option value="SI">SI</option>
                                            <option value="NO" selected>NO</option>
                                        @endif
                                    </select>
                                    <input type="hidden" id="txt_update_whidrawal_paid"
                                        value="{{ route('update_whitdrawal_paid') }}">
                                </td>
                                <td>
                                    @foreach ($retiro->transactions as $item)
                                        <a
                                            href="#{{ 'TC-' . $item->transaction->id }}">{{ 'TC-' . $item->transaction->id }}</a>
                                        <br>
                                    @endforeach
                                    @if (count($retiro->transactions) <= 0)
                                        _
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($retiro->invoive == 'SI')
                                        @if (!empty($retiro->document))
                                            <a href="{{ 'http://dotech.dyndns.biz:16666/dotech/public/storage/' . $retiro->document }}"
                                                target="_BLANK"><span class="icon-eye"></span></a>
                                        @else
                                            <a href="javascript:void(0);"
                                                onclick="subirFactura({{ $retiro->id }});"><span
                                                    class="icon-upload"></span></a>
                                        @endif
                                    @else
                                        N/A
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if (count($proyecto->retiros) <= 0)
                        <tr>
                            <td colspan="9" class="text-center">Sin registros</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_bitacoras">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Bitácoras</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <a href="javascript:void(0)" onclick="addBinnacle({{ $proyecto->id }});"
                                    class="float-right btn btn-success"><span class="icon icon-plus"></span> Agregar</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th>Autor</th>
                            <th>Descripción</th>
                            <th>Firma</th>
                            <th>Observaciones</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->bitacoras as $bitacora)
                            <tr>
                                <td>{{ formatDate($bitacora->created_at) }}</td>
                                <td>{{ $bitacora->author['name'] }} {{ $bitacora->author['middle_name'] }}
                                    {{ $bitacora->author['last_name'] }}</td>
                                <td>{{ $bitacora->description }}</td>
                                <td>
                                    @if (!empty($bitacora->firm))
                                        <img src="http://dotech.dyndns.biz:16666/dotech/public/storage/{{ $bitacora->firm }}"
                                            width="80" height="80">
                                    @else
                                        <center>No disponible</center>
                                    @endif
                                </td>
                                <td>{{ $bitacora->feedback }}</td>
                                <td>
                                    <a href="javascript:void(0);" onclick="agregarImagenBitacora({{ $bitacora->id }})">
                                        <span class="icon-plus" title="Agregar imagen..."
                                            style="cursor:pointer;color:#c52cec">
                                            Nuevo
                                        </span>
                                    </a>
                                    <br>
                                    <a href="javascript:void(0);"
                                        onclick="verImagenesBitacora({{ $bitacora->id }},{{ count(App\BinnacleImage::where('binnacle_id', $bitacora->id)->get()) }})">
                                        <span class="icon-image" title="ver imágenes..."
                                            style="cursor:pointer;color:#2c49ec">
                                            {{ count(App\BinnacleImage::where('binnacle_id', $bitacora->id)->get()) }}
                                            Imágenes
                                        </span>
                                    </a>
                                    <br>
                                    <a href="{{ route('binnacle_pdf', $bitacora->id) }}" target="_blank">
                                        <span class="icon-file-pdf" title="Ver pdf..."
                                            style="cursor:pointer;color:#ec422c">
                                            PDF
                                        </span>
                                    </a>
                                    <br>
                                    <a href="javascript:void(0);" onclick="enviarBitacora({{ $bitacora->id }});">
                                        <span class="icon-envelop" title="Enviar pdf..."
                                            style="cursor:pointer;color:#b3d420">
                                            Enviar
                                        </span>
                                    </a>
                                    <br>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($proyecto->bitacoras) <= 0)
                            <tr>
                                <td colspan="6" class="text-center">Sin registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_transacciones">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Transacciones</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Banco</th>
                            <th>Fecha</th>
                            <th>Concepto/Referencia</th>
                            <th>Cargo</th>
                            <th>Abono</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->transacciones as $item)
                            <tr id="{{ 'TC-' . $item->transaction->id }}">
                                <td>{{ 'TC-' . $item->transaction->id }}</td>
                                <td>{{ $item->transaction->bank }}</td>
                                <td>{{ formatDate($item->transaction->date) }}</td>
                                <td>{{ $item->transaction->description }}</td>
                                <td>{{ $item->transaction->chargue }}</td>
                                <td>{{ $item->transaction->payment }}</td>
                                <td>{{ $item->transaction->description }}</td>
                            </tr>
                        @endforeach
                        @if (count($proyecto->transacciones) <= 0)
                            <tr>
                                <td colspan="7" class="text-center">Sin registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="float-right">
            <small>ID-PROY: {{ $proyecto->id }}</small>
        </div>
        <br><br>
    </div>
    @include('proyectos.solicitar_retiro_modal')
    @include('proyectos.subir_factura_modal')
    @include('proyectos.agregar_seguimiento_proyecto_modal')
    @include('proyectos.enviar_bitacora_pdf_modal')
    @include('proyectos.visor_imagenes')
    @include('proyectos.agregar_pago_modal')
    @include('proyectos.agregar_archivo_modal')
    @include('proyectos.agregar_bitacora_modal')
    @include('proyectos.agregar_imagen_bitacora_modal')
    @include('proyectos.actualizar_estatus_modal')
    @include('proyectos.actualizar_descripcion_modal')
    <script>
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(pintarGraficas);

        function pintarGraficas() {
            pintarGraficaCostos();
        }

        function solicitarRetiro() {
            $("#solicitar_retiro_modal").modal('show');
        }

        function agregarPago() {
            $("#add_sale_payment_modal").modal('show');
        }

        function agregarArchivo() {
            $("#add_sale_document_modal").modal('show');
        }

        function agregarImagenBitacora(bitacora_id) {
            $("#txt_add_binnacle_image_id").val(bitacora_id);
            $("#agregar_imagen_bitacora_modal").modal('show');
        }

        function subirFactura(retiro_id) {
            $("#txt_retiro_id").val(retiro_id);
            $("#subir_factura_modal").modal('show');
        }

        function abrirSeguimientos(proyecto_id) {
            saleFollowModal(proyecto_id);
        }

        function enviarBitacora(binnacle_id) {
            sendBinnacle(binnacle_id);
        };

        function actualizarEstatus() {
            $("#actualizar_estatus_modal").modal('show');
        }

        function actualizarDescripcion(descripcion) {
            $("#txt_actualizar_descripcion").val(descripcion);
            $("#actualizar_descripcion_modal").modal('show');
        }

        function eliminarRetiroNoAprobado(retiro_id) {
            if (confirm("Realmente desea eliminar el registro?")) {
                $("#form_eliminar_retiro_" + retiro_id).submit();
            }
        }
    </script>
    @include('proyectos.grafica_costos')
@endsection
