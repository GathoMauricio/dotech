@extends('layouts.app')
@section('content')
    <h4 class="title_page">Prospectos de venta</h4>
    <br><br>
    <a href="javascript:void(0)" onclick="$('#prospectos_create_modal').modal();" class="btn btn-primary float-right">Crear</a>
    <br><br>
    <div style="width:200px;" class="float-right">
        <form action="#" method="POST">
            @csrf
            <table>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Buscar..."></td>
                    <td><button type="submit" class="btn btn-primary"><span class="icon icon-search"></span></button></td>
                </tr>
            </table>
        </form>
    </div>
    {{ $prospectos->links('pagination::bootstrap-4') }}
    <table class="table">
        <thead>
            <tr>
                <th>Origen</th>
                <th>Nombre</th>
                <th>Responsable</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha de creación</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prospectos as $key => $prospecto)
                <tr>
                    <td>{{ $prospecto->origin }}</td>
                    <td>{{ $prospecto->name }}</td>
                    <td>{{ $prospecto->responsable }}</td>
                    <td>{{ $prospecto->email }}</td>
                    <td>{{ $prospecto->phone }}</td>
                    <td>{{ $prospecto->created_at }}</td>
                    <td>
                        <a href="javascript:void(0)">(0)Seguimientos</a><br>
                        <a href="javascript:void(0)">Cotizar</a><br>
                        <a href="javascript:void(0)" onclick="editProspecto({{ $prospecto->id }})">Editar</a><br>
                        <a href="javascript:void(0)">Eliminar</a><br>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $prospectos->links('pagination::bootstrap-4') }}
    @include('prospectos.create')
    @include('prospectos.edit')
    @include('prospectos.nuevo_origen')
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
                    cbo_edit_create.htmlm(html);
                    $("#txt_nuevo_origen").val('');
                    $("#nuevo_origen_modal").modal('hide');
                    alertify.success("Registro almacenado");
                }).fail(function(jqXHR, textStatus,
                    errorThrown) {
                    console.log(jqXHR);
                });
            });
        });

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
                $("#txt_edit_name").val(response.name);
                $("#txt_edit_responsable").val(response.responsable);
                $("#txt_edit_phone").val(response.phone);
                $("#txt_edit_email").val(response.email);
                $("#cbo_edit_status").val(response.status);
                $("#prospectos_edit_modal").modal();
            }).fail(function(jqXHR, textStatus,
                errorThrown) {
                console.log(jqXHR);
            });
        }
    </script>
@endsection
