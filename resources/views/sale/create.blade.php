@extends('layouts.app')
@section('content')
<h4 class="title_page">
    Crear Cotización para {{ $company->name }}
</h4>
<form action="{{ route('store_sale') }}" method="POST">
    @csrf
    <input type="hidden" name="status" value="Pendiente" />
    <input type="hidden" name="company_id" value="{{ $company->id }}">
    <input type="hidden" name="commision_percent" value="8">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <span id="load_departments_by_company" class="icon-spinner9 float-right" style="color:#3498DB;display:none"></span>
                    <label for="department_id" class="color-primary-sys font-weight-bold">Departamento</label>
                    <select name="department_id" id="cbo_departments_by_company" class="custom-select">
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
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
                    <input name="investment" onchange="calculateCurrencies()" id="txt_investment_amount" type="number" value="{{ old('investment') }}" class="form-control currency_mask">
                    @if($errors->has('investment'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('investment') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="estimated" class="color-primary-sys font-weight-bold">Venta</label>
                    <span class="color-primary-sys font-weight-bold">*</span>
                    <input name="estimated" onchange="calculateCurrencies()" id="txt_estimated_amount" value="{{ old('estimated') }}" type="number" class="form-control currency_mask">
                    @if($errors->has('estimated'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('estimated') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="utility" class="color-primary-sys font-weight-bold">Utilidad</label>
                    <input name="utility"  onchange="calculateCurrencies()" id="txt_utility_amount" value="{{ old('utility') }}" type="text" class="form-control currency_mask" readonly>
                    @if($errors->has('utility'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('utility') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="iva" class="color-primary-sys font-weight-bold">IVA</label>
                    <input name="iva" id="txt_iva_amount"  onchange="calculateCurrencies()" value="{{ old('iva') }}" type="text" class="form-control currency_mask" readonly>
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
                    <span class="color-primary-sys font-weight-bold">*</span>
                    <input name="deadline" value="{{ old('deadline') }}" type="date" class="form-control date_mask">
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
            <input type="hidden" id="cbo_commision_percent" value="8">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="commision_pay" class="color-primary-sys font-weight-bold">Comisión $</label>
                    <input name="commision_pay" id="txt_commision_pay_amount" value="{{ old('commision_pay') }}" type="text" class="form-control currency_mask" readonly>
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
                        <option value="Si" >Si</option>
                        <option value="No" selected>No</option>
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
                        <option value="N/A" selected>N/A</option>
						<option value="15 Días">15 Días</option>
						<option value="30 Días">30 Dias</option>
                        <option value="90 Días">90 Dias</option>
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
                        <option value="Efectivo">Efectivo</option>
						<option value="Depósito">Depósito</option>
						<option value="Transferencia">Transferencia</option>
                        <option value="Cheque">Cheque</option>
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
                        <option value="MXN" >MXN</option>
                        <option value="USD">USD</option>
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
                    <textarea name="observation" class="form-control">{{ old('observation') }}</textarea>
                    @if($errors->has('observation'))
                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('observation') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="material" class="color-primary-sys font-weight-bold">Material</label>
                    <textarea name="material" class="form-control">{{ old('material') }}</textarea>
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
                    <a href="{{ route('company_index')}}" class="btn btn-secondary">Cancelar</a>  
                    <input type="submit" value="Guardar información" class="btn btn-primary-sys">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection