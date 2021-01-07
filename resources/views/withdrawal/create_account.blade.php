@extends('layouts.app')
@section('content')
<img src="{{ asset('img/withdrawal_header.png') }}" style="width:100%;" height="200" />
<br><br>
<h4 class="title_page">Agregar cuenta de retiro</h4>
@include('config.menu')
<br>
<form action="{{ route('store_account') }}" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Alias de la cuenta
                    </label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type" class="font-weight-bold color-primary-sys">
                        Tipo
                    </label>
                    <select name="type" class="custom-select">
                        <option value="Comercial">Comercial</option>
                        <option value="Operación">Operación</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="balance" class="font-weight-bold color-primary-sys">
                        Saldo
                    </label>
                    <input type="number" step="0.01" name="balance" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="number" class="font-weight-bold color-primary-sys">
                        Número
                    </label>
                    <input type="text" name="number" class="form-control" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('index_account') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection