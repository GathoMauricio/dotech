@extends('layouts.app')
@section('content')
<h4 class="title_page">Editar vehiculo</h4> 

<form action="{{ route('vehicle_update',$vehicle->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Visibilidad
                    </label>
                    <select name="visibility" class="form-control" required>
                        @if($vehicle->visibility == 'publica')
                        <option value="publica" selected>Pública</option>
                        <option value="privada">Privada</option>
                        @else
                        <option value="publica">Pública</option>
                        <option value="privada" selected>Privada</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Marca
                    </label>
                    <input type="text" value="{{ $vehicle->brand }}" name="brand" class="form-control" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Modelo
                    </label>
                    <input type="text" value="{{ $vehicle->model }}" name="model" class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Combustible
                    </label>
                    <input type="text" value="{{ $vehicle->fuel }}" name="fuel" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Tipo
                    </label>
                    <select type="text" name="vehicle_type_id" class="form-control">
                        @foreach($vehicleTypes as $vehicleType)
                        @if($vehicleType->id == $vehicle->vehicle_type_id)
                        <option value="{{ $vehicleType->id }}" selected>{{ $vehicleType->type}}</option>
                        @else
                        <option value="{{ $vehicleType->id }}">{{ $vehicleType->type}}</option>
                        @endif
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
                    <input type="text" value="{{ $vehicle->kilometers }}" name="kilometers" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Matricula
                    </label>
                    <input type="text" value="{{ $vehicle->enrollment }}" name="enrollment" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Año
                    </label>
                    <input type="text" value="{{ $vehicle->year }}" name="year" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Cilindrada
                    </label>
                    <input type="text" value="{{ $vehicle->displacement }}" name="displacement" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Potencia
                    </label>
                    <input type="text" value="{{ $vehicle->power }}" name="power" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Color
                    </label>
                    <input type="text" value="{{ $vehicle->color }}" name="color" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('vehicle_index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Actualizar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection