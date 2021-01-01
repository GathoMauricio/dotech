@extends('layouts.app')
@section('content')
<h4 class="title_page">Editar cuenta de retiro</h4>
@include('config.menu')
<br>
<form action="{{ route('update_account', $account->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Alias de la cuenta
                    </label>
                    <input type="text" name="name" value="{{ $account->name }}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type" class="font-weight-bold color-primary-sys">
                        Tipo
                    </label>
                    <select name="type" class="custom-select">
                        @if($account->type == 'Comercial')
                        <option value="Comercial" selected>Comercial</option>
                        <option value="Operación">Operación</option>
                        <option value="Otro">Otro</option>
                        @endif
                        @if($account->type == 'Operación')
                        <option value="Comercial">Comercial</option>
                        <option value="Operación" selected>Operación</option>
                        <option value="Otro">Otro</option>
                        @endif
                        @if($account->type == 'Otro')
                        <option value="Comercial">Comercial</option>
                        <option value="Operación">Operación</option>
                        <option value="Otro" selected="selected">Otro</option>
                        @endif
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
                    <input type="number" name="balance" value="{{ $account->balance }}" step="0.01" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="number" class="font-weight-bold color-primary-sys">
                        Número
                    </label>
                    <input type="text" name="number" value="{{ $account->number }}" class="form-control" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('index_account') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Actualizar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection