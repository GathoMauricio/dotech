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
<form action="{{ route('update_sale',$sale->id) }}" method="POST">
    @csrf
    @method('PUT')
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
                    @if($errors->has('status'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('status') }}</small>
                    @endif
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
                    @if($errors->has('company_id'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('company_id') }}</small>
                    @endif
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
                    @if($errors->has('department_id'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('department_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="color-primary-sys font-weight-bold">Descripción</label>
                    <span class="color-primary-sys font-weight-bold">*</span>
                    <textarea name="description" class="form-control">{{ old('description',$sale->description) }}</textarea>
                    @if($errors->has('description'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('description') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="investment" class="color-primary-sys font-weight-bold">Inversión</label>
                    <span class="color-primary-sys font-weight-bold">*</span>
                    <input name="investment" onchange="calculateCurrencies()" id="txt_investment_amount" type="text" value="{{ old('investment',$sale->investment) }}" class="form-control currency_mask">
                    @if($errors->has('investment'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('investment') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="estimated" class="color-primary-sys font-weight-bold">Venta</label>
                    <span class="color-primary-sys font-weight-bold">*</span>
                    <input name="estimated" onchange="calculateCurrencies()" id="txt_estimated_amount" value="{{ old('estimated',$sale->estimated) }}" type="text" class="form-control currency_mask">
                    @if($errors->has('estimated'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('estimated') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="utility" class="color-primary-sys font-weight-bold">Utilidad</label>
                    <input name="utility"  onchange="calculateCurrencies()" id="txt_utility_amount" value="{{ old('utility',$sale->utility) }}" type="text" class="form-control currency_mask" readonly>
                    @if($errors->has('utility'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('utility') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="iva" class="color-primary-sys font-weight-bold">IVA</label>
                    <input name="iva" id="txt_iva_amount"  onchange="calculateCurrencies()" value="{{ old('iva',$sale->iva) }}" type="text" class="form-control currency_mask" readonly>
                    @if($errors->has('iva'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('iva') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="deadline" class="color-primary-sys font-weight-bold">Deadline</label>
                    <input name="deadline" value="{{ old('deadline',$sale->deadline) }}" type="date" class="form-control date_mask">
                    @if($errors->has('deadline'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('deadline') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label  class="color-primary-sys font-weight-bold">Total</label>
                    <input  id="txt_total_amount"  onchange="calculateCurrencies()"  type="text" class="form-control currency_mask" readonly>
                    @if($errors->has(''))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="commision_percent" class="color-primary-sys font-weight-bold">Comisión %</label>
                    <select name="commision_percent"  onchange="calculateCurrencies()" id="cbo_commision_percent" type="text" class="custom-select">
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
                    @if($errors->has('commision_percent'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('commision_percent') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="commision_pay" class="color-primary-sys font-weight-bold">Comisión $</label>
                    <input name="commision_pay" id="txt_commision_pay_amount" value="{{ old('commision_pay',$sale->commision_pay) }}" type="text" class="form-control currency_mask" readonly>
                    @if($errors->has('commision_pay'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('commision_pay') }}</small>
                    @endif
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
                    @if($errors->has('shipping'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('shipping') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="credit" class="color-primary-sys font-weight-bold">Crédito</label>
                    <select name="credit" class="custom-select">
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
                    @if($errors->has('credit'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('credit') }}</small>
                    @endif
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
                    @if($errors->has('payment_type'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('payment_type') }}</small>
                    @endif
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
                    @if($errors->has('currency'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('currency') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observation" class="color-primary-sys font-weight-bold">Observaciones</label>
                    <textarea name="observation" class="form-control">{{ old('observation',$sale->observation) }}</textarea>
                    @if($errors->has('observation'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('observation') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="material" class="color-primary-sys font-weight-bold">Material</label>
                    <textarea name="material" class="form-control">{{ old('material',$sale->material) }}</textarea>
                    @if($errors->has('material'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('material') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                Los campos marcados con <span class="color-primary-sys font-weight-bold">*</span> son obligatorios.
                <div class="float-right">
                    <a href="{{ route('show_sale',$sale->id) }}" class="btn btn-secondary">Cancelar</a>  
                    <input type="submit" value="Actualizar información" class="btn btn-primary-sys">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection