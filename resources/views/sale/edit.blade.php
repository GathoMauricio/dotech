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
                    <label for="status" class="color-primary-sys font-weight-bold">Estatus</label>
                    <select name="status" class="custom-select">
                        @if($sale->status == 'Pendiente')
                        <option value="Pendiente" selected>Cotización</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Rechazada">Rechazada</option>
                        <option value="Finalizado">Finalizado</option>
                        @endif
                        @if($sale->status == 'Proyecto')
                        <option value="Pendiente">Cotización</option>
                        <option value="Proyecto" selected>Proyecto</option>
                        <option value="Rechazada">Rechazada</option>
                        <option value="Finalizado">Finalizado</option>
                        @endif
                        @if($sale->status == 'Rechazada')
                        <option value="Pendiente">Cotización</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Rechazada" selected>Rechazada</option>
                        <option value="Finalizado">Finalizado</option>
                        @endif
                        @if($sale->status == 'Finalizado')
                        <option value="Pendiente">Cotización</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Rechazada">Rechazada</option>
                        <option value="Finalizado" selected>Finalizado</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company_id" class="color-primary-sys font-weight-bold">Compañía</label>
                    <input type="hidden" id="txt_route_load_departments_by_id" value="{{ route('load_departments_by_id') }}">
                    <select onchange="loadDepartmentsByCompany(this.value)" name="company_id" class="custom-select">
                        @foreach($companies as $company)
                        @if($sale->company_id == $company->id)
                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <span id="load_departments_by_company" class="icon-spinner9 float-right" style="color:#3498DB;display:none"></span>
                    <label for="department_id" class="color-primary-sys font-weight-bold">Departamento</label>
                    <select name="department_id" id="cbo_departments_by_company" class="custom-select">
                        @foreach($departments as $department)
                        @if($sale->department_id == $department->id)
                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                        @else
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="color-primary-sys font-weight-bold">Descripción</label>
                    <textarea name="description" class="form-control">{{ old('description',$sale->description) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="investment" class="color-primary-sys font-weight-bold">Inversión</label>
                    <input name="investment" value="{{ old('investment',$sale->investment) }}" type="text" class="form-control currency_mask">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="estimated" class="color-primary-sys font-weight-bold">Venta</label>
                    <input name="estimated" value="{{ old('estimated',$sale->estimated) }}" type="text" class="form-control currency_mask">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="utility" class="color-primary-sys font-weight-bold">Utilidad</label>
                    <input name="utility" value="{{ old('utility',$sale->utility) }}" type="text" class="form-control currency_mask" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="iva" class="color-primary-sys font-weight-bold">IVA</label>
                    <input name="iva" value="{{ old('iva',$sale->iva) }}" type="text" class="form-control currency_mask" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="deadline" class="color-primary-sys font-weight-bold">Deadline</label>
                    <input name="deadline" value="{{ old('deadline',$sale->deadline) }}" type="date" class="form-control date_mask">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="commision_percent" class="color-primary-sys font-weight-bold">Comisión %</label>
                    <select name="commision_percent" type="text" class="custom-select">
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="commision_pay" class="color-primary-sys font-weight-bold">Comisión $</label>
                    <input name="commision_pay" value="{{ old('commision_pay',$sale->commision_pay) }}" type="text" class="form-control currency_mask" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="color-primary-sys font-weight-bold">Con envio</label>
                    <select name="shipping" class="custom-select">
                        @if($sale->shipping == 'Si')
                        <option value="Si" selected>Si</option>
                        <option value="No">No</option>
                    @else
                        <option value="Si">Si</option>
                        <option value="No" selected>No</option>
                    @endif
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="creadit" class="color-primary-sys font-weight-bold">Crédito</label>
                    <select name="creadit" class="custom-select">
                        @if($sale->credit == 'N/A')
                        <option value="N/A" selected>N/A</option>
						<option value="15 Días">15 Días</option>
						<option value="30 Días">30 Dias</option>
                        <option value="90 Días">90 Dias</option>
                        @endif
                        @if($sale->credit == '15 D�as' || $sale->credit == '15 Días')
                        <option value="N/A">N/A</option>
						<option value="15 Días" selected>15 Días</option>
						<option value="30 Días">30 Dias</option>
                        <option value="90 Días">90 Dias</option>
                        @endif
                        @if($sale->credit == '30 D�as' || $sale->credit == '30 Días')
                        <option value="N/A">N/A</option>
						<option value="15 Días">15 Días</option>
						<option value="30 Días" selected>30 Dias</option>
                        <option value="90 Días">90 Dias</option>
                        @endif
                        @if($sale->credit == '90 D�as' || $sale->credit == '90 Días')
                        <option value="N/A">N/A</option>
						<option value="15 Días">15 Días</option>
						<option value="30 Días">30 Dias</option>
                        <option value="90 Días" selected>90 Dias</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="payment_type" class="color-primary-sys font-weight-bold">Tipo de pago</label>
                    <select name="payment_type" class="custom-select">
                        @if($sale->payment_type  == 'Efectivo')
                        <option value="Efectivo" selected>Efectivo</option>
						<option value="Depósito">Depósito</option>
						<option value="Transferencia">Transferencia</option>
                        <option value="Cheque">Cheque</option>
                        @endif
                        @if($sale->payment_type  == 'Deposito' || $sale->payment_type == 'Depósito')
                        <option value="Efectivo">Efectivo</option>
						<option value="Depósito" selected>Depósito</option>
						<option value="Transferencia">Transferencia</option>
                        <option value="Cheque">Cheque</option>
                        @endif
                        @if($sale->payment_type  == 'Transferencia')
                        <option value="Efectivo">Efectivo</option>
						<option value="Depósito">Depósito</option>
						<option value="Transferencia" selected>Transferencia</option>
                        <option value="Cheque">Cheque</option>
                        @endif
                        @if($sale->payment_type  == 'Cheque')
                        <option value="Efectivo">Efectivo</option>
						<option value="Depósito">Depósito</option>
						<option value="Transferencia">Transferencia</option>
                        <option value="Cheque" selected>Cheque</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="currency" class="color-primary-sys font-weight-bold">Divisa</label>
                    <select name="currency" class="custom-select">
                        @if($sale->currency == 'MXN')
                        <option value="MXN" selected>MXN</option>
                        <option value="USD">USD</option>
                        @else
                        <option value="MXN">MXN</option>
                        <option value="USD" señected>USD</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observation" class="color-primary-sys font-weight-bold">Observaciones</label>
                    <textarea name="observation" class="form-control">{{ old('observation',$sale->observation) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="material" class="color-primary-sys font-weight-bold">Material</label>
                    <textarea name="material" class="form-control">{{ old('material',$sale->material) }}</textarea>
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