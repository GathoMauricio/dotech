@extends('layouts.app')
@section('content')
<h4 class="title_page">Crear expediente de servicio</h4>
<br><br>
<form action="{{ route('store_service') }}" method="POST">
    <input type="hidden" name="status" value="Pendiente">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type" class="font-weight-bold color-primary-sys">
                        Tipo de servicio
                    </label>
                    <select name="type" class="custom-select">
                        <option value="Domicilio">Domicilio</option>
                        <option value="Remoto">Remoto</option>
                        <option value="Telefónico">Telefónico</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="location_id" class="font-weight-bold color-primary-sys">
                        Localidad
                    </label>
                    <select name="location_id" class="custom-select">
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="technical_id" class="font-weight-bold color-primary-sys">
                        Técnico
                    </label>
                    <select name="technical_id" class="custom-select">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_id" class="font-weight-bold color-primary-sys">
                        Compañía
                    </label>
                    <select onchange="loadDepartmentsByCompany(this.value)" name="company_id" class="custom-select">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    
                    <label for="department_id" class="font-weight-bold color-primary-sys">
                        Departamento 
                        <span id="load_departments_by_company" class="icon-spinner9 float-right" style="color:#3498DB;display:none"></span>
                    </label>
                    <select name="department_id" id ="cbo_departments_by_company" class="custom-select">
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="subject" class="font-weight-bold color-primary-sys">
                        Asunto
                    </label>
                    <input name="subject" type="text" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="font-weight-bold color-primary-sys">
                        Descripción
                    </label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date" class="font-weight-bold color-primary-sys">
                        Fecha
                    </label>
                    <input name="date" type="date" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="time" class="font-weight-bold color-primary-sys">
                        Hora
                    </label>
                    <input name="time" type="time" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('index_service') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>
<input type="hidden" id="txt_route_load_departments_by_id" value="{{ route('load_departments_by_id') }}">
@endsection