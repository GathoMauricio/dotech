@extends('layouts.app')
@section('content')
<h4 class="title_page">Crear vehiculo</h4> 

<form action="{{ route('vehicle_store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Marca
                    </label>
                    <input type="text" name="brand" class="form-control" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Modelo
                    </label>
                    <input type="text" name="model" class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Combustible
                    </label>
                    <input type="text" name="fuel" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Tipo
                    </label>
                    <select type="text" name="vehicle_type_id" class="form-control">
                        @foreach($vehicleTypes as $vehicleType)
                        <option value="{{ $vehicleType->id }}">{{ $vehicleType->type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Kilometros
                    </label>
                    <input type="text" name="kilometers" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Matricula
                    </label>
                    <input type="text" name="enrollment" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Año
                    </label>
                    <input type="text" name="year" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Cilindrada
                    </label>
                    <input type="text" name="displacement" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Potencia
                    </label>
                    <input type="text" name="power" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Color
                    </label>
                    <input type="text" name="color" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('vehicle_index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection