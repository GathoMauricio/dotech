@extends('layouts.app')
@section('content')
    <a href="{{ route('exportar_ultimos_seguimientos') }}" target="_BLANK" class="float-right">
        <i class="icon icon-download"></i>
        Exportar últimos
        <br>
        seguimientos (30+ días)
    </a>
    <h4 class="title_page">Prospectos de venta</h4>
    <br><br>
    <a href="javascript:void(0)" onclick="$('#prospectos_create_modal').modal();" class="btn btn-primary float-right">Crear</a>
    <br><br>
    <div style="width:200px;" class="float-right">
        <form action="#" method="POST">
            @csrf
            <table>
                <tr>
                    <select class="select2 form-control" onchange="verProspecto(this.value)">
                        <option value>--Buscar prospecto--</option>
                        @foreach ($prospectos_all as $key => $prospecto)
                            <option value="{{ $prospecto->id }}">{{ $prospecto->name }}</option>
                        @endforeach
                    </select>
                </tr>
            </table>
        </form>
    </div>
    {{ $prospectos->links('pagination::bootstrap-4') }}
    <table class="table">
        <thead>
            <tr>
                <th>Origen</th>
                <th>Porcentaje</th>
                <th>Nombre</th>
                <th>Responsable</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha de creación</th>
                <th>Vendedor asignado</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prospectos as $key => $prospecto)
                <tr>
                    <td>{{ $prospecto->origin }}</td>
                    <td>
                        {{ $prospecto->porcentaje }}%
                        <br>
                        Autor: <br>
                        {{ $prospecto->author->name }}
                        {{ $prospecto->author->middle_name }}
                        {{ $prospecto->author->last_name }}
                    </td>
                    <td>{{ $prospecto->name }}</td>
                    <td>{{ $prospecto->responsable }}</td>
                    <td>{{ $prospecto->email }}</td>
                    <td>{{ $prospecto->phone }}</td>
                    <td>{{ $prospecto->created_at }}</td>
                    <td>
                        {{ $prospecto->vendedor->name }} {{ $prospecto->vendedor->middle_name }}
                        @if (@Auth::user()->hasPermissionTo('editar_clientes'))
                            <br>
                            <a href="javascript:void(0);"
                                onclick="editarVendedor({{ $prospecto->id }},{{ $prospecto->vendedor->id }})">Editar</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('clientes.show', $prospecto->id) }}">Abrir</a><br>
                        <a href="javascript:void(0)" onclick="iniciarCotizacion({{ $prospecto->id }});">Iniciar
                            cotizacion</a><br>
                        <a href="javascript:void(0)"
                            onclick="openSeguimientos({{ $prospecto->id }})">({{ $prospecto->seguimientos->count() }})Seguimientos</a><br>
                        <a href="javascript:void(0)" onclick="editProspecto({{ $prospecto->id }})">Editar</a><br>
                        <a href="javascript:void(0)" onclick="eliminarProspecto({{ $prospecto->id }})">Eliminar</a><br>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $prospectos->links('pagination::bootstrap-4') }}
    @include('prospectos.create')
    @include('prospectos.edit')
    @include('prospectos.nuevo_origen')
    @include('prospectos.iniciar_cotizacion_modal')
    @include('prospectos.seguimientos')
    @include('clientes.editar_vendedor_modal')
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

        function nuevoOrigen() {
            $("#nuevo_origen_modal").modal();
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

        function verProspecto(prospecto_id) {
            if (prospecto_id.length > 0)
                window.location = "{{ url('clientes.show') }}/" + prospecto_id;
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
    </script>
@endsection
