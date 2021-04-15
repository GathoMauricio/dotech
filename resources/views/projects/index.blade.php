@extends('layouts.app')
@section('content')
<h4 class="title_page ">Proyectos</h4>
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th width="15%">Folio</th>
            <th width="15%">Compañía</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Precio</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>{{ $sale->description }}</td>
            <td>${{ $sale->estimated }}</td>
            <td>{{ onlyDate($sale->created_at) }}</td>
            <td>
                <!--
                <a href="{{ route('quote_products',$sale->id) }}"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>
                <br>
                <a href="#" onclick="changeStatusModal({{ $sale->id }});"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                
                <a href="#" onclick="editQuote({{ $sale->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                -->
                <a href="{{ route('binnacles_by_project',$sale->id) }}"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
                <br>
                <a href="{{ route('show_sale',$sale->id) }}"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
                <br>
                <a href="#" onclick="editProject({{ $sale->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="{{ route('sale_follows',$sale->id) }}"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $sale->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
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
                        aTargets: [5]
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
<input type="hidden" id="txt_delete_sale_route" value="{{ route('delete_sale') }}">
@include('projects.edit_project_modal')
@endsection