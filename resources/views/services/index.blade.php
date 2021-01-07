@extends('layouts.app')
@section('content')
<h4 class="title_page">Expedientes de servicios pendientes</h4>
<div class="float-right">
    <a href="{{ route('processing_service') }}"> <span></span>Expedientes en proceso</a>
    &nbsp;&nbsp;
    <a href="{{ route('finished_service') }}"> <span></span>Expedientes Finalizados</a>
    &nbsp;&nbsp;
    <a href="{{ route('canceled_service') }}"> <span></span>Expedientes Cancelados</a>
</div>
<br>
<br>
<a href="{{ route('create_service') }}"class="float-right"> <span class="icon-plus"></span> Agregar expediente</a>
@if(count($services) <= 0) 
@include('layouts.no_records') 
@else 
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th width="10%">Exp.</th>
            <th width="10%">Autor</th>
            <th width="10%">Tipo</th>
            <th width="15%">Cliente</th>
            <th width="20%">Asunto</th>
            <th width="10%">Técnico</th>
            <th width="10%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->author['name'] }} {{ $service->author['middle_name'] }}</td>
            <td>{{ $service->type }}</td>
            <td>{{ $service->company['name'] }}</td>
            <td>{{ $service->subject }}</td>
            <td>{{ $service->technical['name'] }} {{ $service->technical['middle_name'] }}</td>
            <td>{{ formatDate($service->programed_at) }}</td>
            <td>
                <a href="#" onclick="followServiceModal({{ $service->id }})"><span class="icon-bubble"
                        title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                <br>
                <a href="{{ route('show_service') }}"><span class="icon-eye" title="Detalles"
                        style="cursor:pointer;color:#3498DB"> Detalles</span></a>
                <br>
                <a href="{{ route('edit_service') }}"><span class="icon-pencil" title="Editar"
                        style="cursor:pointer;color:#F39C12"> Editar</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteService({{ $service->id }})"><span class="icon-bin" title="Eliminar"
                        style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function(){
        $("#index_table").dataTable({
                deferRender: true,
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [[0, "desc"]],
                pageLength: 10,
                bDestroy: true,
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [7]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            setTableStyle()
    });
    function setTableStyle() {
        setTimeout(function() {
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "custom-select"
            );
            $(".dataTables_length").prepend("<b>Mostrar</b> ");
            $("select[name='table_asistencias_length']").prop(
                "class",
                "custom-select"
            );
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "form-control"
            );
            $(".dataTables_length").append(" <b>elementos por página</b>");
    
            $("input[type='search']").prop("class", "form-control");
            $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
        }, 300);
    }
    </script>
    @endif
    <input type="hidden" id="txt_delete_service_route" value="{{ route('delete_service') }}">
    @endsection