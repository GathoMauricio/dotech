@extends('layouts.app')
@section('content')
<h4 class="title_page">Editar mantenimiento</h4> 
<br/>
<form action="{{ route('maintenance_update',$maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="vehicle_id" id="txt_add_maintenance_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maintenance_type_id" class="font-weight-bold color-primary-sys">
                                    Tipo
                                </label>
                                <select onchange="checkSectionOther(this.value)" name="maintenance_type_id" class="form-control">
                                    @php
                                        $types = App\MaintenanceType::orderBy('id')->get();
                                    @endphp
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kilometers" class="font-weight-bold color-primary-sys">
                                    Kilometros
                                </label>
                                <input type="text" value="{{ $maintenance->kilometers }}" name="kilometers" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="section_other_type" 
                    @if($maintenance->type['id'] != 22)
                    style="display: none;"
                    @endif
                    >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="other" class="font-weight-bold color-primary-sys">
                                    Otro
                                </label>
                                <input type="text" value="{{ $maintenance->other }}"  name="other" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date" class="font-weight-bold color-primary-sys">
                                    Fecha
                                </label>
                                <input type="date" value="{{ explode(' ',$maintenance->date)[0] }}"  name="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount" class="font-weight-bold color-primary-sys">
                                    Monto
                                </label>
                                <input type="text" value="{{ $maintenance->amount }}"  name="amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="font-weight-bold color-primary-sys">
                                    Descripción
                                </label>
                                <textarea name="description" class="form-control" required>{{ $maintenance->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>

@endsection