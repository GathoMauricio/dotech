@extends('layouts.app')
@section('content')
<h4 class="title_page ">Últimas salidas</h4>
@if(count($exits) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Autor</th>
            <th>Producto</th>
            <th>Cant.</th>
            <th>Descripción</th>
            <th>Estatus</th>
            @if(Auth::user()->rol_user_id == 1)
            <th></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($exits as $exit)
        <tr>
            <td>{{ formatDate($exit->created_at)  }}</td>
            <td>{{ $exit->author['name'].' '.$exit->author['middle_name'].' '.$exit->author['last_name'] }}</td>
            <td>{{ $exit->product['product'] }}</td>
            <td>{{ $exit->quantity }}</td>
            <td>{{ $exit->description }}</td>
            @if($exit->status == 'USANDO')
            <td class="font-weight-bold" style="color:orange;">{{ $exit->status }}</td>
            @endif
            @if($exit->status == 'DEVUELTO')
                <td class="font-weight-bold" style="color:#2ECC71">{{ $exit->status }}</td>
            @endif
            @if($exit->status == 'N/A')
                <td class="font-weight-bold">{{ $exit->status }}</td>
            @endif
            @if(Auth::user()->rol_user_id == 1)
            <td>
                @if($exit->status != 'N/A')
                <a href="#" onclick="changeStatusExitModal({{ $exit->id }});"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                @endif
                <a href="#" onclick="deleteStatusExit({{ $exit->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@include('product_exits.change_status_exit_modal')
<input type="hidden" id="txt_delete_status_exit_route" value="{{ route('delete_stock_product_exit') }}">
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
            aaSorting: [],
            pageLength: 10,
            bDestroy: true,
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [0,1,2,3,4,6]
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
