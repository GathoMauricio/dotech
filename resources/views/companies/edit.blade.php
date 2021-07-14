@extends('layouts.app')
@section('content')
<h4 class="title_page">Editar compañía</h4> 
<center>
@if($company->image == 'compania.png')
<img src="{{asset('img')}}/{{ $company->image }}" width="150" height="120" />
@else
<img src="{{asset('storage')}}/{{ $company->image }}" width="150" height="120" />
@endif
</center>
<form action="{{ route('update_company',$company->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Origen
                    </label>
                    <select name="origin" class="custom-select">
                        @if($company->origin == 'Recomendación')
                        <option value="Recomendación" selected>Recomendación</option>
                        <option value="Google">Google</option>
                        <option value="Facebook">Facebook</option>
                        <option value="App">App</option>
                        @endif
                        @if($company->origin == 'Google')
                        <option value="Recomendación">Recomendación</option>
                        <option value="Google" selected>Google</option>
                        <option value="Facebook">Facebook</option>
                        <option value="App">App</option>
                        @endif
                        @if($company->origin == 'Facebook')
                        <option value="Recomendación">Recomendación</option>
                        <option value="Google">Google</option>
                        <option value="Facebook" selected>Facebook</option>
                        <option value="App">App</option>
                        @endif
                        @if($company->origin == 'App')
                        <option value="Recomendación">Recomendación</option>
                        <option value="Google">Google</option>
                        <option value="Facebook">Facebook</option>
                        <option value="App" selected>App</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="font-weight-bold color-primary-sys">
                        Estatus
                    </label>
                    <select name="status" class="custom-select">
                        @if($company->status == 'Prospecto')
                        <option value="Prospecto" selected>Prospecto</option>
                        <option value="Cliente">Cliente</option>
                        @endif
                        @if($company->status == 'Cliente')
                        <option value="Prospecto">Prospecto</option>
                        <option value="Cliente" selected>Cliente</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Nombre*
                    </label>
                    <input name="name" type="text" value="{{ $company->name }}" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="responsable" class="font-weight-bold color-primary-sys">
                        Responsable*
                    </label>
                    <input name="responsable" value="{{ $company->responsable }}"  type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rfc" class="font-weight-bold color-primary-sys">
                        RFC
                    </label>
                    <input name="rfc" value="{{ $company->rfc }}"  type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="font-weight-bold color-primary-sys">
                        Email*
                    </label>
                    <input name="email"  value="{{ $company->email }}"  type="email" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="font-weight-bold color-primary-sys">
                        Teléfono*
                    </label>
                    <input name="phone" value="{{ $company->phone }}"  type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="iguala" class="font-weight-bold color-primary-sys">
                        Iguala
                    </label>
                    <select name="iguala"  class="custom-select">
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
                    <textarea name="address" class="form-control">{{ $company->address }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description" class="font-weight-bold color-primary-sys">
                        Descripción
                    </label>
                    <textarea name="description" class="form-control">{{ $company->description }}</textarea>
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
                    <input type="submit" value="Actualizar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection