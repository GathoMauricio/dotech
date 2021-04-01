@extends('layouts.app')
@section('content')
<h4 class="title_page">Edición de retiro</h4>
@include('config.menu')
<br><br>
<form action="{{ route('update_provider',$whitdrawal->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="font-weight-bold color-primary-sys">
                    Nombre del proveedor*
                </label>
                <input name="name" value="{{ $whitdrawal->name }}" type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="bank" class="font-weight-bold color-primary-sys">
                    Banco
                </label>
                <input name="bank" value="{{ $whitdrawal->bank }}" type="text" class="form-control" >
            </div>
            <div class="col-md-4">
                <label for="account" class="font-weight-bold color-primary-sys">
                    Cuenta
                </label>
                <input name="account" value="{{ $whitdrawal->account }}" type="text" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="pay_type" class="font-weight-bold color-primary-sys">
                    Forma pago
                </label>
                <input name="pay_type" value="{{ $whitdrawal->pay_type }}" type="text" class="form-control" >
            </div>
            <div class="col-md-4">
                <label for="rfc" class="font-weight-bold color-primary-sys">
                    Rfc
                </label>
                <input name="rfc" value="{{ $whitdrawal->rfc }}" type="text" class="form-control" >
            </div>
            <div class="col-md-4">
                <label for="address" class="font-weight-bold color-primary-sys">
                    Dirección
                </label>
                <input name="address" value="{{ $whitdrawal->address }}" type="text" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="manager" class="font-weight-bold color-primary-sys">
                    Ejecutivo
                </label>
                <input name="manager" value="{{ $whitdrawal->manager }}" type="text" class="form-control" >
            </div>
            <div class="col-md-4">
                <label for="phone" class="font-weight-bold color-primary-sys">
                    Teléfono
                </label>
                <input name="phone" value="{{ $whitdrawal->phone }}" type="text" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="submit" value="Guardar" class="btn btn-primary" >
            </div>
        </div>
    </div>
</form>
@endsection