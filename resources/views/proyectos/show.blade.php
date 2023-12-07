@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">Folio: {{ $proyecto->folio_proyecto }}</h3>
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
                        <span class="font-weight-bold">Descripcion</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->description }}</div>
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
                        <a href="javascript:void(0)" onclick="abrirSeguimientos();"
                            class="btn btn-primary">({{ $proyecto->seguimientos->count() }})
                            Seguimientos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                <h5>Información</h5>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Identificador interno</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->id }}</div>
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
                        <span class="font-weight-bold"><a href="#row_archivos">N° de Archivos</a></span>
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
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_productos">
            <div class="col-md-12 p-2">
                {{--  <a href="javascript:void(0);" class="float-right"><span class="icon icon-eye-blocked"></span></a>  --}}
                <h5 class="text-success">Productos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <a href="{{ route('quote_products', $proyecto->id) }}" class="float-right"><span
                                        class="icon icon-pencil"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <th>Cant</th>
                            <th>U. Medida</th>
                            <th>Producto</th>
                            <th>P/U</th>
                            <th>Descuento</th>
                            <th>Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyecto->productos as $key => $producto)
                            <tr>
                                <td>{{ $producto->quantity }}</td>
                                <td>{{ $producto->measure }}</td>
                                <td>{{ $producto->description }}</td>
                                <td>${{ $producto->unity_price_sell }}</td>
                                <td>{{ $producto->discount }}%</td>
                                <td>${{ $producto->total_sell }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" class="text-right">Subtotal: ${{ number_format($productos_subtotal, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">IVA: ${{ number_format($productos_iva, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">Total: ${{ number_format($productos_total, 2) }}</td>
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
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_archivos">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Archivos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Archivo</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3" id="row_bitacoras">
            <div class="col-md-12 p-2">
                <h5 class="text-success">Bitácoras</h5>
                <table class="table">
                    <thead></thead>
                </table>
            </div>
        </div>
        <br>
    </div>
@endsection
