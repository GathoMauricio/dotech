@extends('layouts.app')
@section('content')
<h4 class="title_page ">Proyectos</h4>
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Compañía</th>
            <th>Inversión</th>
            <th>Estimado</th>
            <th>Descriptción</th>
            <th>Observación</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ formatDate($sale->created_at) }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>${{ $sale->investment }}</td>
            <td>${{ $sale->estimated }}</td>
            <td>{{ $sale->description }}</td>
            <td>{{ $sale->observation }}</td>
            <td><a href="{{ route('show_sale',$sale->id) }}">Ver cotización>></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
                        aTargets: [6]
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
@endsection