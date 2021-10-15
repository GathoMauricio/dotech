@extends('layouts.app')
@section('content')
<h4 class="title_page">Provedores de retiro</h4>
@include('config.menu')
<br>
<p>
    <a href="#" onclick="addProviderModal();" class="float-right"><span class="icon-plus"></span> Agregar nuevo</a>
</p>
<br>
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th >Nombre</th>
            <th >RFC</th>
            <th >Banco</th>
            <th >Cuenta</th>
            <th >Forma pago</th>
            
            
            <th >Ejecutivo</th>
            <th >Teléfono</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($whitdrawals as $whitdrawal)
        <tr>
            <td>{{ $whitdrawal->name }}</td>
            <td>{{ $whitdrawal->rfc }}</td>
            <td>{{ $whitdrawal->bank }}</td>
            <td>{{ $whitdrawal->account }}</td>
            <td>{{ $whitdrawal->pay_type }}</td>
            
            
            <td>{{ $whitdrawal->manager }}</td>
            <td>{{ $whitdrawal->phone }}</td>
            <td>
                <a href="{{ route('edit_provider',$whitdrawal->id) }}"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="#" onclick="deleteProvider({{ $whitdrawal->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                <br>
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
                aaSorting: [[0, "asc"]],
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

@include('withdrawal.add_provider_modal')
<input type="hidden" id="txt_delete_provider_route" value="{{ route('delete_provider') }}">
@endsection