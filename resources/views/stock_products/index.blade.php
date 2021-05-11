@extends('layouts.app')
@section('content')
<br><br>
<a href="{{ route('stock_product_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar producto ]</a>
<h4 class="title_page">Almacén</h4>
@if(count($products) <= 0)
@include('layouts.no_records')
@else
<table class="table table-striped" id="index_table">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Categoría</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Con regreso</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>
            @if($product->image == 'product_stock.png')
            <img src="{{ asset('img') }}/{{ $product->image }}" width="100" />
            @else
            <img src="{{ asset('storage') }}/{{ $product->image }}" width="100" />
            @endif
            </td>
            <td>{{ $product->category['name'] }}</td>
            <td>{{ $product->product }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->return }}</td>
            <td>
                <a href="{{ route('stock_product_exit_index',$product->id) }}">
                    <span class="icon-share" title="Salidas..." style="cursor:pointer;color:blue">
                        Salidas
                    </span>
                </a>
                <br>
                @if(Auth::user()->rol_user_id == 1)
                <a href="{{ route('stock_product_edit',$product->id) }}">
                    <span class="icon-pencil" title="Editar..." style="cursor:pointer;color:orange">
                        Editar
                    </span>
                </a>
                <br>
                <a onclick="deleteStockProduct({{ $product->id }})" href="#">
                    <span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:red">
                        Eliminar
                    </span>
                </a>
                <br>
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
                aaSorting: [[2, "asc"]],
                pageLength: 10,
                bDestroy: true,
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [0,5]
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

<input type="hidden" id="txt_delete_binnacle_route" value="{{ route('stock_product_delete') }}">
@endif

@endsection