@extends('layouts.app')
@section('content')
<h4 class="title_page">Crear compañía</h4> 
<form action="{{ route('store_company') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Origen
                    </label>
                    <select name="origin" class="custom-select">
                        <option value="Recomendación">Recomendación</option>
                        <option value="Google">Google</option>
                        <option value="Facebook">Facebook</option>
                        <option value="App">App</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="font-weight-bold color-primary-sys">
                        Estatus
                    </label>
                    <select name="status" class="custom-select">
                        <option value="Prospecto">Prospecto</option>
                        <option value="Cliente">Cliente</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Nombre*
                    </label>
                    <input name="name" type="text" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="responsable" class="font-weight-bold color-primary-sys">
                        Responsable*
                    </label>
                    <input name="responsable" type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rfc" class="font-weight-bold color-primary-sys">
                        RFC
                    </label>
                    <input name="rfc" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="font-weight-bold color-primary-sys">
                        Email*
                    </label>
                    <input name="email" type="email" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="font-weight-bold color-primary-sys">
                        Teléfono*
                    </label>
                    <input name="phone" type="phone" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="iguala" class="font-weight-bold color-primary-sys">
                        Iguala
                    </label>
                    <select name="iguala" class="custom-select">
                        <option value="NO">NO</option>
                        <option value="SI">SI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="image" class="font-weight-bold color-primary-sys">
                        Foto
                    </label>
                    <input name="image" type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address" class="font-weight-bold color-primary-sys">
                        Dirección
                    </label>
                    <textarea name="address" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description" class="font-weight-bold color-primary-sys">
                        Descripción
                    </label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <!--
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="font-weight-bold color-primary-sys">
                        Contraseña
                    </label>
                    <input name="password" type="password" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirm" class="font-weight-bold color-primary-sys">
                        Confirmar contraseña
                    </label>
                    <input name="password_confirm" type="password" class="form-control">
                </div>
            </div>
        </div>
        -->
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('company_index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection