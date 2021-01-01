@extends('layouts.app')
@section('content')
<h4 class="title_page">Agregar provedor de retiro</h4>
@include('config.menu')
<br>
<form action="{{ route('store_department') }}" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Nombre del departamento
                    </label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('index_department') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection