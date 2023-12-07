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
                    <div class="col-md-6 p-2">{{ $proyecto->cliente->name }}</div>
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
                        <span class="font-weight-bold">N° de Productos</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->productos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">N° de Pagos</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->pagos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">N° de Archivos</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->archivos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">N° de Retiros</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->retiros->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">N° de Bitácoras</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $proyecto->bitacoras->count() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
