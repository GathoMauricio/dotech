@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">{{ $cliente->name }}</h3>
        <div class="row">
            <div class="col-md-8 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                @if (@Auth::user()->hasPermissionTo('editar_clientes'))
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
                        <span class="font-weight-bold">Web</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->web }}</div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Giro</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->giro }}</div>
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
                        <span class="font-weight-bold">Estatus</span>
                    </div>
                    <div class="col-md-6 p-2">{{ $cliente->status }}</div>
                </div>
                @if ($cliente->status == 'Prospecto')
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <span class="font-weight-bold">Autor</span>
                        </div>
                        <div class="col-md-6 p-2">
                            {{ $cliente->author->name }}
                            {{ $cliente->author->middle_name }}
                            {{ $cliente->author->last_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <span class="font-weight-bold">En la mira</span>
                        </div>
                        <div class="col-md-6 p-2">
                            <form action="{{ route('cambiar_mira', $cliente->id) }}" method="POST"
                                id="form_cambiar_mira_{{ $cliente->id }}">
                                @csrf
                                @method('PUT')
                                <select name="mira" onchange="$('#form_cambiar_mira_{{ $cliente->id }}').submit();">
                                    @if ($cliente->mira == 'NO')
                                        <option value="NO" selected>NO</option>
                                        <option value="SI">SI</option>
                                    @else
                                        <option value="NO">NO</option>
                                        <option value="SI" selected>SI</option>
                                    @endif
                                </select>
                            </form>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Vendedor</span>
                    </div>
                    <div class="col-md-6 p-2">
                        {{ $cliente->vendedor->name }}
                        {{ $cliente->vendedor->middle_name }}
                        {{ $cliente->vendedor->last_name }}
                    </div>
                </div>

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
                @if ($cliente->status == 'Cliente')
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <span class="font-weight-bold">Fecha cliente</span>
                        </div>
                        <div class="col-md-6 p-2">{{ $cliente->fecha_cliente }}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Cotizaciones</span>
                    </div>
                    <div class="col-md-6 p-2">
                        {{ $cliente->cotizaciones_proyectos->where('status', 'Pendiente')->count() }}
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
                    <div class="col-md-6 p-2">
                        {{ $cliente->cotizaciones_proyectos->where('status', 'Rechazada')->count() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                        <span class="font-weight-bold">Últ. Seguimiento</span>
                    </div>
                    <div class="col-md-6 p-2">
                        @if ($cliente->seguimientos->last())
                            {{ $cliente->seguimientos->last()->created_at }}
                        @else
                            Sin seguimientos
                        @endif
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

                            {{--  <th>&nbsp</th>  --}}

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente->cotizaciones_proyectos as $key => $historial)
                            <tr>
                                <td>{{ $historial->status }}</td>
                                <td>{{ $historial->created_at }}</td>
                                <td>{{ $historial->project_at }}</td>
                                <td>{{ $historial->finished_at }}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                        onclick="loadPdf({{ $historial->id }})">{{ $historial->folio_cotizacion }}</a>
                                </td>
                                <td>
                                    @if ($historial->folio_proyecto)
                                        <a
                                            href="{{ route('proyecto.show', $historial->id) }}">{{ $historial->folio_proyecto }}</a>
                                    @endif
                                </td>
                                <td>{{ $historial->description }}</td>
                                <td>${{ number_format($historial->estimated, 2) }}</td>
                                <td>${{ number_format($historial->investment, 2) }}</td>
                                <td>{{ $historial->commision_percent }}%</td>

                                {{--  <td>
                                        <a href="{{ route('proyecto.show', $historial->id) }}">Abrir</a>
                                    </td>  --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>

        {{--  @if (@Auth::user()->hasPermissionTo('eliminar_clientes'))  --}}
        @if ($cliente->status == 'Prospecto')
            <div class="row" style="background-color: white;p-3">
                <div class="col-md-12 p-2">
                    <a href="javascript:void(0);" onclick="eliminarCliente({{ $cliente->id }})"
                        class="text-danger float-right"><span class="icon icon-bin"></span>Eliminar
                        {{ $cliente->status }}
                    </a>
                    <form action="{{ route('eliminar_cliente', $cliente->id) }}"
                        id="form_eliminar_cliente_{{ $cliente->id }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
            <br>
        @endif
        {{--  @endif  --}}
    </div>
    @include('clientes.edit')
    @include('clientes.nuevo_origen')
    @include('clientes.seguimientos')
    @include('clientes.iniciar_cotizacion_modal')
    @include('wire.quotes.pdf')
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/pdf/pdfobject.js') }}"></script>
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
                            <small class="float-right">${item.tipo_seguimiento}</small><br>
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
        @if (@Auth::user()->hasPermissionTo('editar_clientes'))
            function editarCliente() {
                $("#editar_cliente_modal").modal('show');
            }
        @endif
        {{--  @if (@Auth::user()->hasPermissionTo('eliminar_clientes'))  --}}

        function eliminarCliente(cliente_id) {
            alertify
                .confirm(
                    "",
                    function() {
                        $("#form_eliminar_cliente_" + cliente_id).submit();
                    },
                    function() {
                        //alertify.error('Cancel');
                    }
                )
                .set("labels", {
                    ok: "Si, eliminar!",
                    cancel: "Cancelar"
                })
                .set({
                    transition: "flipx",
                    title: "Alerta",
                    message: "¿Eliminar registro?",
                });
        }
        {{--  @endif  --}}

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
                        <small class="float-right">${item.tipo_seguimiento}</small><br>
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

        function loadPdf(id) {
            PDFObject.embed("{{ route('load_sale_pdf') }}/" + id, "#content_pdf");
            $("#full_modal_pdf").css('display', 'block');
        }
    </script>
    <style>
        .pdfobject-container {
            height: 90vh;
        }
    </style>
@endsection
