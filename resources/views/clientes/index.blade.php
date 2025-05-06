@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div style="width: 100%;">
                <a href="{{ route('exportar_ultimos_seguimientos') }}" target="_BLANK" class="float-right">
                    <i class="icon icon-download"></i>
                    Exportar últimos
                    <br>
                    seguimientos (30+ días)
                </a>
            </div>
            <div class="col-md-12">
                <h3>Catálogo de clientes</h3>
                <div style="width:200px;" class="float-right">
                    <table>
                        {{--  <tr>
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="select2 form-control" onchange="verProspecto(this.value)">
                                    <option value>--Buscar prospecto--</option>
                                    @foreach ($clientes_all as $key => $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </tr>  --}}
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label>Autor</label>
                                    <form action="{{ route('clientes') }}" id="form_buscar_autor">
                                        <select class="select2 form-control" onchange="buscarAutor(this.value);">
                                            <option value>--Buscar autor--</option>
                                            @foreach ($autores as $key => $autor)
                                                <option value="{{ $autor->id }}">{{ $autor->name }}
                                                    {{ $autor->middle_name }}
                                                    {{ $autor->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <form action="{{ route('clientes') }}" id="form_mira">
                                <div class="form-group">
                                    <label>En la mira</label>
                                    <select name="mira" onchange="$('#form_mira').submit();" class="form-control">
                                        @if (request()->mira and request()->mira == 'SI')
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO">NO</option>
                                            <option value="SI" selected>SI</option>
                                        @elseif(request()->mira and request()->mira == 'NO')
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO" selected>NO</option>
                                            <option value="SI">SI</option>
                                        @else
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO">NO</option>
                                            <option value="SI">SI</option>
                                        @endif
                                    </select>
                                </div>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{ route('clientes') }}" id="form_esporadico">
                                <div class="form-group">
                                    <label>Esporadico</label>
                                    <select name="esporadico" onchange="$('#form_esporadico').submit();"
                                        class="form-control">
                                        @if (request()->esporadico and request()->esporadico == 'SI')
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO">NO</option>
                                            <option value="SI" selected>SI</option>
                                        @elseif(request()->esporadico and request()->esporadico == 'NO')
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO" selected>NO</option>
                                            <option value="SI">SI</option>
                                        @else
                                            <option value>--Seleccione una opción--</option>
                                            <option value="NO">NO</option>
                                            <option value="SI">SI</option>
                                        @endif
                                    </select>
                                </div>
                            </form>
                        </tr>
                    </table>
                </div>

                {{--  <a href="{{ url('create_cliente') }}" class="btn btn-primary float-right">Nuevo</a>  --}}

                <div class="table-responsive">
                    {{ $clientes->links('pagination::bootstrap-4') }}
                    <br>
                    <select class="select2 form-control" onchange="verCliente(this.value)">
                        <option value>--Buscar cliente--</option>
                        @foreach ($clientes_all as $key => $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Origen</th>
                                <th>Porcentaje</th>
                                <th>Nombre</th>
                                <th>Responsable</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Vendedor asignado</th>
                                <th>En la mira</th>
                                <th>Esporadico</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $key => $cliente)
                                <tr>
                                    <td>
                                        {{ $cliente->origin }}
                                        <br>
                                        Autor: <br>
                                        {{ $cliente->author->name }}
                                        {{ $cliente->author->middle_name }}
                                        {{ $cliente->author->last_name }}
                                    </td>
                                    <td>
                                        {{ $cliente->porcentaje }}%
                                        <br>
                                        Vendedor: <br>
                                        {{ $cliente->vendedor->name }}
                                        {{ $cliente->vendedor->middle_name }}
                                        {{ $cliente->vendedor->last_name }}
                                    </td>
                                    <td>{{ $cliente->name }}</td>
                                    <td>{{ $cliente->responsable }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->phone }}</td>
                                    <td>
                                        {{ $cliente->vendedor->name }} {{ $cliente->vendedor->middle_name }}
                                        @if (@Auth::user()->hasPermissionTo('editar_clientes'))
                                            <br>
                                            <a href="javascript:void(0);"
                                                onclick="editarVendedor({{ $cliente->id }},{{ $cliente->vendedor->id }})">Editar</a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('cambiar_mira', $cliente->id) }}" method="POST"
                                            id="form_cambiar_mira_{{ $cliente->id }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="mira"
                                                onchange="$('#form_cambiar_mira_{{ $cliente->id }}').submit();">
                                                @if ($cliente->mira == 'NO')
                                                    <option value="NO" selected>NO</option>
                                                    <option value="SI">SI</option>
                                                @else
                                                    <option value="NO">NO</option>
                                                    <option value="SI" selected>SI</option>
                                                @endif
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('cambiar_esporadico', $cliente->id) }}" method="POST"
                                            id="form_cambiar_esporadico_{{ $cliente->id }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="esporadico"
                                                onchange="$('#form_cambiar_esporadico_{{ $cliente->id }}').submit();">
                                                @if ($cliente->esporadico == 'NO')
                                                    <option value="NO" selected>NO</option>
                                                    <option value="SI">SI</option>
                                                @else
                                                    <option value="NO">NO</option>
                                                    <option value="SI" selected>SI</option>
                                                @endif
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('clientes.show', $cliente->id) }}">Abrir</a><br>
                                        <a href="javascript:void(0)"
                                            onclick="iniciarCotizacion({{ $cliente->id }});">Iniciar
                                            cotizacion</a><br>
                                        <a href="javascript:void(0)"
                                            onclick="openSeguimientos({{ $cliente->id }})">({{ $cliente->seguimientos->count() }})Seguimientos</a><br>
                                        <a href="javascript:void(0)"
                                            onclick="editProspecto({{ $cliente->id }})">Editar</a><br>
                                        <a href="javascript:void(0)"
                                            onclick="eliminarProspecto({{ $cliente->id }})">Eliminar</a><br>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('clientes.editar_vendedor_modal')
    @include('prospectos.iniciar_cotizacion_modal')
    @include('prospectos.seguimientos')
    @include('prospectos.edit')
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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

        function eliminarProspecto(prospecto_id) {
            alertify
                .confirm(
                    "",
                    function() {
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('ajax_eliminar_prospecto') }}",
                            data: {
                                prospecto_id: prospecto_id
                            },
                        }).done(function(response) {
                            alert(response);
                            window.location.reload();
                        }).fail(function(jqXHR, textStatus,
                            errorThrown) {
                            console.log(jqXHR);
                        });
                    },
                    function() {

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

        function editProspecto(prospecto_id) {
            $("#txt_edit_prospecto_id").val(prospecto_id);
            $.ajax({
                type: 'GET',
                url: "{{ url('ajax_show_prospecto') }}",
                data: {
                    prospecto_id: prospecto_id
                },
            }).done(function(response) {
                console.log(response);
                $("#cbo_edit_origin").val(response.origin);
                $("#cbo_edit_porcentaje").val(response.porcentaje);
                $("#txt_edit_porcentaje").text(response.porcentaje + '%');
                $("#txt_edit_name").val(response.name);
                $("#txt_edit_responsable").val(response.responsable);
                $("#txt_edit_phone").val(response.phone);
                $("#txt_edit_email").val(response.email);
                $("#cbo_edit_status").val(response.status);
                $("#cbo_edit_author").val(response.author_id);
                $("#hidden_vendedor_id").val(response.vendedor_id);
                $("#prospectos_edit_modal").modal();
            }).fail(function(jqXHR, textStatus,
                errorThrown) {
                console.log(jqXHR);
            });
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

        function iniciarCotizacion(prospecto_id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('company_department_show_ajax') }}",
                data: {
                    id: prospecto_id
                },
            }).done(function(response) {
                console.log(response);
                var html = `<option value>--Seleccione una opción--</option>`;
                html += response.department_items;
                $("#cbo_prospecto_iniciar_cotizacion").html(html);
                $("#txt_iniciar_cotizacion_prospecto_id").val(prospecto_id);
                $("#iniciar_cotizacion_modal").modal('show');
            }).fail(function(jqXHR, textStatus,
                errorThrown) {
                console.log(jqXHR);
            });
        }

        function verCliente(cliente_id) {
            if (cliente_id.length > 0)
                window.location = "{{ url('clientes.show') }}/" + cliente_id;
        }

        function editarVendedor(cliente_id, vendedor_id) {
            $("#txt_cliente_id").val(cliente_id);
            $("#cbo_vendedor_id").val(vendedor_id);
            $("#editar_vendedor_modal").modal('show');
        }

        function guardarVendedor() {
            var clente_id = $("#txt_cliente_id").val();
            var vendedor_id = $("#cbo_vendedor_id").val();
            $.ajax({
                type: 'GET',
                url: '{{ route('editar_vendedor_cliente') }}/' + clente_id + '/' + vendedor_id,
                data: {},
                //contentType: 'application/json',
                success: function(data) {
                    console.log(data)
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }

        function buscarAutor(value) {
            if (value.length > 0) {
                window.location = "{{ route('clientes') }}?author_id=" + value;
            } else {
                window.location = "{{ route('clientes') }}";
            }
        }
    </script>
@endsection
