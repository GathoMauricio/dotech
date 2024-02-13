@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary">Solicitudes pendientes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Tipo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Nro Dias</th>
                                    <th>Motivo</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacaciones as $vacation)
                                    <tr>
                                        <td>{{ $vacation->empleado->name }} {{ $vacation->empleado->middle_name }}
                                            {{ $vacation->empleado->last_name }}
                                        </td>
                                        <td>{{ $vacation->tipo }}</td>
                                        <td scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}</td>
                                        <td>{{ $vacation->dias }}</td>
                                        <td>{{ $vacation->motivo }}</td>
                                        <td>
                                            <select onchange="cambiarEstatusVacacion({{ $vacation->id }},this.value)"
                                                class="custom-select">
                                                @if ($vacation->estatus == 'pendiente')
                                                    <option value="pendiente" selected>Pendiente</option>
                                                    <option value="aprobado">Aprobado</option>
                                                @else
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="aprobado" selected>Aprobado</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($vacaciones) <= 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No hay solicitudes</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><a href="{{ route('index_user') }}">Empleados</a></h5>
                    </div>
                    <div class="card-body">
                        {{ $users->links('pagination::bootstrap-4') }}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <form action="{{ route('index_user') }}" id="form_buscar_empleado">
                                            <table style="width: 100%">
                                                <tr>
                                                    <td width="90%"><input type="text" placeholder="Buscar..."
                                                            class="form-control" id="txt_buscar_empleado"></td>
                                                    <td width="10%"><button type="submit" class="form-control"><span
                                                                class="icon icon-search"></span></button></td>
                                                </tr>
                                            </table>

                                        </form>
                                    </th>
                                    <th colspan="3" class="text-center bg-info">Dias vacaciones</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Rol</th>
                                    <th>Empleado</th>
                                    <th class="text-center">Contacto</th>
                                    <th>Fecha contrato</th>
                                    <th class="text-center bg-info">Obtenidos</th>
                                    <th class="text-center bg-info">Tomados</th>
                                    <th class="text-center bg-info">Restantes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $user->getRoleNames()[0] }}</td>
                                        <td>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                        <td class="text-center">
                                            <small>{{ $user->email }}</small>
                                            <br>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            {{ $user->anios }} Años
                                            <br>
                                            <small>{{ $user->fecha_contrato }}</small>
                                        </td>
                                        <td>{{ $user->dias_obtenidos }}</td>
                                        <td>{{ $user->dias_tomados }}</td>
                                        <td>{{ $user->dias_restantes }}</td>
                                        <td>
                                            <a href="{{ route('show_user', $user->id) }}">Ver</a>
                                            <br>
                                            <a href="{{ route('edit_user', $user->id) }}">Editar</a>
                                            <br>
                                            <a href="javascript:void(0)" onclick="eliminarUsuario({{ $user->id }})"
                                                class="text-danger">Eliminar</a>
                                            <form id="form_eliminar_usuario_{{ $user->id }}" style="display:none;"
                                                action="{{ route('delete_user', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($users) <= 0)
                                    <tr>
                                        <td colspan="7" class="text-center">Sin resultados</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#form_buscar_empleado").submit(function(e) {
                e.preventDefault();
                var value = $("#txt_buscar_empleado").val();
                if (value.length > 0)
                    window.location = $("#form_buscar_empleado").prop('action') +
                    '/' + value;
            });
        });

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

        function eliminarUsuario(id) {
            if (confirm("¿Eliminar empleado de la lista?")) {
                $("#form_eliminar_usuario_" + id).submit();
            }
        }
    </script>
@endsection
