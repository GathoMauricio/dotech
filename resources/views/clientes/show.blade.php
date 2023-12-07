@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">{{ $cliente->name }}</h3>
        <div class="row">
            <div class="col-md-8 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                @if (Auth::user()->rol_user_id == 1)
                    <a href="javascript:void(0);" onclick="editarCliente()"><span
                            class="icon icon-pencil float-right"></span></a>
                @endif
                <h5>Contacto</h5>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Origen</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->origin }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Porcentaje</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->porcentaje }}%</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Nombre</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Responsable</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->responsable }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">RFC</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->rfc }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Teléfono</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->phone }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Email</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->email }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Dirección</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->address }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3 p-2">
                        <a href="javascript:void(0);" onclick="iniciarCotizacion();" class="btn btn-primary">
                            Iniciar cotización
                        </a>
                    </div>
                    <div class="col-md-3 p-2">
                        <a href="javascript:void(0);" onclick="openSeguimientos({{ $cliente->id }})"
                            class="btn btn-primary">({{ $cliente->seguimientos->count() }}) Seguimientos</a>
                    </div>
                    <div class="col-md-3 p-2">
                        <a href="{{ route('repository_company', $cliente->id) }}"
                            class="btn btn-primary">({{ $cliente->repositorios->count() }}) Repositorios</a>
                    </div>
                    <div class="col-md-3 p-2">
                        <a href="{{ route('company_documents', $cliente->id) }}"
                            class="btn btn-primary">({{ $cliente->documentaciones->count() }})
                            Documentación</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3" style="background-color: white;;border: solid 5px #f4f6f9;">
                <h5>Información</h5>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Departamentos</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->departamentos->count() }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Fecha prospecto</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->fecha_prospecto }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Fecha cliente</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->fecha_cliente }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Cotizaciones</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->cotizaciones_proyectos->where('status', 'Pendiente')->count() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Proyectos</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->cotizaciones_proyectos->where('status', 'Proyecto')->count() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Finalizados</span>
                    </div>
                    <div class="col-md-6 p-2">
                        {{ $cliente->cotizaciones_proyectos->where('status', 'Finalizado')->count() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Rechazados</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->cotizaciones_proyectos->where('status', 'Rechazada')->count() }}
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3">
            <div class="col-md-12 p-2">
                <h5>Departamentos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Depto</th>
                            <th>Encargado</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente->departamentos as $key => $departamento)
                            <tr>
                                <td>{{ $departamento->name }}</td>
                                <td>{{ $departamento->manager }}</td>
                                <td>{{ $departamento->email }}</td>
                                <td>{{ $departamento->phone }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="background-color: white;p-3">
            <div class="col-md-12 p-2">
                <h5>Historial</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Estatus</th>
                            <th>Fecha de cotización</th>
                            <th>Fecha de proyecto</th>
                            <th>Fecha de finalizado</th>
                            <th>Folio cotización</th>
                            <th>Folio proyecto</th>
                            <th>Descripción</th>
                            <th>Precio de venta</th>
                            <th>Inversión</th>
                            <th>Comisión</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente->cotizaciones_proyectos as $key => $historial)
                            <tr>
                                <td>{{ $historial->status }}</td>
                                <td>{{ $historial->created_at }}</td>
                                <td>{{ $historial->project_at }}</td>
                                <td>{{ $historial->finished_at }}</td>
                                <td>{{ $historial->folio_cotizacion }}</td>
                                <td>{{ $historial->folio_proyecto }}</td>
                                <td>{{ $historial->description }}</td>
                                <td>${{ number_format($historial->estimated, 2) }}</td>
                                <td>${{ number_format($historial->investment, 2) }}</td>
                                <td>{{ $historial->commision_percent }}%</td>
                                <td>
                                    <a href="{{ route('show_sale', $historial->id) }}">Abrir</a>
                                    <a href="{{ route('proyecto.show', $historial->id) }}"><i
                                            class="icon icon-clock"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        @if (Auth::user()->rol_user_id == 1)
            <div class="row" style="background-color: white;p-3">
                <div class="col-md-12 p-2">
                    <a href="#" class="text-danger float-right"><span class="icon icon-bin"></span>Eliminar
                        cliente</a>
                </div>
            </div>
            <br>
        @endif
    </div>
    @include('clientes.edit')
    @include('clientes.nuevo_origen')
    @include('clientes.seguimientos')
    @include('clientes.iniciar_cotizacion_modal')
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#form_nuevo_origen").submit(function(e) {
                e.preventDefault();
                var nuevoOrigen = $("#txt_nuevo_origen").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('ajax_store_origen') }}",
                    data: $("#form_nuevo_origen").serialize()
                }).done(function(response) {
                    var html = `<option value>--Seleccione una opción--</option>`;
                    var cbo_create = $("#cbo_origin");
                    var cbo_edit_create = $("#cbo_edit_origin");
                    $.each(response, function(index, item) {
                        html += `<option value="${item.origen}">${item.origen}</option>`;
                    });
                    cbo_create.html(html);
                    cbo_edit_create.html(html);
                    $("#txt_nuevo_origen").val('');
                    $("#nuevo_origen_modal").modal('hide');
                    alertify.success("Registro almacenado");
                }).fail(function(jqXHR, textStatus,
                    errorThrown) {
                    console.log(jqXHR);
                });
            });

            $("#form_store_seguimiento_prospecto").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('ajax_store_seguimiento_prospecto') }}",
                    data: $("#form_store_seguimiento_prospecto").serialize(),
                }).done(function(response) {
                    var html = ``;
                    $.each(response, function(index, item) {
                        html += `
                        <div class="alert alert-secondary" role="alert">
                            <b>${item.author.name} ${item.author.middle_name} ${item.author.last_name}</b>
                            <p>${item.body}</p>
                            <small class="float-right">${item.created_at}</small><br>
                        </div>
                        `;
                    });
                    $("#caja_seguimientos").html(html);
                    $("#txt_body_seguimiento").val('');
                }).fail(function(jqXHR, textStatus,
                    errorThrown) {
                    console.log(jqXHR);
                });
            });

        });

        function editarCliente() {
            $("#editar_cliente_modal").modal('show');
        }

        function iniciarCotizacion() {
            $("#iniciar_cotizacion_modal").modal('show');
        }

        function nuevoOrigen() {
            $("#nuevo_origen_modal").modal();
        }

        function openSeguimientos(prospecto_id) {
            $("#txt_seguimiento_prospecto_id").val(prospecto_id);
            $.ajax({
                type: 'GET',
                url: "{{ url('ajax_open_seguimientos') }}",
                data: {
                    prospecto_id: prospecto_id
                },
            }).done(function(response) {
                var html = ``;
                $.each(response, function(index, item) {
                    html += `
                    <div class="alert alert-secondary" role="alert">
                        <b>${item.author.name} ${item.author.middle_name} ${item.author.last_name}</b>
                        <p>${item.body}</p>
                        <small class="float-right">${item.created_at}</small><br>
                    </div>
                    `;
                });
                $("#caja_seguimientos").html(html);
                $("#prospectos_seguimientos_modal").modal();
            }).fail(function(jqXHR, textStatus,
                errorThrown) {
                console.log(jqXHR);
            });
        }
    </script>
@endsection
