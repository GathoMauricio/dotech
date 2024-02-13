@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-heading clearfix p-3">
                        <h3 class="card-title pull-left">Datos del Trabajador</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Estatus:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->status->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Nombre:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->name }} {{ $usuario->middle_name }} {{ $usuario->last_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Teléfono:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->phone }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Email:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Fecha Ingreso:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->fecha_contrato }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><b>Rol:</b></p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $usuario->getRoleNames()[0] }}</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card card-success">
                    <div class="card-heading p-3">
                        <h3 class="card-title">Vacaciones</h3>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Nro Dias</th>
                                    <th>Motivo</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuario->vacaciones as $vacation)
                                    @if ($vacation->tipo == 'vacaciones')
                                        <tr>
                                            <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}</th>
                                            <td>{{ $vacation->dias }}</td>
                                            <td>{{ $vacation->motivo }}</td>
                                            <td>
                                                @if (Auth::user()->rol_user_id == 1)
                                                    <select
                                                        onchange="cambiarEstatusVacacion({{ $vacation->id }},this.value)"
                                                        class="custom-select">
                                                        @if ($vacation->estatus == 'pendiente')
                                                            <option value="pendiente" selected>Pendiente</option>
                                                            <option value="aprobado">Aprobado</option>
                                                        @else
                                                            <option value="pendiente">Pendiente</option>
                                                            <option value="aprobado" selected>Aprobado</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    {{ $vacation->estatus }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-warning">
                    <div class="card-heading p-3">
                        <h3 class="card-title">Permisos</h3>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Nro Dias</th>
                                    <th>Motivo</th>
                                    <th>Estatus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuario->vacaciones as $vacation)
                                    @if ($vacation->tipo == 'permiso')
                                        <tr>
                                            <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}</th>
                                            <td>{{ $vacation->dias }}</td>
                                            <td>{{ $vacation->motivo }}</td>
                                            <td>
                                                @if (Auth::user()->rol_user_id == 1)
                                                    <select
                                                        onchange="cambiarEstatusVacacion({{ $vacation->id }},this.value)"
                                                        class="custom-select">
                                                        @if ($vacation->estatus == 'pendiente')
                                                            <option value="pendiente" selected>Pendiente</option>
                                                            <option value="aprobado">Aprobado</option>
                                                        @else
                                                            <option value="pendiente">Pendiente</option>
                                                            <option value="aprobado" selected>Aprobado</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    {{ $vacation->estatus }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-danger">
                    <div class="card-heading p-3">
                        <h3 class="card-title">Faltas</h3>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Nro Dias</th>
                                    <th>Motivo</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuario->vacaciones as $vacation)
                                    @if ($vacation->tipo == 'falta')
                                        <tr>
                                            <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}</th>
                                            <td>{{ $vacation->dias }}</td>
                                            <td>{{ $vacation->motivo }}</td>
                                            <td>
                                                @if (Auth::user()->rol_user_id == 1)
                                                    <select
                                                        onchange="cambiarEstatusVacacion({{ $vacation->id }},this.value)"
                                                        class="custom-select">
                                                        @if ($vacation->estatus == 'pendiente')
                                                            <option value="pendiente" selected>Pendiente</option>
                                                            <option value="aprobado">Aprobado</option>
                                                        @else
                                                            <option value="pendiente">Pendiente</option>
                                                            <option value="aprobado" selected>Aprobado</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    {{ $vacation->estatus }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cambiarEstatusVacacion(vacacion_id, estatus) {

            $.ajax({
                type: 'GET',
                url: "{{ route('cambiar_estatus_vacacion') }}",
                data: {
                    vacacion_id: vacacion_id,
                    estatus: estatus
                },
            }).done(function(response) {
                if (response.status == 1) {
                    successNotification(response.message);
                } else {
                    errorNotification(response.message);
                }

            }).fail(function(jqXHR, textStatus,
                errorThrown) {
                console.log(jqXHR);
            });
        }
    </script>
@endsection
