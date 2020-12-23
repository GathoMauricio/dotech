@extends('layouts.app')
@section('content')
<h4 class="title_page">
    Editar 
    @if($sale->status == 'Pendiente')
    Cotización
    @else
    {{ $sale->status }}
    @endif 
    {{ $sale->description }}</h4>
<form action="#">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Estatus</label>
                    <select name="" class="custom-select">
                        <option value="Cotización">Cotización</option>
                        <option value="Proyecto">Proyecto</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Compañía</label>
                    <select name="" class="custom-select">
                        
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Departamento</label>
                    <select name="" class="custom-select">
                        
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Descripción</label>
                    <textarea name="" class="form-control">{{ $sale->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Inverción</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Venta</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Utilidad</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">IVA</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Deadline</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Comisión %</label>
                    <select type="text" class="custom-select"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Comisión $</label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Con envio</label>
                    <select name="" class="custom-select"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Crédito</label>
                    <select name="" class="custom-select"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Tipo de pago</label>
                    <select name="" class="custom-select"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Divisa</label>
                    <select name="" class="custom-select"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Observaciones</label>
                    <textarea name="" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Observaciones</label>
                    <textarea name="" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('show_sale',$sale->id) }}" class="btn btn-secondary">Cancelar</a>  
                    <input type="submit" value="Actualizar información" class="btn btn-primary-sys">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection